<?php 

add_action( 'wp_enqueue_scripts', 'ms_divi_enqueue_styles' );
function ms_divi_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

// add_action( 'wp_enqueue_scripts', 'ms_divi_enqueue_scripts' );
// function ms_divi_enqueue_scripts() {
// 	wp_enqueue_script( "blogHandler", get_template_directory_uri() . '/scripts/mermaid-blog.js');
// }


/*-----------------------------------------------------------------------------------*/
/* Add library items with shortcodes */
/*-----------------------------------------------------------------------------------*/

function showlibraryitem_shortcode($moduleid) {
	extract(shortcode_atts(array('id' =>'*'),$moduleid));
	return do_shortcode('[et_pb_section global_module="' . $id . '"][/et_pb_section]');
}
add_shortcode('showlibraryitem', 'showlibraryitem_shortcode');

/*-----------------------------------------------------------------------------------*/
/* Add the MEET PAM header. Done as shortcode to protect the HTML */
/*-----------------------------------------------------------------------------------*/

function meet_pam_func($atts, $content) {
	$atts = shortcode_atts(array(
		'meet_img' => '/wp-content/uploads/2015/09/xPAM-CIRCLE.png.pagespeed.ic.uGSTvRkPaO.png',
		'meet_header' => "Meet Pam",
		'meet_consult' => "Norwex Independent Sales Consultant"
	),$atts, "meet_pam");

	$pam = "Pam Altendorf, Norwex Independent Sales Consultant";

	$html = "<div class='meet'>
	<div class='meet__intro'>
		<p class='meet__pam'>%s</p>
		<p class='meet__consult'>%s</p>
	</div>
	<figure class='meet__mug'>
		<img src='%s' alt='%s' title='%s' />
	</figure>
	<div class='meet__bio'>
		<p>%s</p>
	</div></div>";

	return sprintf($html, $atts['meet_header'], $atts['meet_consult'], $atts['meet_img'],$pam, $pam, $content );
}
add_shortcode('meet_pam', 'meet_pam_func');


/*-----------------------------------------------------------------------------------*/
/*  MAKE SVGs ALLOWED
/*-----------------------------------------------------------------------------------*/

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


function lorem_function($atts){
	// This function adds an arbitrary number of lorm grafs as placeholders. It's marked as red so as to be obviously in need of replacing.
	
	extract(shortcode_atts(array(
		'num' => 4
		),$atts));
	$retval = "<p style='color:red;background:rgba(255,0,0,.25);'><strong>Dummy type needs replacing: </strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud execcaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est labor.</p>";
	$lorem = "<p style='color:red;background:rgba(255,0,0,.25);'>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud execcaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laboru</p>";
	
	for ($i = 0; $i < intval($atts['num']) - 1; $i++) {
    	$retval = $retval . $lorem;
	}

	return $retval;
}

add_shortcode('lorem','lorem_function');

function add_contact_module($atts){
	// This shortcode adds a contact module

	extract(shortcode_atts(array(
		'text' => "Want to host a party? Want to join the team? Pam would love to hear from you."
		),$atts));
	

	$retval ="<div class='contact-pam-module'>
			<img class='aligncenter' style='display: block; max-width: 220px; margin: 10px auto;' src='/wp-content/uploads/2015/09/xenvelope.png.pagespeed.ic.j_kWqJORac.png' />
			<h2 style='text-align: center;'>Contact Pam</h2>
			<p style='text-align: center;'>Want to host a party? Want to join the team? Pam would love to hear from you.</p>
			<p style='text-align: center;'><a class='et_pb_promo_button et_pb_button' href='/contact'>Reach out</a></p>
		</div>";


	return $retval;
}
add_shortcode('contact_module','add_contact_module');

function add_homepage_blog_posts_function($atts){
	// This shortcode adds blogs in a specific way to the homepage.

	$retval ="";

	$a = extract(shortcode_atts(array(
		'number_of_posts' => 1
		),$atts));
	
	$args = array(
		'posts_per_page'   => 7,
		'offset'           => 0,
		'category'         => '',
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


	$retval = "<div class='homepage-posts'>";


	foreach ($posts_array as $post ) : 
		$temp_title=get_the_title($post->ID);;
		$temp_link=get_permalink($post->ID);;
		$temp_date=get_the_time("g:i a \&#187; M. j, Y", $post->ID);

		$retval = $retval . "<article class='homepage-post'>
			<div class='homepage-post__skewed-bg--before'></div>
			<div class='homepage-post__text-container'>
				<h2 class='homepage-post__title'>
					<a href='" . $temp_link . "'>" . $temp_title . "</a>
				</h2>
				<p class='homepage-post__meta'>" .  $temp_date . "</p>
			</div>
			<div class='homepage-post__skewed-bg--after'></div>
		</article>";

	endforeach;

	$retval = $retval . "</div>";

	return $retval;
}
add_shortcode('add_homepage_blog_posts','add_homepage_blog_posts_function');


function add_homepage_blog_posts_function2($atts){
	// This shortcode adds blogs in a specific way to the homepage.

	$retval ="";

	$a = extract(shortcode_atts(array(
		'number_of_posts' => 1
		),$atts));

	var_dump($a);

	$args = array(
		'posts_per_page'   => $a['number_of_posts'],
		'offset'           => 0,
		'category'         => '',
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


	$retval = "<div class='homepage-posts'>";


	foreach ($posts_array as $post ) : 
		$temp_title=get_the_title($post->ID);;
		$temp_link=get_permalink($post->ID);;
		$temp_date=get_the_time("g:i a \&#187; M. j, Y", $post->ID);

		$retval = $retval . "<article class='homepage-post'>
			<div class='homepage-post__skewed-bg--before'></div>
			<div class='homepage-post__text-container'>
				<h2 class='homepage-post__title'>
					<a href='" . $temp_link . "'>" . $temp_title . "</a>
				</h2>
				<p class='homepage-post__meta'>" .  $temp_date . "</p>
			</div>
			<div class='homepage-post__skewed-bg--after'></div>
		</article>";

	endforeach;

	$retval = $retval . "</div>";

	return $retval;
}
add_shortcode('add_homepage_blog_posts2','add_homepage_blog_posts_function2');

?>