<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	/**
	*@access public
	*Function to display latest news
	**/
	public function index() {
		$data['site_title'] = lang('ctn_1').': '.lang('ctn_2');
		$data['result'] = $this->common_model->getLatestNewsList();
		$this->load->view('header', $data);
		$this->load->view('index');
		$this->load->view('footer');
	}

	/**
	*@access public
	*Function for show single news
	* Accept Params : slug(text)
	**/
	public function news() {
		$slug = $this->uri->segment(2);
		if($slug=="") {
			$this->session->set_flashdata('error', lang('error_2'));
			redirect('');
		}
		$data['row'] = $this->common_model->getNewsBySlug($slug);
		if(empty($data['row'])) {
			$this->session->set_flashdata('error', lang('error_2'));
			redirect('');
		}
		$data['result'] = $this->common_model->getLatestNewsList();
		$data['site_title'] = lang('ctn_1').': Home';
		$this->load->view('header', $data);
		$this->load->view('news');
		$this->load->view('footer');
	}

	/**
	*@access public
    * Generate PDF File
    * @return Response
   	*/
   	public function newspdf() {
   		$slug = $this->uri->segment(2);
		if($slug=="") {
			$this->session->set_flashdata('error', lang('error_2'));
			redirect('');
		}
		$data['row'] = $this->common_model->getNewsBySlug($slug);
		if(empty($data['row'])) {
			$this->session->set_flashdata('error', lang('error_2'));
			redirect('');
		}
		$data['site_title'] = lang('ctn_1').': Home';

		$this->load->helper('pdf_helper');

	    tcpdf();
		$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$title = lang('ctn_1');;
		$obj_pdf->SetTitle($title);
		//$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
		$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title);
		$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$obj_pdf->SetDefaultMonospacedFont('helvetica');
		$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$obj_pdf->SetFont('helvetica', '', 9);
		$obj_pdf->setFontSubsetting(false);
		$obj_pdf->AddPage();
		ob_start();
		    // we can have any view part here like HTML, PHP etc
			$content = $this->load->view('newspdf', $data, true);
		ob_end_clean();
		$obj_pdf->writeHTML($content, true, false, true, false, '');
		$obj_pdf->Output('output.pdf', 'I');
   }
}
