<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function get_all()
	{
		$this->db->select('id, username, email, first_name, last_name')
			->from('users');
		return $this->db->get();
	}

	private function _datatable($fillable=array())
	{
        # start query
		$this->db->select($fillable)
			->from('users');
		# searching
		if (!empty( $_GET['search']['value'] )) {
			foreach ($fillable as $f) {
				$this->db->or_like('LOWER('.$f.')', strtolower($_GET['search']['value']), 'BOTH');
			}
		}
	}

	public function get_datatable($fillable)
	{
		$this->_datatable($fillable);
		# ordering
		if(!empty($_GET['order'][0])) 
        {
        	$this->db->order_by( $fillable[ $_GET['order'][0]['column'] ], $_GET['order'][0]['dir'] );
        }
        # paging
		if ($this->input->get('length') != -1 && !empty($this->input->get('length'))) {
			$this->db->limit($this->input->get('length'), $this->input->get('start'));
		}
		return $this->db->get();		
	}

	public function count_filtered($fillable)
	{
		$this->_datatable($fillable);
		return $this->db->get()->num_rows();
	}

	public function count_all()
	{
		$this->db->from('users');
		return $this->db->get()->num_rows();
	}

}

/* End of file User_model.php */
/* Location: ./application/modules/template/models/User_model.php */