<?php defined( 'ABSPATH' ) or die( 'Cheatin\' uh?' ); ?>
<p>
  <label for="title">
  <?php _e( 'Title', 'wp-news-feed-widget' ) ?>
  </label>  
  <input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat">  
</p>
<p>
  <label for="numberposts">
  <?php _e( 'Number of posts to include', 'wp-news-feed-widget' ) ?>
  </label>  
  <input type="text" id="<?php echo $this->get_field_id('numberposts'); ?>" name="<?php echo $this->get_field_name('numberposts'); ?>" value="<?php echo $numberposts; ?>"><br>
  <span class="description"><?php _e( '-1 will include all posts', 'wp-news-feed-widget' ) ?></span>
</p>
<p>
  <label for="numberposts">
  <?php _e( 'Number of posts to display on one page', 'wp-news-feed-widget' ) ?>
  </label>  
  <input type="text" id="<?php echo $this->get_field_id('posts_per_page'); ?>" name="<?php echo $this->get_field_name('posts_per_page'); ?>" value="<?php echo $posts_per_page; ?>"><br>
</p>
<p>
  <input type="checkbox" id="<?php echo $this->get_field_id('truncate'); ?>" name="<?php echo $this->get_field_name('truncate'); ?>" value="1" <?php checked( 1, $truncate ) ?>>
  <label for="truncate">
  <?php _e( 'Truncate title ?', 'wp-news-feed-widget' ) ?>
  </label>  
</p>
<p>
  <label for="limit">
  <?php _e( 'Title length', 'wp-news-feed-widget' ) ?>
  </label>  
  <input type="text" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" value="<?php echo $title_limit; ?>"><br>
</p>
<p>
  <input type="checkbox" id="<?php echo $this->get_field_id('css_active'); ?>" name="<?php echo $this->get_field_name('css_active'); ?>" value="1" <?php checked( 1, $css_active ) ?>>
  <label for="css">
  <?php _e( "Use plugin's css ?", 'wp-news-feed-widget' ) ?>
  </label>  
</p>
<p>
  <label for="css">
  <?php _e( "Choose your style", 'wp-news-feed-widget' ) ?>
  </label><br>
  <select id="<?php echo $this->get_field_id('css_style'); ?>" name="<?php echo $this->get_field_name('css_style'); ?>">
    <option value="light" <?php selected( 'light', $css_style ) ?>><?php _e( 'Light', 'wp-news-feed-widget' ) ?></option>
    <option value="dark" <?php selected( 'dark', $css_style ) ?>><?php _e( 'Dark', 'wp-news-feed-widget' ) ?></option>
  </select>
</p>