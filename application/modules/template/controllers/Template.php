<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends MY_Controller {

	public function index($data=array())
	{
		// $data['title'] = 'Laman Test';
		$data['sidebar'] = 'template/singapp/sidebar';
		$data['topbar'] = 'template/singapp/topbar';
		// $data['content'] = 'template/singapp/content';

		$this->load->view('singapp/backbone', $data);
	}

	public function login($data=array())
	{
		$this->load->view('singapp/login', $data);
	}

}

/* End of file Template.php */
/* Location: ./application/modules/template/controllers/Template.php */