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
			
			jQuery('.icon').click(function(){
				mathtex_insert(jQuery(this).attr('data-insert'));
			});
			
			jQuery('#codeassist h3').click(function(){
				if(jQuery(this).next().css('display') == "block") {
					jQuery('#codeassist > div').hide();
				}
				else
				{
					jQuery('#codeassist > div').hide();
					jQuery(this).next().show();
				}
				
			});
			<?php
			if(get_option('mathtex_editor_code_completion') == "yes")
			{
			?>
				jQuery('#EditorWindow textarea').keydown(function(event){
						positionStart = jQuery('#EditorWindow textarea').caret().start;
						positionEnd = jQuery('#EditorWindow textarea').caret().end;
						
						if(event.shiftKey == true && event.which == 219)
						{
							if(mathtex_autocomplete() == true)
								{
									event.preventDefault();
									return false;
								}
						}
						
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
					});
			
			<?php
			}
			?>
			
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
				<?php
				if(get_option('mathtex_editor_code_completion') == "yes")
				{
				?>
					positionStart = jQuery('#EditorWindow textarea').caret().start;
					positionEnd = jQuery('#EditorWindow textarea').caret().end;
					<?php
				}
				?>
				},500);
			
			
		});
		
		function mathtex_autocomplete()
		{
			$textarea = jQuery('#EditorWindow textarea');
			matches = $textarea.val().substring(0, positionStart).match(/\\(.*)$/);
			return_val = false;
			if(matches)
			{
				toadd = '';
				xfocus = positionStart;
				switch(matches[0])
				{
					case '\\frac':
					case '\\tfrac':
					case '\\overset':
					case '\\underset':
						next_char=$textarea.val().substring(positionStart, positionStart+1);
						if(next_char != "}")
						{
							toadd = "{}{}";
							xfocus = positionStart + 1;
						}
						break;
					case '\\sqrt':
					case '\\widetilde':
					case '\\widehat':
					case '\\overleftarrow':
					case '\\overrightarrow':
					case '\\overline':
					case '\\underline':
					case '\\overbrace':
					case '\\underbrace':
					case '\\lim_':
					case '\\dot':
					case '\\ddot':
					case '\\hat':
					case '\\check':
					case '\\grave':
					case '\\acute':
					case '\\tilde':
					case '\\breve':
					case '\\bar':
					case '\\vec':
					case '\\not':
						next_char=$textarea.val().substring(positionStart, positionStart+1);
						if(next_char != "}")
						{
							toadd = "{}";
							xfocus = positionStart + 1;
						}
						break;
					
				}
				
				$textarea.val($textarea.val().substring(0, positionStart) + toadd + $textarea.val().substring(positionEnd));
				$textarea.caret(xfocus, xfocus);
				
				if(toadd.length > 0)
					return_val = true;
			}
			
			return return_val;
		}
		
		
    
		function mathtex_insert(data)
		{
			$textarea = jQuery('#EditorWindow textarea');
			if(positionStart == positionEnd)
			{
				if(data.indexOf('#') > 0)
				{
					data2 = data.replace("#", "");
					$textarea.val($textarea.val().substring(0, positionStart) + data2 + $textarea.val().substring(positionEnd));
					$textarea.caret(positionStart + data.indexOf('#'), positionStart + data.indexOf('#'));
				}
				else
				{
				$textarea.val($textarea.val().substring(0, positionStart) + data + $textarea.val().substring(positionEnd));
				$textarea.caret(positionStart + data.length, positionStart + data.length);
				} 
			}
			else
			{
				selected_text = $textarea.val().substring(positionStart,positionEnd);
				if(data.indexOf('#') > 0)
					{
					xpos = data.indexOf('#');
					data = data.substring(0, data.indexOf('#')) + selected_text + data.substring(data.indexOf('#') +1);
					$textarea.val(data);
					$textarea.caret(positionStart + data.length, positionStart + data.length); 
					}
				else
					{
					$textarea.val($textarea.val().substring(0, positionStart) + data + $textarea.val().substring(positionEnd));
					$textarea.caret(positionStart + data.length, positionStart + data.length); 	
					}
			}
		}
		
		function mathex_autoclose(charstart, charend)
			{
				//check for left and right
				$textarea = jQuery('#EditorWindow textarea');
				matches = $textarea.val().substring(0, positionStart).match(/\\left\s$/);
				if(matches)
				{
				ismatch = matches[0].match(/^\\left/);
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