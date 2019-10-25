<?php

add_theme_support( 'post-thumbnails' );
add_image_size( 'med_thumbnail', 500, 300, true );
add_image_size( 'med_large_thumbnail', 700, 500, true );
add_image_size( 'feature_image', 1800, 1200, true );

// rit add function

function get_share_content($post) {

	$url = get_permalink($post);
	$post_title = $post->post_title;
	print '<div class="share-holder" style="margin-top: 30px">
	
		<div class="social-icons type-icon layout-normal">
			<h4>Share</h4>
		    <ul class="">
		        <li>
					<a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u='.$url.'" target="_blank">
						<i class="fa fa-facebook"></i>
					</a>
				</li>
				<li>
					<a class="twitter" href="https://twitter.com/intent/tweet?text='.$post_title.'&amp;url='.$url.'" target="_blank">
						<i class="fa fa-twitter"></i>
					</a>
				</li>
			</ul>
		</div>
					
	</div>';
}

function render_exhibition_front($is_exhibition_page = false) {
	$upcomming_exhibition = get_upcoming_exhibition();
	$current_exhibition = get_current_exhibition();
	$exhibitions = array_merge($upcomming_exhibition, $current_exhibition);
		if ($current_exhibition) {
			print '<h3>Current Exhibition</h3>';
			print '<div class="row mar30">';
			foreach( $current_exhibition as $exhibition ) {
				//print '<div class="col-md-6 col-sm-6 col-xs-12">';
					print '<div>';
						print '<div class="col-md-7 col-sm-7 col-xs-12 border-top">';
								//print '<a href="'.get_permalink( $exhibition->ID ).'">';
								//print get_the_post_thumbnail($exhibition->ID, 'large');
								//print '</a>';

	   				        $slide_images = get_post_meta( $exhibition->ID, 'slide_image' );
					        $image_array = array();
					        foreach ( $slide_images as $image ) {
								
								$image_array[] = $image['ID'];
							}
					        $image_implode = implode(',', $image_array);
					
					       
					        $slide = '[vc_images_carousel images="'.$image_implode.'" img_size="full" onclick="link_no" autoplay="yes" hide_prev_next_buttons="yes" wrap="yes"]';
					        print do_shortcode($slide);
					        
							print '</div>';
							print '<div class="col-md-5 col-sm-5 col-xs-12" style="padding-top:10px">';
								print '<a href="'.get_permalink( $exhibition->ID ).'">';
				 				print '<h4>'.$exhibition->post_title.'</h4>';
								print '</a>';
								$artists = get_post_meta( $exhibition->ID, 'exhibition_artists' ); 

								if($artists[0]) {
									foreach($artists as $artist) {

									  print '<a href="'.get_permalink($artist['ID']).'">';
									  print '<h5>'.$artist['post_title'].'</h5></a>';

									}
								}

					            //print '<h5>'.$exhibition->subheading.'</h5>';
								//print '<p>'.$exhibition->exhibition_start_date;
								//print ' - '.$exhibition->exhibition_end_date.'</p>';
								print '<div class="body-content">'.$exhibition->post_excerpt.'</div>';
			
							print '</div>';
						print '</div>';
					print '</div>';
				//print '</div>';
			}
			print '</div>';
		}
	
	
	
	
		if ($upcomming_exhibition) {
			print '<div style="padding-bottom: 40px"></div>';
			print '<h3>Upcoming Exhibition</h3>';
			
			print '<div class="row mar30">';
			foreach( $upcomming_exhibition as $exhibition ) {
				
					print '<div>';
						print '<div class="col-md-7 col-sm-7 col-xs-12 same-height border-top-first-img">';
				        
							print '<a href="'.get_permalink( $exhibition->ID ).'">';
							print get_the_post_thumbnail($exhibition->ID, 'large');
							print '</a>';
						print '</div>';
						print '<div class="col-md-5 col-sm-5 col-xs-12 same-height" style="padding-top:10px">';
				        
							print '<a href="'.get_permalink( $exhibition->ID ).'">';
			 				print '<h4>'.$exhibition->post_title.'</h4>';
							print '</a>';
							$artists = get_post_meta( $exhibition->ID, 'exhibition_artists' ); 

							if($artists[0]) {
								foreach($artists as $artist) {

								  print '<a href="'.get_permalink($artist['ID']).'">';
								  print '<h5>'.$artist['post_title'].'</h5></a>';

								}
							}
            				//print '<h5>'.$exhibition->subheading.'</h5>';
							//print '<p>'.$exhibition->exhibition_start_date;
							//print ' - '.$exhibition->exhibition_end_date.'</p>';
							print '<div class="body-content">'.$exhibition->post_excerpt.'</div>';
		
						print '</div>';
					print '</div>';
				
			}
			print '</div>';
			
		}
	if (!$is_exhibition_page && ($upcomming_exhibition || $current_exhibition)) {
		//print '<div style="text-align:center"><a class="button main-color" href="exhibition">More Exhibition</a></div>';
		//print '<div style="border-bottom: 1px solid; padding-bottom: 40px"></div>';
	}
	

}


