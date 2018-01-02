<?php
/**
 * 用户
 */
namespace model;
use core\Model;

class Users extends Model {
    protected $table = 'users';
    protected $primaryKey = 'id';
    private $tokenkey = 'blog12n';

    /**
     * 根据名称，加载用户
     */
    public function loadUserByName($name){
        $result = $this->getOne("SELECT * FROM " . $this->table . " Where `name` = ? ", array($name));

        return $result;
    }

    /**
     * 生成token
     */
    public function createToken($user){
        return md5($user['id'] . '-' . $user['password'] . '-' . $this->tokenkey) . '.' . time().$user['id'];
    }

    /**
     * 校验token
     */
    public function checkToken($token){
        // 格式示例： 5bcb0db9dafe0c50375b7c0e15cdc28b.1426993172
        // md5(userid-password-time-tokenkey).time+userid
        // md5(123-pwd-1426993172-blog12n).1426993172123

        if(empty($token)) {
            return false;
        }
        $ret = explode('.', $token);
        $tk = isset($ret[0]) ? $ret[0] : '';
        if(!isset($tk) || empty($tk)){
            return false;
        }
        $time_uid = isset($ret[1]) ? $ret[1] : '';
        $time = substr($time_uid, 0, 10);
        $uid = substr($time_uid, 10);
        if(!isset($uid) || empty($uid) || !isset($time) || empty($time)) {
            return false;
        }
        $user = $this->getObjByPrimaryKey($uid);
        if(empty($user)){
            return false;
        }
        $checkToken = md5($uid . '-' . $user['password'] . '-' . $this->tokenkey) . '.' . $time_uid;
        if($checkToken != $token){
            return false;
        }

        return true;
    }
}