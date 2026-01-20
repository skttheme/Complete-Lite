<?php
/**
 * The template for displaying home page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package SKT Complete Lite
 */

get_header(); 
?>
<?php if ( 'page' == get_option( 'show_on_front' ) && ( '' != get_option( 'page_for_posts' ) ) && $wp_query->get_queried_object_id() == get_option( 'page_for_posts' ) ) : ?>   
<div class="container">
     <div class="page_content">
        <section class="site-main">
        	 <div class="blog-post">
					<?php
                    if ( have_posts() ) :
                        // Start the Loop.
                        while ( have_posts() ) : the_post();
                            /*
                             * Include the post format-specific template for the content. If you want to
                             * use this in a child theme, then include a file called called content-___.php
                             * (where ___ is the post format) and that will be used instead.
                             */
                            get_template_part( 'content', get_post_format() );
                    
                        endwhile;
                        // Previous/next post navigation.
                        	the_posts_pagination( array(
							'mid_size' => 2,
							'prev_text' => __( 'Back', 'complete-lite' ),
							'next_text' => __( 'Onward', 'complete-lite' ),
						) );
                    
                    else :
                        // If no content, include the "No posts found" template.
                         get_template_part( 'no-results', 'index' );
                    
                    endif;
                    ?>
                    </div><!-- blog-post -->
             </section>
      
        <?php get_sidebar();?>     
        <div class="clear"></div>
    </div><!-- site-aligner -->
</div><!-- content -->
<?php else: ?>
       <div class="clear"></div>
  
 <section id="FrontBlogPost">
  <div class="container">
  <h1 class="entry-title"><center><?php esc_html_e('Latest Posts','complete-lite'); ?></center></h1>       
     <div class="site-main" id="sitefull">         
      <?php
	  $p = 0;
	  $args = array('post__not_in' => get_option('sticky_posts'), 'orderby' => 'date', 'order' => 'desc', 'paged' => get_query_var('paged') );
	  $postquery = new WP_Query( $args );
	  ?>			
        <?php while( $postquery->have_posts() ) : $postquery->the_post(); ?><?php $p++; ?>      
            <div class="blog_lists homepost BlogPosts <?php if( $p%4==0 ){?>last_column<?php } ?>">    
              <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                <?php if( has_post_thumbnail() ) { ?>
                <div class="thumbbox">
                <?php the_post_thumbnail(); ?>
                </div>
                <?php } ?>
                </a>
               <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <div class="blog-meta"><?php echo get_the_date(); ?> | <?php comments_number(); ?></div>
              <?php the_excerpt(); ?>
              <a class="sktmore" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more','complete-lite');?></a> 
              <div class="clear"></div>
          </div> 
          <?php if( $p%4==0 ){?><div class="clear"></div><?php } ?>     
        <?php endwhile; ?> 
        <?php 
		    // Previous/next post navigation.
			the_posts_pagination( array(
			'mid_size' => 2,
			'prev_text' => __( 'Back', 'complete-lite' ),
			'next_text' => __( 'Onward', 'complete-lite' ),
		) );
		?>   
      <div class="clear"></div>
  </div> 
  </div><!-- .container -->   
 </section><!-- #FrontBlogPost -->  
<?php endif; ?>
<?php get_footer(); ?>