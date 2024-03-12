<?php

class Logout extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}
	//로그아웃
	public function destroySession()
	{
		$res = $this->session->sess_destroy();
	}

}
?>
