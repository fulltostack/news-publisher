<?php
/*ob_start();
$xml = new SimpleXMLElement('<xml/>');
if(isset($result) && !empty($result)) {
    foreach ($result as $key => $row) {
		$item = $xml->addChild('item');
		$item->addChild('title',nohtml($row->title));
		$item->addChild('description',nohtml($row->text));
	} 
}
Header('Content-type: text/xml');
print($xml->asXML());*/
header("Content-Type: application/rss+xml; charset=ISO-8859-1");
$rssfeed = '<?xml version="1.0" encoding="ISO-8859-1"?>';
$rssfeed .= '<rss version="2.0">';
$rssfeed .= '<channel>';
$rssfeed .= '<title>'.lang('ctn_108').'</title>';
$rssfeed .= '<link>'.base_url().'</link>';
$rssfeed .= '<description>'.lang('ctn_101').' '.lang('ctn_108').'</description>';
$rssfeed .= '<language>en-us</language>';
$rssfeed .= '<copyright>Copyright (C) 2017 '.lang('ctn_1').'</copyright>';
if(isset($result) && !empty($result)) {
    foreach ($result as $key => $row) {
    	$rssfeed .= '<item>';
        $rssfeed .= '<title>' . $row->title . '</title>';
        $rssfeed .= '<description>' . nohtml($row->text) . '</description>';
        $rssfeed .= '<link>' . base_url('newspdf/'.$row->slug) . '</link>';
        $rssfeed .= '<author>' . get_username_by_id($row->user_id) . '</author>';
        $rssfeed .= '<pubDate>' . date("D, d M Y H:i:s O", strtotime($row->created_date)) . '</pubDate>';
        $rssfeed .= '</item>';
	}
} else {
	$rssfeed .= '<item>'.lang('ctn_205').'</item>';
}

$rssfeed .= '</channel>';
$rssfeed .= '</rss>';
echo $rssfeed;
?>