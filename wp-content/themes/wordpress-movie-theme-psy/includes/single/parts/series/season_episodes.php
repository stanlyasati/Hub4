<?php get_template_part('includes/single/parts/controls'); ?>
<?php get_template_part('includes/single/parts/series/ep_sched'); ?>
<?php if( have_rows('temporadas') ): ?>
<div id="seasons">

<?php if( have_rows('temporadas') ): 
$numerado = 1; { 
while( have_rows('temporadas') ): the_row(); ?>
<div class="tvseason" <?php if (!have_rows('episodios')) : ?>style="display: none"<?php endif;  ?> >    
<?php if( have_rows('episodios') ): ?>
<div class="les-title"> <i class="fa fa-server mr5"></i>
<strong><?php _e('Season','psythemes') ?> <?php echo $numerado; ?></strong>
</div>
<div class="les-content" <?php if ($count == 0) : ?>style="display: block"<?php endif; $count++; ?>>

<?php $numerado2 = 1; { while( have_rows('episodios') ): the_row(); ?>

																																		 

<a href="<?php bloginfo('url'); ?>/episode/<?php echo get_sub_field('slug'); ?>-season-<?php echo $numerado ?>-episode-<?php echo $numerado2; ?>/">
																									
																	  
									  
																						  
<?php _e('Episode', 'psythemes'); ?> <?php echo $numerado2 ?> <?php if($title = get_sub_field('titlee')) { echo '- '; echo $title; } ?>
</a>


<?php $numerado2++; ?> 
<?php endwhile; } ?> 
</ul>
</div>
<?php else : ?>
												
																	   
	   


<?php endif; ?>



</div>
<?php $numerado++; ?> 
<?php endwhile; } ?> 
<?php endif; ?>
</div>
<?php endif; ?>