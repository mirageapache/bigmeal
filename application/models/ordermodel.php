<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OrderModel extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    //新增暫存訂單
    function generate_temp_order($order_id,$total,$user_id){
    	date_default_timezone_set('Asia/Taipei');
        $this->db->insert("temp_order_list",Array(
                "order_id" => strtoupper($order_id),
                "total" => $total,
                "user_id" => $user_id,
                "order_time" => date('Y-m-d H:i:s')
            ));
    	return 'success';
    }

    //新增訂單內容
    function generate_order_content($order_id,$data){
        foreach ($data as $value) {
            $this->db->insert("order_content",Array(
                "order_id" => $order_id,
                "product_id" => $value->id,
                "amount" => $value->amount,
                "sub_total" => $value->sub_total
            ));
        }
      return 'success';
    }

    // 新增訂單
    function generate_order($user_id,$name,$post_code,$address,$phone,$email,$deliver_type,$pay_type){
    	// get temp order
		$this->db->select('order_id,total');
    	$this->db->from('temp_order_list');
    	$this->db->where(array('user_id'=>$user_id));
    	$query = $this->db->get();
    	$order_id = $query->row()->order_id;
		$total = $query->row()->total;

        date_default_timezone_set('Asia/Taipei');
        $this->db->insert("order_list",Array(
                "order_id" => $order_id,
                "state" => 0,
                "total" => $total,
                "deliver_type" => $deliver_type,
                "pay_type" => $pay_type,
                "order_time" => date('Y-m-d H:i:s'),
                "pay_time" => null,
                "deliver_time" => null,
                "finish_time" => null,
                "user_id" => $user_id,
                "name" => $name,
                "post_code" => $post_code,
                "address" => $address,
                "phone" => $phone,
                "email" => $email
            ));

        $this->db->delete('temp_order_list', array('user_id' => $user_id));

        return $order_id;
    }

    // 查詢未完成訂單
    function get_temp_order($user_id){
    	$this->db->select('order_id');
    	$this->db->from('temp_order_list');
    	$this->db->where(array('user_id'=>$user_id));
    	$query = $this->db->get();

    	if($query->num_rows() > 0){
    		return true;
    	}
    	else{
    		return false;
    	}
    }

    // 查詢單筆訂單資訊(order_list)
    function get_order($order_id){
    	$this->db->select('*');
    	$this->db->from('order_list');
    	$this->db->where(array('order_id'=>$order_id));
    	$query = $this->db->get();

    	return $query->row_array();
    }

    // 查詢訂單列表
    function get_order_list($condition,$start_date,$end_date,$sort_prop,$order_by,$user_id){
        $this->db->select('order_id,state,total,order_time,name');
        $this->db->from('order_list');
        $this->db->where(array('user_id'=>$user_id));
        if(!empty($condition)){
            $this->db->like(array('order_id'=>$condition));
            $this->db->or_like(array('name'=>$condition));
        }
        if(!empty($start_date)){
            $this->db->where('order_time >', $start_date);
        }
        if(!empty($end_date)){
            $this->db->where('order_time <', $end_date);
        }
        $this->db->order_by($sort_prop, $order_by);

        $query = $this->db->get();

        return $query->result_array();
    }

    // 查詢訂單內容(order_content)
    function get_order_content($order_id){
        $this->db->select('products.name,order_content.sub_total,order_content.amount');
        $this->db->from('order_content');
        $this->db->join('products','order_content.product_id = products.product_id');
        $this->db->where(array('order_content.order_id'=>$order_id));
        $query = $this->db->get();

        return $query->result_array();
    }

}