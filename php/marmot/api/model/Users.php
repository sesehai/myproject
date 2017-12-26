<?php
/**
 * 用户
 */
namespace model;
use core\Model;

class Users extends Model {
    protected $table = 'users';
    protected $primaryKey = 'id';

    /**
     * 根据名称，加载用户
     */
    public function loadUserByName($name){
        $result = $this->getOne("SELECT * FROM " . $this->table . " Where `name` = ? ", array($name));

        return $result;
    }
}