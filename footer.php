<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package SKT Complete Lite
 */
?>
<?php 
	$hidefooter = get_theme_mod('hide_footer', '1');		
?> 
<div id="footer-wrapper">
 <?php if($hidefooter == ''){ ?>
  <div class="footer">
    	<div class="container">
             <div class="cols-4">   
					<?php
                    $about_title = esc_attr(get_theme_mod('about_title'));
                     if( !empty($about_title) ){ ?>
                            <h5 class="section_title"><?php echo $about_title; ?></h5>              
                    <?php } ?>
					<?php 
                    $about_description = esc_attr(get_theme_mod('about_description'));
                    if( !empty($about_description) ){ ?> 
                    <?php echo $about_description; ?>
              <?php } ?>

              </div>                  
               <div class="cols-4">
                <?php if ( ! dynamic_sidebar( 'footer-1' ) ) : ?>	
                   <h5><?php esc_html_e('Recent Posts','complete-lite'); ?></h5>            	
					<?php $args = array( 'posts_per_page' => 3, 'post__not_in' => get_option('sticky_posts'), 'orderby' => 'date', 'order' => 'desc' );
					$the_query = new WP_Query( $args );
					?>
                    <?php while ( $the_query->have_posts() ) :  $the_query->the_post(); ?>
                        <div class="recent-post">
                         <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
                         <a href="<?php the_permalink(); ?>"><h6><?php the_title(); ?></h6></a>  
                         <?php echo wp_kses_post(complete_lite_short_the_content(get_the_content())); ?>	
                        </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                 <?php endif; ?>
                </div>

                <div class="cols-4 widget-column-4">
				<?php
                $contact_title = esc_attr(get_theme_mod('contact_title'));
                 if( !empty($contact_title) ){ ?>
                        <h5><?php echo $contact_title; ?></h5>              
                <?php } ?>
			    <?php
				 $contact_add = esc_attr(get_theme_mod('contact_add'));	
				 if (!empty($contact_add)){  ?>
                 <p><?php echo $contact_add; ?></p>
			  <?php } ?>
              <div class="phone-no">
              <?php
              $contact_no = esc_attr(get_theme_mod('contact_no'));
			  if(!empty($contact_no)){
			  ?>
         	  <strong><?php esc_html_e('Phone:', 'complete-lite'); ?></strong> 
			  <?php echo $contact_no; ?><br  />
	          <?php } ?>

            <?php 
	 	$contact_mail = get_theme_mod('contact_mail');
		if( !empty($contact_mail) ){ ?>
        <strong><?php if ( '' !== get_theme_mod( 'contact_mail' ) ){ esc_html_e('Email:', 'complete-lite'); } ?></strong>
          <a href="mailto:<?php echo antispambot( sanitize_email( $contact_mail ) ); ?>"><?php echo antispambot( sanitize_email( $contact_mail ) ); ?></a>			
	 <?php } ?>
           </div>
                <div class="clear"></div>  
                              
                <div class="social-icons">                   
                   <?php $fb_link = get_theme_mod('fb_link');
		 				if( !empty($fb_link) ){ ?>
            			<a title="facebook" class="fa fa-facebook fa-1x" target="_blank" href="<?php echo esc_url($fb_link); ?>"></a>
           		   <?php } ?>
                
                   <?php $twitt_link = get_theme_mod('twitt_link');
					if( !empty($twitt_link) ){ ?>
					<a title="twitter" class="fa fa-twitter fa-1x" target="_blank" href="<?php echo esc_url($twitt_link); ?>"></a>
          		  <?php } ?>
            
    			  <?php $gplus_link = get_theme_mod('gplus_link');
					if( !empty($gplus_link) ){ ?>
					<a title="google-plus" class="fa fa-google-plus fa-1x" target="_blank" href="<?php echo esc_url($gplus_link); ?>"></a>
           		  <?php }?>
            
           		  <?php $linked_link = get_theme_mod('linked_link');
					if( !empty($linked_link) ){ ?>
					<a title="linkedin" class="fa fa-linkedin fa-1x" target="_blank" href="<?php echo esc_url($linked_link); ?>"></a>
          		  <?php } ?>                  
                </div><!--end .social-icons-->
                   
                </div><!--end .widget-column-4-->
            <div class="clear"></div>
         </div><!--end .container-->
       </div><!--end .footer--> 
       <?php } ?>
        <div class="copyright-wrapper">
        	<div class="container">
              <div class="copyright-txt">
				<?php esc_attr_e('&copy; 2025','complete-lite');?> <?php bloginfo('name'); ?>. <?php esc_attr_e('All Rights Reserved.', 'complete-lite');?>				
			   </div>
               <div class="design-by">	
               <?php bloginfo('name'); ?> <?php esc_html_e('Theme By ','complete-lite');?> <a href="<?php echo esc_url('https://www.sktthemes.org/themes/');?>" target="_blank"><?php esc_html_e('SKT Premium Themes','complete-lite'); ?></a>		
			   </div>
               <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
<?php wp_footer(); ?>
</body>
</html>