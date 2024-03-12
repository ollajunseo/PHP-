<?php

class SearchBoard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model("search_model");
	}

	//로그인 정보가 없을때 접속불가
	public function company_Info($offset = 0)
	{
		$data = array(
			'mem_id' => $this->session->userdata('mem_id'),
		);
		$selectKeyword = $this->input->post('searchKeyword');

		if (!$data['mem_id']) {
			echo "<script> alert('로그인을 해주세요')</script>";
			echo "<script>location.replace('/web/main')</script>";
		} else if (!empty($selectKeyword)) {
			$data['company_info'] = $this->search_model->selectSearchBoard($selectKeyword);
			echo json_encode($data['company_info']);
		} else {
			$this->load->library('pagination');
			$total_rows = $this->db->count_all('company_info');
			// 페이징 설정
			$per_page = isset($_COOKIE['per_page']) ? intval($_COOKIE['per_page']) : 100;
			$config['total_rows'] = $total_rows;
			$config['per_page'] = $per_page;
			$config['uri_segment'] = 3;
			$this->pagination->initialize($config);

			$current_page = intval($this->uri->segment(3)) ? intval($this->uri->segment(3)) : 1;

			$pagination['pages'] = array();
			for ($i = 1; $i <= ceil($total_rows / $config['per_page']); $i++) {
				$pagination['pages'][] = array(
					'num' => $i,
					'is_current' => ($i == $current_page),
					'url' => ('/web/searchBoard/company_Info/' . $i)
				);
			}
			$data['pagination'] = $pagination;

			$limit = $config['per_page'];
			$offset = ($current_page - 1) * $limit;
			$data['company_info'] = $this->search_model->selectBoard($limit, $offset);
			$data['pagination']['prev_page'] = ($current_page > 1) ? ('/web/searchBoard/company_Info/' . ($current_page - 1)) : FALSE;
			$data['pagination']['next_page'] = ($current_page < ceil($total_rows / $config['per_page'])) ? ('/web/searchBoard/company_Info/' . ($current_page + 1)) : FALSE;

			$this->load->view('pages/searchPage.html', $data);
		}
	}



}
?>
