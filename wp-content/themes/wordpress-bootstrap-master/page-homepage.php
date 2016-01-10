<?php
/*
Template Name: Homepage
*/
?>
<?php get_header(); ?>
<div id="content" class="clearfix row">

	<div id="main" class="col-sm-12 clearfix" role="main">
		<!-- Widget -->
		<?php if ( is_active_sidebar( 'portada_contenido' ) ) : ?>

			<?php dynamic_sidebar( 'portada_contenido' ); ?>

		<?php endif; ?>
		
		<!-- Noticias laterales -->
		<section class="row frontpage">
		    <?php 
            $args = array(
                'post_type' => 'post', 
                'order' => 'DESC', 
                'posts_per_page' => 6,
                'meta_query' => array(
                    array(
                     'key' => '_thumbnail_id',
                     'compare' => 'EXISTS'
                    ),
                )
            );

            $q = new WP_Query( $args );

		    if ($q->have_posts()) {
		        $i = 0; // Detectamos el primer post
	        ?>
	        <?php 
		        while ($q->have_posts()) : $q->the_post();
		        $categories = get_the_category();
		        ?>
	        <div class="col-sm-6 featured-new">
				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
				    <?php if ( has_post_thumbnail() ) : ?>
				    <div class="thumb">
				        <span class="frontpage-tag-main"><?php echo $categories[0]->name ?></span>
				        <?php the_post_thumbnail(array(440, 250));  ?>
				    </div>
				    <?php endif; ?>
				    <a href="<?php echo the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
				    <p><?php the_excerpt(); ?></p>
				</article>
			</div>
			<?php  
			    $i++; ?>
			<?php endwhile; 
			    wp_reset_postdata();
			?>	
			</div>
			<?php }; ?>
		</section>
		
	</div> <!-- end #main -->

	<?php //get_sidebar(); // sidebar 1 ?>

</div> <!-- end #content -->

<?php get_footer(); ?>

