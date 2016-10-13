<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ProductModel extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function get_product(){
    	$this->db->select('products.product_id, products.name, products.price, product_img.img_name, product_img.path');
    	$this->db->from('products');
    	$this->db->join('product_img', 'products.product_id = product_img.product_id');
    	$query = $this->db->get();

        $result = $query->result_array();
        return $result;
    }

    function get_product_detail($id){
    	$this->db->select('*');
    	$this->db->from('products');
    	$this->db->join('product_img', 'products.product_id = product_img.product_id');
    	$this->db->where(array('products.product_id'=>$id));
    	$query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    function check_amount($id,$amount){
        $this->db->select('price,stock');
        $this->db->from('products');
        $this->db->where(array('products.product_id'=>$id));
        $query = $this->db->get();
        
        if($amount > $query->row()->stock){
            return false; //庫存不足
        }
        else{
            return $query->row()->price;
        }
    }

    function generate_order($order_id,$user_id,$total){
        date_default_timezone_set('Asia/Taipei');
        $this->db->insert("order_list",Array(
                "order_id" => $order_id,
                "state" => 0,
                "total" => $total,
                "order_time" => date('Y-m-d H:i:s'),
                "pay_time" => null,
                "deliver_time" => null,
                "finish_time" => null,
                "user_id" => $user_id
            ));

      return 'success';
    }

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


    //修改資料
    // $this->db->where('user_id',$user_id);
    // $this->db->update("user_info",Array(
    //     "name" => $name,
    //     "telephone" => $telephone,
    //     "cellphone" => $cellphone,
    //     "address" => $address,
    //     "email" => $email
    // ));

    // return 'success';

}
