<?php
/*
Template Name: Portada RadioUC
*/
?>

<?php get_header(); ?>
            
			<div id="content" class="clearfix">
			    <div class="row medio-bar">
			        <div class="col-sm-2 logo">
			            <img src="<?php echo get_bloginfo('template_directory');?>/images/radiouc.png">
			        </div>
			        <div class="col-sm-6">
    					<?php wp_bootstrap_radio_uc(); // Adjust using Menus in Wordpress Admin ?>
			        </div>
			        <div class="col-sm-4">
			            <a target="_blank" title="Escucha Señal 1" href="http://www.radiouc.cl/play.html" class="popup"><span aria-hidden="true" class="glyphicon glyphicon-volume-up btn-lg radio-icono"></span>Señal 1</a>
			            <a target="_blank" title="Escucha Señal 2" href="http://www.radiouc.cl/play2.html" class="popup"><span aria-hidden="true" class="glyphicon glyphicon-headphones btn-lg radio-icono"></span>Señal 2</a>
			            <a target="_blank" title="Radio UC Se Ve" href="http://www.ustream.tv/channel/radiouc-tv" class="popup"><span aria-hidden="true" class="glyphicon glyphicon-play-circle btn-lg radio-icono"></span>SeVe</a>
			        </div>
			    </div>
				<div class="row frontpage">
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
				            <div class="img-no-padding image" style="position:relative; height: 120px; overflow:hidden;">
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
				<div class="row frontpage">
				    <div class="col-sm-8">
					<?php endif; ?>
					    <article <?php post_class('clearfix col-sm-6 news-fixed'); ?>>
				            <div class="image">
				                <?php if($tags[0]->name != ""): ?>
					            <span class="frontpage-tag"><?php echo $categories[0]->name ?></span>
					            <?php endif; ?>
					            <a href="<?php echo the_permalink(); ?>">
					                <?php the_post_thumbnail('medium'); ?>
    		                        <img class="media" src="<?php echo get_bloginfo('template_directory');?>/images/sound-play.png">
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
					</div>
					<?php endif; ?>
					<div class="col-sm-4">
					    <a class="twitter-timeline"
                          data-widget-id="600720083413962752"
                          href="https://twitter.com/radiouc"
                          data-screen-name="radiouc"></a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

                        <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/"><img alt="Licencia Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-nd/4.0/88x31.png" /></a><br />Esta obra de <span xmlns:cc="http://creativecommons.org/ns#" property="cc:attributionName">Benjamín Marchant / RadioUC</span> está bajo una <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/">Licencia Creative Commons Atribución-NoComercial-SinDerivar 4.0 Internacional</a>.<br />Basada en una obra en <a xmlns:dct="http://purl.org/dc/terms/" href="www.radiouc.cl" rel="dct:source">www.radiouc.cl</a>
					</div>
				</div><!-- end article header -->
				<div class="row programas radio">
				    <div class="titulo">Programas</div>
				    <div class="col-sm-3">
				        <h2>Actualidad</h2>
				        <div class="programa b1">
				            Acceso Directo
				        </div>
				        <div class="programa b2">
				            Miradas UC
				        </div>
				    </div>
				    <div class="col-sm-6">
				        <h2>Cultura y Entretenimiento</h2>
				        <div class="programa b4">
				            Hablando en Serie
				        </div>
				        <div class="programa b3">
				            Hablemos de Historia
				        </div>
				        <div class="programa b1">
				            Santiago a Diario
				        </div>
				        <div class="programa b5">
				            La Séptima Estación
				        </div>
				        <div class="programa b1">
				            Conexión Patio Scout
				        </div>
				        <div class="programa b2">
				            Módulo 2
				        </div>
				        <div class="programa b4">
				            Sólo Teatro 
				        </div>
			        </div>
				    <div class="col-sm-3">
				        <h2>Deportes</h2>
				        <div class="programa b3">
				            Tercer Saque
				        </div>
				        <div class="programa b4">
				            Jugo de Pelotas
				        </div>
				        <div class="programa b2">
				            Gambeta y guitarra
				        </div>
				    </div>
				    <div class="col-sm-5">
				        <h2>Música</h2> 
				        <div class="programa b1">
				            Producto Nacional
				        </div>
				        <div class="programa b5">
				            La Rumba
				        </div>
				        <div class="programa b2">
				            Modo Aleatorio
				        </div>
				        <div class="programa b5">
				            Generación Británica
				        </div>
			        </div>
				    <div class="col-sm-7">
				        <h2>Vida Universitaria</h2>
				        <div class="programa b2">
				            Plan Común
				        </div>
				        <div class="programa b3">
				            Página 33
				        </div>
				        <div class="programa b4">
				            Encuentro con
				        </div>
			        </div>
				</div>
			</div> <!-- end #content -->
        <script>
        jQuery(document).ready(function($) {
            $('.popup').click(function (event) {
            event.preventDefault();
            window.open($(this).attr("href"), "popupWindow", "width=600,height=600,scrollbars=yes");
        });
        });
        </script>
<?php get_footer(); ?>
