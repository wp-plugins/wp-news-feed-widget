=== WP News feed widget ===

Contributors: tabrisrp
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=6V74BBTNMWW38&lc=FR&item_name=R%c3%a9my%20Perona&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted
Tags: widget, news
Requires at least: 3.2
Tested up to: 3.6
Stable tag: 1.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A simple news feed widget with pagination

== Description ==

WP News feed widget is a simple news feed widget, with pagination, to display the latest news on your website. It will display a list of your latest news titles, with the publication time (if today) or the publication date next to it.

In the widget configuration, you can set the number of posts you want to include, the number of posts per page and disable the plugin's css if you want to apply your own.

More features coming in future releases.

== Installation ==

1. Upload `wp-news-feed-widget` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to 'Appearance' -> 'Widgets' and drop it in your desired widget zone to configure

== Frequently Asked Questions ==

= What are the css classes to style the widget ? =

`/* ul list wrapper */
.wp-newsfw-list {}

/* list items */
.wp-newsfw-item {}

/* ul pager wrapper */
.pager {}

/* pager items */
.pager a,
.pager span {}

/* previous page item */
.prev {}

/* next page item */
.next {
    margin-left: 5px;
}`

= Why can't I configure more options ? =

More configuration is coming in future releases.

== Screenshots ==

1. Widget configuration
2. Widget display

== Changelog ==

= 1.1.1 =
* Security fixes
* Wrong label corrected in admin form

= 1.1 =
* changed basic css
* new js script for pagination + minification
* HTML5 time markup for time/date
* new option : posts per page
* new string translated in french

= 1.0 =
* Initial release.
