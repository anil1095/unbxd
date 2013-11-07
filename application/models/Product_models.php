<?php
class Product_models extends CI_Model {

	private $table	=	'product_models';

	/**
	 * inserts a new entry in product table
	 *
	 * @author Anil
	 * @param integer $pid
	 * @param integer $shipping_duration
	 * @param integer $price
	 * @return integer true if success else false
	 */
	function insertNewModel($pid,$shipping_duration,$price){
		$product_arr = array(
			'product_id'	=> $pid
			,'shipping_duration'=> $shipping_duration
			,'price'		=> $price
		);
		
		$this->db->insert($this->table, $product_arr);
		
		if ($this->db->_error_message()){
			$err_msg = $this->db->_error_message();
			$err_num = $this->db->_error_number();
			log_message('error',$err_num.' : '.$err_msg.'. It happened during inserting new product model with following details : '.http_build_query($product_arr,'num_') );
			return FALSE;
		}else
			return TRUE;
	}
}