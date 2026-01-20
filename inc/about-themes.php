<?php
/**
 * SKT Complete Lite About Theme
 *
 * @package SKT Complete Lite
 */
 
//about theme info
add_action( 'admin_menu', 'complete_lite_abouttheme' );
function complete_lite_abouttheme() {    	
	add_theme_page( __('About Theme', 'complete-lite'), __('About Theme', 'complete-lite'), 'edit_theme_options', 'complete_lite_guide', 'complete_lite_mostrar_guide');   
} 

//guidline for about theme
function complete_lite_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
?>

<style type="text/css">
@media screen and (min-width: 800px) {
.col-left {float:left; width: 65%; padding: 1%;}
.col-right {float:right; width: 30%; padding:1%; border-left:1px solid #DDDDDD; }
}
</style>

<div class="wrapper-info">
	<div class="col-left">
   		   <div style="font-size:16px; font-weight:bold; padding-bottom:5px; border-bottom:1px solid #ccc;">
			  <?php esc_html_e('About Theme Info', 'complete-lite'); ?>
		   </div>
          <p><?php esc_html_e('Complete Lite is a complete theme in every way and can be used for any business, commercial, corporate, personal, photography and eCommerce use. It is simple, adaptable as well as flexible and has been built using WordPress codex standards. It is fully translatable and compatible with numerous plugins like contact form 7 and WooCommerce, Nextgen Gallery etc.','complete-lite'); ?></p>
		  <a href="<?php echo esc_url(SKT_PRO_THEME_URL); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/free-vs-pro.png" alt="" /></a>
	</div><!-- .col-left -->
	
	<div class="col-right">			
			<div style="text-align:center; font-weight:bold;">
				<hr />
				<a href="<?php echo esc_url(SKT_LIVE_DEMO); ?>" target="_blank"><?php esc_html_e('Live Demo', 'complete-lite'); ?></a> | 
				<a href="<?php echo esc_url(SKT_PRO_THEME_URL); ?>"><?php esc_html_e('Buy Pro', 'complete-lite'); ?></a> | 
				<a href="<?php echo esc_url(SKT_THEME_DOC); ?>" target="_blank"><?php esc_html_e('Documentation', 'complete-lite'); ?></a>
                <div style="height:5px"></div>
				<hr />                
                <a href="<?php echo esc_url(SKT_THEME_URL); ?>" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/sktskill.jpg" alt="" /></a>
			</div>		
	</div><!-- .col-right -->
</div><!-- .wrapper-info -->
<?php } ?>