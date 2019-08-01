<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends MY_Controller {
	
	protected $template = 'template';
	
	public function __construct()
	{
		parent::__construct();
		is_login_admin();
		$this->load->helper('Crud_helper');
	}
}
