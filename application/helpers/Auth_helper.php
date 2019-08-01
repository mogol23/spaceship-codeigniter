<?php

if (! function_exists('is_login_admin')) {
	function is_login_admin()
	{
		$CI =& get_instance();
	    if (!$CI->ion_auth->logged_in())
		{
			// redirect them to the login page
		    redirect(base_url('admin/auth'));
		}
		else if (!$CI->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			show_error('You must be an administrator to view this page.');
		}
	}
}

if (! function_exists('is_login')) {
	function is_login()
	{
		$CI =& get_instance();
	    if (!$CI->ion_auth->logged_in())
		{
			// redirect them to the login page
		    redirect(base_url('admin/auth'));
		}
	}
}

if (! function_exists('user')) {
	function user($val)
	{
		$CI =& get_instance();
		return $CI->ion_auth->user()->row()->$val;
	}
}