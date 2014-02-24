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
		<li style="margin-left:50px;">http://www.forkosh.com/mathtex.cgi</li>
		<li style="margin-left:50px;">http://www.cyberroadie.org/cgi-bin/mathtex.cgi</li>
		<li style="margin-left:50px;">http://s0.wp.com/latex.php?bg=ffffff&fg=000&s=1&latex=</li>
		<li style="margin-left:50px;">http://www.sciweavers.org/tex2img.php?bc=White&fc=Black&im=jpg&fs=12&ff=arev&edit=0&eq=</li>
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
        <td><input type="text" name="mathtex_enable_codecogs_conversions" value="<?php echo get_option('mathtex_enable_codecogs_conversions'); ?>" size="3"/> 
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