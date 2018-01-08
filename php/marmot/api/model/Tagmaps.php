<?php
/**
 * 标签、文章映射关系
 */
namespace model;
use core\Model;

class Tagmaps extends Model {
    protected $table = 'tag_maps';
    protected $primaryKey = '';

    public function save($articleId, $tagId){
        $dbObj = $this->getOne("SELECT * FROM " . $this->table . " where `article_id` = ? and `tag_id` = ? ", array($articleId, $tagId));
        if(!$dbObj){
            $this->addObj(array('article_id'=>$articleId, 'tag_id'=>$tagId));
            $dbObj = $this->getOne("SELECT * FROM " . $this->table . " where `article_id` = ? and `tag_id` = ? ", array($articleId, $tagId));
        }
        return $dbObj;
    }
}