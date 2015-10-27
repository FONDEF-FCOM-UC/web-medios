<?php
/*
Template Name: Portada KmCero
*/
?>

<?php get_header(); ?>
			<div id="content" class="clearfix row">
			
				<div id="main" class="col-sm-12 clearfix" role="main">
					<section class="row frontpage">
					    <?php 
                        $args = array(
                            'post_type' => 'post', 
                            'order' => 'DESC', 
                            'posts_per_page' => 8,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'category',
                                    'field'    => 'term_id',
                                    'terms'    => 7,
                                ),
                            ),
                        );

                        $q = new WP_Query( $args );

					    if ($q->have_posts()) {
					        $i = 0; // Detectamos el primer post
				        ?>
				        <div class="col-sm-6">
				        <?php 
					        while ($q->have_posts()) : $q->the_post();
					        $categories = get_the_category();
					        if($i == 0) {
					        ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
							    <div style="position:relative">
							        <span class="frontpage-tag-main"><?php echo $categories[0]->name ?></span>
							        <?php the_post_thumbnail('slider-thumb');  ?>
							    </div>
							    <a href="<?php echo the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
							    <p><?php the_excerpt(); ?></p>
							</article>
						</div>
						<div class="col-sm-6">
							<div class="row">
						<?php } else if($i > 0) { ?>
						        <div class="col-sm-4">
						            <div style="position:relative">
							            <span class="frontpage-tag"><?php echo $categories[0]->name ?></span>
							            <?php the_post_thumbnail('thumbnail');  ?>
							        </div>
							        <a href="<?php echo the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
							    </div>
						<?php } 
						    $i++; ?>
						<?php endwhile; 
						    wp_reset_postdata();
						?>	
						</div>
						<?php }; ?>
					</section> <!-- end article header -->
					
			        <section class="row frontpage">
						<div class="col-sm-12">
							Secciones
							<ul>
							<?php 
							    $args = array(
                                    'type'                     => 'post',
                                    'child_of'                 => 7,
                                    'orderby'                  => 'name',
                                    'order'                    => 'ASC',
                                    'hide_empty'               => FALSE,
                                    'hierarchical'             => 1,
                                    'taxonomy'                 => 'category',
                                );
							    $categories = get_categories($args);
							    wp_reset_postdata();
							    
							    foreach($categories as $cat)
							    {
							    ?>
							        <li><?php echo $cat->name ?></li>
							    <?php
							    }
							?></ul>
						</div>
					</section> <!-- end article header -->
					
					<section class="row especiales">
						<div class="col-sm-12">
							Especiales
						</div>
					</section> <!-- end article header -->
					
				</div> <!-- end #main -->
			</div> <!-- end #content -->

<?php get_footer(); ?>
