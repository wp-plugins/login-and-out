=== Plugin Name ===
Contributors: roggie
Donate link: http://www.rogerh.com/donate.html
Tags: widget, login, logout
Requires at least: 2.7
Tested up to: 2.8.4
Stable:1.2

Adds a user friendly widget to make login/logout easy. Compatible WP 2.7+.

== Description ==

Although WordPress comes with a similar feature, called the "Meta" widget, the built in Meta control uses a lot of screen space and presents more information than some site designers would like. This Login/Logout widget provides web designers with a compact alternative.

When the user is not logged in, the widget presents options to Register and to Login. For logged in users, the options change to Logout and, depending on the user's role, a link to their profile or to the main site administration pages.

If the user is logged in, the widget also display's the username and their email address.

Website administrators simply need to download and unzip the software, then copy one file to their WordPress plugins directory. Then login to WordPress as an administrator, go to the Plugins control panel and activate the plugin. Once activated, they can add the Login-Logout widget to any Widget-enabled WordPress sidebar.


== Installation ==

1. Copy the file login-and-out.php to your WordPress plugins directory.
2. Login to WordPress as an administrator, go to Plugins and Activate it.
3. Add the Hypervisor Login-Logout widget to your Widget-enabled Sidebar
   instead of the default "Meta" Widget

== Frequently Asked Questions ==

What is the required format for the links that can be displayed by the widget?
These settings are managed from the Tools menu, Login & Out menu option.
Enter any text description you line in the "Add text for new link" box.
Enter a full URI - e.g. http://www.thehypervisor.com - to link to an external site.
Enter a permalink - e.g. /about - to link to an internal Wordpress blog page or post.

= What about foo bar? =

Sorry, we can't help you with that one.

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.jpg. It shows the widget near the bottom right corner of the screen. Note that the screenshot is taken from
the directory of the stable readme.txt, so in this case, `/trunk/screenshot-1.jpg


== Changelog ==

= 1.1 =
Added new admin page to Tools menu.
- enables admin to enter list of text labels and URLs. If list is not empty, the links are displayed by the widget.
Added config options to widget:
- checkbox to toggle display of user's email address.
- checkbox to toggle center alignment of widget text.

= 1.2 =
Changed format for link URL displayed by widget. Enter full URI for extrnal website or /pagename for permalink to page on local wordpress site
