<?php get_header(); 
$img = series_get_meta('fondo_player'); 
$tvsplash = get_option('tv_splash'); 
?>
<div id="main" class="page-detail" style="padding-top: 70px;">
<div class="container">
<div class="pad"></div>
<div class="main-content main-detail">
<span style="font-size: xx-small;"><a href="https://jasaseo.be/"><span style="color: white;">Jasa SEO profesional</span></a> <a href="https://jasaseo.be/jasa-seo-murah-berkualitas/"><span style="color: white;">Jasa SEO profesional</span></a></span>
<?php if(get_option("notice_location") == "global" ){?>
<?php get_template_part('includes/parts/notice'); ?>
<?php }?>
<?php psythemes_breadcrumbs();?>

<?php $active = get_option('tv-ad-1'); if ($active == "true") { ?>

            <div class="content-kuss" >
<?php if ($note = get_option('ads-vid-1-title')) { ?>
                <div id="content-kuss-title"> <span><?php echo $note; ?></span></div>
<?php }?>
				<?php if ($ads = get_option('ads-vid-1-code')) { ?><div class="content-kuss-ads"><?php echo stripslashes($ads); ?></div><?php }?>
            </div>
<?php }?> 			
<div id="mv-info">
<?php if($tvsplash== "enable") {?>
<?php   if(!empty($img)) {?><a title="<?php the_title(); ?>" class="thumb mvi-cover splash-image" style="background-image: url(<?php echo $img;?>)"></a><?php }?>
<?php }?>

<div id="content-embed" style="<?php  if($tvsplash == "enable") { if(empty($img)) { echo 'display:block;';} } else {  echo 'display:block;';}?>">
<?php include_once 'parts/notice.php'; ?>
<div id="content-cover" style="background-image:url(<?php if($fondo = series_get_meta('fondo_player')) { $img = str_replace("/t/p/w300/","/t/p/w1280/",$fondo); echo $img; } else { echo get_template_directory_uri().'/images/cover.jpg'; } ?>);"></div>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php include_once 'parts/series/season_episodes.php'; ?>
<?php endwhile; endif; ?>
</div>
  

<?php $active = get_option('tv-ad-2'); if ($active == "true") { ?>

            <div class="content-kuss" >
<?php if ($note = get_option('ads-vid-2-title')) { ?>
                <div id="content-kuss-title"> <span><?php echo $note; ?></span></div>
<?php }?>
				<?php if ($ads = get_option('ads-vid-2-code')) { ?><div class="content-kuss-ads"><?php echo stripslashes($ads); ?></div><?php }?>
            </div>
<?php }?> 			
  
 <div class="mvi-content" itemscope itemtype="http://schema.org/TVSeries" style="margin-top:0;<?php if($tvsplash == "enable" && !empty($img)) { echo 'margin-top: -5px;'; }?>">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php get_template_part('includes/single/parts/series/microdata'); ?>
<div class="mvic-btn">
<?php $active = get_option('watch-ratings'); if ($active == "true") { ?>
<div class="mv-rating">
<?php echo star_rating(); ?>	
<div class="clearfix"></div>
</div>
<?php }?>
<div class="clearfix"></div>
<?php get_template_part('includes/single/parts/fake_buttons'); ?>
 </div>
 <div class="thumb mvic-thumb" style="background-image: url('<?php echo psy_get_thumb(); ?>');">
<img itemprop="image" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" src="<?php echo psy_get_thumb(); ?>" class="hidden" style="width: 140px; height: 210px;">
</div>
 <div class="mvic-desc">
