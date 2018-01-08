<?php
/**
 * 标签
 */
namespace model;
use core\Model;

class Tags extends Model {
    protected $table = 'tags';
    protected $primaryKey = 'id';

    /**
     * 保存
     */
    public function saveTag($tag){
        $dbTag = $this->getOne("SELECT * FROM " . $this->table . " where `name` = ? ", array($tag['name']));
        if(!$dbTag){
            $this->addObj($tag);
            $dbTag = $this->getOne("SELECT * FROM " . $this->table . " where `name` = ? ", array($tag['name']));
        }
        return $dbTag;
    }

    /**
     * 列表
     */
    public function list(){
        return $this->query("select * from " . $this->table, array());
    }

}