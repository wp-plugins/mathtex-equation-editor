<?php
define('WP_USE_THEMES', false); 
$dirname = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
require($dirname.'/wp-blog-header.php'); 

$path = wp_upload_dir();
if(!file_exists($path['basedir'].'/mathtex/cache/'.md5(get_option('mathtex_editor_server_url'))))
	mkdir($path['basedir'].'/mathtex/cache/'.md5(get_option('mathtex_editor_server_url')));

function mathtex_check_cachedate($file)
{
	$time = filectime($file);
	$com_date = (int)get_option('mathtex_cache_limit');
	if($com_date == 0)
		{
		return true;
		}
	else 
		{
		if($time <= strtotime("-".$com_date.' days'))
			{
				unlink($file);
				return false;
			}	
		else
			{
				return true;
			}
		}
}

if(get_option('mathtex_enable_cache') == "yes")
{
	$test = md5($_GET['d']);
	if(file_exists($path['basedir'].'/mathtex/cache/'.md5(get_option('mathtex_editor_server_url')).'/'.$test.'.gif'))
		{
			if(mathtex_check_cachedate($path['basedir'].'/mathtex/cache/'.md5(get_option('mathtex_editor_server_url')).'/'.$test.'.gif') == true)
			{
			header("Content-Type: image/gif");
			header("Content-Length: ".filesize($path['basedir'].'/mathtex/cache/'.md5(get_option('mathtex_editor_server_url')).'/'.$test.'.gif'));
			echo file_get_contents($path['basedir'].'/mathtex/cache/'.md5(get_option('mathtex_editor_server_url')).'/'.$test.'.gif');
			return true;
			}
		}
	else if(file_exists($path['basedir'].'/mathtex/cache/'.md5(get_option('mathtex_editor_server_url')).'/'.$test.'.jpg'))
		{
			if(mathtex_check_cachedate($path['basedir'].'/mathtex/cache/'.md5(get_option('mathtex_editor_server_url')).'/'.$test.'.jpg') == true)
			{
			header("Content-Type: image/jpeg");
			header("Content-Length: ".filesize($path['basedir'].'/mathtex/cache/'.md5(get_option('mathtex_editor_server_url')).'/'.$test.'.jpg'));
			echo file_get_contents($path['basedir'].'/mathtex/cache/'.md5(get_option('mathtex_editor_server_url')).'/'.$test.'.jpg');
			return true;
			}
		}
	else if(file_exists($path['basedir'].'/mathtex/cache/'.md5(get_option('mathtex_editor_server_url')).'/'.$test.'.png'))
		{
			if(mathtex_check_cachedate($path['basedir'].'/mathtex/cache/'.md5(get_option('mathtex_editor_server_url')).'/'.$test.'.png') == true)
			{
			header("Content-Type: image/png");
			header("Content-Length: ".filesize($path['basedir'].'/mathtex/cache/'.md5(get_option('mathtex_editor_server_url')).'/'.$test.'.png'));
			echo file_get_contents($path['basedir'].'/mathtex/cache/'.md5(get_option('mathtex_editor_server_url')).'/'.$test.'.png');
			return true;
			}
		}	
}
//echo get_option('mathtex_editor_server_url').(substr(get_option('mathtex_editor_server_url'), -1) != '=' ? '?' : '').stripslashes($_GET['d']));
$urlm= get_option('mathtex_editor_server_url').(substr(get_option('mathtex_editor_server_url'), -1) != '=' ? '?'.$_GET['d'] : urlencode_deep(stripslashes($_GET['d'])));
$result = wp_remote_get($urlm);
if($result['response']['code'] == "200")
{
	header("Content-Type: ".$result['content-type']);
	header("Content-Length: ".$result['content-length']);
	echo $result['body'];
	
	if(get_option('mathtex_enable_cache') == "yes")
	{
		if(!isset($_GET['cache']))
		{
			switch($result['content-type'])
			{
				case 'image/png':
					$ext = '.png';
					break;
				case 'image/jpeg':
					$ext = '.jpg';
					break;
				default: // 'image/gif':
					$ext = '.gif';
					break;
			}
			file_put_contents($path['basedir'].'/mathtex/cache/'.md5(get_option('mathtex_editor_server_url')).'/'.$test.$ext, $result['body']);
		}
	}
}
else 
{
	echo "Invalid Image Request/MathTex Server is Offline";
}

?>