<?php
/*
Plugin Name: Login-Logout
Version: 1.0
Author: Roger Howorth
Author URI: www.thehypervisor.com
Description: Adds a user friendly widget to make login/logout easy. Compatible WP 2.7+
License: http://www.gnu.org/licenses/gpl.html
*/
/*
Installation
1. Copy the file login-and-out.php to your WordPress plugins directory.
2. Login to WordPress as Administrator, go to Plugins and Activate it.
3. Add the Login-Logout widget to your Widget-enabled Sidebar
   instead of the default "Meta" Widget

Credit: Thanks to Patrick Khoo http://www.deepwave.net/ for model code. I worked with his Hide dashboard code, removed unwanted sections and updated for Wordpress 2.7+.

Copyright (c) 2009 Roger Howorth

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

*/

function rhsidebar_meta($args) {
	extract ($args);
	global $user_identity , $user_email;
	$options = get_option('dw_hidedash_options');
	echo $before_widget;
	echo $before_title . $options['title'] . $after_title;

	if (is_user_logged_in()) {
		// User Already Logged In
		get_currentuserinfo();  // Usually someone already did this, right?
		printf('Welcome, <u><b>%s</b></u> (%s)<br />Options: &nbsp;',$user_identity,$user_email);

		// Default Strings
		$link_string_site = "<a href=\"".get_bloginfo('wpurl')."/wp-admin/index.php\" title=\"".__('Site Admin')."\">".__('Site Admin')."</a>&nbsp;&nbsp;|&nbsp;&nbsp;";
		$link_string_logout = '<a href="'. wp_logout_url(get_permalink()) .'" title="Log out">Log out</a>';
		$link_string_edit = "<a href=\"".get_bloginfo('wpurl')."/wp-admin/edit.php\" title=\"".__('Edit Posts')."\">".__('Edit Posts')."</a>&nbsp;&nbsp;|&nbsp;&nbsp;";
		$link_string_profile = "<a href=\"".get_bloginfo('wpurl')."/wp-admin/profile.php\" title=\"".__('My Profile')."\">".__('My Profile')."</a>&nbsp;&nbsp;|&nbsp;&nbsp;";

		// Administrator?
		if (current_user_can('level_10')) {
			echo $link_string_site;
			echo $link_string_logout;
			echo $after_widget;
			return;
		}

		// level_2?
		if (current_user_can('level_2')) {
			if ($options['allow_authed']) {
				// Allow level_2 user to see Dashboard - treat like Administrator
				echo $link_string_site;
				echo $link_string_logout;
				echo $after_widget;
				return;
			}
			// Hide Dashboard for level_2 user
			echo $link_string_edit;
			echo $link_string_logout;
			echo $after_widget;
			return;
		}

		// Less than level_2 user - Hide Dashboard from this User
		echo $link_string_profile;
		echo $link_string_logout;
		echo $after_widget;
		return;
	}

	// User _NOT_ Logged In
	echo "<a href=\"".get_bloginfo('wpurl')."/wp-login.php?action=register&amp;redirect_to=".$_SERVER['REQUEST_URI']."\" title=\"".__('Register')."\">".__('Register')."</a>&nbsp;&nbsp;|&nbsp;&nbsp;";
	echo "<a href=\"".get_bloginfo('wpurl')."/wp-login.php?action=login&amp;redirect_to=".$_SERVER['REQUEST_URI']."\" title=\"".__('Login')."\">".__('Login')."</a>";
	echo $after_widget;
	return;
}

function rhsidebar_meta_control () {
	$options = get_option('rh_hidedash_options');
	if ( $_POST['rhhd_submit'] ) {
		$options['title'] = strip_tags(stripslashes($_POST['rhhd_title']));
		update_option('rh_hidedash_options', $options);
	}
	$title = wp_specialchars($options['title']);
	?>
	<p style="text-align: center">
		<input type="hidden" name="rhhd_submit" id="rhhd_submit" value="1" />
		<label for="rhhd_title"><?php _e('Title:'); ?> <input type="text" id="rhhd_title" name="rhhd_title" value="<?php echo $title; ?>" /></label>
	</p>
	<?php
	return;
}


function rh_plugin_init() {
	register_sidebar_widget('Hypervisor Login/Logout', 'rhsidebar_meta');
	register_widget_control('Hypervisor Login/Logout', 'rhsidebar_meta_control');
	return;
}

add_action("plugins_loaded", "rh_plugin_init");

?>

