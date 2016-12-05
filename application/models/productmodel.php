<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ProductModel extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    // 查詢產品列表
    function get_product($filter){
    	$this->db->select('products.product_id, products.name, products.price, product_img.img_name, product_img.path');
    	$this->db->from('products');
    	$this->db->join('product_img', 'products.product_id = product_img.product_id','left');
        if (!is_null($filter) && $filter <> 'all') {
            $this->db->like('name',$filter);
            $this->db->or_like('b_type',$filter);
            $this->db->or_like('s_type',$filter);
        }
    	$query = $this->db->get();
        return $query->result_array();
    }

    // 查詢產品內容
    function get_product_detail($id){
    	$this->db->select('*');
    	$this->db->from('products');
    	$this->db->join('product_img', 'products.product_id = product_img.product_id','left');
    	$this->db->where(array('products.product_id'=>$id));
    	$query = $this->db->get();
        if($query->num_rows() > 0){
            $result = $query->row();
            return $result;
        }
        else{
            return 'null';
        }
    }

    function check_amount($id,$amount){
        $this->db->select('price,stock');
        $this->db->from('products');
        $this->db->where(array('product_id'=>$id));
        $query = $this->db->get();

        if($amount > $query->row()->stock){
            return false; //庫存不足
        }
        else{
            return $query->row()->price;
        }
    }

    //修正產品庫存量
    function stock_change($id,$amount,$act){ 
        $this->db->select('stock');
        $this->db->from('products');
        $this->db->where(array('product_id'=>$id));
        $query = $this->db->get();
        $old_stock = $query->row()->stock; //舊庫存量
        if($act == '+'){
            $new_stock = $old_stock + $amount;
        }
        else{
            $new_stock = $old_stock - $amount;
        }
        $this->db->where('product_id',$id);
        $this->db->update("products",Array("stock" => $new_stock));
    }

    //陣列資料修正產品庫存量
    function stock_change_array($data_array){ 
        foreach ($data_array as $value) {
            $this->db->select('stock');
            $this->db->from('products');
            $this->db->where(array('product_id'=>$value['id']));
            $query = $this->db->get();
            $old_stock = $query->row()->stock; //舊庫存量
            $new_stock = $old_stock + $value['amount'];
            $this->db->where('product_id',$value['id']);
            $this->db->update("products",Array("stock" => $new_stock));
        }
    }
}
