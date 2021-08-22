<?php get_header(); ?>
<div id="main" class="page-news">
<div class="container">
<div class="pad"></div>
<div class="main-content main-news">
<?php if(get_option("notice_location") == "global" ){?>
<?php get_template_part('includes/parts/notice'); ?>
<?php }?>
<?php psythemes_breadcrumbs();?>
<?php $active = get_option('article-archive-ad-1'); if ($active == "true") { ?>

            <div class="content-kuss" >
<?php if ($note = get_option('ads-page-1-title')) { ?>
                <div id="content-kuss-title"> <span><?php echo $note; ?></span></div>
<?php }?>
				<?php if ($ads = get_option('ads-page-1-code')) { ?><div class="content-kuss-ads"><?php echo stripslashes($ads); ?></div><?php }?>
            </div>
<?php }?> 			
<div class="news-block">
<div class="box news-content news-view">
<?php if (have_posts()) :
while (have_posts()) : the_post();  ?>
<div class="box-content news-view-content">
<!---<?php $active = get_option('article-header'); if ($active == "true") { ?><div class="nvc-thumb" style="background-image: url(<?php echo $imgsrc; $imgsrc = ''; ?>);"></div><?php }?>--->
<h1 class="title"><?php the_title(); ?></h1>
<p class="time"><i class="fa fa-clock-o mr5"></i><?php _e('Posted', 'psythemes'); ?> <?php echo get_the_date('Y/m/d');?><span class="ml10">
<?php if($noners = noticias_get_meta("views")) { ?><i class="fa fa-eye mr5"></i><?php echo $noners; ?></span><?php }?>
<a href="<?php echo get_permalink(); ?>#comment" class="ml10 view-comment" style="color: #333;">
<i class="fa fa-comments mr5"></i><span id="fb-comment-count"><?php $totalcomments = get_comments_number(); echo $totalcomments; ?></span>
</a>
</p>

<div class="block-social" style="padding-top: 15px; padding-bottom: 15px;">
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<div class="addthis_inline_share_toolbox"></div>
</div>
<?php $active = get_option('article-ad-2'); if ($active == "true") { ?>

            <div class="content-kuss" >
<?php if ($note = get_option('ads-page-2-title')) { ?>
                <div id="content-kuss-title"> <span><?php echo $note; ?></span></div>
<?php }?>
				<?php if ($ads = get_option('ads-page-2-code')) { ?><div class="content-kuss-ads"><?php echo stripslashes($ads); ?></div><?php }?>
            </div>
<?php }?> 			
<!--content -->
<?php the_content(); ?>
<!-- /content -->

<div class="clearfix"></div>
<?php $active = get_option('article-ad-3'); if ($active == "true") { ?>

            <div class="content-kuss" >
<?php if ($note = get_option('ads-page-3-title')) { ?>
                <div id="content-kuss-title"> <span><?php echo $note; ?></span></div>
<?php }?>
				<?php if ($ads = get_option('ads-page-3-code')) { ?><div class="content-kuss-ads"><?php echo stripslashes($ads); ?></div><?php }?>
            </div>
<?php }?> 			

<?php if($mostrar = $terms = strip_tags( $terms = get_the_term_list( $post->ID, 'articlestags' ))) {  ?>
<div class="tags" style="margin-top: 30px;"><i class="fa fa-tags mr5"></i><?php echo get_the_term_list($post->ID, 'articlestags', 'TAGs: ', ', ', ''); ?></div>
<?php }?>
<div class="block-social" style="padding-top: 15px; padding-bottom: 15px;">

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<div class="addthis_inline_share_toolbox"></div>

</div>
</div>
<?php if( have_rows('movarticle') ): ?>
<div class="movies-embed content-padding">
<h3 class="title"><?php _e('Movies in this article', 'psythemes'); ?></h3>
<?php $numerado = 1; { while( have_rows('movarticle') ): the_row(); ?>
<div class="me-li">
<h4>
<a href="<?php bloginfo('url'); ?>/<?php  the_sub_field('movarticle_slug'); ?>" title="<?php  the_sub_field('movarticle_title'); ?>"><?php  the_sub_field('movarticle_title'); ?>
<span class="pull-right badge"><?php _e('Play Now', 'psythemes'); ?></span>
</a>
</h4>
</div>
<?php $numerado++; ?>   
<?php endwhile; } ?>

</div>
<?php endif; ?>
<?php endwhile; endif; ?>

<?php $active = get_option('article-ad-4'); if ($active == "true") { ?>

            <div class="content-kuss" style="margin:0;background:#e5e5e5;">
<?php if ($note = get_option('ads-page-4-title')) { ?>
                <div id="content-kuss-title"> <span><?php echo $note; ?></span></div>
<?php }?>
				<?php if ($ads = get_option('ads-page-4-code')) { ?><div class="content-kuss-ads"><?php echo stripslashes($ads); ?></div><?php }?>
				
            </div>
<?php }?> 			

<?php $activar = get_option('comm_news'); if ($activar == "true") { ?>
<div class="content-padding"id="comment" style="border-top: 20px solid #e5e5e5;">
<?php get_template_part('includes/single/parts/comments'); ?>
</div>
<?php }?>
<div class="clearfix"></div>
</div>
<div class="news-sidebar">
<?php $active = get_option('article-likebox'); if ($active == "enable") : get_template_part('includes/parts/widgets/nws_sidebar3'); endif;?>
<?php $active = get_option('article-hot'); if ($active == "true") : get_template_part('includes/parts/widgets/nws_sidebar2'); endif; ?>




</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>
<?php $active = get_option('article-archive-ad-5'); if ($active == "true") { ?>

            <div class="content-kuss" >
<?php if ($note = get_option('ads-page-5-title')) { ?>
                <div id="content-kuss-title"> <span><?php echo $note; ?></span></div>
<?php }?>
				<?php if ($ads = get_option('ads-page-5-code')) { ?><div class="content-kuss-ads"><?php echo stripslashes($ads); ?></div><?php }?>
            </div>
<?php }?> 			
</div>
</div>

<?php  get_footer(); ?>