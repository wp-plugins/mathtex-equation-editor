<div class="wrap">
<h2>MathTex Equation Editor Settings</h2>
<p>
	MathTex lets you add LaTeX math in your own blog posts. It parses a LaTeX math expression and immediately emits the corresponding gif (or png) image.
</p>
<p>
	If have wish to run mathTex on your own personal server, click <a href="http://www.forkosh.com/mathtex.html">here</a> for instructions or documentation. 
	You can also look up our blog post on the step by step installation of mathTex <a href="http://kobmat.com/math/?p=5805">here</a>.
</p>
<p>
	There are however other Math LaTeX services that can be used. Here are a few of those services.
	<ul style="list-style: disc;">
		<li style="margin-left:50px;">http://www.forkosh.com/cgi-bin/mathtex.cgi (work if php requests is set to yes)</li>
		<li style="margin-left:50px;">http://www.cyberroadie.org/cgi-bin/mathtex.cgi</li>
		<li style="margin-left:50px;">http://s0.wp.com/latex.php?bg=ffffff&fg=000&s=1&latex=</li>
		<li style="margin-left:50px;">http://www.sciweavers.org/tex2img.php?bc=White&fc=Black&im=jpg&fs=12&ff=arev&edit=0&eq=</li>
		<li style="margin-left:50px;">http://chart.apis.google.com/chart?cht=tx&chl=</li>
		<li style="margin-left:50px;"><b style="color:Red">http://latex.kobmat.com/cgi-bin/mathtex.cgi (Paid LaTeX Web Service)</b> <a href="http://kobmat.com/math/?p=7661">Click Here to Help us out!</a></li>
	</ul>
</p>

<form method="post" action="options.php"> 
<?php settings_fields( 'mathTex' ); ?>
<?php do_settings_sections( 'mathTex' ); ?>
 <table class="form-table">
 		<tr valign="top" nowrap="nowrap">
        <th scope="row">MathTex Server URL</th>
        <td><input type="text" name="mathtex_editor_server_url" value="<?php echo get_option('mathtex_editor_server_url'); ?>" size="50"/></td>
        </tr>
        <tr valign="top" nowrap="nowrap">
        	<th scope="row">Use PHP to request for the latex equations</th>
	        <td>
	        	<select name="mathtex_use_php_to_request">
	        		<option value="yes" <?php echo get_option('mathtex_use_php_to_request') == "yes" ? 'selected="selected"' : ''; ?>>yes</option>
	        		<option value="no" <?php echo get_option('mathtex_use_php_to_request') == "no" ? 'selected="selected"' : ''; ?>>no</option>
	        	</select>
	        </td>
        </tr>
        <tr valign="top" nowrap="nowrap">
        	<th scope="row">Enable Equations Caching?</th>
	        <td>
	        	<select name="mathtex_enable_cache">
	        		<option value="yes" <?php echo get_option('mathtex_enable_cache') == "yes" ? 'selected="selected"' : ''; ?>>yes</option>
	        		<option value="no" <?php echo get_option('mathtex_enable_cache') == "no" ? 'selected="selected"' : ''; ?>>no</option>
	        	</select>
	        </td>
        </tr>
        <tr valign="top" nowrap="nowrap">
        	<th scope="row">Cache Equations Expiration?</th>
	        <td>
	        	<select name="mathtex_cache_limit">
	        		<option value="15" <?php echo get_option('mathtex_cache_limit') == "15" ? 'selected="selected"' : ''; ?>>15 days</option>
	        		<option value="30" <?php echo get_option('mathtex_cache_limit') == "30" ? 'selected="selected"' : ''; ?>>30 days</option>
	        		<option value="45" <?php echo get_option('mathtex_cache_limit') == "45" ? 'selected="selected"' : ''; ?>>45 days</option>
	        		<option value="60" <?php echo get_option('mathtex_cache_limit') == "60" ? 'selected="selected"' : ''; ?>>60 days</option>
	        		<option value="75" <?php echo get_option('mathtex_cache_limit') == "75" ? 'selected="selected"' : ''; ?>>75 days</option>
	        		<option value="90" <?php echo get_option('mathtex_cache_limit') == "90" ? 'selected="selected"' : ''; ?>>90 days</option>
	        		<option value="120" <?php echo get_option('mathtex_cache_limit') == "120" ? 'selected="selected"' : ''; ?>>120 days</option>
	        		<option value="240" <?php echo get_option('mathtex_cache_limit') == "240" ? 'selected="selected"' : ''; ?>>240 days</option>
	        		<option value="360" <?php echo get_option('mathtex_cache_limit') == "360" ? 'selected="selected"' : ''; ?>>360 days</option>
	        		<option value="0" <?php echo get_option('mathtex_cache_limit') == "0" ? 'selected="selected"' : ''; ?>>Never Expire</option>
	        	</select>
	        </td>
        </tr>
        <tr valign="top" nowrap="nowrap">
        <th scope="row">Enable Math Latex Code Completion</th>
        <td>
        	<select name="mathtex_editor_code_completion">
        		<option value="yes" <?php echo get_option('mathtex_editor_code_completion') == "yes" ? 'selected="selected"' : ''; ?>>yes</option>
        		<option value="no" <?php echo get_option('mathtex_editor_code_completion') == "no" ? 'selected="selected"' : ''; ?>>no</option>
        	</select>
        	
        </tr>
        <tr>
        	<td colspan="2">
        		<p>
	If you where using the CodeCogs Editor and you wish to edit the old equations with this editor, set this options to yes.<br> This will also allow
	you to have the ability to switch your equations to be rendered by the mathTex URL.
</p>
        	</td>
        </tr>
         <tr valign="top" nowrap="nowrap">
        <th scope="row">Enable Latex Form CodeCogs Conversion</th>
        <td>
        	<select name="mathtex_enable_codecogs_conversions">
        		<option value="yes" <?php echo get_option('mathtex_enable_codecogs_conversions') == "yes" ? 'selected="selected"' : ''; ?>>yes</option>
        		<option value="no" <?php echo get_option('mathtex_enable_codecogs_conversions') == "no" ? 'selected="selected"' : ''; ?>>no</option>
        	</select>
        </td>
        </tr>
        <tr valign="top" nowrap="nowrap">
        <th scope="row">URL of CodeCogs Rendered Equations</th>
        <td><input type="text" name="mathtex_codecogs_url" value="<?php echo get_option('mathtex_codecogs_url'); ?>" size="50"/></td>
        </tr>
        
        
    </table>
    
    <?php submit_button(); ?>

</form>
<p>
	To learn Math LaTeX, click <a href="http://www.forkosh.com/mimetextutorial.html">here</a> for a tutorial.
</p>
</div>