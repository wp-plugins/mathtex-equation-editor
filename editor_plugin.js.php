<?php  
define('WP_USE_THEMES', false); 
$dirname = dirname(dirname(dirname(dirname(__FILE__))));
require($dirname.'/wp-blog-header.php'); 
if(get_option('mathtex_use_php_to_request') == "yes" || get_option('mathtex_enable_cache') == "yes")
	$murl = plugins_url('html/latex.php?d=', __FILE__);
else 
	$murl = get_option('mathtex_editor_server_url');
	
$mcurl = get_option('mathtex_codecogs_url');
?>
var popupEqnwin = null; 

(function() {
	tinymce.create('tinymce.plugins.MathTexPlugin', {
		init: function(ed, url) {
			 <?php
			 if(get_option('mathtex_enable_codecogs_conversions') == "yes")
			 {
			 ?>
			ed.addCommand('mathTexCommand2', function(a, latex) {
				temp = jQuery('<p></p>').html(ed.getContent());
				images = jQuery('img[src^="<?php echo $mcurl; ?>?"]', temp);
				jQuery(images).each(function(key, elem){
					jQuery(elem).attr('src',"<?php echo $murl; ?><?php echo substr($murl, -1) != "=" ? '?' : '' ?>" + 
									<?php echo substr($murl, -1) != "=" ? "jQuery(elem).attr('alt')" : "encodeURIComponent(jQuery(elem).attr('alt'))" ?> );
				});
				
				content = '';
				
				ed.setContent(jQuery(temp).html());
			});
			<?php
			 }
			 ?>
			
			ed.addCommand('mathTexCommand', function(a, latex)	{
																					
	  		//open a popup window when the button is clicked
				if (popupEqnwin==null || popupEqnwin.closed || !popupEqnwin.location) 
				{
					var url2 = url + '/html/index.php';
			
					//if(language!='') url+='&lang='+language;
					if(latex!==undefined) 
					{	
						latex=unescape(latex);
						latex=latex.replace(/\+/g,'&plus;');
						url2 +='?latex='+escape(latex);
					}
					
					popupEqnwin=window.open(url2,'mathTexEditor','width=700,height=750,status=1,scrollbars=yes,resizable=1');
					
				}
				else if (window.focus) 
				{ 
					popupEqnwin.focus()
					if(latex!==undefined)
					{ 
						try
						{
							latex=decodeURIComponent(latex);
							popupEqnwin.load(latex);
						}
						catch(err)
						{
							alert(err.message);
						}			
          			}
					popupEqnwin.document.getElementById("latex_formula").focus();
		  			popupEqnwin.document.getElementById("latex_formula").select();
				}
																																									

			}); 
		 
		 ed.addButton('mathTex', {
				title: 'MathTex Equation Editor',
				image: url + '/img/equation.gif',
				cmd: 'mathTexCommand' });
				
		 ed.addButton('mathTex', {
				title: 'MathTex Equation Editor',
				image: url + '/img/equation.gif',
				cmd: 'mathTexCommand' });
				
		 <?php
		 if(get_option('mathtex_enable_codecogs_conversions') == "yes")
		 {
		 ?>
		 ed.addButton('mathTexConverter', {
				title: 'CodeCogs Equation Converter',
				image: url + '/img/refresh.gif',
				cmd: 'mathTexCommand2' });		
		 <?php
		 }
		 ?>	
			ed.onDblClick.add(function(ed, e) {
				if (e.target.nodeName.toLowerCase() == "img") {
					<?php
					$nurl = explode("//", $murl);
					$nurl = $nurl[1];
					$nurl = explode("/", $nurl);
					$domain = array_shift($nurl);
					
					if(get_option('mathtex_use_php_to_request') == "yes" || get_option('mathtex_enable_cache') == "yes")
					{
						if(substr($murl, -2) == "d=")
						{
							?> 
							var domainstring = e.target.src.match( /http:\/\/(<?php echo $domain; ?>)\/(.*)$/ );
							var sName = e.target.src.split("d=")[1];
							if(sName.length)
							{
								if(domainstring[1]=='<?php echo $domain; ?>')
					      			{
					      				mystring = sName;
					      				tinymce.execCommand('mathTexCommand', false, mystring);
					      			}
				      		}
							<?php
						}
					}
					else 
					{
						if(substr($murl, -6) == "latex=")
						{
							?>
							var domainstring = e.target.src.match( /http:\/\/(<?php echo $domain; ?>)\/(.*)$/ );
							var sName = e.target.src.split("latex=")[1];
							if(sName.length)
							{
								if(domainstring[1]=='<?php echo $domain; ?>')
					      			{
					      				mystring = sName;
					      				tinymce.execCommand('mathTexCommand', false, mystring);
					      			}
				      		}
							<?php
						}
						if(substr($murl, -3) == "eq=")
						{
							?> 
							var domainstring = e.target.src.match( /http:\/\/(<?php echo $domain; ?>)\/(.*)$/ );
							var sName = e.target.src.split("eq=")[1];
							if(sName.length)
							{
								if(domainstring[1]=='<?php echo $domain; ?>')
					      			{
					      				mystring = sName;
					      				tinymce.execCommand('mathTexCommand', false, mystring);
					      			}
				      		}
							<?php
						}
						else {
							?>
							var sName = e.target.src.match( /http:\/\/(<?php echo $domain; ?>)\/<?php echo implode("\\/", $nurl); ?>\?(.*)/ );
						
							if(sName)
							{
								if(sName[1]=='<?php echo $domain; ?>')
					      			{
					      				mystring = sName[2];
					      				tinymce.execCommand('mathTexCommand', false, mystring);
					      			}
				      		}
							<?php
						}
						
					}
					?>
					
		      		
		      		<?php
					 if(get_option('mathtex_enable_codecogs_conversions') == "yes")
					 {
					 	$mncurl =  explode("//", $mcurl);
						$mncurl = $mncurl[1];
						$mncurl = explode("/", $mncurl); 
						$mncurl = $mncurl[0];
					?>	
		      		var sName = e.target.src.match( /http:\/\/(<?php echo $mncurl; ?>)\/(gif|png)\.latex\?(.*)/ );	
		      		if(sName)
		      		{
		      			if(sName[1]=='<?php echo $mncurl; ?>')
		      				{
		      					latex = sName[3];
		      					latex = latex.replace(/@plus;/g,'+');
								latex = latex.replace(/&plus;/g,'+');
								latex = latex.replace(/&space;/g,' ');
								latex = latex.replace(/&hash;/g,'#');
								
								tinymce.execCommand('mathTexCommand', false, latex);
		      				}
		      		}
		      		 <?php
					 }
					 ?>	
		      		
			    }
			});
			
	  }, 
	
	  createControl : function(n, cm) { return null; } 
  });
 
  tinymce.PluginManager.add('mathTex', tinymce.plugins.MathTexPlugin);
})();


// Add a new placeholder at the actual selection.
TinyMCE_Add = function( name)
{
	tinyMCE.activeEditor.execCommand('mceInsertContent', false, '<img src="<?php echo $murl; ?><?php echo substr($murl, -1) != "=" ? '?' : '' ?>'+ <?php echo substr($murl, -1) != "=" ? 'name' : 'encodeURIComponent(name)' ?> +'" alt="'+name+'" align="absmiddle" class="mathtex-equation-editor" />');
	tinyMCE.execCommand('mceFocus', false, tinymce.activeEditor.editorId);
};