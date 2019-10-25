<?php

// Social Media - NeuronElement
$proton_social_media_class[] = "social-icons";
$proton_social_media_ul_class = array();

extract(
	shortcode_atts(
		array(
	        'proton_social_media_type' => '1',
	        'proton_social_media_layout' => '1',
	        'proton_social_media_style' => '1',
	        'proton_social_media_url_inheritance' => '1',
	        'proton_social_media_facebook_url' => '',
	        'proton_social_media_twitter_url' => '',
	        'proton_social_media_500px_url' => '',
	        'proton_social_media_google_plus_url' => '',
	        'proton_social_media_vimeo_url' => '',
	        'proton_social_media_dribbble_url' => '',
	        'proton_social_media_pinterest_url' => '',
	        'proton_social_media_youtube_url' => '',
	        'proton_social_media_tumblr_url' => '',
	        'proton_social_media_linkedin_url' => '',
	        'proton_social_media_behance_url' => '',
	        'proton_social_media_flickr_url' => '',
	        'proton_social_media_spotify_url' => '',
	        'proton_social_media_instagram_url' => '',
	        'proton_social_media_github_url' => '',
	        'proton_social_media_houzz_url' => '',
	        'proton_social_media_stackexchange_url' => '',
	        'proton_social_media_soundcloud_url' => '',
	        'proton_social_media_vk_url' => '',
	        'proton_social_media_vine_url' => '',
			'el_class' => '',
			'proton_css' => '',
		),
		$atts
	)
);

// Type
if ($proton_social_media_type == '1') {
	$proton_social_media_class[] = "type-icon";
} else {
	$proton_social_media_class[] = "type-text";
}

// Layout
if ($proton_social_media_layout == '1') {
	$proton_social_media_class[] = "layout-normal";
} elseif ($proton_social_media_layout == '2' && $proton_social_media_style != '4') {
	$proton_social_media_class[] = "layout-bg";
}

// Style
switch ($proton_social_media_style) {
	case '2':
		$proton_social_media_class[] = "colorful";
		break;
	case '3':
		$proton_social_media_class[] = "colorful-hover";
		break;
	case '4':
		$proton_social_media_class[] = "colorful-bg layout-bg";
		break;
	case '5':
		$proton_social_media_class[] = "colorful-underline";
		$proton_social_media_ul_class[] = "underline";
		break;
}

// Extra Class
if ($el_class) {
	$proton_social_media_class[] = $el_class;
}

// CSS Editor
if ($proton_css) {
	$proton_social_media_class[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($proton_css, ''), $this->settings['base'], $atts);
}

// Social Icons type
$proton_social_media_array = array(
	'facebook' => array(
		'link' => $proton_social_media_facebook_url,
		'string' => 'Facebook',
		'icon' => 'facebook',
		'class' => 'facebook'
	),
	'500px' => array(
		'link' => $proton_social_media_500px_url,
		'string' => '500px',
		'icon' => '500px',
		'class' => 'i-500px'
	),
	'twitter' => array(
		'link' => $proton_social_media_twitter_url,
		'string' => 'Twitter',
		'icon' => 'twitter',
		'class' => 'twitter'
	),
	'google_plus' => array(
		'link' => $proton_social_media_google_plus_url,
		'string' => 'Google Plus',
		'icon' => 'google-plus',
		'class' => 'google-plus'
	),
	'vimeo' => array(
		'link' => $proton_social_media_vimeo_url,
		'string' => 'Vimeo',
		'icon' => 'vimeo',
		'class' => 'vimeo'
	),
	'dribbble' => array(
		'link' => $proton_social_media_dribbble_url,
		'string' => 'Dribbble',
		'icon' => 'dribbble',
		'class' => 'dribbble'
	),
	'pinterest' => array(
		'link' => $proton_social_media_pinterest_url,
		'string' => 'Pinterest',
		'icon' => 'pinterest',
		'class' => 'pinterest'
	),
	'youtube' => array(
		'link' => $proton_social_media_youtube_url,
		'string' => 'Youtube',
		'icon' => 'youtube',
		'class' => 'youtube'
	),
	'tumblr' => array(
		'link' => $proton_social_media_tumblr_url,
		'string' => 'Tumblr',
		'icon' => 'tumblr',
		'class' => 'tumblr'
	),
	'linkedin' => array(
		'link' => $proton_social_media_linkedin_url,
		'string' => 'Linkedin',
		'icon' => 'linkedin',
		'class' => 'linkedin'
	),
	'behance' => array(
		'link' => $proton_social_media_behance_url,
		'string' => 'Behance',
		'icon' => 'behance',
		'class' => 'behance'
	),
	'flickr' => array(
		'link' => $proton_social_media_flickr_url,
		'string' => 'Flickr',
		'icon' => 'flickr',
		'class' => 'flickr'
	),
	'spotify' => array(
		'link' => $proton_social_media_spotify_url,
		'string' => 'Spotify',
		'icon' => 'spotify',
		'class' => 'spotify'
	),
	'instagram' => array(
		'link' => $proton_social_media_instagram_url,
		'string' => 'Instagram',
		'icon' => 'instagram',
		'class' => 'instagram'
	),
	'github' => array(
		'link' => $proton_social_media_github_url,
		'string' => 'Github',
		'icon' => 'github',
		'class' => 'github'
	),
	'stackexchange' => array(
		'link' => $proton_social_media_stackexchange_url,
		'string' => 'Stack Exchange',
		'icon' => 'stack-exchange',
		'class' => 'stackexchange'
	),
	'soundcloud' => array(
		'link' => $proton_social_media_soundcloud_url,
		'string' => 'Soundcloud',
		'icon' => 'soundcloud',
		'class' => 'soundcloud'
	),
	'vk' => array(
		'link' => $proton_social_media_vk_url,
		'string' => 'VK',
		'icon' => 'vk',
		'class' => 'vk'
	),
	'vine' => array(
		'link' => $proton_social_media_vine_url,
		'string' => 'Vine',
		'icon' => 'vine',
		'class' => 'vine'
	)
);

