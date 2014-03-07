<?php
define('WP_USE_THEMES', false); 
$dirname = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
require($dirname.'/wp-blog-header.php'); 

$upload_path = wp_upload_dir();
if(!file_exists($upload_path['basedir'].'/mathtex'))
	{
		mkdir($upload_path['basedir'].'/mathtex');
		mkdir($upload_path['basedir'].'/mathtex/cache');
		mkdir($upload_path['basedir'].'/mathtex/cache/'.md5(get_option('mathtex_editor_server_url')));
		mkdir($upload_path['basedir'].'/mathtex/history');
		mkdir($upload_path['basedir'].'/mathtex/macros');
	}
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
			<div id="toolbar"></div>
			<p>Enter the latex code:</p>
			
			
			<div id="editorlayer">
				<div id="codeassist" class="accordion">
					<h3>Operators</h3>
					<div>
						<?php
						require_once(dirname(__FILE__).'/img/operators/symbols.php');
						foreach($operators as $file => $item)
						{
							?>
							<div class="icon" data-insert="<?php echo $item[0]; ?>"><img src="img/operators/<?php echo $file; ?>" 
											style="margin-top:;"></div>
							<?php
						}
						?>
						<div style="clear:both;"></div>
					</div>
					<h3>Fractions &amp Exponents</h3>
					<div>
						<?php
						require_once(dirname(__FILE__).'/img/fractions/symbols.php');
						foreach($fractions as $file => $item)
						{
							$size = getimagesize('img/fractions/'.$file)
							?>
							<div class="icon" data-insert="<?php echo $item[0]; ?>"><img src="img/fractions/<?php echo $file; ?>" <?php echo $size[1] > 32 ? 'height="30px"' : ''; ?>
											style="margin-top:;"></div>
							<?php
						}
						?>
						<div style="clear:both;"></div>
					</div>
					<h3>Calculus</h3>
					<div>
						<?php
						require_once(dirname(__FILE__).'/img/calculus/symbols.php');
						foreach($calculus as $file => $item)
						{
							$size = getimagesize('img/calculus/'.$file)
							?>
							<div class="icon" data-insert="<?php echo $item[0]; ?>"><img src="img/calculus/<?php echo $file; ?>" <?php echo $size[1] > 32 ? 'height="30px"' : ''; ?>
											style="margin-top:;"></div>
							<?php
						}
						?>
						<div style="clear:both;"></div>
					</div>
					<h3>Brackets</h3>
					<div>
						<?php
						require_once(dirname(__FILE__).'/img/brackets/symbols.php');
						foreach($brackets as $file => $item)
						{
							?>
							<div class="icon" data-insert="<?php echo $item[0]; ?>"><img src="img/brackets/<?php echo $file; ?>" 
											style="margin-top:;"></div>
							<?php
						}
						?>
						<div style="clear:both;"></div>
					</div>
					<h3>Arrows</h3>
					<div>
						<?php
						require_once(dirname(__FILE__).'/img/arrows/symbols.php');
						foreach($arrows as $file => $item)
						{
							?>
							<div class="icon" data-insert="<?php echo $item[0]; ?>"><img src="img/arrows/<?php echo $file; ?>" 
											style="margin-top:;"></div>
							<?php
						}
						?>
						<div style="clear:both;"></div>
					</div>
					<h3>Relational</h3>
					<div>
						<?php
						require_once(dirname(__FILE__).'/img/relational/symbols.php');
						foreach($relational as $file => $item)
						{
							?>
							<div class="icon" data-insert="<?php echo $item[0]; ?>"><img src="img/relational/<?php echo $file; ?>" 
											style="margin-top:;"></div>
							<?php
						}
						?>
						<div style="clear:both;"></div>
					</div>
					<h3>Lowercase Greek</h3>
					<div>
						<?php
						require_once(dirname(__FILE__).'/img/lowercase_greek/symbols.php');
						foreach($lowercase_greek as $file => $item)
						{
							?>
							<div class="icon" data-insert="<?php echo $item[0]; ?>"><img src="img/lowercase_greek/<?php echo $file; ?>" 
											style="margin-top:;"></div>
							<?php
						}
						?>
						<div style="clear:both;"></div>
					</div>
					<h3>Uppercase Greek</h3>
					<div>
						<?php
						require_once(dirname(__FILE__).'/img/uppercase_greek/symbols.php');
						foreach($uppercase_greek as $file => $item)
						{
							?>
							<div class="icon" data-insert="<?php echo $item[0]; ?>"><img src="img/uppercase_greek/<?php echo $file; ?>" 
											style="margin-top:;"></div>
							<?php
						}
						?>
						<div style="clear:both;"></div>
					</div>
					<h3>Sets</h3>
					<div>
						<?php
						require_once(dirname(__FILE__).'/img/sets/symbols.php');
						foreach($sets as $file => $item)
						{
							?>
							<div class="icon" data-insert="<?php echo $item[0]; ?>"><img src="img/sets/<?php echo $file; ?>" 
											style="margin-top:;"></div>
							<?php
						}
						?>
						<div style="clear:both;"></div>
					</div>
					
					
				</div>
				<div id="containersa">
					<div style="text-align: right;">
						<a href="" id="prevbutton"><<</a>&nbsp;&nbsp;&nbsp;<span>History</span>&nbsp;&nbsp;&nbsp;
						<a href="" id="forwardbutton">>></a>
					</div>
					<textarea id="latex_formula"><?php echo stripslashes(substr(get_option('mathtex_editor_server_url'), -1) != '=' ? $_GET['latex'] : urldecode($_GET['latex'])); ?></textarea>
					<div id="resultWindow">
						<img src="<?php echo (get_option('mathtex_use_php_to_request') == "no" && get_option('mathtex_enable_cache') == "no") ? get_option('mathtex_editor_server_url') : plugins_url('latex.php?cache=1&d=', __FILE__); ?>
								<?php echo stripslashes(substr(get_option('mathtex_editor_server_url'), -1) != '=' ? $_GET['latex'] : urldecode($_GET['latex'])); ?>">
					</div>
					<div id="controlbuttons">
						<input type="button" value="Clear" />
						<input type="button" value="Insert Equation" />
						<input type="button" value="Send To Wolfram Alpha" style="background-color:#CCCCCC;margin-top: 10px;"/>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>