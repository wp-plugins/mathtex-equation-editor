<?php
define('WP_USE_THEMES', false); 
$dirname = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
require($dirname.'/wp-blog-header.php'); 
?>
<html>
	<head>
		<title>MathTex Editor</title>
		<?php wp_head(); ?> 
		<script src="<?php echo plugins_url('js/jquery.caret.1.02.js', __FILE__); ?>"></script>
		<script src="<?php echo plugins_url('js/mathtex.js.php', __FILE__); ?>"></script>
		<link href="<?php echo plugins_url('css/style.css', __FILE__); ?>" rel="stylesheet" type="text/css">
		
	</head>
	<body>
		<div id="EditorWindow">
			<h2>MathTex Equation Editor</h2>
			<p>Enter the latex code:</p>
			<textarea id="latex_formula"><?php echo stripslashes(substr(get_option('mathtex_editor_server_url'), -1) != '=' ? $_GET['latex'] : urldecode($_GET['latex'])); ?></textarea>
		</div>
		<div id="resultWindow">
			<img src="<?php echo get_option('mathtex_editor_server_url'); ?>">
		</div>
		<div id="controlbuttons">
			<input type="button" value="Clear" />
			<input type="button" value="Insert Equation" />
		</div>
	</body>
</html>