<?php
namespace core;

Class Model{
    protected $table = '';
    protected $primaryKey = 'id';

    public function __construct(){
    }

    public function getTable(){
        return $this->table;
    }

    public function getPrimaryKey(){
        return $this->primaryKey;
    }

    public function getDb($db = 'db'){
        $dbConfig = Dispatcher::$config[$db];
        return Db::instance($dbConfig);
    }

    public function insert($data){
        $result = '';
        $db = $this->getDb();
        $db->connect();
        $fieldStr = '';
        $fieldValStr = '';
        $valueAry = array();
        if( isset($data) && !empty($data) ){
            foreach($data as $key=>$value){
                $fieldStr .= " `{$key}`,";
                $fieldValStr .= " ?,";
                $valueAry[] = $value;
            }
            $fieldStr = substr($fieldStr,0,-1);
            $fieldValStr = substr($fieldValStr,0,-1);
        }
        $sql = "INSERT INTO `{$this->getTable()}`({$fieldStr}) VALUES({$fieldValStr})";
        $db->prepare($sql);
        $result = $db->execute($valueAry);
        $db->disConnect();
        return $result;
    }

    public function query($sql, $valueAry){
        $db = $this->getDb();
        $db->connect();
        $db->prepare($sql);
        $result = $db->execute($valueAry);
        $row = $db->fetchAll();
        $db->disConnect();
        return $row;
    }

    public function getOne($sql, $valueAry){
        $db = $this->getDb();
        $db->connect();
        $db->prepare($sql);
        $result = $db->execute($valueAry);
        $row = $db->fetchOne();
        $db->disConnect();
        return $row;
    }

    public function update($condition, $conditionValAry, $data){
        $result = '';
        $db = $this->getDb();
        $db->connect();
        $fieldValStr = '';
        $valueAry = array();
        if( isset($data) && !empty($data) ){
            foreach($data as $key=>$value){
                $fieldValStr .= " `{$key}` = ?,";
                $valueAry[] = $value;
            }
        }
        $fieldValStr = substr($fieldValStr,0,-1);
        foreach ($conditionValAry as $value) {
            $valueAry[] = $value;
        }
        $sql = "UPDATE `{$this->getTable()}` SET {$fieldValStr}  WHERE {$condition} ";
        $db->prepare($sql);
        $result = $db->execute($valueAry);
        $db->disConnect();
        return $result;
    }

    public function delete($condition, $valueAry){
        $db = $this->getDb();
        $db->connect();
        $sql = "DELETE  FROM `{$this->getTable()}` WHERE {$condition} ";
        $db->prepare($sql);
        $result = $db->execute($valueAry);
        $db->disConnect();
        return $result;
    }

    /**
     * 新增
     */
    public function addObj($objAry){
        return $this->insert($objAry);
    }

    /**
     * 删除
     */
     public function deleteObj($id){
        $condition = " `" . $this->primaryKey ."` = ? ";
        $valueAry = array($id);
        return $this->delete($condition, $valueAry);
     }

     /**
      * 更新
      */
     public function updateObj($objAry){
        $condition = " `" . $this->primaryKey ."` = ? ";
        $conditionValAry = array($objAry[$this->primaryKey]);
        unset($objAry[$this->primaryKey]);
        return $this->update($condition, $conditionValAry, $objAry);
     }

     /**
      * 加载信息
      */
     public function getObjByPrimaryKey($id){
        return $this->getOne("SELECT * FROM " . $this->table . " where `". $this->primaryKey ."` = ? ", array($id));
     }

     public function saveObj($objAry){
        if( isset($objAry[$this->primaryKey]) && !empty($objAry[$this->primaryKey]) ){
            return $this->updateObj($objAry);
        }else{
            return $this->addObj($objAry);
        }
     }

}