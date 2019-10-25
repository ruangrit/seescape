<?php

// Coming Soon Mode
add_filter('proton_display_header', '__return_false');
add_filter('proton_display_footer', '__return_false');

global $proton_options;

$proton_coming_soon_date = proton_get_rdx_option('proton_coming_soon_date');
$proton_coming_soon_title = proton_get_rdx_option('proton_coming_soon_title');
$proton_coming_soon_description = proton_get_rdx_option('proton_coming_soon_description');
$proton_social_media_enable = proton_get_rdx_option('proton_social_media_enable');
$proton_social_media = proton_get_rdx_option('proton_social_media');

$proton_social_array = array(
    'facebook' => "Facebook",
    'px500' => "500px",
    'twitter' => "Twitter",
    'google_plus' => "Google Plus",
    'vimeo' => "Vimeo",
    'dribbble' => "Dribbble",
    'pinterest' => "Pinterest",
    'youtube' => "Youtube",
    'tumblr' => "Tumblr",
    'linkedin' => "Linkedin",
    'behance' => "Behance",
    'flickr' => "Flickr",
    'spotify' => "Spotify",
    'instagram' => "Instagram",
    'github' => "Github",
    'stackexchange' => "Stack Exchange",
    'soundcloud' => "Soundcloud",
    'vk' => "Vk",
    'vine' => "Vine"
);

$proton_social_media_enabled = $proton_social_media['enabled'];

get_header();

?>
<div class="coming-soon-holder">
    <div class="full-width-section full-height">
        <div class="vertical-aligment">
            <div class="container">
                <div class="col-md-10 col-md-offset-1">
                    <div class="title-section">
                        <h1><?php echo esc_attr($proton_coming_soon_title ? $proton_coming_soon_title : esc_html__('Website coming soon', 'proton')) ?></h1>
                        <p><?php echo esc_attr($proton_coming_soon_description ? $proton_coming_soon_description : esc_html__('We are working very hard to be back as soon as we can!', 'proton')) ?></p>
                    </div>
                    <?php if ($proton_coming_soon_date) : ?>
                        <div class="row countdown-holder">
                            <div class="countdown"></div>
                        </div>
                    <?php
                        endif;

                        if ($proton_social_media_enable && $proton_social_media_enabled) {
                            echo "<div class='social-icons type-text layout-normal colorful'><ul>";
        	                foreach ($proton_social_media_enabled as $proton_key => $proton_value) {
        	                    switch ($proton_key) {
                                    case 'facebook':
                                        echo '<li><a target="_BLANK" class="facebook" href='. proton_get_rdx_option('proton_social_media_facebook') .'>'. $proton_social_array['facebook'] .'</a></li>';
                                    	break;
                                    case '500px':
                                        echo '<li><a target="_BLANK" class="i-500px" href='. proton_get_rdx_option('proton_social_media_500px') .'>'. $proton_social_array['px500'] .'</a></li>';
                                    	break;
                                    case 'twitter':
                                        echo '<li><a target="_BLANK" class="twitter" href='. proton_get_rdx_option('proton_social_media_twitter') .'>'. $proton_social_array['twitter'] .'</a></li>';
                                    	break;
                                    case 'google-plus':
                                        echo '<li><a target="_BLANK" class="google-plus" href='. proton_get_rdx_option('proton_social_media_google_plus') .'>'. $proton_social_array['google_plus'] .'</a></li>';
                                    	break;
                                    case 'vimeo':
                                        echo '<li><a target="_BLANK" class="vimeo" href='. proton_get_rdx_option('proton_social_media_vimeo') .'>'. $proton_social_array['vimeo'] .'</a></li>';
                                    	break;
                                    case 'dribbble':
                                        echo '<li><a target="_BLANK" class="dribbble" href='. proton_get_rdx_option('proton_social_media_dribbble') .'>'. $proton_social_array['dribbble'] .'</a></li>';
                                    	break;
                                    case 'pinterest':
                                        echo '<li><a target="_BLANK" class="pinterest" href='. proton_get_rdx_option('proton_social_media_pinterest') .'>'. $proton_social_array['pinterest'] .'</a></li>';
                                    	break;
                                    case 'youtube':
                                        echo '<li><a target="_BLANK" class="youtube" href='. proton_get_rdx_option('proton_social_media_youtube') .'>'. $proton_social_array['youtube'] .'</a></li>';
                                    	break;
                                    case 'tumblr':
                                        echo '<li><a target="_BLANK" class="tumblr" href='. proton_get_rdx_option('proton_social_media_tumblr') .'>'. $proton_social_array['tumblr'] .'</a></li>';
                                    	break;
                                    case 'linkedin':
                                        echo '<li><a target="_BLANK" class="linkedin" href='. proton_get_rdx_option('proton_social_media_linkedin') .'>'. $proton_social_array['linkedin'] .'</a></li>';
                                    	break;
                                    case 'behance':
                                        echo '<li><a target="_BLANK" class="behance" href='. proton_get_rdx_option('proton_social_media_behance') .'>'. $proton_social_array['behance'] .'</a></li>';
                                    	break;
                                    case 'flickr':
                                        echo '<li><a target="_BLANK" class="flickr" href='. proton_get_rdx_option('proton_social_media_flickr') .'>'. $proton_social_array['flickr'] .'</a></li>';
                                    	break;
                                    case 'spotify':
                                        echo '<li><a target="_BLANK" class="spotify" href='. proton_get_rdx_option('proton_social_media_spotify') .'>'. $proton_social_array['spotify'] .'</a></li>';
                                    	break;
                                    case 'instagram':
                                        echo '<li><a target="_BLANK" class="instagram" href='. proton_get_rdx_option('proton_social_media_instagram') .'>'. $proton_social_array['instagram'] .'</a></li>';
                                    	break;
                                    case 'github':
                                        echo '<li><a target="_BLANK" class="github" href='. proton_get_rdx_option('proton_social_media_github') .'>'. $proton_social_array['github'] .'</a></li>';
                                    	break;
                                    case 'stackexchange':
                                        echo '<li><a target="_BLANK" class="stackexchange" href='. proton_get_rdx_option('proton_social_media_stackexchange') .'>'. $proton_social_array['stackexchange'] .'</a></li>';
                                    	break;
                                    case 'soundcloud':
                                        echo '<li><a target="_BLANK" class="soundcloud" href='. proton_get_rdx_option('proton_social_media_soundcloud') .'>'. $proton_social_array['soundcloud'] .'</a></li>';
                                    	break;
                                    case 'vk':
                                        echo '<li><a target="_BLANK" class="vk" href='. proton_get_rdx_option('proton_social_media_vk') .'>'. $proton_social_array['vk'] .'</a></li>';
                                    	break;
                                    case 'vine':
                                        echo '<li><a target="_BLANK" class="vine" href='. proton_get_rdx_option('proton_social_media_vine') .'>'. $proton_social_array['vine'] .'</a></li>';
                                    	break;
        	                    }
        	                }
                            echo "</div></ul>";
        	            }

                            if ($proton_coming_soon_date) :
                        ?>
                            <script type="text/javascript">
                               jQuery(document).ready(function($){
                                   $('.countdown').countdown('<?php echo esc_attr($proton_coming_soon_date) ?>', function(event) {
                                     var $this = $(this).html(event.strftime(''
                                       + '<div class="col-xs-3"><div class="countdown-number"><h1>%D</h1><p><?php echo esc_html__('Days', 'proton') ?></p></div></div>'
                                       + '<div class="col-xs-3"><div class="countdown-number"><h1>%H</h1><p><?php echo esc_html__('Hours', 'proton') ?></p></div></div>'
                                       + '<div class="col-xs-3"><div class="countdown-number"><h1>%M</h1><p><?php echo esc_html__('Minutes', 'proton') ?></p></div></div>'
                                       + '<div class="col-xs-3"><div class="countdown-number"><h1>%S</h1><p><?php echo esc_html__('Seconds', 'proton') ?></p></div></div>'));
                                   });
                               });
                            </script>
                   <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

get_footer();
