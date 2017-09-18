<?php
namespace core;

Class Model{
    protected $table = '';

    public function __construct(){
    }

    public function getTable(){
        return $this->table;
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

}