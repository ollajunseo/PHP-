<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_save extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
	public function save_pageData() {
		if($this->input->post('per_page')) {
			$per_page = intval($this->input->post('per_page'));
			setcookie('per_page', $per_page, time() + (86400 * 30), "/");
			echo "success";
		} else {
			echo "error";
		}
	}
}
?>
