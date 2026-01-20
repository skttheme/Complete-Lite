<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package SKT Complete Lite
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php 
	$hideslide = get_theme_mod('hide_slides', '1');
	$hidetopbar = get_theme_mod('hide_topbar', '1');
	$hidepagebx = get_theme_mod('hide_boxes', '1'); 
?>  
<div class="header">
<?php if($hidetopbar == ''){ ?>
   <div class="signin_wrap">
  <div class="container">  
  	 <div class="left">
	 <?php if( '' !== get_theme_mod( 'top_phone')){ ?><span class="phntp"><i class="fa fa-phone"></i> <?php echo esc_attr( get_theme_mod( 'top_phone', '12 8888 6666', 'complete-lite' )); ?></span><?php } ?> 
     
       <?php 
	 	$top_email = get_theme_mod('top_email');
		if( !empty($top_email) ){ ?>
          <a href="mailto:<?php echo antispambot( sanitize_email( $top_email ) ); ?>"><i class="fa fa-envelope"></i> <?php echo antispambot( sanitize_email( $top_email ) ); ?></a>			
	 <?php } ?>
     
     </div>
     
     
     
     <div class="right"><?php if('' !== get_theme_mod('top_right1')){?><span class="sintp"><i class="fa fa-user"></i> <?php echo html_entity_decode(esc_attr( get_theme_mod( 'top_right1', 'Sign In', 'complete-lite' ))); ?></span><?php } ?> <?php if('' !== get_theme_mod('top_right2')){?><span class="suptp"><i class="fa fa-pencil"></i><?php echo html_entity_decode(esc_attr( get_theme_mod( 'top_right2', 'Sign Up', 'complete-lite' ))); ?> </span><?php } ?> </div>
     
     <div class="clear"></div>
  </div>
 </div><!--end signin_wrap-->
 <?php } ?>
        <div class="header-inner">
                <div class="logo">
                <?php complete_lite_the_custom_logo(); ?>
                <div class="clear"></div>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <h1><?php bloginfo('name'); ?></h1>
                <span class="tagline"><?php bloginfo( 'description' ); ?></span>                          
                </a>
                 </div><!-- logo -->                 
                <div class="toggle">
                <a class="toggleMenu" href="<?php echo esc_url('#');?>" style="display:none;"><?php esc_html_e('Menu','complete-lite'); ?></a>
                </div><!-- toggle -->
                <div class="nav">                  
                    <?php wp_nav_menu( array('theme_location' => 'primary')); ?>
                </div><!-- nav --><div class="clear"></div>
                    </div><!-- header-inner -->
</div><!-- header -->
<?php if (is_front_page() && !is_home()) { ?>
<!-- Slider Section -->
<?php for($sld=7; $sld<10; $sld++) { ?>
	<?php if( get_theme_mod('page-setting'.$sld)) { ?>
     <?php $slidequery = new WP_query('page_id='.get_theme_mod('page-setting'.$sld,true)); ?>
		<?php while( $slidequery->have_posts() ) : $slidequery->the_post();
        $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
        $img_arr[] = $image;
        $id_arr[] = $post->ID;
        endwhile;
  	  }
    }
?>

<?php if($hideslide == ''){ ?>
<?php if(!empty($id_arr)){ ?>
<section id="home_slider">
  <div class="slider-wrapper theme-default">
    <div id="slider" class="nivoSlider">
      <?php 
	$i=1;
	foreach($img_arr as $url){ ?>
      <img src="<?php echo esc_url($url);?>" title="#slidecaption<?php echo $i; ?>" />
      <?php $i++; }  ?>
    </div>
		<?php 
        $i=1;
        foreach($id_arr as $id){ 
        $title = get_the_title( $id ); 
        $post = get_post($id); 
        ?>
    <div id="slidecaption<?php echo $i; ?>" class="nivo-html-caption">
      <div class="slide_info">
        <h2><?php echo $title; ?></h2>
 		<p><?php the_excerpt(); ?></p>
        <div class="slidebtn"><a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','complete-lite');?></a></div>        
      </div>
    </div>
    <?php $i++; } ?>
  </div>
  <div class="clear"></div>
</section>
<?php } } ?>
 <div class="clear"></div>
<?php if($hidepagebx == ''){ ?>
<section id="wrapsecond">
            	<div class="container">                
                    <div class="sectionrow">
                   <?php if('' !== get_theme_mod('featured_heading')){?>
                    <h2><?php echo esc_html( get_theme_mod('featured_heading','Featured Boxes','complete-lite')); ?></h2>
                    <?php } ?>
<?php
$pages = array();
for ( $count = 1; $count <= 4; $count++ ) {
	$mod = get_theme_mod( 'page-setting' . $count );
	if ( 'page-none-selected' != $mod ) {
		$pages[] = $mod;
	}
}
$filterArray = array_filter($pages);
$filled_array=array_filter($pages);
$classNo = count($filled_array);	
	
$args = array(
	'posts_per_page' => 4,
	'post_type' => 'page',
	'post__in' => $pages,
	'orderby' => 'post__in'
);
$query = new WP_Query( $args );
if ( $query->have_posts() ) :
	$count = 1;
	while ( $query->have_posts() ) : $query->the_post();
	?>
	<div class="featured_block <?php echo 'fblock'.$classNo; if($count % $classNo == 0){ ?> no_margin_right<?php } ?>"> <a href="<?php the_permalink(); ?>">
        <?php if( has_post_thumbnail()) { ?>
          <div class="ftrthumb"><?php the_post_thumbnail() ?></div>
        <?php } ?>
          </a>
          <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          <p><?php the_excerpt(); ?></p>
          <a class="sktmore" href="<?php the_permalink(); ?>" style="color:#FFF;">
          <?php esc_attr_e('Read More','complete-lite');?>
          </a> </div>
        <?php if($count % $classNo == 0) { ?>
        <div class="clear"></div>
        <?php } ?>
	<?php
	$count++;
	endwhile; wp_reset_postdata();
 endif;
 
 
?></div><!-- services-wrap-->
               
             
               
              <div class="clear"></div>
            </div><!-- container -->
       </section>
         <?php } ?>
       <div class="clear"></div>      
<?php } ?>