=== WP News feed widget ===

Contributors: tabrisrp
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=6V74BBTNMWW38&lc=FR&item_name=R%c3%a9my%20Perona&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted
Tags: widget, news, pagination
Requires at least: 3.2
Tested up to: 4.0
Stable tag: 1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A simple news feed widget with pagination

== Description ==

WP News feed widget is a simple news feed widget, with pagination, to display the latest news on your website. It will display a list of your latest news titles, with the publication time (if today) or the publication date next to it.

In the widget configuration, you can set the number of posts you want to include, the number of posts per page, chosse a style or disable the plugin's css if you want to apply your own.

The widget is customizable through a lot of filters and actions hooks.

== Installation ==

1. Upload `wp-news-feed-widget` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to 'Appearance' -> 'Widgets' and drop it in your desired widget zone to configure

== Frequently Asked Questions ==

= What are the css classes to style the widget ? =

`
/* Select category dropdown */
    .wp-newsfw-select> .postform {}

/* pager wrapper */
.wpnewsfw-pager,
.info_text {}

/* pager items */
.page_link {}

.active_page {}

.no_more {}

/* prev & next items */
.visually-hidden {}

[dir=rtl] .visually-hidden {}

.previous_link,
.next_link {}

/* list items */
.wp-newsfw-item {}
`

= Why can't I configure more options ? =

Options & customization can be added with the filter & hooks available, or with the add-ons.

= List of filters & actions hooks =

= Filters =
* `wpnfw_query_args` (array) : Allows changing the main widget query args
* `wpnfw_time_format` (string) : Allows changing the time format displayed in the widget
* `wpnfw_date_format` (string) : Allows changing the date format displayed in the widget

= Actions =
* `wpnfw_before_link` : Runs before an item link output
* `wpnfw_after_link` : Runs after an item link output
* `wpnfw_before_title` : Runs before the title output (inside the link)
* `wpnfw_after_title` : Runs after the title output (inside the link)

== Screenshots ==

1. Widget configuration
2. Widget display

== Changelog ==

= 1.2 =
* Added filters and actions hooks to allow customization of the widget settings and output
* New Pager script
* New default styles for light and dark themes

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
