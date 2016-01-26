<?php
/*
Template Name: Portada KmCero
*/
?>

<?php get_header(); ?>
            
			<div id="content" class="clearfix">
			    <div class="row medio-bar">
			        <div class="col-sm-2 logo">
			            <img src="<?php echo get_bloginfo('template_directory');?>/images/kmcero.png">
			        </div>
			        <div class="col-sm-10">
    					<?php wp_bootstrap_kmcero(); // Adjust using Menus in Wordpress Admin ?>
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
						    <div class="main-photo">
						        <span class="frontpage-tag-main"><?php echo $categories[0]->name ?></span>
						        <a href="<?php echo the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a>
						    </div>
						    <a href="<?php echo the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
						    <p><?php the_excerpt(); ?></p>
						</article>
					</div>
					<div class="col-sm-4">
					<?php elseif($i > 0 and $i < 4): ?>
					    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
				            <div class="img-no-padding image sidenews">
					            <span class="frontpage-tag"><?php echo $categories[0]->name ?></span>
					            <a href="<?php echo the_permalink(); ?>"><?php the_post_thumbnail('medium');  ?></a>
					        </div>
					        <a href="<?php echo the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
					    </article>
					<?php elseif($i >= 4): ?>
					<?php if($i == 4): ?>
				    </div>
				</div>
				<hr>
				<div id="main" class="row frontpage" role="main">
					<?php endif; ?>
					    <article <?php post_class('clearfix col-sm-4 news-fixed'); ?>>
				            <div class="image">
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
				</div> <!-- end #main -->
			</div> <!-- end #content -->

<?php get_footer(); ?>
