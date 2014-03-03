<?php
define('WP_USE_THEMES', false); 
$dirname = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
require($dirname.'/wp-blog-header.php'); 

function readthelastline($file){
	$data = file_get_contents($file);
	$data = explode($file);
	return array_pop($data);
}
$upload = wp_upload_dir();

if($_GET['d'] == "savehistory")
{
	if(strlen($_POST['latex']))
	{
		file_put_contents($upload['basedir'].'/mathtex/history/'.date("mY").'.history', base64_encode($_POST['latex'])."\n", FILE_APPEND);
	}	
}
else 
{
	$data = "\n";
	if(file_exists($upload['basedir'].'/mathtex/history/'.date("mY").'.history'))
		$data = file_get_contents($upload['basedir'].'/mathtex/history/'.date("mY").'.history');
	else if(file_exists($upload['basedir'].'/mathtex/history/'.date("mY", strtotime("-1 month")).'.history'))
		$data = file_get_contents($upload['basedir'].'/mathtex/history/'.date("mY").'.history');
	else if(file_exists($upload['basedir'].'/mathtex/history/'.date("mY", strtotime("-2 month")).'.history'))
		$data = file_get_contents($upload['basedir'].'/mathtex/history/'.date("mY", strtotime("-2 month")).'.history');
	else if(file_exists($upload['basedir'].'/mathtex/history/'.date("mY", strtotime("-3 month")).'.history'))
		$data = file_get_contents($upload['basedir'].'/mathtex/history/'.date("mY", strtotime("-3 month")).'.history');
	
	$data = explode("\n", $data);
	array_pop($data);
	foreach($data as $k=>$v)
		$data[$k] = stripslashes(base64_decode($v));
	wp_send_json($data);
}
?>