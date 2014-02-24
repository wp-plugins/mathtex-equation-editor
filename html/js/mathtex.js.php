<?php
define('WP_USE_THEMES', false); 
$dirname = dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))));
require($dirname.'/wp-blog-header.php'); 
?>
jQuery(document).ready(function($){
			url = "<?php echo get_option('mathtex_editor_server_url'); ?>";
			
			jQuery('#controlbuttons input[value="Insert Equation"]').click(function(){
				opener.TinyMCE_Add(jQuery('#EditorWindow textarea').val());
			});
			
			
			
			jQuery('#EditorWindow textarea').keydown(function(event){
				positionStart = jQuery('#EditorWindow textarea').caret().start;
				positionEnd = jQuery('#EditorWindow textarea').caret().end;
				
				//@TODO add code for auto completion
				if(event.shiftKey == true && event.which == 219)
				{
					mathex_autoclose("{", "}");
					event.preventDefault();
				}
				
				if(event.shiftKey == true && event.which == 57)
				{
					mathex_autoclose("(", ")");
					event.preventDefault();
				}
				
				if(event.shiftKey == true && event.which == 220)
				{
					mathex_autoclose("|", "|");
					event.preventDefault();
				}
				
				if(event.shiftKey == false && event.which == 219)
				{
					mathex_autoclose("[", "]");
					event.preventDefault();
				}
				
			}).mousemove(function() {
				positionStart = jQuery('#EditorWindow textarea').caret().start;
				positionEnd = jQuery('#EditorWindow textarea').caret().end;
				console.log(positionStart,positionEnd);
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
				positionStart = jQuery('#EditorWindow textarea').caret().start;
				positionEnd = jQuery('#EditorWindow textarea').caret().end;
				
				},500);
				
				
		});
		
		function mathex_autoclose(charstart, charend)
			{
				//check for left and right
				$textarea = jQuery('#EditorWindow textarea');
				matches = $textarea.val().substring(0, positionStart).match(/\\left\s$/);
				if(matches)
				{
				ismatch = matches[0].match(/^\\left/);
				console.log(ismatch);
				if(ismatch[0] == "\\left")
					charend = "\\right "+charend;
				}
					 
				if(positionStart == positionEnd)
					{
					$textarea.val($textarea.val().substring(0, positionStart) + charstart + charend + $textarea.val().substring(positionEnd)); 
					$textarea.caret({start:positionStart+charstart.length,end:positionStart+charstart.length});
					}
				else
					{
					newval = $textarea.val().substring(0, positionStart) + charstart + $textarea.val().substring(positionStart,positionEnd) + charend + $textarea.val().substring(positionEnd);	
					$textarea.val(newval);
					$textarea.caret({start:positionStart+charstart.length,end:positionStart+charstart.length});
					} 
			}
			
		function load(latex)
		{
			jQuery('#EditorWindow textarea').val(latex);
			jQuery('#EditorWindow textarea').change();
		}