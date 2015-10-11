<?php
/**
 * Created by PhpStorm.
 * User: Arathi
 * Date: 2015/10/11
 * Time: 18:26
 */

class Draw_result_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_draw_results()
    {
        $query = $this->db->get('draw_results');
        return $query->result_array();
    }

    public function get_newest_draw_result()
    {
        $this->db->limit(1);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('draw_results');
        return $query->row_array();
    }

    public function add_all_draw_results($drawResults)
    {
        $this->db->trans_begin();
        //truncate掉draw_results表
        $this->db->truncate('draw_results');
        //把$drawResults的所有值insert进去
        foreach ($drawResults as $drawResult)
        {
            $this->db->insert('draw_results', $drawResult);
        }
        //提交事务
        $this->db->trans_commit();
    }

    public function add_draw_results_not_exists($drawResults)
    {
        $this->db->trans_begin();
        //把$drawResults的所有值insert进去
        foreach ($drawResults as $drawResult)
        {
            //查找
            $this->db->where('id', $drawResult['id']);
            $this->db->from('draw_results');
            if ( $this->db->count_all_results()>0 )
            {
                //如果该数据已经存在，则跳过
                continue;
            }
            //插入
            $this->db->insert('draw_results', $drawResult);
        }
        //提交事务
        $this->db->trans_commit();
    }
}