function render_artwork_front($limit=6) {
	$artworks = get_feature_artwork($limit);
	if ($artworks) {
		print '<br />';
		print '<h3 style="border-bottom: 2px solid; padding-bottom: 10px;">Featured Artworks</h3>';
		
		print '<div class="" style="padding-top:10px">';
		foreach( $artworks as $artwork ) {
			
			print '<div class="col-md-3 col-xs-6 same-height" style="padding-right: 5px; padding-left: 5px;">';
			$image_url = get_the_post_thumbnail_url($artwork->ID, 'med_thumbnail');	
			$image = get_the_post_thumbnail($artwork->ID, 'med_thumbnail', array('class' => 'image-hoverbox', 'alt' => 'Avatar'));
			//print $image;
			
		  /*  print '<div class="container-hoverbox">
                      <img src="'.$image_url.'" alt="Avatar" class="image-hoverbox">
                          <div class="overlay-hoverbox">
                              <div class="text-hoverbox">
							      <a style="color: #FFF" href="'.get_permalink( $artwork->ID ).'">'.$artwork->post_title.'</a>
	                              

	                           </div>
                           </div>
                  </div>';*/
		print '<div class="container-hoverbox">'.$image.'
                      
                          <div class="overlay-hoverbox">
                              <div class="text-hoverbox">
							      <a style="color: #FFF" href="'.get_permalink( $artwork->ID ).'">'.$artwork->post_title.'</a>
	                              

	                           </div>
                           </div>
                  </div>';	

					/*print '<a href="'.get_permalink( $artwork->ID ).'">';
					print get_the_post_thumbnail($artwork->ID, 'thumbnail');
					
					print '<h5>'.$artwork->post_title.'</h5>';
					print '</a>';*/
				
				
			print '</div>';
			
		}
		print '</div>';
		
		
	}
	if ($limit != -1) {
		//print '<div style="padding-bottom: 40px"></div>';
		print '<div style="text-align: right"><a class="button btnmain-color" href="artwork">View more</a></div>';
		//print '<div style="border-bottom: 1px solid; padding-bottom: 40px"></div>';
	}


}

function get_other_exhibition() {
	$exhibitions = get_posts(array(
                     'post_type' => 'exhibition',
		             'numberposts' => 4,
		             'orderby' => 'rand',
		             'order'    => 'ASC'
                   ));

	print '<div class="row">';
					foreach( $exhibitions as $exhibition ) {
						print '<div class="col-md-6 col-sm-6 col-xs-12 mar30">';
							print '<div class="row">';

								print '<div class="col-md-6 col-sm-6 col-xs-12">';
									print '<a href="'.get_permalink( $exhibition->ID ).'">';
										print get_the_post_thumbnail($exhibition->ID, 'medium_large');
									print '</a>';
								print '</div>';

								print '<div class="col-md-6 col-sm-6 col-xs-12">';
									print '<a href="'.get_permalink( $exhibition->ID ).'">';
					 					print '<h4>'.$exhibition->post_title.'</h4>';
									print '</a>';
									$artists = get_post_meta( $exhibition->ID, 'exhibition_artists' ); 

									if($artists[0]) {
										foreach($artists as $artist) {

										  print '<a href="'.get_permalink($artist['ID']).'">';
										  print '<h5>'.$artist['post_title'].'</h5></a>';

										}
									}
		            				//print '<h5>'.$exhibition->subheading.'</h5>';
									print '<div class="body-content">'.$exhibition->post_excerpt.'</div>';
								print '</div>';

							print '</div>';
						print '</div>';
					}
	print '</div>';

}

function get_other_artist() {

	$artists = get_posts(array(
                     'post_type' => 'artist',
		             'numberposts' => -1,
		             'orderby' => 'post_title',
		             'order'    => 'ASC'
                   ));
	foreach($artists as $artist) {
		print '<div>';
		print '<a href="'.get_permalink($artist->ID).'">';
	  	print '<h5>'.$artist->post_title.'</h5></a>';
		print '</div>';
  	}
  	
  	

}

function exhibition_year_list() {
	$exhibitions = get_posts(array(
                     'post_type' => 'exhibition',
		             'numberposts' => -1,
                   ));
	$years = array();
	foreach ($exhibitions as $exhibition) {
		$start_date = get_post_meta( $exhibition->ID, 'exhibition_start_date' );
		$year = substr($start_date[0], -4);
		$years[] = (int)$year;

	}
		

	$years = array_unique($years);
	rsort($years);
	return $years;
}
function get_current_exhibition() {
		 $today = $date = date('Y-m-d', time());
         $exhibitions = get_posts(array(
                     		'post_type' => 'exhibition',
                     		'numberposts' => -1,
                     		'meta_query' => array(
										 'relation' => 'AND',
										  array(
												'key' => 'exhibition_end_date',
												'value' => $today,
												'compare' => '>='
												),
										  array(
												'key' => 'exhibition_start_date',
												'value' => $today,
												'compare' => '<='
												)
                            				),
											
                            				
                        				));
	return $exhibitions;
}

