=== WP Blog and Widget  ===
Contributors: wponlinesupport, anoopranawat 
Tags: wordpress blog , wordpress blog widget, Free wordpress blog, blog custom post type, blog tab, blog menu, blog page with custom post type, blog, latest blog, custom post type, cpt, widget
Requires at least: 3.1
Tested up to: 4.3.1
Author URI: http://wponlinesupport.com
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A quick, easy way to add an Blog custom post type, Blog widget to Wordpress.

== Description ==

Every CMS site needs a Blog section. WP Blog and widgets, manage and display blog, date archives, widget on your website. You can display latest blog post on your homepage/frontpage as well as
in inner page. 

This plugin add a Blog custom post type,  blog widget to your Wordpress site. WP Blog adds a Blog tab to your admin menu, which allows you to enter Blog post just as you would regular posts.

View [DEMO](http://demo.wponlinesupport.com/blog-demo/) for additional information.

= Installation help and support =
* Please check [Installation and Document ](http://wponlinesupport.com/sp_plugin/wp-blog-and-widgets/)  on our website.
* Get [Free installation and setup](http://wponlinesupport.com/plugin-installation-support/)  on your website.


**This wordpress blog plugin contains two shorcode**
<code>
1) Display Blog in a page (list view and grid view)
[blog limit="10"] 

2) Display Latest blog on Homepage/Frontpage in list view and grid view
[recent_blog_post limit="3" grid="3"]
</code>

= Important Note For How to Install =
* Install the Blog plugin and activate.
* Create a Blog page and add shortcode: 
<code> [blog] </code>
* Also you can Display the blog post with category wise :
<code> Sports news [blog category="category_id"] </code>
* Display blog with Grid:
<code>[blog grid="2"] </code>
* Also you can Display the blog post with Multiple categories wise 
<code> Sports Blog : 
[blog category="category_id"]

Arts Blog 
[blog category="category_id"]
</code>

* **Complete shortcode example:**
<code>[blog limit="10" category="category_id" grid="2"
 show_content="true" show_full_content="true" show_category_name="true"
show_date="false" content_words_limit="30" ]</code>

* Comments for the blog.

* Added Widget Options like Show Blog date, Show Blog Categories, Select Blog Categories.

* If you want to use Latest blog post on home page then use following shortcode 
<code>[recent_blog_post limit="3" grid="3"]</code>

= Following are Blog Parameters: =

* **limit :** [blog limit="10"] (Display latest 10 blog post and then pagination).
* **category :**  [blog category="category_id"] (Display Blog post categories wise).
* **grid :** [blog grid="2"] (Display blog in Grid formats).
* **show_date :** [blog show_date="false"] (Display Blog date OR not. By default value is "True". Options are "ture OR false")
* **show_content :** [blog show_content="true" ] (Display blog post Short content OR not. By default value is "True". Options are "ture OR false").
* **show_full_content :** [blog show_full_content="true"] (Display Full Blog post content on main page if you do not want word limit. By default value is "false")
* **show_category_name :** [blog show_category_name="true" ] (Display blog post category name OR not. By default value is "True". Options are "ture OR false").
* **content_words_limit :** [blog content_words_limit="30" ] (Control blog post short content Words limit. By default limit is 20 words).

If you are getting any kind of problum with Blog page means your are not able to see all blog posts then please remodify your permalinks Structure for example 
first select "Default" and save then again select "Custom Structure "  and save. 

Finally, the plugin adds a Recent Blog Post widget  which can be placed on any sidebar available in your theme. You can set the title of this list and the number of blog post to show.

= Added New Features : =
* Added new shortcode parameters show_date

= Features include: =
* Added Widget Options like Show Blog date, Show Blog Categories, Select Blog Categories.
* Just create a Blog page with any name and add the shortcode  <code> [blog] </code>
* Easy to configure.
* Smoothly integrates into any theme.
* Yearly, Monthly and Daily archives.
* Blog Categories.
* Blog Tags.
* Recent Blog Post widget. 
* CSS file for custmization.

 
== Installation ==

1. Upload the 'wp-blog-and-widgets' folder to the '/wp-content/plugins/' directory.
2. Activate the WP Blog and widgets plugin through the 'Plugins' menu in WordPress.
3. Add and manage Blog Post on your site by clicking on the  'Blog' tab that appears in your admin menu.
4. Create a page with the any name and paste this short code  <code> [blog] </code>.



== Screenshots ==
1. Display Blog Posts with grid-1 view.
2. Display Recent Blog Posts.
3. Display Blog Posts with List view.
4. Display Blog Posts with grid-3 view
5. Display Blog Posts with grid-2 view
6. Blog admin view


== Changelog ==

= 1.2 =
* Added new shortcode parameters show_date.
* Fixed some bugs.

= 1.1 =

* Added Widget Options like Show Blog date, Show Blog Categories, Select Blog Categories.
* Fixed some bugs

= 1.0 =
* Initial release


== Upgrade Notice ==

= 1.2 =
* Added new shortcode parameters show_date.
* Fixed some bugs.

= 1.1 =

* Added Widget Options like Show Blog date, Show Blog Categories, Select Blog Categories.
* Fixed some bugs

= 1.0 =
* Initial release


