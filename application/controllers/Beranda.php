<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

	public function index() {
		$data = array(
			'title' => "Your title"
		);
		$this->load->view('beranda', $data);
	}
}
?>