function get_upcoming_exhibition() {
	
		 $today = $date = date('Y-m-d', time());
         $exhibitions = get_posts(array(
                     		'post_type' => 'exhibition',
                     		'numberposts' => -1,
			 				'orderby' => 'meta_value',
			 				'meta_key' => 'exhibition_start_date',
							'order' => 'ASC',
                     		'meta_query' => array(
										 
										array(
												'key' => 'exhibition_start_date',
												'value' => $today,
												'compare' => '>',
											  )
											
                            				),
											
                            				
                        				));
	return $exhibitions;
}

function get_artist($limit=-1) {
	
	$artists = get_posts(array(
                     		'post_type' => 'artist',
                     		'numberposts' => $limit,				
               				));
	return $artists;
}

function get_feature_artwork($limit=-1) {
	
	$artworks = get_posts(array(
                     		'post_type' => 'artwork',
                     		'numberposts' => $limit,
		                    'meta_key' => 'show_in_front_page',
							'order' => 'ASC',
                     		'meta_query' => array(
										 
										array(
												'key' => 'show_in_front_page',
												'value' => true,
												'compare' => '=',
											  )
											
                            				),
											
               				));
	return $artworks;
}

function get_artwork($limit=-1) {
	
	$artists = get_posts(array(
                     		'post_type' => 'artwork',
                     		'numberposts' => $limit,				
               				));
	return $artists;
}

function get_exhibition_by_year($year, $only_past = true) {
	if($only_past) {
		$today = $date = date('Y-m-d', time());
		$meta_query = array(
										 'relation' => 'AND',
										  array(
												'key' => 'exhibition_start_date',
												'value' => $year.'-01-01',
												'compare' => '>='
												),
										  array(
												'key' => 'exhibition_start_date',
												'value' => $year.'-12-31',
												'compare' => '<='
												),
											array(
												'key' => 'exhibition_end_date',
												'value' => $today,
												'compare' => '<='
												)
                            				);
	}
	else {
		$meta_query = array(
										 'relation' => 'AND',
										  array(
												'key' => 'exhibition_start_date',
												'value' => $year.'-01-01',
												'compare' => '>='
												),
										  array(
												'key' => 'exhibition_start_date',
												'value' => $year.'-12-31',
												'compare' => '<='
												)
                            				);
		
	}
	
    $exhibitions = get_posts(array(
                     			'post_type' => 'exhibition',
                     			'meta_query' => $meta_query,
                     			'orderby' => 'exhibition_start_date',
                     			'order' => 'DESC',
                     			'numberposts' => -1,
                        	));
	return $exhibitions;
}

function render_current_upcomming_exhibition() {
	$upcomming_exhibition = get_upcoming_exhibition();
	$current_exhibition = get_current_exhibition();
	$exhibitions = array_merge($current_exhibition, $upcomming_exhibition);

		
		if ($exhibitions) {
			
			print '<div class="row">';
			foreach( $exhibitions as $exhibition ) {
				print '<div class="col-md-12 col-sm-12 col-xs-12">';
				
						
					print '<p><a href="'.get_permalink( $exhibition->ID ).'">';
					print get_the_post_thumbnail($exhibition->ID, 'large');
					print '</a></p>';
						
					print '<div>';	
					print '<a href="'.get_permalink( $exhibition->ID ).'">';
			 		print '<h5>'.$exhibition->post_title.'</h5>';
					print '</a>';
					print '<p> วันเริ่มต้นแสดงงาน: '.$exhibition->exhibition_start_date.'</p>';
					print '<p> วันสิ้นสุดแสดงงาน: '.$exhibition->exhibition_end_date.'</p>';
					print '<p>'.$exhibition->post_excerpt.'</p>';
					print '</div>';
						
					
				print '</div>';
			}
			print '</div>';
		
	}
}

function render_exhibition_by_year() {
    
    $ex_year_list = exhibition_year_list();	

    print '<div class="mar30 past-header"><h3>Past</h3></div>';
    print '<div class="year-click-wrapper row mar30">';
		print '<div class="col-md-2 col-sm-2 col-xs-3 year-click align-center active" id="all">';
			print '<a>ALL</a>';
		print '</div>';
	foreach($ex_year_list as $year){

		print '<div class="col-md-2 col-sm-2 col-xs-3 year-click align-center" id="'.$year.'">';
			print '<a>'.$year.'</a>';
		print '</div>';
	}
	print '</div>';

	foreach($ex_year_list as $year){
		$exhibitions = get_exhibition_by_year($year);
		
		if ($exhibitions) {
			print '<div id="ex-'.$year.'" class="ex-year-wrapper">';
				print '<div class="row">';
					foreach( $exhibitions as $exhibition ) {
						print '<div class="col-md-6 col-sm-6 col-xs-12 mar30">';
							print '<div class="row">';

								print '<div class="col-md-6 col-sm-6 col-xs-12">';
									print '<a href="'.get_permalink( $exhibition->ID ).'">';
										print get_the_post_thumbnail($exhibition->ID, 'medium_large');
									print '</a>';
								print '</div>';

								print '<div class="col-md-6 col-sm-6 col-xs-12">';
									print '<a href="'.get_permalink( $exhibition->ID ).'">';
					 					print '<h4>'.$exhibition->post_title.'</h4>';
									print '</a>';
									$artists = get_post_meta( $exhibition->ID, 'exhibition_artists' ); 

									if($artists[0]) {
										foreach($artists as $artist) {

										  print '<a href="'.get_permalink($artist['ID']).'">';
										  print '<h5>'.$artist['post_title'].'</h5></a>';

										}
									}
		            				//print '<h5>'.$exhibition->subheading.'</h5>';
									print '<div class="body-content">'.$exhibition->post_excerpt.'</div>';
								print '</div>';

							print '</div>';
						print '</div>';
					}
				print '</div>';
			print '</div>';
		}
		//s($ex);
	}
}




