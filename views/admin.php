<?php defined( 'ABSPATH' ) or die( 'Cheatin\' uh?' ); ?>
<p>
  <label for="title">
  <?php _e( 'Title', 'wp-newsfw' ) ?>
  </label>  
  <input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat">  
</p>
<p>
  <label for="numberposts">
  <?php _e( 'Number of posts to include', 'wp-newsfw' ) ?>
  </label>  
  <input type="text" id="<?php echo $this->get_field_id('numberposts'); ?>" name="<?php echo $this->get_field_name('numberposts'); ?>" value="<?php echo $numberposts; ?>"><br>
  <span class="description"><?php _e( '-1 will include all posts', 'wp-newsfw' ) ?></span>
</p>
<p>
  <label for="posts_per_page">
  <?php _e( 'Number of posts to display on one page', 'wp-newsfw' ) ?>
  </label>  
  <input type="text" id="<?php echo $this->get_field_id('posts_per_page'); ?>" name="<?php echo $this->get_field_name('posts_per_page'); ?>" value="<?php echo $posts_per_page; ?>"><br>
</p>
<p>
  <label for="css">
  <?php _e( "Use plugin's css ?", 'wp-newsfw' ) ?>
  </label>  
  <select id="<?php echo $this->get_field_id('css_active'); ?>" name="<?php echo $this->get_field_name('css_active'); ?>">
    <option value="1" <?php selected( 1, $css_active ) ?>><?php _e( 'Yes', 'wp-newsfw' ) ?></option>
    <option value="0" <?php selected( 0, $css_active ) ?>><?php _e( 'No', 'wp-newsfw' ) ?></option>
  </select>
</p>