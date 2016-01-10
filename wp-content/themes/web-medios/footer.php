		</div> <!-- end #container -->
		
		<footer role="contentinfo">
		
			<div id="inner-footer" class="clearfix container">
	          <div id="widget-footer" class="clearfix row">
	            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1') ) : ?>
	            <?php endif; ?>
	            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer2') ) : ?>
	            <?php endif; ?>
	            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer3') ) : ?>
	            <?php endif; ?>
	            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer4') ) : ?>
	            <?php endif; ?>
	            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer5') ) : ?>
	            <?php endif; ?>
	            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer6') ) : ?>
	            <?php endif; ?>
	          </div>
				
				<nav class="clearfix">
					<?php wp_bootstrap_footer_links(); // Adjust using Menus in Wordpress Admin ?>
				</nav>
				
				<p class="pull-right">Créditos</p>
		        
		        <h2><?php bloginfo('name'); ?></h2>
				<p class="attribution">
				    &copy; 2015<br>
				    Facultad de Comunicaciones UC<br>
				    Alameda 340<br>
				    Santiado de Chile <br>
				    Fono: +56 2 2354 2020<br>
				    Fax: +56 2 2354 2988
				</p>
			
			</div> <!-- end #inner-footer -->
			
		</footer> <!-- end footer -->
		
		<!--[if lt IE 7 ]>
  			<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  			<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->
		
		<?php wp_footer(); // js scripts are inserted using this function ?>

		<!-- remove this for production -->

		<script src="//localhost:35729/livereload.js"></script>

	</body>

</html>
