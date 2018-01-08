<?php
/**
 * 文章
 */
namespace model;
use core\Model;

class Articles extends Model {
    protected $table = 'articles';
    protected $primaryKey = 'id';

    public function list($page, $pagesize, $tag = '', $date = ''){
        $result = array(
            'totalRows' => 0,
            'totalPages' => 0,
            'currentPage' => $page,
            'rows' => array()
        );
        $start = ($page - 1) <= 0 ? 0 : ($page - 1)*$pagesize;
        $sql = 'select distinct a.* from ' . $this->table . ' a ';
        $sql .= ' left join tag_maps tm on tm.article_id = a.id ';
        $sql .= ' left join tags t on tm.tag_id = t.id ';
        $sql .= '  where 1   ';
        if(!empty($tag)){
            $sql .= ' and t.id = ' . $tag . ' ';
        }
        if(!empty($date)){
            $sql .= ' and DATE_FORMAT(a.ctime, \'%Y-%m\') = \'' . $date . '\' ';
        }
        $sql .= ' order by ctime desc ' . ' limit ' . $start . ',' . $pagesize ;
        $result['rows'] = $this->query($sql, array());
        $sql_count = 'select count(id) as `total` from ' . $this->table;
        $total_row = $this->getOne($sql_count, array());
        $result['totalRows'] = $total_row['total'];
        $result['totalPages'] = ceil($result['totalRows']/$pagesize);
        
        return $result;
    }

    /**
     * 按日期分组
     */
    public function groupArticleByDate(){
        $sql = "select DATE_FORMAT(ctime, '%Y-%m') as `m`, count(id) as num from ". $this->table ." group by DATE_FORMAT(ctime, '%Y-%m')";
        $result = $this->query($sql, array());

        return $result;
    }

    /**
     * 按日期分组 列表
     */
    public function groupArticleListByDate(){
        $result = array();
        $sql = "select DATE_FORMAT(ctime, '%Y-%m') as `m`, count(id) as num from ". $this->table ." group by DATE_FORMAT(ctime, '%Y-%m')";
        $group = $this->query($sql, array());
        foreach($group as $val){
            $result[] = array(
                'group_month' => $val['m'],
                'group_num' => $val['num'],
                'rows' => $this->query("select * from ". $this->table ." where DATE_FORMAT(ctime, '%Y-%m') = '".$val['m']."'", array()),
            );
        }

        return $result;
    }

    /**
     * 获取
     */
    public function getArticle($article){
        $sql = "select * from ". $this->table . " where 1 ";
        $param = array();
        foreach($article as $key=>$val){
            $sql .= " and `" .$key. "` = ? ";
            $param[] = $val;
        }

        $result = $this->getOne($sql, $param);

        return $result;
    }

    /**
     * 详情
     */
    public function getDetail($id){
        $article = $this->getObjByPrimaryKey($id);
        $tags = $this->query("select t.id, t.name from tags t left join tag_maps tm on t.id = tm.tag_id where tm.article_id = ? ",array($id));
        $article['tags'] = $tags;
        $tagAry = array();
        foreach($tags as $item){
            $tagAry[] = $item['name'];
        }
        $article['tagStr'] = implode(',', $tagAry);
        $article['prev'] = $this->getOne("select * from " . $this->table . " where id < " . $article['id'] . " limit 1 ", array());
        $article['next'] = $this->getOne("select * from " . $this->table . " where id > " . $article['id'] . " limit 1 ", array());
        return $article;
    }

}