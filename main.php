<?php

class Main extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}
	// 기본 화면
	public function index()
	{
		$data = array(
			'mem_id'  	 => $this->session->userdata('mem_id'),
			'mem_nm'   	 => $this->session->userdata('mem_nm'),
			'mem_birth'  => $this->session->userdata('mem_birth'),
			'mem_date'   => $this->session->userdata('mem_date'),
		);
		$this->load->view("/pages/mainpage.html",$data);
	}
}
?>