function render_artwork_main() {
	$artworks = get_artwork(0);
	if ($artworks) {
		print '<div style="padding-bottom: 40px"></div>';		
		print '<div class="container">';
		foreach( $artworks as $artwork ) {
			print '<div class="row" style="margin-bottom: 20px">';
				print '<div class="col-md-6 col-sm-6 col-xs-12">';
			
					print '<a href="'.get_permalink( $artwork->ID ).'">';
					print get_the_post_thumbnail($artwork->ID, 'large');
					print '</a>';
				print '</div>';
				print '<div class="col-md-6 col-sm-6 col-xs-12">';
					print '<a href="'.get_permalink( $artwork->ID ).'">';
					print '<h3>'.$artwork->post_title.'</h3>';
					print '</a>';					
					print '<p>'.$artwork->post_excerpt.'</p>';
				print '</div>';
			print '</div>';
		}
		print '</div>';
		
		
	}



}

function render_artist_front($limit=8) {
	$artists = get_artist($limit);
	if ($artists) {
		print '<br />';
		print '<h3>Artist</h3>';
		print '<div class="container">';
		print '<div class="row display-flex">';
		foreach( $artists as $artist ) {
			print '<div class="col-md-3 col-xs-6 mar30">';
			
					
					print '<a href="'.get_permalink( $artist->ID ).'">';
					print get_the_post_thumbnail($artist->ID, 'thumbnail');
					
					print '<h5>'.$artist->post_title.'</h5>';
					print '</a>';
				
			print '</div>';
		    
		}
		print '</div>';
		print '</div>';
		
	}
	if ($limit != -1) {
		print '<div style="padding-bottom: 40px"></div>';
		print '<div style="text-align: center"><a class="button main-color" href="artist">More Artist</a></div>';
		print '<div style="border-bottom: 1px solid; padding-bottom: 40px"></div>';
	}


}


//======= End rit add function


// Define global theme variables
$proton_options = get_proton_options();
$proton_theme = wp_get_theme();
$proton_theme_version = $proton_theme['Version'];

// Language Setup
add_action('after_setup_theme', 'proton_language_setup');
function proton_language_setup()
{
	load_theme_textdomain('proton', get_template_directory() . '/languages');
}

// Set max content width
if (!isset($content_width)) {
	$content_width = 1170;
}

// Get Options from Redux
function get_proton_options()
{
	$proton_options = get_option('proton_redux');

	if (!empty($proton_options)) {
		return $proton_options;
	}
}

// Get Redux Options
function proton_get_rdx_option($proton_option)
{
	global $proton_options;

	return isset($proton_options[$proton_option]) ? $proton_options[$proton_option] : null;
}

