<?php
/**
 * 文章
 */
namespace model;
use core\Model;

class Articles extends Model {
    protected $table = 'articles';
    protected $primaryKey = 'id';

    public function list($page, $pagesize){
        $result = array(
            'totalRows' => 0,
            'totalPages' => 0,
            'currentPage' => $page,
            'rows' => array()
        );
        $start = ($page - 1) <= 0 ? 0 : ($page - 1);
        $sql = 'select * from ' . $this->table . ' order by ctime desc ' . ' limit ' . $start . ',' . $pagesize ;
        $result['rows'] = $this->query($sql, array());
        $sql_count = 'select count(id) as `total` from ' . $this->table;
        $total_row = $this->getOne($sql_count, array());
        $result['totalRows'] = $total_row['total'];
        $result['totalPages'] = intval($result['totalRows']/$pagesize);
        
        return $result;
    }

}