<?php

class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->load->library('session');
		$this->load->helper('url');
	}
	//로그인 기능
	public function memberLogin()
	{
		$userid 			= $_POST['mem_id'];
		$userpassword 		= $_POST['mem_pw'];

		$res = $this->login_model->selectMember($userid, $userpassword);

		if ($res && isset($res['mem_id'])) {
			// 로그인 성공
			$this->session->set_userdata('mem_id', $res['mem_id']);
			$this->session->set_userdata('mem_nm', $res['mem_nm']);
			$this->session->set_userdata('mem_birth', $res['mem_birth']);
			$this->session->set_userdata('mem_email', $res['mem_email']);
			$this->session->set_userdata('mem_date', $res['mem_date']);
			echo json_encode(array("success" => true));
		} else {
			echo json_encode(array("success" => false));
		}
	}
}
?>
