<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Content-type: text/xml');
header('Pragma: public');
header('Cache-control: private');
header('Expires: -1');
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>";

class Rss extends CI_Controller {

	/**
	*@access public
	*Function to generate RSS Feed for latest 10 news
	**/
	public function index() {
		$data['result'] = $this->common_model->getLatestNewsList();
		$this->load->view('rss', $data);
	}

	
}
