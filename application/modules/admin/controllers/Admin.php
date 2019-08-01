<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Admin_Controller {

	public function index()
	{
		$data['title'] = 'Admin Dashboard';
		$data['content'] = 'template/singapp/content';
		$data['load_js'] = array(			
			base_url('assets/js/widget.js'),
		); 

		echo modules::run($this->template, $data);
	}

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */