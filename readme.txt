=== MathTex Equation Editor ===
Contributors: kobmat
Donate Link: http://kobmat.com/math/?page_id=5919
Tags: math, equation, editor, latex
Requires at least: 1.5
Tested up to: 4.1
Version: 1.1.4
Stable tag: 1.1.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Inserts Math Equations on your posts. 

== Description ==

MathTex Equation Edtor is a Free and Open Source Wordpress plugin which is able to insert math equations on while adding/editing a post. It can also convert
equations made using the Codecogs editor to be rendered by the MathTex.cgi installation.

This plugin can be used with a mathtex.cgi installation provided at http://www.forkosh.com/mathtex.html or any other service that renders Math LaTeX if supplied 
with the markup text on the URL. By default, the latex equations are rendered by the free mathtex.cgi installation provided at http://chart.apis.google.com/chart?cht=tx&chl=. 

To run mathTex.cgi installation on your own personal server, installation instructions can be found at http://www.forkosh.com/mathtex.html. 
You can also look up my blog post on the step by step installation of mathTex.cgi at http://kobmat.com/math/?p=5805.

For a quickstart guide on how to work with Math LaTeX, you can check on the guide for the syntax at http://www.forkosh.com/mimetextutorial.html

Features:

1. Can work with a variety of Math Latex Rendering services. See Options for examples
2. Insert images of math equations on your WYSIWYG Editor when creating/editing a blog post
3. Convert equations in you created using codecogs to be rendered to your equations.
4. Easy to use Math Latex toolbar
5. Auto closes (, [, { and |, and inserts any selected text between the brackets, or parenthesis. Making typing equations a lot easier
5. Caches equations you insert into your blog post
6. Can be set to submit request to the Math Latex Rendering servers using PHP (gets around that annoying referrer error on post emails sent to subscribers)
7. Saves a history of the math latex mark up you inserted into your blog posts
8. Can Send entire equations or a selections of it to Wolfram Alpha

In the works:

1. Support for custom button on the toolbar for those most used latex mark up.
2. More icons especiall for matrices on the toolbar

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

= 1.0.5 =
* Auto closing {,(, [ and | when typing on the MathTex Editor
* Auto completions of math LaTeX markup like \frac{}{} and \sqrt{}

= 1.0.6 =
* Toolbar for to simplify math latex markups

= 1.0.7 =
* Allow PHP to request for the LateX Equation
* Caching of rendered equations
* Default MathLaTeX Service set to http://chart.apis.google.com/chart?cht=tx&chl=

= 1.0.8 =
* Fixes to html/latex.php
* Add to send to wolframalpha button
* Added History 

= 1.0.9 =
* Fixes to the javascript for the toolbar
* Added code to javascript to handle specifying focus and insertion point
* Fixes to the math latex mark up inserted via the toolbar
* Fixes to the javascript handling the history feature

= 1.1.0 =
* Fixes to the history feature
* Fixes to the editor

= 1.1.1 =
* Fixes to the javascript for the editor

== Upgrade Notice ==

= 1.0.5 =
This version add basic auto closing and completion features

= 1.0.6 =
This version add a math latex toolbar to simplify using math latex

= 1.0.7 =
This version allows the server to request for the equation using php and to cache the equation.

= 1.0.8 = 
This version contains fixes, a history function and way to send entire equations or selections to WolframAlpha

= 1.0.9 =
This version contains fixes to the javascript for the editor

= 1.1.0 = 
This version contain fixes to the history and the editor

= 1.1.1 = 
This version contain fixes to the javascript for the editor

= 1.1.2 =
Tested with Wordpress 3.9

= 1.1.3 = 
Tested with Wordpress 4.0

= 1.1.4 = 
Tested with Wordpress 4.1
Updates to options

= 1.1.5 =
Fixes to options