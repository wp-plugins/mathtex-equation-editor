<?php
define('WP_USE_THEMES', false); 
$dirname = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
require($dirname.'/wp-blog-header.php'); 
/*
$d = dir("img/uppercase_greek");
$data = 'Array(';
while($file = $d->read())
{
	$data .= '"'.$file.'" => array("\\"),'."\n";
}
$data .= ')';
*/ ?>
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
					<h3>Symbols</h3>
					<div>
						<div class="icon m_cdot" data-insert="\cdot "></div>
						<div class="icon m_div" data-insert="\div "></div>
						<div class="icon m_approx" data-insert="\approx "></div>
						<div class="icon m_mp" data-insert="\mp "></div>
						<div class="icon m_bigcirc" data-insert="\bigcirc "></div>
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
							<div class="icon" data-insert="<?php echo $item[0]; ?>"><img src="img/lowercase_greek/<?php echo $file; ?>" 
											style="margin-top:;"></div>
							<?php
						}
						?>
						<div style="clear:both;"></div>
					</div>
					<h3>Sets</h3>
					<div>
						<div class="icon m_otimes" data-insert="\otimes "></div>
						<div class="icon m_asymp" data-insert="\asymp "></div>
						<div class="icon m_supseteq" data-insert="\subseteq "></div>
						<div class="icon m_preceq" data-insert="\preceq "></div>
						<div class="icon m_ll" data-insert="\ll "></div>
						<div class="icon m_succ" data-insert="\succ "></div>
						<div style="clear:both;"></div>
					</div>
					
					
				</div>
				<textarea id="latex_formula"><?php echo stripslashes(substr(get_option('mathtex_editor_server_url'), -1) != '=' ? $_GET['latex'] : urldecode($_GET['latex'])); ?><?php echo $data; ?></textarea>
				<div id="resultWindow">
					<img src="<?php echo get_option('mathtex_editor_server_url'); ?>">
				</div>
				<div id="controlbuttons">
					<input type="button" value="Clear" />
					<input type="button" value="Insert Equation" />
				</div>
			</div>
		</div>
	</body>
</html>