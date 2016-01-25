<?php
/*
Template Name: Portada KmCero
*/
?>

<?php get_header(); ?>
            
			<div id="content" class="clearfix row">
			    <div class="col-sm-12 clearfix logo">
			        <img src="http://www.kilometrocero.cl/wp-content/themes/km0/images/logo.png">
			    </div>
			    
				<div id="main" class="col-sm-12 clearfix" role="main">
					<section class="row frontpage">
					    <?php 
                        $args = array(
                            'post_type' => 'post', 
                            'order' => 'DESC', 
                            'posts_per_page' => 9,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'category',
                                    'field'    => 'term_id',
                                    'terms'    => 7,
                                ),
                            ),
                        );

                        $q = new WP_Query( $args );

					    if ($q->have_posts()):
					        $i = 0; // Detectamos el primer post
				        ?>
				        <div class="col-sm-8">
				        <?php 
					        while ($q->have_posts()) : $q->the_post();
					        $categories = get_categories('&child_of=7');
					        if($i == 0):
					        ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
							    <div style="position:relative">
							        <span class="frontpage-tag-main"><?php echo $categories[0]->name ?></span>
							        <a href="<?php echo the_permalink(); ?>"><?php the_post_thumbnail('slider-thumb'); ?></a>
							    </div>
							    <a href="<?php echo the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
							    <p><?php the_excerpt(); ?></p>
							</article>
						</div>
						<div class="col-sm-4">
						<?php elseif($i > 0 and $i < 4): ?>
						    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
					            <div class="img-no-padding" style="position:relative">
						            <span class="frontpage-tag"><?php echo $categories[0]->name ?></span>
						            <a href="<?php echo the_permalink(); ?>"><?php the_post_thumbnail('medium');  ?></a>
						        </div>
						        <a href="<?php echo the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
						    </article>
						<?php elseif($i >= 4): ?>
						<?php if($i == 4): ?>
					    </div>
					</section>
					<section class="row frontpage">
						<?php endif; ?>
						    <article <?php post_class('clearfix col-sm-4 news-fixed'); ?>>
					            <div style="position:relative">
					                <?php if($tags[0]->name != ""): ?>
						            <span class="frontpage-tag"><?php echo $categories[0]->name ?></span>
						            <?php endif; ?>
						            <a href="<?php echo the_permalink(); ?>"><?php the_post_thumbnail('medium');  ?></a>
						        </div>
						        <a href="<?php echo the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
						        <p><?php the_excerpt(); ?></p>
						    </article>
						<?php endif;
						    $i++; ?>
						<?php endwhile; 
						    wp_reset_postdata();
						?>	
						</div>
						<?php endif; ?>
					</section> <!-- end article header -->
				</div> <!-- end #main -->
			</div> <!-- end #content -->

<?php get_footer(); ?>
