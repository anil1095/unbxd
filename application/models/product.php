<?php
class Product extends CI_Model {

	private $table	=	'product';

	/**
	 * inserts a new entry in product table
	 *
	 * @author Anil
	 * @param integer $pid
	 * @param string $name
	 * @param string $store
	 * @param integer $cat_id
	 * @return integer last inserted id
	 */
	function insertNewProduct($pid,$name,$store,$cat_id = 0){
		$product_arr = array(
			'product_id'=> $pid
			,'name'		=> $name
			,'store'	=> $store
			,'cat_id'	=> $cat_id
		);
		
		$this->db->insert($this->table, $product_arr);
		
		if ($this->db->_error_message()){
			$err_msg = $this->db->_error_message();
			$err_num = $this->db->_error_number();
			log_message('error',$err_num.' : '.$err_msg.'. It happened during inserting new product with following details : '.http_build_query($product_arr,'num_') );
			return 0;
		}else
			return $this->db->insert_id();
	}
}