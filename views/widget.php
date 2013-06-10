<?php echo $before_title . $title . $after_title;
$posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $numberposts, 'ignore_sticky_posts' => 1 ) );
if ( $posts->have_posts() ) : ?>
    <ul id="wp-newsfw-list" class="wp-newsfw-list">
    <?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
        <li class="wp-newsfw-item"><?php if ( get_the_date( 'm d Y' ) == date( 'm d Y' ) ) { echo the_time( get_option( 'time_format') ); } else { echo get_the_date( get_option( 'date_format' ) ); } ?> <a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></li>
    <?php endwhile; ?>
    </ul>
<?php endif;
wp_reset_postdata() ?>