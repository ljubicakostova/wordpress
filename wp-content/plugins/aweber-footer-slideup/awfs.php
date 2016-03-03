<?php
/*
	Plugin Name: AWeber Footer SlideUp
	Plugin URI: http://wordpress.org/extend/plugins/aweber-footer-slideup/
	Description: Footer Slideup Form is one of the best ways to ask users to subscribe to your list without any interruption or blocking and this plugin does exactly that. It adds an AWeber subscribe form in the footer of your Wordpress blog.
	Author: Shabbir Bhimani
	Version: 1.1
	Author URI: http://imtips.co/aweber-footer-slideup-installation-instructions.html
 */
if ( ! defined( 'WP_CONTENT_URL' ) )
    define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
if ( ! defined( 'WP_CONTENT_DIR' ) )
    define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
if ( ! defined( 'WP_PLUGIN_URL' ) )
    define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
if ( ! defined( 'WP_PLUGIN_DIR' ) )
    define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );
if ( ! defined( 'PLUGIN_ABS_URL' ) )
	define('PLUGIN_ABS_URL', WP_PLUGIN_URL . '/aweber-footer-slideup');

function awfs_js()
{
	if(!get_option('awfs_no_jquery')) wp_enqueue_script( 'jquery' );

	wp_enqueue_script(
		'awfs_cookie_script',
		PLUGIN_ABS_URL . '/js/jquery-cookie.js',
		array('jquery')
	);
	wp_enqueue_script(
		'awfs_libs_script',
		PLUGIN_ABS_URL . '/js/jquery-libs.js',
		array('jquery')
	);
}

function awfs_header_elements()
{
?>
<?php if(!get_option('awfs_no_css')) : ?><link rel="stylesheet" href="<?php echo PLUGIN_ABS_URL ?>/style.css" type="text/css" media="screen" /> <?php endif ?>
<?php
}

function awfs_form()  {
$awfs_hiddenfields = get_option('awfs_hiddenfields');
if($awfs_hiddenfields =='') return;
?>
<div id="footerform">
	<div class="close">
		<?php if(!get_option('awfs_no_close')): ?><div id="closefornow"> <a href="#" onclick="slidedown(); return false;">Close for now.</a></div> <?php endif ?>
	    <?php if(!get_option('awfs_no_never_show')): ?><div id="dontshowanymore"><a href="#" onclick="slidedown(); return false;">Never show again.</a></div> <?php endif ?>
	</div>
	<?php $awfs_tagimage= get_option('awfs_tagimage'); if(trim($awfs_tagimage)!='') echo "<img src='$awfs_tagimage' class='awfs_tagimage' alt='' border='0' />"; ?>
	<div class="tagline"><?php $awfs_tagline=get_option('awfs_tagline'); echo $awfs_tagline==''?'Subscribe By Email for Updates.':$awfs_tagline; ?></div>
	<form method="post" action="http://www.aweber.com/scripts/addlead.pl" target="_new" onsubmit="slidedown();savePermCookie();">
		<?php echo $awfs_hiddenfields ?>
		<?php if(!get_option('awfs_no_name_field')): ?><input type="text" name="name" class="formInputfooter formInputNamefooter" value="<?php $awfs_def_name=get_option('awfs_def_name'); echo $awfs_def_name==''?'Your Name':$awfs_def_name; ?>" size="20" /> <?php endif ?>
		<input type="text" name="from" class="formInputfooter formInputEmailfooter" value="<?php $awfs_def_email=get_option('awfs_def_email'); echo $awfs_def_email==''?'Your Best Email?':$awfs_def_email; ?>" size="20" />
		<input type="submit" name="submit" class="formInputSubmitfooter" value="<?php $awfs_def_submit=get_option('awfs_def_submit'); if($awfs_def_submit=='-')echo'';else if($awfs_def_submit=='')echo 'Subscribe' ; else echo $awfs_def_submit;?>" />
	</form>
	<?php $awfs_formstatstracking= get_option('awfs_formstatstracking'); if(trim($awfs_formstatstracking)!='') echo "<img src='$awfs_formstatstracking' border='0' width='0' height='0' alt='' />"; ?>
</div>
<?php
}
add_action ( 'wp_footer', 'awfs_form');
add_action ( 'wp_head', 'awfs_header_elements');
add_action ( 'wp_enqueue_scripts', 'awfs_js');
add_action ( 'admin_menu', 'awfs_plugin_menu');

