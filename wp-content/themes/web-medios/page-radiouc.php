<?php
/*
Template Name: Portada RadioUC
*/
?>

<?php get_header(); ?>
            
			<div id="content" class="clearfix row">
			    <div class="col-sm-12 clearfix logo">
			        <img src="http://www.radiouc.cl/wp-content/uploads/logo_071.gif">
			    </div>
			    
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
                                    'terms'    => 5,
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
						            <a href="<?php echo the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
						        </div>
						        <a href="<?php echo the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
						    </article>
						<?php elseif($i >= 4): ?>
						<?php if($i == 4): ?>
					    </div>
					</section>
					<section class="row frontpage">
					    <div class="col-sm-8">
						<?php endif; ?>
						    <article <?php post_class('clearfix col-sm-6 news-fixed'); ?>>
					            <div style="position:relative">
					                <?php if($tags[0]->name != ""): ?>
						            <span class="frontpage-tag"><?php echo $categories[0]->name ?></span>
						            <?php endif; ?>
						            <a href="<?php echo the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
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
						<div class="col-sm-4">
						    <a class="twitter-timeline"
                              data-widget-id="600720083413962752"
                              href="https://twitter.com/radiouc"
                              data-screen-name="radiouc"></a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

                            <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/"><img alt="Licencia Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-nd/4.0/88x31.png" /></a><br />Esta obra de <span xmlns:cc="http://creativecommons.org/ns#" property="cc:attributionName">Benjamín Marchant / RadioUC</span> está bajo una <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/">Licencia Creative Commons Atribución-NoComercial-SinDerivar 4.0 Internacional</a>.<br />Basada en una obra en <a xmlns:dct="http://purl.org/dc/terms/" href="www.radiouc.cl" rel="dct:source">www.radiouc.cl</a>
						</div>
					</section> <!-- end article header -->
				</div> <!-- end #main -->
			</div> <!-- end #content -->

<?php get_footer(); ?>