// URL Inheritance
if ($proton_social_media_url_inheritance == '1') {
	$proton_social_media_array['facebook']['link'] = proton_get_rdx_option('proton_social_media_facebook');
	$proton_social_media_array['twitter']['link'] = proton_get_rdx_option('proton_social_media_twitter');
	$proton_social_media_array['500px']['link'] = proton_get_rdx_option('proton_social_media_500px');
	$proton_social_media_array['google_plus']['link'] = proton_get_rdx_option('proton_social_media_google_plus');
	$proton_social_media_array['vimeo']['link'] = proton_get_rdx_option('proton_social_media_vimeo');
	$proton_social_media_array['dribbble']['link'] = proton_get_rdx_option('proton_social_media_dribbble');
	$proton_social_media_array['pinterest']['link'] = proton_get_rdx_option('proton_social_media_pinterest');
	$proton_social_media_array['youtube']['link'] = proton_get_rdx_option('proton_social_media_youtube');
	$proton_social_media_array['tumblr']['link'] = proton_get_rdx_option('proton_social_media_tumblr');
	$proton_social_media_array['linkedin']['link'] = proton_get_rdx_option('proton_social_media_linkedin');
	$proton_social_media_array['behance']['link'] = proton_get_rdx_option('proton_social_media_behance');
	$proton_social_media_array['flickr']['link'] = proton_get_rdx_option('proton_social_media_flickr');
	$proton_social_media_array['spotify']['link'] = proton_get_rdx_option('proton_social_media_spotify');
	$proton_social_media_array['instagram']['link'] = proton_get_rdx_option('proton_social_media_instagram');
	$proton_social_media_array['github']['link'] = proton_get_rdx_option('proton_social_media_github');
	$proton_social_media_array['houzz']['link'] = proton_get_rdx_option('proton_social_media_houzz');
	$proton_social_media_array['stackexchange']['link'] = proton_get_rdx_option('proton_social_media_stackexchange');
	$proton_social_media_array['soundcloud']['link'] = proton_get_rdx_option('proton_social_media_soundcloud');
	$proton_social_media_array['vk']['link'] = proton_get_rdx_option('proton_social_media_vk');
	$proton_social_media_array['vine']['link'] = proton_get_rdx_option('proton_social_media_vine');
}

?>
<div class="<?php echo esc_attr(implode(' ', $proton_social_media_class)) ?>">
    <ul class="<?php echo esc_attr(implode(' ', $proton_social_media_ul_class)) ?>">
		<?php
			foreach ($proton_social_media_array as $proton_social_media) {
				if (!empty($proton_social_media['link'])) {
					if ($proton_social_media_type == '2') {
						echo "<li><a class=". esc_attr($proton_social_media['class']) ." target='_BLANK' href=". esc_url($proton_social_media['link']) .">" . esc_attr($proton_social_media['string']) . "</a></li>";
					} else {
						echo "<li><a class=". esc_attr($proton_social_media['class']) ." target='_BLANK' href=". esc_url($proton_social_media['link']) ."><i class='fa fa-". esc_attr($proton_social_media['icon']) ."'></i></a></li>";
					}
				}
			}
		?>
    </ul>
</div>
