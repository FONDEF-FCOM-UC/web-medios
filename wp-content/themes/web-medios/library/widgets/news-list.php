<?php

class FCOM_UC_Widget_News_List extends WP_Widget {
	public function __construct() {
		$widget_ops = array( 'classname' => 'fcom_webmedios_widget_news_list', 'description' => 'Muestra los posts como una lista' );
		parent::__construct( 'news-list', 'FCOM UC: News List', $widget_ops );
		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	public function widget( $args, $instance ) {
		$cache = array();
		$category_style = '';
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'fcom_webmedios_widget_news_list', 'widget' );
		}

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		$show_content = ( ! empty( $instance['show_content'] )) ? $instance['show_content'] : '';
		$cat_id = ( ! empty( $instance['cat_id'] ) ) ? absint( $instance['cat_id'] ) : 0;
		$tags = ( ! empty( $instance['tags'] ) ) ? $instance['tags'] : '';
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		$show_author = isset( $instance['show_author'] ) ? $instance['show_author'] : false;
		$show_comment = isset( $instance['show_comment'] ) ? $instance['show_comment'] : false;
		$show_sub_cat = isset( $instance['show_sub_cat'] ) ? $instance['show_sub_cat'] : false;
		$post_format = isset( $instance['post_format'] ) ? $instance['post_format'] : '';

		$query = array(
					'posts_per_page' => $number,
					'no_found_rows' => true,
					'post_status' => 'publish',
					'ignore_sticky_posts' => true,
				);
		if ( $post_format ) {
				$query['post_format'] = 'post-format-'.$post_format;
		}

		if ( '' != $tags && 0 != $cat_id ) {
			$query['tax_query'] = array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'category',
						'field' => 'id',
						'terms' => array( $cat_id ),
						),
					array(
						'taxonomy' => 'post_tag',
						'field' => 'name',
						'terms' => explode( ',', $tags ),
						),
				);
		} else {
			if ( '' != $tags ) {
				$query['tag_slug__in'] = explode( ',', $tags );
			}

			if ( 0 != $cat_id ) {
				$query['cat'] = $cat_id;
				$options = fcom_webmedios_get_category_option( $cat_id );
				if ( 'none' != $options['style'] ) {
					$category_style = 'color-'.$options['style'];
				} else {
					$category_style = '';
				}
			}
		}

		$r = new WP_Query( apply_filters( 'fcom_webmedios_widget_news_list', $query ) );

		if ( $r->have_posts() ) :
