<?php
/**
 * 用户
 */
namespace model;

class User extends Model {
    protected $table = 'user_info';

    public function loadUserByNameAndPwd($name, $pwd){
        $result = $this->getOne("SELECT * FROM " . $this->_tableName . " Where `username` = ? AND `password` = ? ", array($name, $pwd));

        return $result;
    }
}