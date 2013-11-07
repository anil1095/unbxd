<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * this function will load the home page where a seach input field with autocomplete is available
	 * 
	 * @author Anil
	 */
	public function index()
	{
		$this->load->view('home');
	}
	
	/**
	 * will display information about a product
	 * 
	 * @author Anil
	 */
	public function display($pid){
		$q = $this->db->where('product_id', $pid)->get('product');
		$pdata = $q->row();
		
		$q = $this->db->where('product_id', $pid)->get('product_models');
		$mdata = $q->result();
		
		$this->load->model('category','c');
		$cat_data = $this->c->getParentsUptoCertainLevel($pdata->cat_id, 2);
		
		//echo '<pre>';print_r($pdata);echo '</pre>';
		//echo '<pre>';print_r($cat_data);echo '</pre>';
		//echo '<pre>';print_r($mdata);echo '</pre>';exit;
		$this->load->view('details',array(
			'product'	=> $pdata
			,'cats'		=> $cat_data
			,'models'	=> $mdata
		));
	}
	
	public function saveUploadedFile(){
		set_time_limit(60 * 60);
		
		$file_handle = fopen("./temp/movies-catalog.csv", "r");
		$i = 0;
		
		$this->load->model('category','c');
		$this->load->model('Product','p');
		$this->load->model('Product_models','pm');
		
		$cat_arr = array();
		
		//reading the first line so that we dont loop thorough titles
		$new_line = fgetcsv($file_handle, 0);
		
		while (!feof($file_handle) ) {
			$new_line = fgetcsv($file_handle, 0);
			
			$prod_name =  preg_replace('!\s+!', ' ', trim($new_line[2]));
			$stor_name =  preg_replace('!\s+!', ' ', trim($new_line[3]));
			$pcat_name =  preg_replace('!\s+!', ' ', trim($new_line[4]));
			$scat_name =  preg_replace('!\s+!', ' ', trim($new_line[5]));
			
			$scat_id = 0;
			$parent_cat_id = 0;
			
			if(array_key_exists($pcat_name, $cat_arr))
				$parent_cat_id = $cat_arr[$pcat_name]['id'];
			else{
				$parent_cat_id = $this->c->insertNewCategory($pcat_name, 0);
				$cat_arr[$pcat_name] = array(
					'id' => $parent_cat_id
					,'sub' => array()
				);
			}
			
			if(array_key_exists($scat_name, $cat_arr[$pcat_name]['sub']))
				$scat_id = $cat_arr[$pcat_name]['sub'][$scat_name];
			else{
				$scat_id = $this->c->insertNewCategory($scat_name, $parent_cat_id);
				$cat_arr[$pcat_name]['sub'][$scat_name] = $scat_id;
			}
			
			$pid = 0;
			$model_id = 1;
			
			$id_arr = explode('-', preg_replace('!\s+!', ' ', trim($new_line[1])));

			$pid = intval(substr($id_arr[0], 6));
			$model_id = intval($id_arr[1]);
			
			if($pid){
				if($model_id == 1){
					$this->p->insertNewProduct($pid,$prod_name,$stor_name,$scat_id);
				}
				
				$this->pm->insertNewModel($pid,intval($new_line[7]),intval($new_line[6]));
			}
		}
		
		fclose($file_handle);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */