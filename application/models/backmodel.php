<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class BackModel extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function get_overview_data() {
    	date_default_timezone_set('Asia/Taipei');
    	$current_day = date('Y-m-d');
    	// 瀏覽數
    	$this->db->select('*');
    	$this->db->from('user_log');
    	$this->db->like('time',$current_day);
    	$query = $this->db->get();
    	$views = $query->num_rows();
    	$data['views'] = number_format($views);

    	// 訂單數
    	$this->db->select('*');
    	$this->db->from('order_list');
    	$this->db->like('order_time',$current_day);
    	$query = $this->db->get();
    	$orders = $query->num_rows();
    	$data['orders'] = number_format($orders);

    	// 營收
    	$this->db->select('SUM(total) as total');
    	$this->db->from('order_list');
    	$this->db->like('order_time',$current_day);
    	$query = $this->db->get();
    	$turnover = $query->row()->total;
    	$data['turnover'] = number_format($turnover);

        // 熱門產品
        $sql = 'select T1.name as popular from products as T1 Join
                (SELECT order_list.order_id, order_content.product_id as product_id, SUM( order_content.amount ) as amount , order_list.order_time
                FROM order_list
                JOIN order_content
                WHERE order_list.order_id = order_content.order_id
                group by order_content.product_id
                order by amount desc) as T2
                where T1.product_id = T2.product_id limit 0,1';
        $query = $this->db->query($sql);
        $data['popular'] = $query->row()->popular;

        // 會員總  數
        $this->db->select('*');
        $this->db->from('user');
        $query = $this->db->get();
        $user_num = $query->num_rows();
        $data['user_num'] = number_format($user_num);

    	return $data;
    }
    
   
}