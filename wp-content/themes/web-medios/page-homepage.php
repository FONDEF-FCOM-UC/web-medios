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
		    <?php $secciones = array('kmcero' => "Km Cero", 'senal-uc' => "Señal UC", 'radiouc' => "Radio UC") ?>
		    <?php foreach($secciones as $key => $value): ?>
	        <div class="col-sm-4 featured-new">
	            <div class="titulo"><?php echo $value ?></div>
	            <?php 
                $args = array(
                    'post_type' => 'post', 
                    'order' => 'DESC', 
                    'posts_per_page' => 4,
                    'category_name' => $key,
                    'post__not_in' => get_rolling_posts(),
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
		            $tags = wp_get_post_tags(get_the_ID());
		            ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
				    <?php if ( has_post_thumbnail() ) : ?>
				    <div class="thumb">
				        <span class="frontpage-tag-main"><?php echo $tags[0]->name ?></span>
				        <?php the_post_thumbnail('large');  ?>
				    </div>
				    <?php endif; ?>
				    <a href="<?php echo the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
				    <p><?php the_excerpt(); ?></p>
				</article>
				<?php  
			        $i++; 
			        $post_ids[] = get_the_ID();?>
			    <?php endwhile; 
			        wp_reset_postdata();
			        add_rolling_posts($post_ids);
			    ?>	
			    <?php }; ?>
			</div>
			<?php endforeach; ?>
		</section>
		
	</div> <!-- end #main -->

	<?php //get_sidebar(); // sidebar 1 ?>

</div> <!-- end #content -->

<?php get_footer(); ?>

