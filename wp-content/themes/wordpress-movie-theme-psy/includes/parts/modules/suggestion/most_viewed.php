<?php
query_posts( array('post_type'=>array('post','tvshows','episodes'), 'meta_key' => 'views', 'orderby' => 'meta_value_num', 'order' => 'DESC', 'posts_per_page' => $suggnum ) );   ?>
<?php  if (have_posts()) : ?>
<?php post_movies_true(); ?>
<?php while (have_posts()) : the_post(); 
if(get_option('edd_sample_theme_license_key')) {
?>

<?php get_template_part('includes/parts/item'); ?>
<?php } endwhile; wp_reset_query();?>						
<?php endif; ?>