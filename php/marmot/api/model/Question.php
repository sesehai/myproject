<?php
/**
 * 问题
 */
namespace model;
use core\Model;

class Question extends Model {
    protected $table = 'question';

    public function loadList(){
        $result = $this->query("SELECT * FROM " . $this->getTable() . " ORDER BY id DESC" , array());
        return $result;
    }

    public function insert($data)
    {
        return parent::insert($data);
    }
}