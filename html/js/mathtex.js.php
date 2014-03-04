<?php
define('WP_USE_THEMES', false); 
$dirname = dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))));
require($dirname.'/wp-blog-header.php'); 


?>
jQuery(document).ready(function($){
			url = "<?php echo (get_option('mathtex_use_php_to_request') == "no" && get_option('mathtex_enable_cache') == "no") ? get_option('mathtex_editor_server_url') : plugins_url('latex.php?cache=1&d=', dirname(__FILE__)); ?>";
			$.get('<?php echo plugins_url('history.php', dirname(__FILE__)); ?>', function(data) {
				equations = data;
				loaded_equation = equations.length-1;
				if(jQuery('#EditorWindow textarea').val().length == 0)
					jQuery('#EditorWindow textarea').val(equations[equations.length-1]);
					
				if(equations.length == 0)
					{
						$('#forwardbutton').hide();
						$('#prevbutton').hide();
						$('#prevbutton').parent().hide();
					}
			});
			
			$('input[value="Send To Wolfram Alpha"]').click(function(){
				if(positionStart == positionEnd)
					window.open('http://www.wolframalpha.com/input/?i=' + encodeURIComponent($('#EditorWindow textarea').val()), 'wolframwindow');
				else
					window.open('http://www.wolframalpha.com/input/?i=' + encodeURIComponent($('#EditorWindow textarea').val().substring(positionStart, positionEnd)), 'wolframwindow');			
			});
			
			$('#forwardbutton').click(function(){
				if(loaded_equation+1 >= equations.length)
					loaded_equation = -1;
				
				loaded_equation++;	
				jQuery('#EditorWindow textarea').val(equations[loaded_equation]);
				jQuery('#EditorWindow textarea').caret({start:jQuery('#EditorWindow textarea').val().length,end:jQuery('#EditorWindow textarea').val().length});
				return false;	
			});
			
			$('#prevbutton').click(function(){
				if(loaded_equation-1 < 0)
					loaded_equation = equations.length;
				
				loaded_equation--;	
				jQuery('#EditorWindow textarea').val(equations[loaded_equation]);	
				jQuery('#EditorWindow textarea').caret({start:jQuery('#EditorWindow textarea').val().length,end:jQuery('#EditorWindow textarea').val().length});	
				return false;
			});
			
			jQuery('#controlbuttons input[value="Insert Equation"]').click(function(){
				$.post('<?php echo plugins_url('history.php?d=savehistory', dirname(__FILE__)); ?>', {latex: jQuery('#EditorWindow textarea').val()}, function(){
						equations[equations.length] = jQuery('#EditorWindow textarea').val();
 					});
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
			
			lastvalue = jQuery('#EditorWindow textarea').val();
			
			setInterval(function(){
				if(jQuery('#EditorWindow textarea').val().length == 0)
					jQuery('#resultWindow img').hide();
				else
					jQuery('#resultWindow img').show();
					
				if(jQuery('#EditorWindow textarea').val() != lastvalue)
				{	
					jQuery('#resultWindow img').attr('src', url + <?php if(substr(get_option('mathtex_editor_server_url'), -1) != '=') { echo "'?' + "; } ?>  encodeURIComponent($('#EditorWindow textarea').val())); 
					lastvalue = jQuery('#EditorWindow textarea').val();
				}
				
				positionStart = jQuery('#EditorWindow textarea').caret().start;
				positionEnd = jQuery('#EditorWindow textarea').caret().end;
				
				},500);
			
			jQuery('#resultWindow img').attr('src', url + <?php if(substr(get_option('mathtex_editor_server_url'), -1) != '=') { echo "'?' + "; } ?>  encodeURIComponent($('#EditorWindow textarea').val())); 
			lastvalue = jQuery('#EditorWindow textarea').val();
			
			jQuery('#EditorWindow textarea').caret({start:jQuery('#EditorWindow textarea').val().length,end:jQuery('#EditorWindow textarea').val().length});
		});
		
		function mathtex_autocomplete()
		{
			$textarea = jQuery('#EditorWindow textarea');
			positionStart = jQuery('#EditorWindow textarea').caret().start;
			positionEnd = jQuery('#EditorWindow textarea').caret().end;
				
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
			positionStart = jQuery('#EditorWindow textarea').caret().start;
			positionEnd = jQuery('#EditorWindow textarea').caret().end;
			if(positionStart == positionEnd)
			{
				if($textarea.val().length > positionEnd)
				{
					if(data.indexOf('#') > 0)
					{
						data2 = data.replace("#", "");
						data2 = data2.replace("{f?}", "");
						data2 = $textarea.val().substring(0, positionStart) + data2 + $textarea.val().substring(positionEnd);
						$textarea.val(data);
						
						$textarea.caret(positionStart + data.indexOf('#'), positionStart + data.indexOf('#'));
					}
					else
					{
						data2 = data.replace("{f?}", "");
						
						$textarea.val($textarea.val().substring(0, positionStart) + data2 + $textarea.val().substring(positionEnd));
						$textarea.caret(positionStart + data2.length, positionStart + data2.length);
					}
				}
				else
				{
					if(data.indexOf('#') > 0)
					{
						data2 = data.replace("#", "");
						data2 = data2.replace("{f?}", "");
						data2 = $textarea.val() + data2;
						$textarea.val(data2);
						$textarea.caret(positionStart + data.indexOf('#'), positionStart + data.indexOf('#'));
					}
					else
					{
						data2 = data.replace("{f?}", "");
						data2 = $textarea.val() + data;
						$textarea.val(data2);
						$textarea.caret(positionStart + data2.length, positionStart + data2.length);
					}
				}	 
			}
			else
			{
				selected_text = $textarea.val().substring(positionStart,positionEnd);
				if(data.indexOf('#') > 0)
					{
						xpos = data.indexOf('#');
						data = data.substring(0, data.indexOf('#')) + selected_text + data.substring(data.indexOf('#') +1);
						
						if(data.indexOf('{f?}') > 0)
						{
							focus_start = data.indexOf('{f?}');
							data = data.replace('{f?}', '');
							$textarea.val(data);
							$textarea.caret(positionStart + focus_start, positionStart + focus_start);
						}
						else
						{
							$textarea.val(data);
							$textarea.caret(positionStart + data.length, positionStart + data.length);
						}
					 
					}
				else
					{
						
						if(data.indexOf('{f?}') > 0)
						{
							focus_start = data.indexOf('{f?}');
							data = data.replace('{f?}', '');
							$textarea.val($textarea.val().substring(0, positionStart) + data + $textarea.val().substring(positionEnd));
							$textarea.caret(positionStart + focus_start, positionStart + focus_start); 	
						}
						else
						{
							$textarea.val($textarea.val().substring(0, positionStart) + data + $textarea.val().substring(positionEnd));
							$textarea.caret(positionStart + data.length, positionStart + data.length); 	
						}
					
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
			jQuery('#EditorWindow textarea').caret({start:latex.length,end:latex.length});
		}