<?php get_header(); ?>

<div id="main-content">
	<?php 
		// Add global banner to all posts. The banner is edited in the Divi library
		echo do_shortcode("[showlibraryitem id=26380]"); 
	?>
	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">
				<?php 
					// Add global shop banner. The banner is edited in the Divi library
					echo do_shortcode("[showlibraryitem id=27382]"); 
				?>
				<div class='products'>
				<div class='products__traveler'>
					<p class='products__traveler-note'>Choose a product type:</p>
					<?php 
						// Load the category list and make the traveler
						$categories =  get_categories('child_of=125');
						echo '<ul>';
						foreach  ($categories as $category) {
						  	$list_item_string = "<li><a href='#%s'>%s</a></li>";
							echo sprintf($list_item_string, $category->slug, $category->cat_name);
						}
						echo '</ul>';
					?>
				</div>
				<div class='products__posts'>
				<?php
					foreach  ($categories as $category) {
						echo "<section class='product-category' id='" . $category->slug . "'>";
						echo "<h2 class='product-category__header'>" . $category->cat_name . "</h2>";
						$args = array(
							'posts_per_page'   => 10,
							'offset'           => 0,
							'category'         => $category->term_id,
							'category_name'    => '',
							'orderby'          => 'date',
							'order'            => 'DESC',
							'include'          => '',
							'exclude'          => '',
							'meta_key'         => '',
							'meta_value'       => '',
							'post_type'        => 'post',
							'post_mime_type'   => '',
							'post_parent'      => '',
							'author'	   => '',
							'author_name'	   => '',
							'post_status'      => 'publish',
							'suppress_filters' => true 
						);
						$posts_array = get_posts( $args );


						foreach ($posts_array as $post ) : setup_postdata($post); ?>
				
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>
<?php
					$thumb = '';

					$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

					$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
					$classtext = 'et_pb_post_main_image';
					$titletext = get_the_title();
					$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
					$thumb = $thumbnail["thumb"];

					et_divi_post_format_content();

					if ( ! in_array( $post_format, array( 'link', 'audio', 'quote' ) ) ) {
						if ( 'video' === $post_format && false !== ( $first_video = et_get_first_video() ) ) :
							printf(
								'<div class="et_main_video_container">
									%1$s
								</div>',
								$first_video
							);
						elseif ( ! in_array( $post_format, array( 'gallery' ) ) && 'on' === et_get_option( 'divi_thumbnails_index', 'on' ) && '' !== $thumb ) : ?>
							<a href="<?php the_permalink(); ?>">
								<?php print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height ); ?>
							</a>
					<?php
						elseif ( 'gallery' === $post_format ) :
							et_pb_gallery_images();
						endif;
					} ?>

				<?php if ( ! in_array( $post_format, array( 'link', 'audio', 'quote' ) ) ) : ?>
					<?php if ( ! in_array( $post_format, array( 'link', 'audio' ) ) ) : ?>
						<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php endif; ?>

					<?php
						// et_divi_post_meta();

						if ( 'on' !== et_get_option( 'divi_blog_style', 'false' ) || ( is_search() && ( 'on' === get_post_meta( get_the_ID(), '_et_pb_use_builder', true ) ) ) ) {
							truncate_post( 270 );
						} else {
							the_content();
						}
					?>
				<?php endif; ?>
							</article>
						<?php endforeach; // End posts loop ?>

					<?php echo "<a class='product-category__more' href='/category/" . $category->slug . "'>More " . $category->cat_name . "</a>";?>

				<?php echo "</section> <!-- End category ".  $category->slug . " section  -->" ?>
			<?php } // End category loop ?>
					</div> <!-- CLOSE PRODUCTS__POSTS -->
				</div> <!-- CLOSE PRODUCTS -->
			</div> <!-- #left-area -->

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->
</div> <!-- #main-content -->

<?php get_footer(); ?>