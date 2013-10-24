<?php
defined( 'ABSPATH' ) or die( 'Cheatin\' uh?' );

echo $before_title . $title . $after_title;
?>
<form method="get" action="" class="wp-newsfw-select">
    <?php
    $term_args = array( 'show_option_all' => __( 'Choose your category', 'wp-newsfw' ), 'id' => 'wpnfw_select', 'name' => 'wpnfw_select', 'orderby' => 'name', 'taxonomy' => 'category' );
    wp_dropdown_categories( apply_filters( 'wpnfw_term_query', $term_args ) ) ?>
</form>
<div id="wpnewsfw-container">
    <div class="wpnewsfw-pager"></div>
    <div class="info_text"></div>
    <ul id= "wp-newsfw-list" class="wp-newsfw-list">
        <?php echo $this->the_feed_list( '', $numberposts, $truncate, $title_limit ) ?>
    </ul>
</div>