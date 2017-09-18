<?php
/**
 * 问题
 */
namespace model;
use core\Model;

class Question extends Model {
    protected $table = 'question';

    public function loadList($category){
        $result = $this->query("SELECT * FROM " . $this->getTable() . " Where `category` = ? ", array($category));
        return $result;
    }
}