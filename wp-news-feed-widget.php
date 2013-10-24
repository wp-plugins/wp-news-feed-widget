<?php
/*
Plugin Name: WP News Feed Widget
Plugin URI: http://remyperona.fr/wp-news-feed-widget/
Description: A news feed widget with pagination
Version: 1.2
Author: Rémy Perona
Author URI: http://remyperona.fr
Author Email: remperona@gmail.com
Text Domain: wp-news-feed-widget
Domain Path: /lang
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

class RP_Wpnfw extends WP_Widget {

	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/

	/**
	 * Specifies the classname and description, instantiates the widget,
	 * includes necessary stylesheets and JavaScript.
	 */
	public function __construct() {

        add_action( 'plugins_loaded', array( $this, 'wp_newsfw_textdomain' ) );
        // AJAX handler
        add_action( 'wp_ajax_get_widget_posts', array( $this, 'get_widget_posts' ) );
        add_action( 'wp_ajax_nopriv_get_widget_posts', array( $this, 'get_widget_posts' ) );

		parent::__construct(
			'wp-news-feed-widget',
			__( 'WP News Feed Widget', 'wp-news-feed-widget' ),
			array(
				'classname'		=>	'wp-news-feed-widget',
				'description'	=>	__( 'A news feed widget with pagination', 'wp-news-feed-widget' )
			)
		);

		// Register site styles and scripts
        add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_styles' ) );
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
		$numberposts = empty( $instance['numberposts'] ) ? '' : $instance['numberposts'];
		$posts_per_page = empty( $instance['posts_per_page'] ) ? '' : $instance['posts_per_page'];
		$truncate = empty( $instance['truncate'] ) ? '' : $instance['truncate'];
		$title_limit = empty( $instance['limit'] ) ? '' : $instance['limit'];

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
		$instance['posts_per_page'] = strip_tags( stripslashes( $new_instance['posts_per_page'] ) );
		$instance['truncate'] = strip_tags( stripslashes( $new_instance['truncate'] ) );
		$instance['limit'] = strip_tags( stripslashes( $new_instance['limit'] ) );
		$instance['css_active'] = strip_tags( stripslashes( $new_instance['css_active'] ) );
        $instance['css_style'] = strip_tags( stripslashes( $new_instance['css_style'] ) );

		return $instance;

	} // end widget

	/**
	 * Generates the administration form for the widget.
	 *
	 * @param	array	instance	The array of keys and values for the widget.
	 */
	public function form( $instance ) {
        $instance_args = array(
			    'title' => __( 'News feed', 'wp-news-feed-widget' ),
			    'numberposts' => 50,
			    'posts_per_page' => 10,
			    'truncate' => 0,
			    'limit' => 30,
			    'css_active' => 1,
			    'css_style' => 'light'
			);

		$instance = wp_parse_args(
			(array) $instance,
			$instance_args
		);

		$title = esc_attr( $instance['title'] );
		$numberposts = esc_attr( $instance['numberposts'] );
		$posts_per_page = esc_attr( $instance['posts_per_page'] );
		$truncate = esc_attr( $instance['truncate'] );
		$title_limit = esc_attr( $instance['limit'] );
		$css_active = esc_attr( $instance['css_active'] );
		$css_style = esc_attr( $instance['css_style'] );

		// Display the admin form
		include( plugin_dir_path(__FILE__) . '/views/admin.php' );

	} // end form

	/*--------------------------------------------------*/
	/* Public Functions
	/*--------------------------------------------------*/

	public function wp_newsfw_textdomain() {
        load_plugin_textdomain( 'wp-news-feed-widget', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
    }

	/**
	 * Registers and enqueues widget-specific styles.
	 */
	public function register_widget_styles() {
	    $css_active = $this->widget_options( 'css_active' );
	    if ( $css_active == 1 ) {
		    wp_enqueue_style( 'wp-newsfw-widget-styles', plugins_url( 'wp-news-feed-widget/css/' . $this->widget_options( 'css_style' ) . '.css' ) );
		}

	} // end register_widget_styles

	/**
	 * Registers and enqueues widget-specific scripts.
	 */
	public function register_widget_scripts() {
		wp_enqueue_script( 'wp-newsfw-script', plugins_url( 'wp-news-feed-widget/js/wp-newsfw.min.js' ), array( 'jquery' ), '1.2', true );
		wp_localize_script( 'wp-newsfw-script', 'wpnewsfw', array( 'prev' => '<span class="visually-hidden">' . __( 'Prev', 'wp-news-feed-widget' ) . '</span>', 'next' => '<span class="visually-hidden">' . __( 'Next', 'wp-news-feed-widget' ) . '</span>', 'perpage' => $this->widget_options( 'posts_per_page' ), 'numberposts' => $this->widget_options( 'numberposts' ), 'truncate' => $this->widget_options( 'truncate' ), 'title_limit' => $this->widget_options( 'limit' ), 'ajaxurl' => admin_url( '/admin-ajax.php' ), 'security' => wp_create_nonce( 'wpnewsfw-security' ) ) );

	} // end register_widget_scripts

    /**
	 * Retrieves the widget settings values
	 */
    public function widget_options( $key ) {
        $widget_id = $this->number;
	    $wp_newsfw_data = $this->get_settings();
	    return $wp_newsfw_data[$widget_id][$key];
    }

    /**
	 * Outputs the widget list
	 */
	 public function the_feed_list( $cat = '', $numberposts, $truncate, $title_limit) {
        $html;
        $cat = absint( $cat );
        $html = $cat;
        $numberposts = ( int ) $numberposts;
        $truncate = absint( $truncate );
        $title_limit = ( int ) $title_limit;
        $query_args = array(
            'post_status' => 'publish',
            'posts_per_page' => $numberposts,
            'ignore_sticky_posts' => 1,
        );
        if ( !empty( $cat ) ) {
            $query_args['tax_query'] = array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'id',
                    'terms' => $cat
                )
            );
        }
        $query_args = apply_filters( 'wpnfw_query_args', $query_args );
        $posts = new WP_Query( $query_args );
        // if we have results
        if ( $posts->have_posts() ) {
            $html = '';
            while ( $posts->have_posts() ) {
                $posts->the_post();
                $html .= '<li class="wp-newsfw-item">';
                if ( get_the_date( 'm d Y' ) == date( 'm d Y' ) ) { 
                    $html .= '<time datetime="' . get_the_time( 'H:i' ) . '">' . apply_filters( 'wpnfw_time_format', get_the_time( get_option( 'time_format') ) ) . '</time> ';
                } else {
                    $html .= '<time datetime="' . get_the_date( 'Y-m-d' ) . '">' . apply_filters( 'wpnfw_date_format', get_the_date( get_option( 'date_format') ) ) . '</time> ';
                }
                $html .= do_action( 'wpnfw_before_link', get_the_id() );
                $html .= '<a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '">';
                $html .= do_action( 'wpnfw_before_title', get_the_id() );
                if ( $truncate == 1 ) {
                    $html .= $this->truncate_title( $title_limit );
                } else {
                    $html .= get_the_title();
                }
                $html .= do_action( 'wpnfw_after_title', get_the_id() );
                $html .= '</a>';
                $html .= do_action( 'wpnfw_after_link', get_the_id() );
                
                $html .= '</li>';
            }
            wp_reset_postdata();
        } else {
            $html = __( 'No posts for this category', 'wp-news-feed-widget' );
        }
        return $html;
	 }

    /**
	 * Handler function for AJAX request
	 */
    public function get_widget_posts() {
        $html = '';
        if ( isset( $_POST['idCat'] ) && isset( $_POST['security'] ) ) {
            if (check_ajax_referer( 'wpnewsfw-security', 'security', false ) ) {
                $html = $this->the_feed_list( $_POST['idCat'], $_POST['numberposts'], $_POST['truncate'], $_POST['title_limit'] );
            } else {
                $html = __( 'Something not okay here', 'wp-news-feed-widget' );
            }
        } else {
            $html = __( 'No category selected', 'wp-news-feed-widget' );
        }
        echo json_encode( $html );
        die();
    }

    /**
	 * Truncates item's title by the $limit defined in the widget settings
	 */
    public function truncate_title( $limit ) {
        $the_title = get_the_title();
        if ( mb_strlen( $the_title, 'utf8' ) > $limit ) {
            $last_space = strrpos( substr( $the_title, 0, $limit ), ' ' );
            $the_title = substr( $the_title, 0, $last_space ) . '...';
        }
        return $the_title;
    }
} // end class

add_action( 'widgets_init', create_function( '', 'register_widget("RP_Wpnfw");' ) );