// Proton Setup
add_action('after_setup_theme', 'proton_setup');
function proton_setup()
{
	// Add theme support
	add_theme_support('menus');
	add_theme_support('post-thumbnails');
	add_theme_support('automatic-feed-links');
	add_theme_support('title-tag');
	add_theme_support('woocommerce');
	add_theme_support('wc-product-gallery-lightbox');

	// Include custom files
	require_once(get_template_directory() . '/includes/tgm.php');
	include_once(get_template_directory() . '/includes/custom-fields.php');
	include(get_template_directory() . "/includes/custom.php");
	include(get_template_directory() . "/includes/custom-fonts.php");
	// define('ACF_LITE', true);

	// Add stylesheets and scripts
	add_action('wp_enqueue_scripts', 'proton_add_external_css');
	add_action('wp_enqueue_scripts', 'proton_add_external_js');

	// Register Menus
	register_nav_menus(
		array(
			"main-menu" => "Main Menu"
		)
	);

	// Active class in header
	add_filter('nav_menu_css_class', 'proton_nav_class', 10 ,2);
	function proton_nav_class($classes, $item)
	{
		if (in_array('current-menu-item', $classes)) {
			$classes[] = 'active ';
		}
		return $classes;
	}

	// Initial the Redux Framework to Proton
	if (!isset($redux_demo) && file_exists(get_template_directory() . '/includes/options-config.php')) {
	    require_once(get_template_directory().'/includes/options-config.php');
	}

	// Set Visual Composer as part of theme
	if (function_exists('vc_map')) {
		// Include NeuronElements Params
		include_once(get_template_directory() . '/includes/vc_functions.php');

		// Disable Front End Editor
		vc_disable_frontend();

		// Set Visual Composer As Theme
		add_action('vc_before_init', 'proton_vcSetAsTheme');
		function proton_vcSetAsTheme()
		{
			vc_set_as_theme();
		}

		// Custom Style for Back End Editor
		add_action('admin_enqueue_scripts', 'proton_vc_styles');
		function proton_vc_styles()
		{
			wp_enqueue_style('proton-vc', get_template_directory_uri() .'/includes/options/vc/vc_custom.css', false, null, null);
		}
	}

	// TGMPA
	add_action('tgmpa_register', 'proton_theme_plugins');
	function proton_theme_plugins()
	{
		$plugins = array(
			array(
	            'name'      => esc_html__('Redux Framework','proton'),
	            'slug'      => 'redux-framework',
	            'required'  => true
	        ),
	        array(
	            'name'      => esc_html__('Contact Form 7','proton'),
	            'slug'      => 'contact-form-7',
	            'required'  => false
	        ),
			array(
				'name'      => esc_html__('WooCommerce','proton'),
				'slug'      => 'woocommerce',
				'required'  => false
	        ),
			array(
	        	'name'      => esc_html__('Advanced Custom Fields', 'proton'),
	            'slug'      => 'advanced-custom-fields',
				'required'  => true,
				'force_activation' => true
	        ),
			array(
	        	'name'      => esc_html__('WPBakery Page Builder(Visual Composer)', 'proton'),
	            'slug'      => 'js-composer',
				'source'    => get_template_directory() . '/includes/plugins/js_composer.zip',
	            'required'  => true
	        ),
			array(
	        	'name'      => esc_html__('ACF Repeater', 'proton'),
	            'slug'      => 'acf-repeater',
				'source'    => get_template_directory() . '/includes/plugins/acf-repeater.zip',
	            'required'  => true
	        ),
			array(
	        	'name'      => esc_html__('ACF Flexible Content', 'proton'),
	            'slug'      => 'acf-flexible-content',
				'source'    => get_template_directory() . '/includes/plugins/acf-flexible-content.zip',
	            'required'  => true
	        ),
			array(
	        	'name'      => esc_html__('Portfolio Post Type', 'proton'),
	            'slug'      => 'portfolio-post-type',
	            'required'  => true
	        ),
			array(
	        	'name'      => esc_html__('Revolution Slider', 'proton'),
	            'slug'      => 'revslider',
				'source'    => get_template_directory() . '/includes/plugins/revslider.zip',
	            'required'  => false
	        ),
			array(
				'name'      => esc_html__('Advanced Custom Fields Font Awesome','proton'),
				'slug'      => 'advanced-custom-fields-font-awesome',
				'required'  => false
			),
			array(
				'name'      => esc_html__('Tweets Widgets','proton'),
				'slug'      => 'rotatingtweets',
				'required'  => false
			),
	    );
		$config = array(
			'id'           => 'tgmpa',
			'default_path' => '',
			'menu'         => 'tgmpa-install-plugins',
			'parent_slug'  => 'themes.php',
			'capability'   => 'edit_theme_options',
			'has_notices'  => true,
			'dismissable'  => true,
			'dismiss_msg'  => '',
			'is_automatic' => false,
			'message'      => ''
		);
	    tgmpa($plugins, $config);
	}
}

// Register Fonts
function proton_fonts_url()
{
	global $proton_options;
	$font_url = '';
	if ('off' !== _x('on', 'Google font: on or off', 'proton')) {
		if (proton_get_rdx_option('proton_style') == 'modern'){
			$font_url = add_query_arg( 'family', urlencode('Hind:300,400,500,600|Poppins:300,400,500,600' ), "//fonts.googleapis.com/css");
		} else {
			$font_url = add_query_arg( 'family', urlencode('Roboto:300,400,400i,500,700' ), "//fonts.googleapis.com/css");
		}
	}
	return $font_url;
}

function proton_add_external_css()
{
	global $proton_options, $proton_theme_version;
	// Enqueue
	wp_enqueue_style('proton-style', get_stylesheet_uri());
	wp_enqueue_style('bootstrap', get_template_directory_uri().'/assets/css/bootstrap.css', false, $proton_theme_version);
	wp_enqueue_style('font-awesome', get_template_directory_uri().'/assets/css/font-awesome.css', false, $proton_theme_version);
	wp_enqueue_style('owl-theme', get_template_directory_uri().'/assets/css/bundle.css', false, $proton_theme_version);
	if (class_exists('WooCommerce')) {
		wp_enqueue_style('woocommerce', get_template_directory_uri().'/assets/css/woocommerce.css', false, $proton_theme_version);
	}
	wp_enqueue_style('main', get_template_directory_uri().'/assets/css/style.css', false, $proton_theme_version);
	if (proton_get_rdx_option('proton_style') == 'modern'){
		wp_enqueue_style('modern', get_template_directory_uri().'/assets/css/modern.css', false, $proton_theme_version);
	}
	if (proton_get_rdx_option('proton_skin') == 'dark'){
		wp_enqueue_style('dark-skin', get_template_directory_uri().'/assets/css/dark-skin.css', false, $proton_theme_version);
	}
	wp_enqueue_style('proton-fonts', proton_fonts_url(), array(), $proton_theme_version);
}