<h3 itemprop="name"><?php the_title(); ?></h3>
<?php if($values = info_movie_get_meta("youtube_id")) { ?>
<div class="block-trailer">
<a data-target="#pop-trailer" data-toggle="modal" class="pop-trailer btn btn-primary">
<i class="fa fa-video-camera mr5"></i><?php _e('Trailer', 'psythemes'); ?>
</a>
</div>
<?php }?>
<div class="block-social">
<!-- Go to www.addthis.com/dashboard to customize your tools --> 
<div class="addthis_inline_share_toolbox"></div>
</div>
<div itemprop="description" class="desc">
<?php the_content(); ?></div>
<div class="mvic-info">
<div class="mvici-left">
<?php if(get_option("watch-views") == "true") {?>
<?php $noners = series_get_meta("views"); if(function_exists('the_views') &&  !empty($noners)) { ?><p><strong><?php _e('Views:', 'psythemes'); ?></strong> <?php echo $noners;?></p><?php }?>
<?php }?>
<p>
<strong><?php _e('Genre:', 'psythemes'); ?> </strong>
<?php the_category(',&nbsp;',''); ?>
</p>
<?php if ($dato = get_the_term_list($post->ID, 'director', '', ', ', '')){?><p><strong><?php _e('Director:', 'psythemes'); ?> </strong><span itemprop="director"><?php echo $dato; ?></span></p><?php }?>
<?php if ($dato = get_the_term_list($post->ID, 'stars', '', ', ', '')){?><p ><strong><?php _e('Actors:', 'psythemes'); ?> </strong><span ><?php echo $dato; ?></span></p><?php }?>
<?php if ($dato = get_the_term_list($post->ID, 'studio', '', ', ', '')){?><p><strong><?php _e('Studio:', 'psythemes'); ?> </strong><span itemprop="productionCompany"><?php echo $dato; ?></span></p><?php }?>
</div>
<div class="mvici-right">
<?php if($dato = series_get_meta('status')) { ?>
<p><strong><?php _e('TV Status:', 'psythemes'); ?></strong> <span itemprop="duration"><?php echo $dato; ?></span></p>
<?php } ?> 
<?php if($dato = series_get_meta('episode_run_time')) { ?>
<p><strong><?php _e('Duration:', 'psythemes'); ?></strong> <span itemprop="duration"><?php echo $dato; ?> <?php _e('min', 'psythemes'); ?></span></p>
<?php } ?> 
<?php if($dato = get_the_term_list($post->ID, 'release-year', '', ', ', '')) { ?>
<p><strong><?php _e('Release:', 'psythemes'); ?></strong> <?php echo $dato; ?></p>
<?php } ?>
<?php if(get_post_custom_values("youtube_id")) { ?>
 <div itemscope itemtype="http://schema.org/VideoObject">       
<?php $trailers = get_post_meta($post->ID, "youtube_id", $single = true); mostrar_trailer_meta($trailers) ?>
<meta itemprop="name" content="<?php the_title(); ?>">
<?php if($noners = get_post_custom_values("tagline")) { ?><meta itemprop="description" conTent="<?php echo $noners[0]; ?>"><?php } ?>
<?php if($noners = get_post_custom_values("fondo_player")) { ?><meta itemprop="thumbnailUrl" conTent="<?php echo $noners[0]; ?>"><?php } ?>
<meta itemprop="uploadDate" content="<?php the_date('c'); ?>">
</div>
<?php } ?>
<!-- Micro data -->
<meta itemprop="url" content="<?php the_permalink() ?>" />
<meta itemprop="datePublished" content=""/>
<?php if($noners = info_movie_get_meta("tagline")) { ?><meta itemprop="headline" conTent="<?php echo $noners; ?>"><?php } ?>

<!-- Micro data -->				

<div class="imdb_r" itemtype="http://schema.org/AggregateRating" itemscope="" itemprop="aggregateRating">
<?php if($dato = series_get_meta('serie_vote_average')) { ?> 
<p><strong><?php _e('TMDb:', 'psythemes'); ?></strong> <span itemprop="ratingValue" class="imdb-r"><?php echo $dato; ?></span></p>
<?php } ?>
<?php if ($dato = get_the_term_list($post->ID, 'country', '', ', ', '')){?><p><strong><?php _e('Country:', 'psythemes'); ?> </strong><span itemprop="countryOfOrigin"><?php echo $dato; ?></span></p><?php }?>
<?php if ($dato = get_the_term_list($post->ID, 'networks', '', ', ', '')){?><p><strong><?php _e('Networks:', 'psythemes'); ?> </strong><?php echo $dato; ?></p><?php }?>
</div>
</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>
<?php endwhile; endif; ?>  


</div>

<!-- keywords -->
<?php the_tags('<div id="mv-keywords"> <strong class="mr10">Keywords:</strong>', ' ', '</div>'); ?>
<!-- /keywords -->

<?php get_template_part('includes/single/parts/images-slideshow'); ?>

<?php $table = get_option('dltb_tv'); if($table != "false" || $table == "true") : get_template_part('includes/single/parts/link-lock'); endif;?>

<?php $active = get_option('tv-ad-3'); if ($active == "true") { ?>

            <div class="content-kuss" >
<?php if ($note = get_option('ads-vid-3-title')) { ?>
                <div id="content-kuss-title"> <span><?php echo $note; ?></span></div>
<?php }?>
				<?php if ($ads = get_option('ads-vid-3-code')) { ?><div class="content-kuss-ads"><?php echo stripslashes($ads); ?></div><?php }?>
            </div>
<?php }?> 			


<?php $activar = get_option('comm_tv'); if ($activar == "true") { ?>
<div id="commentfb">
<?php get_template_part('includes/single/parts/comments'); ?>
</div>
<?php }?>

<?php $active = get_option('widget_related_tv'); if ($active == "true") { ?>
<!--related-->
<?php get_template_part('includes/single/parts/related'); ?>
<!--/related-->
<?php }?>


<?php $active = get_option('tv-ad-4'); if ($active == "true") { ?>

            <div class="content-kuss" >
<?php if ($note = get_option('ads-vid-4-title')) { ?>
                <div id="content-kuss-title"> <span><?php echo $note; ?></span></div>
<?php }?>
				<?php if ($ads = get_option('ads-vid-4-code')) { ?><div class="content-kuss-ads"><?php echo stripslashes($ads); ?></div><?php }?>
            </div>
<?php }?> 			
</div>
</div>

<div id="overlay"></div>

<?php  get_footer(); ?>