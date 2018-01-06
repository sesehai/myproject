<?php
/**
 * 标签、文章映射关系
 */
namespace model;
use core\Model;

class Comments extends Model {
    protected $table = 'tag_maps';
    protected $primaryKey = '';

    /**
     * 删除
     */
    public function deleteObj($aid, $tid){
        $condition = " where `article_id` = ? and `tag_id` = ? ";
        $valueAry = array($aid, $tid);
        return $this->delete($condition, $valueAry);
     }

     /**
      * 更新
      */
     public function updateObj($objAry){
        $condition = " where `article_id` = ? and `tag_id` = ? ";
        $conditionValAry = array($aid, $tid);
        return $this->update($condition, $conditionValAry, $objAry);
     }

     /**
      * 加载信息
      */
     public function getObjByPrimaryKey($id){
        return $this->getOne("SELECT * FROM " . $this->_tableName . " where `article_id` = ? and `tag_id` = ? ", array($aid, $tid));
     }
}