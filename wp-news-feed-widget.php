<?php
/*
Plugin Name: WP News Feed Widget
Plugin URI: http://remyperona.fr/wp-news-feed-widget/
Description: A news feed widget with pagination
Version: 1.0
Author: Rémy Perona
Author URI: http://remyperona.fr
Author Email: remperona@gmail.com
Text Domain: wp-newsfw
Domain Path: /lang/
Network: true
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Copyright 2013 Rémy Perona (remperona@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class RP_Wpnwf extends WP_Widget {

	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/

	/**
	 * Specifies the classname and description, instantiates the widget,
	 * includes necessary stylesheets and JavaScript.
	 */
	public function __construct() {


		parent::__construct(
			'wp-newsfw',
			__( 'WP News Feed Widget', 'wp-newsfw' ),
			array(
				'classname'		=>	'wp-newsfw',
				'description'	=>	__( 'A news feed widget with pagination', 'wp-newsfw' )
			)
		);

		// Register site styles and scripts
		$wp_newsfw_data = get_option( 'widget_wp-newsfw' );
		if ( $wp_newsfw_data[2]['css_active'] == 1 ) {
		    add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_styles' ) );
		}
		add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_scripts' ) );

	} // end constructor

	/*--------------------------------------------------*/
	/* Widget API Functions
	/*--------------------------------------------------*/

	/**
	 * Outputs the content of the widget.
	 *
	 * @param	array	args		The array of form elements
	 * @param	array	instance	The current instance of the widget
	 */
	public function widget( $args, $instance ) {

		extract( $args, EXTR_SKIP );

		echo $before_widget;

		$title = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
		$numberposts = empty( $instance['numberposts'] ) ? '' : apply_filters( 'numberposts', $instance['numberposts'] );

		include( plugin_dir_path( __FILE__ ) . '/views/widget.php' );

		echo $after_widget;

	} // end widget

	/**
	 * Processes the widget's options to be saved.
	 *
	 * @param	array	new_instance	The previous instance of values before the update.
	 * @param	array	old_instance	The new instance of values to be generated via the update.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags( stripslashes( $new_instance['title'] ) );
		$instance['numberposts'] = strip_tags( stripslashes( $new_instance['numberposts'] ) );
		$instance['css_active'] = strip_tags( stripslashes( $new_instance['css_active'] ) );

		return $instance;

	} // end widget

	/**
	 * Generates the administration form for the widget.
	 *
	 * @param	array	instance	The array of keys and values for the widget.
	 */
	public function form( $instance ) {

    	// TODO:	Define default values for your variables
		$instance = wp_parse_args(
			(array) $instance,
			array(
			    'title' => __( 'News feed', 'wp-newsfw' ),
			    'numberposts' => '50',
			    'css_active' => 1
			)
		);

		$title = esc_attr( $instance['title'] );
		$numberposts = esc_attr( $instance['numberposts'] );
		$css_active = esc_attr( $instance['css_active'] );

		// Display the admin form
		include( plugin_dir_path(__FILE__) . '/views/admin.php' );

	} // end form

	/*--------------------------------------------------*/
	/* Public Functions
	/*--------------------------------------------------*/

	/**
	 * Registers and enqueues widget-specific styles.
	 */
	public function register_widget_styles() {
		wp_enqueue_style( 'wp-newsfw-widget-styles', plugins_url( 'wp-news-feed-widget/css/wp-newsfw.css' ) );

	} // end register_widget_styles

	/**
	 * Registers and enqueues widget-specific scripts.
	 */
	public function register_widget_scripts() {
		wp_enqueue_script( 'wp-newsfw-script', plugins_url( 'wp-news-feed-widget/js/wp-newsfw.js' ), array('jquery') );
		wp_localize_script( 'wp-newsfw-script', 'pager', array( 'prev' => __( 'Prev', 'wp-newsfw' ), 'next' => __( 'Next', 'wp-newsfw' ) ) );

	} // end register_widget_scripts

} // end class

add_action( 'widgets_init', create_function( '', 'register_widget("RP_Wpnwf");' ) );

function wp_newsfw_textdomain() {
    load_plugin_textdomain( 'wp-newsfw', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
}
add_action( 'plugins_loaded', 'wp_newsfw_textdomain' );