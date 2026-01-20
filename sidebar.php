<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package SKT Complete Lite
 */
?>
<div id="sidebar">    
    <?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
    <div class="widget">
      <div class="widget_wrap">
        <h3 class="widget-title">
          <?php _e( 'Archives', 'complete-lite' ); ?>
        </h3>
        <span class="widget_border"></span>
        <ul>
          <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
        </ul>
      </div>
    </div>
    <div class="widget">
      <div class="widget_wrap">
        <h3 class="widget-title">
          <?php _e( 'Meta', 'complete-lite' ); ?>
        </h3>
        <span class="widget_border"></span>
        <ul>
			<?php wp_register(); ?>
            <li><?php wp_loginout(); ?></li>
            <?php wp_meta(); ?>
        </ul>
      </div>
    </div>
    <?php endif; // end sidebar widget area ?>	
</div><!-- sidebar -->