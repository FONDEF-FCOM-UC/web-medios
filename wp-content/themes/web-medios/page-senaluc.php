<?php
/*
Template Name: Portada Señal UC
*/
?>

<?php get_header(); ?>
            
			<div id="content" class="clearfix row">
			    <div class="col-sm-12 clearfix logo">
			        <img src="http://www.senaluc.cl/imag/senaluc/logo_senal_uc.png">
			    </div>
			    
				<div id="main" class="col-sm-12 clearfix" role="main">
					<section class="row frontpage">
					    <?php 
                        $args = array(
                            'post_type' => 'post', 
                            'order' => 'DESC', 
                            'posts_per_page' => 10,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'category',
                                    'field'    => 'term_id',
                                    'terms'    => 6,
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
							    <div style="position:relative;">
							        <span class="frontpage-tag-main"><?php echo $categories[0]->name ?></span>
							        <a href="<?php echo the_permalink(); ?>">
							            <?php the_post_thumbnail('slider-thumb'); ?>
        		                        <img class="media" src="<?php echo get_bloginfo('template_directory');?>/images/video-play.png">
						            </a>
							    </div>
							    <a href="<?php echo the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
							    <p><?php the_excerpt(); ?></p>
							</article>
						</div>
						<div class="col-sm-4">
						<?php elseif($i > 0 and $i < 4): ?>
						    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
					            <div class="img-no-padding image" style="position:relative; height: 120px; overflow:hidden;">
						            <span class="frontpage-tag"><?php echo $categories[0]->name ?></span>
						            <a href="<?php echo the_permalink(); ?>">
						                <?php the_post_thumbnail('medium'); ?>
        		                        <img class="media" src="<?php echo get_bloginfo('template_directory');?>/images/video-play.png">
						            </a>
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
					            <div class="image">
					                <?php if($tags[0]->name != ""): ?>
						            <span class="frontpage-tag"><?php echo $categories[0]->name ?></span>
						            <?php endif; ?>
						            <a href="<?php echo the_permalink(); ?>">
						                <?php the_post_thumbnail('medium');  ?>
        		                        <img class="media" src="<?php echo get_bloginfo('template_directory');?>/images/video-play.png">
					                </a>
						        </div>
						        <a href="<?php echo the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
						        <p><?php the_excerpt(); ?></p>
						    </article>
						<?php endif;
						    $i++; ?>
						<?php endwhile; 
						    wp_reset_postdata();
						?>	
						<?php endif; ?>
					</section> <!-- end article header -->
					<section class="row programas">
					    <div class="titulo">Programas</div>
					    <div class="col-sm-3 programa">
					        <img src="http://www.senaluc.cl/app_socialstream/uploads/programacion/56610497ddd11.jpg"><br>
					        <h2>Miradas UC</h2>
					    </div>
					    <div class="col-sm-3 programa">
					        <img src="http://www.senaluc.cl/app_socialstream/uploads/programacion/566104c9bd01e.png"><br>
					        <h2>Norte Centro Sur</h2>
					    </div>
					    <div class="col-sm-3 programa">
					        <img src="http://www.senaluc.cl/app_socialstream/uploads/programacion/566104dcee241.jpg"><br>
					        <h2>Los Especialistas</h2>
					    </div>
					    <div class="col-sm-3 programa">
					        <img src="http://www.senaluc.cl/app_socialstream/uploads/programacion/56610482cbfbe.png"><br>
					        <h2>Viernes de Medios</h2>
					    </div>
					    <div class="col-sm-3 programa">
					        <img src="http://www.senaluc.cl/app_socialstream/uploads/programacion/5654e8cc5a1ac.png"><br>
					        <h2>Día F</h2>
					    </div>
					</section>
				</div> <!-- end #main -->
			</div> <!-- end #content -->

<?php get_footer(); ?>
