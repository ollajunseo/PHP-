<?php

class Search_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	//게시판 불러오기
	public function selectBoard($limit, $offset)
	{
		$this->db->order_by('num', 'desc');
		$query = $this->db->get('company_info', $limit, $offset);
		return $query->result();
	}
	//검색
	public function selectSearchBoard($selectKeyword)
	{
		$this->db->like('company_nm', $selectKeyword);
		$this->db->or_like('company_address', $selectKeyword);
		$this->db->or_like('Business_num', $selectKeyword);

		$query = $this->db->get('company_info');
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return array();
		}
	}
}
?>
