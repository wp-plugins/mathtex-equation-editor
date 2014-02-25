=== MathTex Equation Editor ===
Contributors: kobmat
Donate Link: http://kobmat.com/math/?page_id=5919
Tags: math, equation, editor, latex
Requires at least: 1.5
Tested up to: 3.8.1
Stable tag: 1.05
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Inserts Math Equations on your posts. 

== Description ==

MathTex Equation Edtor is a Free and Open Source Wordpress plugin which is able to insert math equations on while adding/editing a post. It can also convert
equations made using the Codecogs editor to be rendered by the MathTex.cgi installation.

This plugin depends on a mathtex.cgi installation provided at http://www.forkosh.com/mathtex.html or any other service that renders Math LaTeX if supplied with the markup text on the URL. 
By default, the latex equations are rendered by the free mathtex.cgi installation provided at http://www.cyberroadie.org/cgi-bin/mathtex.cgi. 

To run mathTex.cgi installation on your own personal server, installation instructions can be found at http://www.forkosh.com/mathtex.html. 
You can also look up my blog post on the step by step installation of mathTex.cgi at http://kobmat.com/math/?p=5805.

For a quickstart guide on how to work with Math LaTeX, you can check on the guide for the syntax at http://www.forkosh.com/mimetextutorial.html

Features:

1. Insert images of math equations on your WYSIWYG Editor when creating/editing a blog post
2. Convert equations in you created using codecogs to be rendered to your equations.

== Installation ==

1. Upload "mathtex" directory to the "/wp-content/plugins/" directory
2. Activate the plugin through the "Plugins" menu in WordPress
3. Go to the Settings > MathTex Equation Editor, to change the MathTex Server URL and to enable or disable the conversion of your codecogs equations

== Frequently Asked Questions ==

= How do i edit the equations i added into my posts? =

Simple, just double click on the image. 

== Screenshots ==

1. The Math LaTeX Equation Editor with preview and the insert equation image on the wordpress editor
2. The icons added to the Wordpress editor toolbar.The icon inside the green square, if you were using codecogs before and you want to convert all the equations in the post to your mathtex.cgi installation. Clicking the button will scan the post for the equations and change the src to point to your mathTex Server location.

== Changelog ==

= 1.05 =
* Auto closing {,(, [ and | when typing on the MathTex Editor
* Auto completions of math LaTeX markup like \frac{}{} and \sqrt{}

