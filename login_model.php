<?php

class Login_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	//로그인
	public function selectMember($userid, $userpassword)
	{
		$this->db->select('*');
		$this->db->where('mem_id', $userid);
		$this->db->where('mem_pw', $userpassword);
		$query = $this->db->get('members');
		return $query->row_array();
	}
}
?>