function awfs_plugin_menu() {

	add_options_page('My Plugin Options', 'AWeber Footer SlideUp', 'manage_options', 'awfs', 'awfs_plugin_options');
	add_action( 'admin_init', 'register_awfs_settings' );
}

function register_awfs_settings() {
	//register settings
	register_setting( 'awfs-settings-group', 'awfs_tagline' );
	register_setting( 'awfs-settings-group', 'awfs_hiddenfields' );
	register_setting( 'awfs-settings-group', 'awfs_no_name_field' );
	register_setting( 'awfs-settings-group', 'awfs_no_jquery' );
	register_setting( 'awfs-settings-group', 'awfs_no_close' );
	register_setting( 'awfs-settings-group', 'awfs_no_never_show' );
	register_setting( 'awfs-settings-group', 'awfs_no_css' );
	register_setting( 'awfs-settings-group', 'awfs_def_name' );
	register_setting( 'awfs-settings-group', 'awfs_def_email' );
	register_setting( 'awfs-settings-group', 'awfs_def_submit' );
	register_setting( 'awfs-settings-group', 'awfs_formstatstracking' );
	register_setting( 'awfs-settings-group', 'awfs_tagimage' );
}


function awfs_plugin_options() {
?>
<div class="wrap">
<h2>AWeber Footer Slideup Settings</h2>
<p>Footer Slideup Form is one of the best ways to ask your user to subscribe to your list without any interruption or blocking and this plugin does exactly that. It adds an AWeber subscribe form in the footer of your Wordpress blog. You can read my detailed <A HREF="http://imtips.co/aweber-autoresponder-review.html" target="_blank">AWeber Review</A> on my blog.</p>
<p>For all your queries, help and support for plugin please post them in comments <A HREF="http://imtips.co/aweber-footer-slideup.html" target="_blank">at my blog</A>. I will be actively supporting the plugin.</p>
<p>Some people ask me how they can repay me back - which is not necessary - but for those wanting to show their appreciation, I just say linking to my blog <A href="http://imtips.co/">Internet Marketing Tips</a> is the best compensation I could receive.</p>
<!--<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=3BLM8E3A4TET8" target="_blank">Donate</a>-->
<form method="post" action="options.php">
<?php settings_fields( 'awfs-settings-group' ); ?>
<table class="form-table">
<tr valign="top">
<th scope="row">Tag Line</th>
<td><input type="text" name="awfs_tagline" value="<?php echo get_option('awfs_tagline'); ?>" />
<div>If nothing is entered you will see - "Subscribe By Email for Updates"</div>
</td>
</tr>
<tr valign="top">
<th scope="row">Hidden AWeber Form Date (Required)
<div style="font-weight:bold;color:red;padding-top:10px;">Generate an Inline form using the AWeber WebForm Interface. Grab the HTML code of your AWeber Form and Search for Hidden Div which lists all the hidden form fields. You will see it just after after the &lt;FORM&gt; tag. Read more detailed instructions <a target="_blank" href="http://imtips.co/aweber-footer-slideup-installation-instructions.html">here</a>
</div></th>
<td>
<textarea name="awfs_hiddenfields" id="awfs_hiddenfields" rows="10" cols="80"  ><?php echo get_option('awfs_hiddenfields'); ?></textarea>
</td>
</tr>
<tr valign="top">
<th scope="row">Don't show the Name Field.</th>
<td><INPUT TYPE="checkbox" NAME="awfs_no_name_field" id="awfs_no_name_field" value="1" <?php if(get_option('awfs_no_name_field')) echo 'checked'; ?>>
<div>If you want only the Email field in the form. Note that you need to generate AWeber form where Name is not a required field or else your user will see missing name field error and will not have the option to enter the name.</div>
</td>
</tr>
<tr valign="top">
<th scope="row">Don't include jQuery through plugin.</th>
<td><INPUT TYPE="checkbox" NAME="awfs_no_jquery" id="awfs_no_jquery" value="1" <?php if(get_option('awfs_no_jquery')) echo 'checked'; ?>>
<div>Never check this box unless you have issues with other sliders disappearing.</div></td>
</tr>
<tr valign="top">
<th scope="row">Don't show Close for Now Link.</th>
<td><INPUT TYPE="checkbox" NAME="awfs_no_close" id="awfs_no_close" value="1" <?php if(get_option('awfs_no_close')) echo 'checked'; ?>>
<div>Close for Now link hides the slider for the current session on every page of your blog. If user closes the browser and re-opens it, he will see the slideup once again.</div>
</td>
</tr>
<tr valign="top">
<th scope="row">Don't show Never Show Again Link.</th>
<td><INPUT TYPE="checkbox" NAME="awfs_no_never_show" id="awfs_no_never_show" value="1" <?php if(get_option('awfs_no_never_show')) echo 'checked'; ?>>
<div>Never Show Again link hides the slider permanently using cookies. You may need to clear cookies to see the slideup once again.</div>
</td>
</tr>
<tr valign="top">
<th scope="row">Don't Include Plugin CSS and I have added the CSS to my theme file.</th>
<td><INPUT TYPE="checkbox" NAME="awfs_no_css" id="awfs_no_css" value="1" <?php if(get_option('awfs_no_css')) echo 'checked'; ?>>
<div>Plugin CSS is stored in <A href="<?php echo PLUGIN_ABS_URL ?>/style.css"><?php echo PLUGIN_ABS_URL ?>/style.css</a> file and you can copy the content of the CSS file and paste into your theme's CSS file. Remember to copy the following 2 images as well.
<ol>
<li><img src="<?php echo PLUGIN_ABS_URL ?>/images/name.png" /> @ <a href="<?php echo PLUGIN_ABS_URL ?>/images/name.png"><?php echo PLUGIN_ABS_URL ?>/images/name.png</a></li>
<li><img src="<?php echo PLUGIN_ABS_URL ?>/images/mail.png" /> @ <a href="<?php echo PLUGIN_ABS_URL ?>/images/mail.png"><?php echo PLUGIN_ABS_URL ?>/images/mail.png</a></li>
</ol>
If you are using frameworks like Thesis or Genesis you can add them to the custom CSS options they provide. It will reduce an extra file request to the CSS file on your server.</div>
</td>
</tr>
<tr valign="top">
<th scope="row">Default Value in Name Field (Optional)</th>
<td><input type="text" name="awfs_def_name" value="<?php echo get_option('awfs_def_name'); ?>" />
<div>The Default Content of the Name Field. When user clicks the name field this value vanishes. If you leave it as blank, the form will take the default value of "Your Name".</div>
</td>
</tr>
<tr valign="top">
<th scope="row">Default Value in Email Field (Optional)</th>
<td><input type="text" name="awfs_def_email" value="<?php echo get_option('awfs_def_email'); ?>" />
<div>The Default Content of the Email Field. When user clicks the email field this value vanishes. If you leave it as blank, the form will take the default value of "Your Best Email".</div>
</td>
</tr>
<tr valign="top">
<th scope="row">Default Value in Submit Field (Optional)</th>
<td><input type="text" name="awfs_def_submit" value="<?php echo get_option('awfs_def_submit'); ?>" />
<div>Button Text. If you leave it as blank, the form will take the default value of "Subscribe" If you want to use an image background enter minus (-) and it will not show any text as output.</div>
</td>
</tr>
<tr valign="top">
<th scope="row">Tracking Image URL of AWeber Webform (Optional)</th>
<td><input type="text" name="awfs_formstatstracking" value="<?php echo get_option('awfs_formstatstracking'); ?>" />
<div>Aweber adds a 1px Image url code in the html to track the form impressions. You can add the image url here. If you don't understand what it means you can leave it blank.</div>
</td>
</tr>
<tr valign="top">
<th scope="row">Header Image URL (Optional)</th>
<td><input type="text" name="awfs_tagimage" value="<?php echo get_option('awfs_tagimage'); ?>" />
<div>If you want to show graphics in the bottom left corner of the slideup enter the image of url here. You can upload the image through the Wordpress Media Library and then copy the path of the image and paste here.</div></td>
</tr>
</table>
<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="awfs_formstatstracking,awfs_tagline,awfs_hiddenfields,awfs_tagimage,awfs_no_name_field,awfs_no_jquery,awfs_no_close,awfs_no_never_show,awfs_no_css,awfs_def_name,awfs_def_email,awfs_def_submit" />
<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>
</form>
</div>
<?php
}
?>
