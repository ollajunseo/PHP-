<?php

class Signup extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sign_up_model');
	}

	public function insertId()
	{
		$this->load->view('/pages/signup.html');
	}
	//회원가입
	public function insertMember()
	{
		$members_id 		= $_POST['members_id'];
		$members_nm 		= $_POST['members_nm'];
		$members_pw 		= $_POST['members_pw'];
		$members_email 		= $_POST['members_email'];
		$members_birth 		= $_POST['members_birth'];
		$members_date 		= date('Y-m-d H:i:s');

		$res = $this->sign_up_model->insertData($members_id, $members_nm, $members_pw, $members_email, $members_birth, $members_date);

		if ($res) {
			echo json_encode(array("request" => "success"));
		} else {
			echo json_encode(array("request" => "fail"));
		}
	}
	// 아이디 중복확인
	public function checkId()
	{
		$check_id = $_POST['checkId'];
		$res = $this->sign_up_model->selectCheckId($check_id);

		if ($res) {
			echo json_encode(array("result" => "success"));
		} else {
			echo json_encode(array("result" => "fail"));
		}
	}
}
?>

