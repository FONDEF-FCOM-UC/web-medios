<?php get_header(); ?>
			
			<div id="content" class="clearfix row">
			
				<div id="main" class="col-sm-8 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						<header>
						
							<?php the_post_thumbnail( 'large'); ?>
							
							<div class="page-header">
							    <?php the_category(', '); ?>
							    <h1 class="single-title" itemprop="headline"><?php the_title(); ?></h1>
							    <div class="excerpt">
							        <?php global $more; $more = 0;
                                    the_content('');
                                    $more = 1; ?>
							    </div>
							    <div class="meta">
							        <div class="foto">
						                <?php echo get_avatar( get_the_author_meta( 'ID' ), 38, '', '', array('class' => 'img-circle')); ?>
						                <?php the_author_posts_link(); ?>
        							</div>
        							<div class="fecha">
        							    <?php _e("Posted", "wpbootstrap"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php echo get_the_date('F jS, Y', '','', FALSE); ?></time>
    							    </div>
						        </div>
						    </div>
						</header> <!-- end article header -->
						<section class="post_content clearfix" itemprop="articleBody">
							<?php the_content('',true); ?>
							<?php wp_link_pages(); ?>
						</section> <!-- end article section -->
						
						<footer>
			
							<?php the_tags('<p class="tags"><span class="tags-title">' . __("Tags","wpbootstrap") . ':</span> ', ' ', '</p>'); ?>
							
							<?php 
							// only show edit button if user has permission to edit posts
							if( $user_level > 0 ) { 
							?>
							<a href="<?php echo get_edit_post_link(); ?>" class="btn btn-success edit-post"><i class="icon-pencil icon-white"></i> <?php _e("Edit post","wpbootstrap"); ?></a>
							<?php } ?>
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
					<?php comments_template('',true); ?>
					
					<?php endwhile; ?>			
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("Not Found", "wpbootstrap"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "wpbootstrap"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->
    
				<?php get_sidebar(); // sidebar 1 ?>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
