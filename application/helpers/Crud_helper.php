<?php 
if (!function_exists('responses')) {
	function responses($data)
	{
		$CI =& get_instance();
		$CI->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}