function proton_add_external_js()
{
	global $proton_options, $proton_theme_version;
	$proton_api_key = proton_get_rdx_option('proton_api_key');
	$api_key = "AIzaSyAuaE4p3L0-Q6TXUDc4Xf9ttyCSK6779e4";

	if ($proton_api_key) {
		$api_key = $proton_api_key;
	}

	if (!is_admin()) {
		// Enqueue
		wp_enqueue_script("bootstrap", get_template_directory_uri()."/assets/js/bootstrap.js", array("jquery"), $proton_theme_version, TRUE);
		wp_enqueue_script("bundle", get_template_directory_uri()."/assets/js/bundle.js", array("jquery"), $proton_theme_version, TRUE);
		wp_enqueue_script("owl.carousel", get_template_directory_uri()."/assets/js/owl.carousel.min.js", array("jquery"), $proton_theme_version, TRUE);
		wp_enqueue_script("magnific-popup", get_template_directory_uri()."/assets/js/jquery.magnific-popup.min.js", array("jquery"), $proton_theme_version, TRUE);
		wp_enqueue_script("main", get_template_directory_uri()."/assets/js/main.js", array("jquery"), $proton_theme_version, TRUE);
		if (proton_get_rdx_option('proton_smooth_scroll')) {
			wp_register_script("page-smooth-scroll", get_template_directory_uri()."/assets/js/page-smooth-scroll.js", array("jquery", "maps"), $proton_theme_version, TRUE);
		}
		if (is_singular()) {
			wp_enqueue_script("comment-reply");
		}
		wp_enqueue_script('google-maps','https://maps.googleapis.com/maps/api/js?key='. $api_key .'', array('jquery'), $proton_theme_version);
	}

}

// Favicon
if (!function_exists('wp_site_icon') || !has_site_icon()) {
	function proton_favicon()
	{
		global $proton_options;
		$proton_favicon = proton_get_rdx_option('proton_favicon');
		if ($proton_favicon) {
			$proton_favicon_url = $proton_favicon['url'];
			echo "<link rel='shortcut icon' href='$proton_favicon_url' />";
		}
	}
	add_action('wp_head', 'proton_favicon');
}

