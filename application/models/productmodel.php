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

        return $query->result_array();
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
            echo $act;
        }
        else{
            $new_stock = $old_stock - $amount;
        }
        $this->db->where('product_id',$id);
        $this->db->update("products",Array("stock" => $new_stock));
    }
}
