<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>
			<?php
    wp_enqueue_style('fcom-tags-controls-css', plugins_url('fcom-tags/css/fcom_controls.css'));
    wp_enqueue_style('fcom-tags-mapa-css', plugins_url('fcom-tags/css/fcom_mapa.css'));
    wp_enqueue_script('jquery-js', plugins_url('fcom-tags/js/jquery-2.1.4.min.js'));
    wp_enqueue_script('d3-js', plugins_url('fcom-tags/js/d3.min.js'));
?>

    <div class="leaflet-control-container">
       <div class="leaflet-top leaflet-left has-leaflet-pan-control">
            <div class="pan-controls leaflet-control-pan leaflet-control">
                <div class="pan-control pan-control-up leaflet-control-pan-up-wrap">
                    <button id="panUp" type="button" class="btn btn-default btn-pan btn-xs">
                        <span class="glyphicon glyphicon-arrow-up leaflet-control-pan-up" aria-hidden="true" title="Arriba"></span>
                    </button>
                </div>
                <div class="pan-control pan-control-left leaflet-control-pan-left-wrap">
                    <button id="panLeft" type="button" class="btn btn-default btn-pan btn-xs">
                        <span class="glyphicon glyphicon-arrow-left leaflet-control-pan-left" aria-hidden="true" title="Izquierda"></span>
                    </button>
                </div>
                <div class="pan-control pan-control-right leaflet-control-pan-right-wrap">
                    <button id="panRight" type="button" class="btn btn-default btn-pan btn-xs">
                        <span class="glyphicon glyphicon-arrow-right leaflet-control-pan-right" aria-hidden="true" title="Derecha"></span>
                    </button>
                </div>
                <div class="pan-control pan-control-down leaflet-control-pan-down-wrap">
                    <button id="panDown" type="button" class="btn btn-default btn-pan btn-xs">
                        <span class="glyphicon glyphicon-arrow-down leaflet-control-pan-down" aria-hidden="true" title="Abajo"></span>
                    </button>
                </div>
            </div>
            <div class="btn-group-vertical zoom-controls leaflet-control-zoom leaflet-bar leaflet-control" role="group">
                <button id="zoomIn" type="button" class="btn btn-default btn-pan btn-sm">
                    <span class="glyphicon glyphicon-zoom-in" aria-hidden="true" title="Zoom in"></span>
                </button>
                <button id="zoomOut" type="button" class="btn btn-default btn-pan btn-sm">
                    <span class="glyphicon glyphicon-zoom-out" aria-hidden="true" title="Zoom out"></span>
                </button>
            </div>
        </div>
        </div>
    <div id="fcom-mapa" style="width:930px;height:500px;"></div>
    <?php
        wp_enqueue_script('fcom-tags-mapa-js', plugins_url('fcom-tags/js/fcom_mapa.ribbon.js'),null,null,true);
    ?>
			
			<div id="content" class="clearfix row">
			
				<div id="main" class="col-sm-12 clearfix" role="main">
                    <!-- Noticias principales -->
					<section id="destacado" class="row frontpage">
					
					    <div class="col-sm-3">
					        <small>Epigrafe</small>
					        <h2>Las promesas agrietadas de Bajos de Mena</h2>
					        <p>El trabajo remunerado de los presos dentro de Colina I y el Centro Penintenciario Femenino Metropolitano no cumple con los requisitos dictados por la ley que lo norma</p>
					    </div>
					    <div class="col-sm-9">
				            <div class="row photo">
				                <img src="http://www.kilometrocero.cl/wp-content/uploads/2014/09/Colina-1_CREDITO_-Mathias-Sielfeld.jpg">
				            </div>
				            <div class="row">
				                <div class="col-sm-3">
				                    <small>Km Cero</small>
				                    <h3>Seguros y accidentes laborales</h3>
				                </div>
				                <div class="col-sm-3">
				                    <small>Km Cero</small>
				                    <h3>Seguros y accidentes laborales</h3>
				                </div>
				                <div class="col-sm-3">
				                    <small>Km Cero</small>
				                    <h3>Seguros y accidentes laborales</h3>
				                </div>
				            </div>
					    </div>
					</section>
					
					<!-- Widget -->
			        <section class="row frontpage">
					</section>
					
					<!-- Noticias laterales -->
					<section class="row frontpage">
					    <?php 
                        $args = array(
                            'post_type' => 'post', 
                            'order' => 'DESC', 
                            'posts_per_page' => 7,
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
				        <?php 
					        while ($q->have_posts()) : $q->the_post();
					        $categories = get_the_category();
					        ?>
				        <div class="col-sm-6">
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
							    <div style="position:relative">
							        <span class="frontpage-tag-main"><?php echo $categories[0]->name ?></span>
							        <?php the_post_thumbnail('slider-thumb');  ?>
							    </div>
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
