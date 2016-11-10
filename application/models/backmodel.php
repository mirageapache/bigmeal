<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class BackModel extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    // 查詢總覽資料
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

        // 會員總數
        $this->db->select('*');
        $this->db->from('user');
        $query = $this->db->get();
        $user_num = $query->num_rows();
        $data['user_num'] = number_format($user_num);

    	return $data;
    }
    
    // 查詢資料總筆數
    function page_count($table,$filter){
        $this->db->select('*');
        $this->db->from($table);
        if($table == 'user'){
            $this->db->like('account',$filter);
        }
        else if($table == 'products'){
            $this->db->like('name',$filter);
            $this->db->or_like('b_type',$filter);
            $this->db->or_like('s_type',$filter);
        }
        else if($table == 'order_list'){
            $this->db->like('order_id',$filter);
            $this->db->or_like('order_time',$filter);
        }
            
        $query = $this->db->get();
        return $query->num_rows();
    }

    // 查詢會員列表
    function get_user_data($filter,$n,$m){
        $this->db->select('ID,account,state,user_type,create_day');
        $this->db->from('user');
        $this->db->like('account',$filter);
        $this->db->limit($m,$n);
        $query = $this->db->get();
        
        return $query->result_array();
    }

    // 查詢會員內容
    function get_user_detail($user_id){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('user_info','user.ID = user_info.user_id', 'left');
        $this->db->where('ID', $user_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    // 修改會員內容
    function modify_user_detail($user_id,$user_type){
        $this->db->where('ID',$user_id);
        $this->db->update('user',array('user_type' => $user_type));

        $this->db->select('user_type');
        $this->db->from('user');
        $this->db->where('ID', $user_id);
        $query = $this->db->get();
        return $query->row()->user_type;
    }

    // 查詢產品列表
    function get_product_data($filter,$n,$m){
        $this->db->select('product_id,name,b_type,s_type,price,stock');
        $this->db->from('products');
        $this->db->like('name',$filter);
        $this->db->or_like('b_type',$filter);
        $this->db->or_like('s_type',$filter);
        $this->db->limit($m,$n);
        $query = $this->db->get();
        
        return $query->result_array();
    }

    // 新增產品
    function insert_product($product_id,$name,$price,$stock,$place,$b_type,$s_type,$unit,$description,$standard){
        $this->db->insert('products',array(
            'product_id'=>$product_id,
            'name' => $name,
            'price' => $price,
            'stock' => $stock,
            'place' => $place,
            'b_type' => $b_type,
            's_type' => $s_type,
            'unit' => $unit,
            'description' => $description,
            'standard' => $standard
            ));
        
        return $product_id;
    }

    // 新增產品圖片
    function insert_product_img($img_id,$product_id,$img_name){
        $this->db->insert('product_img',array(
            'img_id'=>$img_id,
            'product_id'=>$product_id,
            'img_name' => $img_name,
            'path' => '/data/products'
            ));
        
        return $product_id;
    }

    // 查詢產品內容
    function get_product_detail($product_id){
        $this->db->select('*');
        $this->db->from('products');
        $this->db->join('product_img','products.product_id = product_img.product_id');
        $this->db->where('products.product_id',$product_id);
        $query = $this->db->get();
        
        return $query->result_array();
    }

    // 修改產品
    function modify_product($product_id,$name,$price,$stock,$place,$b_type,$s_type,$unit,$description,$standard){
        $this->db->where('product_id',$product_id);
        $this->db->update('products',array(
            'name' => $name,
            'price' => $price,
            'stock' => $stock,
            'place' => $place,
            'b_type' => $b_type,
            's_type' => $s_type,
            'unit' => $unit,
            'description' => $description,
            'standard' => $standard));
        return 'success';
    }

    // 修改產品圖片
    function modify_product_img($img_id,$img_name){
        $this->db->where('img_id',$img_id);
        $this->db->update('product_img',array('img_name' => $img_name,'path' => '/data/products'));
    }

    // 刪除產品
    function delete_product($data_array){
        foreach ($data_array as $id) {
            $this->db->delete('products', array('product_id' => $id));
            $this->db->delete('product_img', array('product_id' => $id));
        }
        return 'success';
    }


    // 查詢訂單列表
    function get_order_data($filter,$n,$m){
        $this->db->select('order_id,state,total,order_time');
        $this->db->from('order_list');
        $this->db->like('order_id',$filter);
        $this->db->or_like('order_time',$filter);
        $this->db->order_by('order_time','desc');
        $this->db->limit($m,$n);
        $query = $this->db->get();
        
        return $query->result_array();
    }
   
    // 查詢產品內容
    function get_order_detail($order_id){
        $this->db->select('order_list.*,user.account');
        $this->db->from('order_list');
        $this->db->join('user','order_list.user_id = user.ID');
        $this->db->where('order_list.order_id',$order_id);
        $query = $this->db->get();
        
        return $query->result_array();
    }

    function modify_order($order_id,$state){
        date_default_timezone_set('Asia/Taipei');
        $this->db->where('order_id',$order_id);
        if($state == 1){ //等待出貨
            $this->db->update('order_list',array(
                'state' => $state));
        }
        else if ($state == 2) { //已出貨
            $this->db->update('order_list',array(
                'state' => $state,
                'deliver_time' => date('Y-m-d H:i:s')));
        }
        else if ($state == 3) { //已付款
            $this->db->update('order_list',array(
                'state' => $state,
                'pay_time' => date('Y-m-d H:i:s')));
        }
        else if ($state == 9) { //已完成
            $this->db->update('order_list',array(
                'state' => $state,
                'finish_time' => date('Y-m-d H:i:s')));
        }

        return 'success';
    }

}