// Sidebar
add_action('widgets_init', 'proton_widgets_init');
function proton_widgets_init()
{
	global $proton_options;
    register_sidebar(
    	array(
			'name' => esc_html__('Main Sidebar', 'proton'),
			'id' => 'sidebar-1',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>'
    	)
	);
	register_sidebar(
		array(
			'name' => esc_html__('Contact Sidebar', 'proton'),
			'id' => 'sidebar-2',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>'
		)
	);
	if(class_exists('WooCommerce')){
		register_sidebar(
			array(
				'name' => esc_html__('Shop Sidebar','proton'),
				'id' => 'sidebar-3',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widgettitle">',
				'after_title'   => '</h2>'
			)
		);
	}
	if(proton_get_rdx_option('proton_footer_widgets') == true) :
		register_sidebar(
			array(
		        'name' => esc_html__('Footer Sidebar 1', 'proton'),
		        'id' => 'footer-sidebar-1',
		        'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		    )
		);
		register_sidebar(
			array(
		        'name' => esc_html__('Footer Sidebar 2', 'proton'),
		        'id' => 'footer-sidebar-2',
		        'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		    )
		);
		if(proton_get_rdx_option('proton_footer_widgets_columns') == 'three' || proton_get_rdx_option('proton_footer_widgets_columns') == 'four') {
			register_sidebar(
				array(
			        'name' => esc_html__('Footer Sidebar 3', 'proton'),
			        'id' => 'footer-sidebar-3',
			        'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h3>',
					'after_title'   => '</h3>'
			    )
			);
		}
		if(proton_get_rdx_option('proton_footer_widgets_columns') == 'four') {
			register_sidebar(
				array(
			        'name' => esc_html__('Footer Sidebar 4', 'proton'),
			        'id' => 'footer-sidebar-4',
			        'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h3>',
					'after_title'   => '</h3>'
			    )
			);
		}
	endif;
}

// Pagination
function proton_pagination($proton_pages = '', $proton_range = 4)
{
	global $paged;
	$proton_showitems = ($proton_range * 2) + 1;

	if (empty($paged)) {
		if (get_query_var('paged')) {
			$paged = get_query_var('paged');
		} elseif (get_query_var('page')) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}
	}

	if ($proton_pages == '') {
		global $wp_query;
		$proton_pages = $wp_query->max_num_pages;

		if (!$proton_pages) {
			$proton_pages = 1;
		}
	}

	if (1 != $proton_pages) {
		echo "<ul class='page-pagination'>";

		for ($i = 1; $i <= $proton_pages; $i++) {
			if (1 != $proton_pages && (!($i >= $paged + $proton_range + 1 || $i <= $paged - $proton_range - 1) || $proton_pages <= $proton_showitems)) {
				echo ($paged == $i) ? "<li class=\"active\"><a>". $i ."</a></li>":"<li><a href='". get_pagenum_link($i) ."' class=\"inactive\">". $i ."</a></li>";
			}
		}

		echo "</ul>\n";
	}
}

// Ajax Mini Cart
function woocommerce_header_add_to_cart_fragment($fragments) {
    ob_start();
    ?>
        <span class="number bold">
            <?php echo sprintf('%d', WC()->cart->cart_contents_count); ?>
        </span>
    <?php
    $fragments['#minicart .number'] = ob_get_clean();
    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');


// Change Excerpt length
function excerpt($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if(count($excerpt) >= $limit) {
		array_pop($excerpt);
		$excerpt = implode(" ", $excerpt) . '...';
	} else {
		$excerpt = implode(" ", $excerpt);
	}
	$excerpt = preg_replace('`\[[^\]]*\]`','', $excerpt);
	return $excerpt;
}

// Remove redux menu under the tools
add_action('admin_menu', 'proton_remove_redux_menu', 12);
function proton_remove_redux_menu()
{
	remove_submenu_page('tools.php','redux-about');
}

function proton_removeDemoModeLink()
{
	if ( class_exists('ReduxFrameworkPlugin') ) {
	    remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
	}
	if ( class_exists('ReduxFrameworkPlugin') ) {
	    remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );
	}
}
add_action('init', 'proton_removeDemoModeLink');

// Remove Tags from Portfolio Post Type
add_action('init', 'proton_remove_portfolio_tags');
function proton_remove_portfolio_tags()
{
    unregister_taxonomy_for_object_type('portfolio_tag', 'portfolio');
}


// Map Classic
function proton_map_classic($latitude, $longitude)
{
	?>
	<script>
	    function initialize() {
	      var mapOptions = {
	        zoom: 15,
	        scrollwheel: false,
	        center: new google.maps.LatLng(<?php echo $latitude ?>, <?php echo $longitude ?>)
	      }
	      var image = '<?php echo get_template_directory_uri(); ?>/assets/images/map-marker.png';
	      var myLatLng = new google.maps.LatLng(<?php echo $latitude ?>, <?php echo $longitude ?>);
	      var map = new google.maps.Map(document.getElementById('map'),mapOptions);
	      var beachMarker = new google.maps.Marker({
	          position: myLatLng,
	          map: map,
	          icon: image
	      });
	      var myLatLng = new google.maps.LatLng(<?php echo $latitude ?>, <?php echo $longitude ?>);
	      var styles = [{"featureType":"administrative","elementType":"geometry","stylers":[{"color":"#a7a7a7"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#737373"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#efefef"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#dadada"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#696969"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#b3b3b3"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#d6d6d6"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"weight":1.8}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"color":"#d7d7d7"}]},{"featureType":"transit","elementType":"all","stylers":[{"color":"#808080"},{"visibility":"off"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#d3d3d3"}]},{"featureType":"water","elementType":"labels.text","stylers":[{"color":"#000000"}]}];

	    map.setOptions({styles: styles});
	    }
	    google.maps.event.addDomListener(window, 'load', initialize);
	</script>
	<?php
}

function proton_map_modern($latitude, $longitude)
{
	?>
	<script>
	function initialize() {
	    var a = {
	        zoom: 17,
	        scrollwheel: !1,
	        center: new google.maps.LatLng(<?php echo $latitude ?>, <?php echo $longitude ?>)
	    };
	    new google.maps.Map(document.getElementById("map"), a), new google.maps.LatLng(<?php echo $latitude ?>, <?php echo $longitude ?>)
	}
	google.maps.event.addDomListener(window, "load", initialize);
	<?php
}

// Compress Text
function proton_compress($proton_input)
{
	$proton_input = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $proton_input);
	$proton_input = str_replace(array( "\r\n", "\r", "\n", "\t", '	', '	', '	' ), '', $proton_input);

	return $proton_input;
}

// Generate Custom CSS
$proton_generate_custom_css = array();
function proton_generate_custom_css($proton_css)
{
	global $proton_generate_custom_css;

	$proton_generate_custom_css[] = $proton_css;
}

function proton_generate_css()
{
	global $proton_generate_custom_css;

	if (!isset($proton_generate_custom_css)) {
		return;
	}

	echo "<style>\n" . proton_compress(implode(PHP_EOL . PHP_EOL, $proton_generate_custom_css)) . "\n</style>";
}
add_action('wp_footer', 'proton_generate_css');

// Maintenance Mode
function proton_maintenance_mode()
{
	global $current_user;

	$proton_manage_options = current_user_can('manage_options');
	$proton_coming_soon = proton_get_rdx_option('proton_coming_soon');
	$proton_maintenance_mode = proton_get_rdx_option('proton_maintenance_mode');

	if ($proton_coming_soon && $proton_manage_options == false) {
		get_template_part('templates/page-coming-soon');
		exit();
	}

	if ($proton_maintenance_mode && $proton_manage_options == false) {
		get_template_part('templates/page-maintenance');
		exit();
	}
}
add_action('template_redirect', 'proton_maintenance_mode');

// Rewrite the url of Portfolio
add_filter('portfolioposttype_args', 'proton_change_portfolio_labels');
function proton_change_portfolio_labels(array $args)
{
	$args['has_archive'] = false;
    return $args;
}

// Share Social Media
function proton_share_media($proton_show, $proton_type, $proton_layout, $proton_style, $proton_title, $proton_media)
{
	// Share > Enable
	if ($proton_show == false) {
		return;
	}

    $proton_media_enabled = $proton_media['enabled'];
    $proton_media_class[] = "social-icons";
    $proton_media_ul_class = array();

	$proton_social_array = array(
		'facebook' => '<i class="fa fa-facebook"></i>',
		'twitter' => '<i class="fa fa-twitter"></i>',
		'google_plus' => '<i class="fa fa-google-plus"></i>',
		'linkedin' => '<i class="fa fa-linkedin"></i>',
		'pinterest' => '<i class="fa fa-pinterest"></i>',
		'tumblr' => '<i class="fa fa-tumblr"></i>'
	);

	if ($proton_type == '2') {
		$proton_social_array = array(
			'facebook' => 'Facebook',
			'twitter' => 'Twitter',
			'google_plus' => 'Google Plus',
			'linkedin' => 'Linkedin',
			'pinterest' => 'Pinterest',
			'tumblr' => 'Tumblr'
		);
    }

	// Share > Type
	if ($proton_type == '1') {
		$proton_media_class[] = "type-icon";
	} else {
		$proton_media_class[] = "type-text";
	}

	// Share > Layout
	if ($proton_layout == '1') {
		$proton_media_class[] = "layout-normal";
	} elseif ($proton_layout == '2' && $proton_style != '4') {
		$proton_media_class[] = "layout-bg";
	}

	// Share > Style
	switch ($proton_style) {
		case '2':
			$proton_media_class[] = "colorful";
			break;
		case '3':
			$proton_media_class[] = "colorful-hover";
			break;
		case '4':
			$proton_media_class[] = "colorful-bg layout-bg";
			break;
		case '5':
			$proton_media_class[] = "colorful-underline";
			$proton_media_ul_class[] = "underline";
			break;
	}

	if ($proton_show) {
?>
	<div class="share-holder">
		<?php if ($proton_title) : ?>
			<h4><?php echo esc_attr($proton_title); ?></h4>
		<?php endif; ?>
		<div class="<?php echo esc_attr(implode(' ', $proton_media_class)) ?>">
		    <ul class="<?php echo esc_attr(implode(' ', $proton_media_ul_class)) ?>">
		        <?php
					$proton_shortTitle = get_the_title();
		            $proton_shortURL = get_permalink();

		            if ($proton_media_enabled) {
		                foreach ($proton_media_enabled as $proton_key => $proton_value) {
		                    switch ($proton_key) {
		                        case 'facebook':
		                            echo '<li><a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u='. $proton_shortURL . '">'. $proton_social_array['facebook'] .'</a></li>';
		                        	break;
		                        case 'twitter':
		                            echo '<li><a class="twitter" href="https://twitter.com/intent/tweet?text='. $proton_shortTitle .'&amp;url='. $proton_shortURL.'">'. $proton_social_array['twitter'] .'</a></li>';
		                        	break;
		                        case 'google-plus':
		                            echo '<li><a class="google-plus" href="https://plus.google.com/share?url='. $proton_shortURL .'">'. $proton_social_array['google_plus'] .'</a></li>';
		                        	break;
		                        case 'linkedin':
		                            echo '<li><a class="linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url='. $proton_shortURL .'&title='. $proton_shortTitle .'">'. $proton_social_array['linkedin'] .'</a></li>';
		                        	break;
		                        case 'pinterest':
		                            echo '<li><a class="pinterest" href="https://pinterest.com/pin/create/button/?url='. $proton_shortURL .'&description='. $proton_shortTitle .'">'. $proton_social_array['pinterest'] .'</a></li>';
		                        	break;
		                        case 'tumblr':
		                            echo '<li><a class="tumblr" href="http://www.tumblr.com/share/link?url='. $proton_shortURL .'&name='. $proton_shortTitle .'">'. $proton_social_array['tumblr'] .'</a></li>';
		                        	break;
		                    }
		                }
		            }
		        ?>
		    </ul>
		</div>
	</div>
<?php
}}