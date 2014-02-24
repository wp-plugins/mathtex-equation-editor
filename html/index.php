<?php
define('WP_USE_THEMES', false); 
$dirname = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
require($dirname.'/wp-blog-header.php'); 
?>
<html>
	<head>
		<title>MathTex Editor</title>
		<?php wp_head(); ?> 
		<script>
		jQuery(document).ready(function($){
			url = "<?php echo get_option('mathtex_editor_server_url'); ?>";
			
			jQuery('#controlbuttons input[value="Insert Equation"]').click(function(){
				opener.TinyMCE_Add(jQuery('#EditorWindow textarea').val());
			});
			
			
			if(jQuery('#EditorWindow textarea').val().length)
			{
				jQuery('#EditorWindow textarea').change();
			}
			
			if(jQuery('#EditorWindow textarea').val().length == 0)
			{
				jQuery('#resultWindow img').hide();
			}
			
			setInterval(function(){
				if(jQuery('#EditorWindow textarea').val().length == 0)
					jQuery('#resultWindow img').hide();
				else
					jQuery('#resultWindow img').show();
				
				jQuery('#resultWindow img').attr('src', url + <?php if(substr(get_option('mathtex_editor_server_url'), -1) != '=') { echo "'?' + "; } ?>  encodeURIComponent($('#EditorWindow textarea').val())); 
				},500);
		});
		
		function load(latex)
		{
			jQuery('#EditorWindow textarea').val(latex);
			jQuery('#EditorWindow textarea').change();
		}
		</script>
		<style>
			Body {
				padding: 10px;
			}
			
			div {
				text-align:center;
			}
			
			#resultWindow, #controlbuttons {
				padding:10px;
			}
			
			#EditorWindow {
				text-align:left;
			}
			
			#EditorWindow h2, #EditorWindow p {
				padding: 0px;
				margin: 0px;	
			}
			
			#latex_formula {
				height: 200px;
			}
		</style>
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