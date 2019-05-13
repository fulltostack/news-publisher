<?php
ob_start();
 
if(!function_exists('is_user_in')) {
	function is_user_in() {
		$CI =& get_instance();
		$is_logged_in = $CI->session->userdata('is_user_in');
		if(!isset($is_logged_in) || $is_logged_in != true) {
		    redirect(base_url());
		}
	}
}			

// Function response alert messages
if(!function_exists('show_response_alert_messages')) {
	function show_response_alert_messages() {
		$CI =& get_instance();
		$success = $CI->session->flashdata('success');
		$info    = $CI->session->flashdata('info');
		$warning = $CI->session->flashdata('warning');
		$error   = $CI->session->flashdata('error');
		?>
		<?php if(isset($success)) { ?>
		<div class="alert alert-success">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <strong>Success!</strong> <?php echo $success; ?>
		</div>
		<?php } ?>
		<?php if(isset($info)) { ?>
		<div class="alert alert-info">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <strong>Info!</strong> <?php echo $info; ?>
		</div>
		<?php } ?>
		<?php if(isset($warning)) { ?>
		<div class="alert alert-warning">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <strong>Warning!</strong> <?php echo $warning; ?>
		</div>
		<?php } ?>
		<?php if(isset($error)) { ?>
		<div class="alert alert-danger">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <strong>Error!</strong> <?php echo $error; ?>
		</div>
		<?php } ?>
		<?php
	}
}

if(!function_exists('get_username_by_id')) {
	function get_username_by_id($id="") {
		$CI =& get_instance();
		$result = "";
		if($id=="")
			return $result;
		$sql = "SELECT first_name, last_name FROM users WHERE id = ".$id;
		$query = $CI->db->query($sql);
		if($query->num_rows()>0) {
			$row = $query->row();
			$result = trim($row->first_name." ".$row->last_name);
		}
		return $result;
	}
}

if(!function_exists('split_on')) {
	function split_on($string, $num=85, $type="first") {
		$length = strlen($string);
		if($length<=$num && $type == "first")
			return $string;

		$output[0] = substr($string, 0, $num);
		$output[1] = substr($string, $num, $length );
		if($type == "first")
			return $output[0].'...';
		else
			return $output;
	}
}

if(!function_exists('nohtml')) {
	function nohtml($message) {
	    $message = trim($message);
	    $message = strip_tags($message);
	    $message = htmlspecialchars($message, ENT_QUOTES);
	    return $message;
	}
}

if(!function_exists('stripHTMLtags')) {
	function stripHTMLtags($str) {
	    $t = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($str));
	    $t = htmlentities($t, ENT_QUOTES, "UTF-8");
	    return $t;
	}
}

if(!function_exists('return_availabel_news_url')) {
	function return_availabel_news_url($url_link="") {
		$url_link = preg_replace('!\s+!', ' ', $url_link);
		$url_link = str_replace(' ', '-', strtolower(trim($url_link)));
		$url_link = preg_replace('/[`~!@#$%\^&*()+={}[\]\\\\|;:\'",.><?\/]/', '-', $url_link);
		return _check_availabel_news_url($url_link);
	}
}

if(!function_exists('_check_availabel_news_url')) {
	function _check_availabel_news_url($url_link="") {
		$CI =& get_instance();
		$sql = "SELECT slug FROM news WHERE slug = '".$url_link."'";
		$query = $CI->db->query($sql);
		if($query->num_rows()>0) {
			if(strpos($url_link,"-") !== false) {
				$ended = end(explode('-', $url_link));
				if (is_numeric($ended)) {
					$newended = intval($ended)+1;
					$new_url_link = str_replace($ended, '', $url_link).$newended;
				} else {
					$newended = rand(1,9);
					$new_url_link = $url_link.'-'.$newended;
				}
			} else {
				$newended = rand(1,9);
				$new_url_link = $url_link.'-'.$newended;			
			}
			return _check_availabel_news_url($new_url_link);
		} else {
			return $url_link;
		}
	}
}

if(!function_exists('imageManupulationCI')) {
	function imageManupulationCI($upload_path, $image) {
		$CI =& get_instance();
	    $CI->load->library('image_lib');
	    $config = array();
	    $config['image_library'] = 'gd2';
	    $config['source_image'] = $upload_path.'/'.$image;
	    //$config['new_image'] = $CI->settings->info->upload_path.'/'.$image;
	    $config['create_thumb'] = FALSE;
	    $config['maintain_ratio'] = TRUE;
	    $config['width']     = 900;
	    $config['height']   = 300;

	    $CI->image_lib->clear();
	    $CI->image_lib->initialize($config);
	    $CI->image_lib->resize();
	}
}

?>