<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	protected $template = 'template';
	public $data = [];

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('Crud_helper');
		$this->load->library('form_validation');	
		$this->form_validation->set_error_delimiters('- ','<br>');	
	}

	public function index()
	{
		if (!$this->ion_auth->logged_in()) {
			echo modules::run('template/login');
		} else {
			redirect(base_url('admin'),'refresh');
		}
	}

	public function signin($value='')
	{
		$remember = (bool)$this->input->post('remember');

		if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
		{
			$json_data = array(
				'success' => true,
				'msg' => 'Berhasil masuk',
				'data' => null
			);
		}
		else
		{
			$json_data = array(
				'success' => false,
				'msg' => 'Pengguna atau Kata Sandi tidak benar',
				'data' => null
			);
		}

		responses($json_data);
	}

	public function signout($value='')
	{
		$this->ion_auth->logout();
		$this->index();
	}

	public function users()
	{
		is_login();

		$data['title'] = 'Auth Users';
		$data['content'] = 'admin/auth/index';
		$data['load_js'] = array(			
			base_url('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js'),
			base_url('assets/vendor/datatables/media/js/jquery.dataTables.min.js'),
			'https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js',
			'https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js',
			base_url('assets/vendor/bootstrap/js/dist/modal.js'),
			base_url('assets/js/widget.js'),
			base_url('assets/js/views/users.js'),
		); 
		$data['load_css'] = array(
			'https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css',
			'https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css'
		);

		echo modules::run($this->template, $data);
	}


	public function users_json()
	{
		is_login();

		$this->load->model('admin/User_model', 'user');
		$fillable = array('id', 'username', 'email', 'first_name', 'last_name');
		
		$data = $this->user->get_datatable($fillable)->result();
		$nested_data = array();
		$no = $this->input->get('start')+1;

		foreach ($data as $key => $value) {
			array_push($nested_data, [
				$no++, 
				$value->username, 
				$value->email, 
				$value->first_name.' '.$value->last_name,
				'<button type="button" class="btn btn-secondary btn-xs" onclick="edit(\''.$value->id.'\')"><i class="glyphicon glyphicon-pencil"></i> Ubah</a></button>' . '&nbsp;' .
				'<button type="button" class="btn btn-danger btn-xs" onclick="destroy(\''.$value->id.'\')"><i class="glyphicon glyphicon-trash"></i> Hapus</a></button>'
			]);
		}

		$json_data = array(
	        "draw"            => intval($this->input->get('draw')),  
	        "recordsTotal"    => intval($this->user->count_all()),  
	        "recordsFiltered" => intval($this->user->count_filtered($fillable)), 
	        "data"            => $nested_data   
        );

        responses($json_data);
	}

	public function store()
	{
		is_login();

		$tables = $this->config->item('tables', 'ion_auth');
		$identity_column = $this->config->item('identity', 'ion_auth');
		$this->data['identity_column'] = $identity_column;

		// validate email and password
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]', array('required' => 'Kolom email tidak boleh kosong', 'valid_email' => 'Email tidak valid', 'is_unique' => 'Email sudah terdaftar'));
		$this->form_validation->set_rules('password', 'Kata Sandi', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[password_confirm]', array('required' => 'Kolom kata sandi tidak boleh kosong', 'min_length' => 'Panjang kata sandi minimal '.$this->config->item('min_password_length', 'ion_auth').' karakter', 'matches' => 'Kata sandi tidak sesuai'));
		$this->form_validation->set_rules('password_confirm', 'Konfirmasi Kata Sandi', 'required', array('required' => 'Kolom konfirmasi kata sandi tidak boleh kosong'));

		if ($this->form_validation->run() === false)
		{
			$json_data = array(
				'success' => false,
				'msg' =>  validation_errors(),
				'data' => null
			);

		} else {
			$email = strtolower($this->input->post('email'));
			$identity = $email;
			$password = $this->input->post('password');

			$additional_data = [
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'company' => $this->input->post('company'),
				'phone' => $this->input->post('phone'),
			];

			$this->ion_auth->register($identity, $password, $email, $additional_data);
			
			$json_data = array(
				'success' => true,
				'msg' => 'Berhasil mencatat data baru',
				'data' => null
			);
		}

		responses($json_data);
	}

	public function user_edit_json()
	{
		is_login();

		$id = $this->input->get('id');
		$user = $this->ion_auth->user($id)->row();
		
		$data = array(
			'success' => true,
			'msg' => 'ok',
			'data' => $user
		);

		responses($data);
	}

	public function update()
	{
		is_login();

		$id = $this->input->post('id');
		$user = $this->ion_auth->user($id)->row();
		$groups = $this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();
			
		//USAGE NOTE - you can do more complicated queries like this
		//$groups = $this->ion_auth->where(['field' => 'value'])->groups()->result_array();
	
		// update the password if it was posted
		if ($this->input->post('password')) {
			$this->form_validation->set_rules('password', 'Kata Sandi', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[password_confirm]', array('required' => 'Kolom kata sandi tidak boleh kosong', 'min_length' => 'Panjang kata sandi minimal '.$this->config->item('min_password_length', 'ion_auth').' karakter', 'matches' => 'Kata sandi tidak sesuai'));
			$this->form_validation->set_rules('password_confirm', 'Konfirmasi Kata Sandi', 'required', array('required' => 'Kolom konfirmasi kata sandi tidak boleh kosong'));
		}

		if ($this->input->post('password') && $this->form_validation->run() === false) {
			$json_data = array(
				'success' => false,
				'msg' =>  validation_errors(),
				'data' => null
			);
		} else {
			$data = [
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'company' => $this->input->post('company'),
				'phone' => $this->input->post('phone'),
			];

			// update the password if it was posted
			if ($this->input->post('password')) {
				$data['password'] = $this->input->post('password');
			}

			// Only allow updating groups if user is admin
			// if ($this->ion_auth->is_admin()) {
			// 	// Update the groups user belongs to
			// 	$this->ion_auth->remove_from_group('', $id);
				
			// 	$groupData = $this->input->post('groups');
			// 	if (isset($groupData) && !empty($groupData)) {
			// 		foreach ($groupData as $grp)
			// 		{
			// 			$this->ion_auth->add_to_group($grp, $id);
			// 		}

			// 	}
			// }

			$this->ion_auth->update($user->id, $data);

			$json_data = array(
				'success' => true,
				'msg' => 'Berhasil memperbarui data',
				'data' => null
			);
		}

		responses($json_data);
	}

	public function destroy()
	{		
		is_login();
		
		$this->db->where('id', $this->input->get('id'))->delete('users');
		$data = array(
			'success' => true,
			'msg' => 'ok',
			'data' => null
		);

		responses($data);
	}

}

/* End of file Auth.php */
/* Location: ./application/modules/admin/controllers/Auth.php */