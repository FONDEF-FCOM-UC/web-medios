<?php
/*
Template Name: Portada Señal UC
*/
?>

<?php get_header(); ?>
            
			<div id="content" class="clearfix">
			    <div class="row medio-bar">
			        <div class="col-sm-2 logo">
			            <img src="<?php echo get_bloginfo('template_directory');?>/images/senaluc.png">
			        </div>
			        <div class="col-sm-8">
    					<?php wp_bootstrap_senal_uc(); // Adjust using Menus in Wordpress Admin ?>
			        </div>
			        <div class="col-sm-2">
			            <a target="_blank" title="Señal en Vivo" href="http://www.senaluc.cl" class="popup"><span aria-hidden="true" class="glyphicon glyphicon-play-circle btn-lg senal-icono"></span>Señal en vivo</a>
			        </div>
			    </div>
				<div class="row frontpage">
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
						    <div class="main-photo">
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
				            <div class="img-no-padding image">
					            <span class="frontpage-tag"><?php echo $categories[0]->name ?></span>
					            <a href="<?php echo the_permalink(); ?>">
					                <?php if ( ( function_exists('has_post_thumbnail') ) && ( has_post_thumbnail() ) ): 
                                        $post_thumbnail_id = get_post_thumbnail_id();
                                        $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
                                        ?>
                                        <img alt="thumb image" src="<?php echo $post_thumbnail_url; ?>" style="max-width:300px; height:auto;">
                                    <?php endif; ?>
    		                        <img class="media" src="<?php echo get_bloginfo('template_directory');?>/images/video-play.png">
					            </a>
					        </div>
					        <a href="<?php echo the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
					    </article>
					<?php elseif($i >= 4): ?>
					<?php if($i == 4): ?>
				    </div>
			    </div>
				<div id="main" class="row frontpage" role="main">
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
				</div> <!-- end article header -->
				<div class="row programas">
				    <div class="titulo">Programas</div>
				    <div class="col-sm-2 programa">
				        <img src="http://www.senaluc.cl/app_socialstream/uploads/programacion/56610497ddd11.jpg"><br>
				        <h2>Miradas UC</h2>
				    </div>
				    <div class="col-sm-2 programa">
				        <img src="http://www.senaluc.cl/app_socialstream/uploads/programacion/566104c9bd01e.png"><br>
				        <h2>Norte Centro Sur</h2>
				    </div>
				    <div class="col-sm-2 programa">
				        <img src="http://www.senaluc.cl/app_socialstream/uploads/programacion/566104dcee241.jpg"><br>
				        <h2>Los Especialistas</h2>
				    </div>
				    <div class="col-sm-2 programa">
				        <img src="http://www.senaluc.cl/app_socialstream/uploads/programacion/56610482cbfbe.png"><br>
				        <h2>Viernes de Medios</h2>
				    </div>
				    <div class="col-sm-2 programa">
				        <img src="http://www.senaluc.cl/app_socialstream/uploads/programacion/5654e8cc5a1ac.png"><br>
				        <h2>Día F</h2>
				    </div>
				</div> <!-- end #programas -->
			</div> <!-- end #content -->

<?php get_footer(); ?>
