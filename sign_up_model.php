<?php

class Sign_up_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	// 회원가입
	public function insertData($members_id, $members_nm, $members_pw, $members_email, $members_birth, $members_date)
	{
		$data = array(
			'mem_id' => $members_id,
			'mem_nm' => $members_nm,
			'mem_pw' => $members_pw,
			'mem_email' => $members_email,
			'mem_birth' => $members_birth,
			'mem_date' => $members_date
		);
		$this->db->insert('members', $data);
		return $this->db->affected_rows() > 0;
	}
	// 중복확인
	public function selectCheckId($check_id)
	{
		$this->db->where('mem_id', $check_id);
		$query = $this->db->get('members');
		// 결과 반환
		return $query->num_rows() > 0;
	}
}

?>
