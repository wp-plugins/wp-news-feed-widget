<?php
defined( 'ABSPATH' ) or die( 'Cheatin\' uh?' );

echo $before_title . $title . $after_title;
$posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $numberposts, 'ignore_sticky_posts' => 1 ) );
if ( $posts->have_posts() ) : ?>
    <ul id= "<?php echo $widget_id ?>" class="wp-newsfw-list">
    <?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
        <li class="wp-newsfw-item"><?php if ( get_the_date( 'm d Y' ) == date( 'm d Y' ) ) { echo '<time datetime="' . get_the_time( 'H:i' ) . '">' . get_the_time( get_option( 'time_format') ) . '</time>'; } else { echo '<time datetime="' . get_the_date( 'Y-m-d' ) . '">' . get_the_date( get_option( 'date_format') ) . '</time>'; } ?> <a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></li>
    <?php endwhile; ?>
    </ul>
    <div class="pager">
        <a class="prev" href="#"><?php _e( 'Prev', 'wp-newsfw' ) ?></a>
        <span id="count"></span>/<span id="total"></span>
        <a class="next" href="#"><?php _e( 'Next', 'wp-newsfw' ) ?></a>
    </div>
<?php endif;
wp_reset_postdata();