?>
		<?php echo $args['before_widget']; ?>
		<div id="destacado" class="<?php echo esc_attr( $category_style ); ?>">
		    <div class="news-grid clearfix">
			<?php $i = 1; ?>
			<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			    <?php $post_ids[] = get_the_ID(); ?>
				<?php if ( 1 === $i ) : ?>
				<div class="col-sm-4">
				    <?php if ( $title ) : ?>
				    <div class="titulo"><?php echo wp_kses_post( $title ); ?></div>
				    <?php else: ?>
				    <div class="titulo">Web de Medios</div>
				    <?php endif; ?>
					<article <?php post_class(); ?>>
						<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
						<div class="entry-meta">
							<?php if ( $show_date ) : ?>
								<span class="entry-date"><?php the_date(); ?></span>
							<?php endif; ?>
							<?php if ( $show_author ) : ?>
								<span class="entry-author">Por <?php the_author(); ?></span>
							<?php endif; ?>
							<?php if ( $show_comment && ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
								<span class="comments-link"><?php _e( '<i class="fa fa-comment"></i> ', 'dw-focus' ); ?><?php comments_popup_link( __( '0', 'dw-focus' ), __( '1', 'dw-focus' ), __( '%', 'dw-focus' ) ); ?></span>
							<?php endif; ?>
						</div>

						<?php if ( 'content' == $show_content ) :
							$more = 0;
						?>
							<div class="entry-content"><?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'dw-focus' ) ); ?></div>
						<?php elseif ( 'excerpt' == $show_content ) : ?>
							<div class="entry-summary"><?php the_excerpt(); ?></div>
						<?php endif; ?>
					</article>
				</div>
				<div class="col-md-8">
				    <?php if ( has_post_thumbnail() ) : ?>
					<div class="row photo">
					    <img class="media" src="<?php echo get_bloginfo('template_directory');?>/images/web-play.png">
					    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a>
				    </div>
					<?php endif; ?>
					<div class="row">
				<?php else : ?>
						<div class="col-sm-4 otras"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
				<?php endif; ?>
			<?php $i++; ?>
			<?php endwhile; ?>
					</div>
				</div>
		    </div>
		</div>
		<?php echo $args['after_widget']; ?>
		<?php
		wp_reset_postdata();
        add_rolling_posts($post_ids);
		endif;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'fcom_webmedios_widget_news_list', $cache, 'widget' );
		} else {
				ob_end_flush();
		}
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_content'] = strip_tags( $new_instance['show_content'] );
		$instance['cat_id'] = (int) $new_instance['cat_id'];
		$instance['tags'] = strip_tags( $new_instance['tags'] );
		$instance['post_format'] = strip_tags( $new_instance['post_format'] );
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['show_author'] = isset( $new_instance['show_author'] ) ? (bool) $new_instance['show_author'] : false;
		$instance['show_comment'] = isset( $new_instance['show_comment'] ) ? (bool) $new_instance['show_comment'] : false;
		$instance['show_sub_cat'] = isset( $new_instance['show_sub_cat'] ) ? (bool) $new_instance['show_sub_cat'] : false;

		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['fcom_webmedios_widget_news_list'] ) ) {
			delete_option( 'fcom_webmedios_widget_news_list' );
		}
		return $instance;
	}

	public function flush_widget_cache() {
		wp_cache_delete( 'fcom_webmedios_widget_news_list', 'widget' );
	}

	public function form( $instance ) {

		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_content = isset( $instance['show_content'] ) ? esc_attr( $instance['show_content'] ) : '';
		$cat_id = isset( $instance['cat_id'] ) ? esc_attr( $instance['cat_id'] ) : 0;
		$tags = isset( $instance['tags'] ) ? esc_attr( $instance['tags'] ) : '';
		$post_format = isset( $instance['post_format'] ) ? esc_attr( $instance['post_format'] ) : '';
		$show_category = isset( $instance['show_category'] ) ? (bool) $instance['show_category'] : false;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		$show_author = isset( $instance['show_author'] ) ? (bool) $instance['show_author'] : false;
		$show_comment = isset( $instance['show_comment'] ) ? (bool) $instance['show_comment'] : false;
		$show_sub_cat = isset( $instance['show_sub_cat'] ) ? (bool) $instance['show_sub_cat'] : false;
	?>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'dw-focus' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Number of posts to show:', 'dw-focus' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'show_content' ) ); ?>"><?php _e( 'Display post content?', 'dw-focus' ) ?></label>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'show_content' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_content' ) ); ?>">
			<option value="" <?php selected( $show_content, '' ) ?>></option>
			<option value="excerpt" <?php selected( $show_content, 'excerpt' ) ?>><?php _e( 'Excerpt', 'dw-focus' ); ?></option>
			<option value="content" <?php selected( $show_content, 'content' ) ?>><?php _e( 'Content', 'dw-focus' ); ?></option>
		</select></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'cat_id' ) ); ?>"><?php _e( 'Category:', 'dw-focus' ); ?></label>
		<?php wp_dropdown_categories( 'name='.$this->get_field_name( 'cat_id' ).'&class=widefat&show_option_all=All&hide_empty=0&hierarchical=1&depth=2&selected='.$cat_id ); ?></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'tags' ) ); ?>"><?php _e( 'Tags:', 'dw-focus' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tags' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tags' ) ); ?>" placeholder="<?php _e( 'tag 1, tag 2, tag 3','dw-focus' )?>" type="text" value="<?php echo esc_attr( $tags ); ?>" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'post_format' ) ); ?>"><?php _e( 'Post Formats:', 'dw-focus' ); ?></label>
		<?php if ( current_theme_supports( 'post-formats' ) ) {
				$valid_formats = get_theme_support( 'post-formats' );
			?>
			<select name="<?php echo esc_attr( $this->get_field_name( 'post_format' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'post_format' ) ); ?>" class="widefat">';
			<option <?php selected( $post_format, '' ); ?> value="">All</option>';
			<?php foreach ( $valid_formats[0] as $format ) {
				?>
					<option <?php selected( $post_format, $format );?> class="level-0" value="<?php echo esc_attr( $format ); ?>"><?php echo esc_attr( ucfirst( $format ) ); ?></option>';
			<?php } ?>
			</select>
		<?php } ?>
		</p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"><?php _e( 'Display post date?', 'dw-focus' ); ?></label></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_author ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_author' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_author' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'show_author' ) ); ?>"><?php _e( 'Display post author?', 'dw-focus' ); ?></label></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_comment ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_comment' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_comment' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'show_comment' ) ); ?>"><?php _e( 'Display comment count?', 'dw-focus' ); ?></label></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_sub_cat ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_sub_cat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_sub_cat' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'show_sub_cat' ) ); ?>"><?php _e( 'Display sub-categories?', 'dw-focus' ); ?></label></p>
<?php
	}
}

add_action( 'widgets_init', 'fcom_webmedios_widgets_news_list_init' );
function fcom_webmedios_widgets_news_list_init() {
	register_widget( 'FCOM_UC_Widget_News_List' );
}
