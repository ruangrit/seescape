<?php
if ( ! class_exists('Redux') ) {
    return;
}

$opt_name = "proton_redux";
$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
    'opt_name'             => $opt_name,
    'display_name'         => $theme->get('Name'),
    'display_version'      => $theme->get('Version'),
    'menu_type'            => 'menu',
    'allow_sub_menu'       => true,
    'menu_title'           => __('Proton', 'proton'),
    'page_title'           => __('Proton Options', 'proton'),
    'google_api_key'       => '',
    'google_update_weekly' => false,
    'async_typography'     => true,
    'admin_bar'            => false,
    'admin_bar_icon'       => 'dashicons-portfolio',
    'admin_bar_priority'   => 50,
    'global_variable'      => '',
    'dev_mode'             => false,
    'update_notice'        => false,
    'customizer'           => false,
    'page_priority'        => null,
    'page_parent'          => 'themes.php',
    'page_permissions'     => 'manage_options',
    'menu_icon'            => '',
    'last_tab'             => '',
    'page_icon'            => 'icon-themes',
    'page_slug'            => '',
    'save_defaults'        => true,
    'default_show'         => false,
    'default_mark'         => '',
    'show_import_export'   => true,
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    'output_tag'           => true,
    'database'             => '',
    'use_cdn'              => true,
);


// Panel Intro text -> before the form
if (!isset($args['global_variable']) || $args['global_variable'] !== false) {
    if (!empty($args['global_variable'])) {
        $v = $args['global_variable'];
    } else {
        $v = str_replace('-', '_', $args['opt_name']);
    }
    $args['intro_text'] = '';
} else {
     $args['intro_text'] = '';
}

// Add content after the form.
// $args['footer_text'] = '';

Redux::setArgs($opt_name, $args );

// Add Extension to Redux
if (!function_exists('redux_register_custom_extension_loader')) :
    function redux_register_custom_extension_loader($ReduxFramework) {
        $path = dirname( __FILE__ ) . '/redux-framework/extensions/';
        $folders = scandir( $path, 1 );
        foreach($folders as $folder) {
            if ($folder === '.' or $folder === '..' or !is_dir($path . $folder) ) {
                continue;
            }
            $extension_class = 'ReduxFramework_Extension_' . $folder;
            if (!class_exists($extension_class)) {
                $class_file = $path . $folder . '/extension_' . $folder . '.php';
                $class_file = apply_filters('redux/extension/'.$ReduxFramework->args['opt_name'].'/'.$folder, $class_file );
                if ($class_file) {
                    require_once($class_file);
                    $extension = new $extension_class($ReduxFramework);
                }
            }
        }
    }
    add_action( "redux/extensions/". $opt_name ."/before", 'redux_register_custom_extension_loader', 0);
endif;

// General Settings
Redux::setSection( $opt_name, array(
    'title'            => __( 'General', 'proton' ),
    'id'               => 'general_settings',
    'desc'             => __( 'Welcome to Proton Theme Options.', 'proton' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-home',
    'fields'           => array(
        array(
            'id' => 'proton_style',
            'type' => 'button_set',
            'title' => __('Proton Style', 'proton'),
            'subtitle' => __('Change the main style of Proton, choose between classic and modern.', 'proton'),
            'options' => array(
                'classic' => __('Classic', 'proton'),
                'modern' => __('Modern', 'proton'),
            ),
            'default' => 'classic'
        ),
        array(
            'id' => 'proton_skin',
            'type' => 'button_set',
            'title' => __('Proton Skin', 'proton'),
            'subtitle' => __('Change the skin of Proton, default is light.', 'proton'),
            'options' => array(
                'light' => __('Light','proton'),
                'dark' => __('Dark','proton'),
            ),
            'default' => 'light'
        ),
        array(
            'id' => 'proton_disable_responsivity',
            'type' => 'switch',
            'title' => __('Responsivity', 'proton'),
            'subtitle' => __('Switch on or off the responsivity, if you disable the responsive your website will remain the same on small devices.', 'proton'),
            'on' => __('Enable','proton'),
            'off' => __('Disable','proton'),
            'default' => true
        ),
        array(
            'id' => 'proton_activate_borders',
            'type' => 'switch',
            'title' => __('Activate Borders', 'proton'),
            'subtitle' => __('Switch on or off the borders in your website, borders will appear in all edges of website.', 'proton'),
        ),
        array(
            'id' => 'proton_borders_size',
            'type' => 'text',
            'title' => __('Borders Size', 'proton'),
            'subtitle' => __('Change the borders size, default is 12px. Write only the number without \'px\'.', 'proton'),
            'required' => array( 'proton_activate_borders', '=', true ),
        ),
        array(
            'id' => 'proton_transition',
            'type' => 'switch',
            'title' => __('Transition Effect', 'proton'),
            'subtitle' => __('Switch on or off the transition effect, all elements will hover or fadeIn smoothly.', 'proton'),
            'default' => true,
        ),
        array(
            'id' => 'proton_transition_duration',
            'type' => 'text',
            'title' => __('Transition Duration', 'proton'),
            'subtitle' => __('Change the transition duration, default is 0.2 seconds. Write only the number.', 'proton'),
            'required' => array( 'proton_transition', '=', true ),
        ),
        array(
            'id' => 'proton_smooth_scroll',
            'type' => 'switch',
            'title' => __('Smooth Scroll', 'proton'),
            'subtitle' => __('Switch on or off the smooth scroll effect, the website will scroll smothly.', 'proton'),
            'default' => false,
        ),
        array(
            'id' => 'proton_favicon',
            'type' => 'media',
            'title' => __('Favicon Upload', 'proton'),
            'subtitle' => __('Upload your favicon, 16x16 preferred size in PNG format.', 'proton')
        ),
        array(
            'id'=>'proton_custom_css',
            'type' => 'ace_editor',
            'title' => __('Custom CSS Code', 'proton'),
            'subtitle' => __('Enter your Custom CSS.', 'proton'),
            'mode' => 'css',
            'theme' => 'monokai',
        ),
        array(
            'id' => 'proton_custom_js',
            'type' => 'ace_editor',
            'title' => __('Custom JS Code', 'proton'),
            'subtitle' => __('Enter your Custom Javascript.', 'proton'),
            'mode' => 'javascript',
            'theme' => 'monokai',
        ),
        array(
            'id' => 'proton_google_analytics',
            'type' => 'ace_editor',
            'title' => __('Google Analytics', 'proton'),
            'subtitle' => __('Enter your google analytics.', 'proton'),
            'mode' => 'text',
            'theme' => 'chrome',
        )
    )
));

// Header Settings
Redux::setSection( $opt_name, array(
    'title'            => __( 'Header', 'proton' ),
    'id'               => 'header_settings',
    'desc'             => __( 'All Header Options are listed on this section.', 'proton' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-lines',
    'fields'           => array(
        array(
            'id' => 'proton_menu_type',
            'type' => 'select',
            'title' => __('Menu Type', 'proton'),
            'subtitle' => __('Select the menu style, classic is the standard one with logo in left and menu in right. Minimal and Overlay menu will open when hamburger bar is clicked.', 'proton'),
            'options' => array(
                'classic' => 'Classic',
                'minimal' => 'Minimal',
                'overlay' => 'Overlay'
            ),
            'default' => 'classic'
        ),
        array(
            'id' => 'proton_sticky_header',
            'type' => 'switch',
            'title' => __('Sticky Menu', 'proton'),
            'subtitle' => __('Enable or Disable the sticky menu, even if you scroll the header will stay fixed.', 'proton'),
            'default' => false,
        ),
        array(
            'id' => 'proton_logo',
            'type' => 'media',
            'title' => __('Logo', 'proton'),
            'subtitle' => __('Upload a .png or .jpg image that will be your logo.', 'proton')
        ),
        array(
            'id' => 'proton_white_logo',
            'type' => 'media',
            'title' => __('White Logo', 'proton'),
            'subtitle' => __('Upload a .png or .jpg image that will be your white logo, which will be displayed on overlay menu.', 'proton'),
            'required' => array( 'proton_menu_type', '=', 'overlay' ),
        ),
        array(
            'id' => 'proton_logo_width',
            'type' => 'text',
            'title' => __('Logo Width', 'proton'),
            'subtitle' => __('Enter the number to change the logo image width, enter only the number without {px}.', 'proton')
        ),
        array(
            'id' => 'proton_logo_height',
            'type' => 'text',
            'title' => __('Logo Height', 'proton'),
            'subtitle' => __('Enter the number to change the logo image height, enter only the number without {px}.', 'proton')
        ),
        array(
            'id' => 'proton_logo_text',
            'type' => 'text',
            'title' => __('Logo Text', 'proton'),
            'subtitle' => __('Enter the text that will appear as logo.', 'proton')
        ),
        array(
            'id' => 'proton_mini_cart',
            'type' => 'switch',
            'title' => __('Mini Cart', 'proton'),
            'subtitle' => __('Show or hide the mini cart on menu.', 'proton'),
            'default' => true,
            'on' => __('Show', 'proton'),
            'off' => __('Hide', 'proton')
        ),
    )
));

// Footer Settings
Redux::setSection( $opt_name, array(
    'title'            => __( 'Footer', 'proton' ),
    'id'               => 'footer_settings',
    'desc'             => __( 'All Footer Options are listed on this section.', 'proton' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-th-list',
    'fields'           => array(
        array(
            'id' => 'proton_footer_parallax',
            'type' => 'switch',
            'title' => __('Footer Parallax', 'proton'),
            'subtitle' => __('Switch on if you want to make footer parallax.', 'proton'),
        ),
        array(
            'id' => 'proton_footer_widgets',
            'type' => 'switch',
            'title' => __('Footer Widgets', 'proton'),
            'subtitle' => __('Switch on if you want to show widgets on footer.', 'proton'),
            'default' => true
        ),
        array(
            'id' => 'proton_footer_widgets_columns',
            'type' => 'select',
            'title' => __('Columns', 'proton'),
            'subtitle' => __('Select the columns of Widgets.', 'proton'),
            'required' => array( 'proton_footer_widgets', '=', true ),
            'options' => array(
                'two' => '2 Columns',
                'three' => '3 Columns',
                'four' => '4 Columns'
            ),
            'default' => 'three'
        ),
        array(
            'id' => 'proton_footer_alignment',
            'type' => 'select',
            'title' => __('Alignment', 'proton'),
            'subtitle' => __('Select the alignment of content.', 'proton'),
            'options' => array(
                'left' => __('Left','proton'),
                'center' => __('Center','proton'),
                'right' => __('Right','proton'),
            ),
            'default' => 'left'
        ),
        array(
            'id' => 'proton_footer_copyright',
            'type' => 'editor',
            'args' => array(
                'media_buttons' => false,
            ),
            'title' => __('Footer Copyright', 'proton'),
            'subtitle' => __('Enter the text that will appear in footer as copyright.', 'proton'),
        ),
        array(
            'id' => 'proton_footer_social_icons',
            'type' => 'switch',
            'title' => __('Social Icons', 'proton'),
            'subtitle' => __('Switch on if you want to show the social icons in footer.', 'proton'),
        ),
        array(
            'id' => 'proton_social_media_facebook_show',
            'type' => 'checkbox',
            'title' => __('Show Facebook Icon', 'proton'),
            'required' => array( 'proton_footer_social_icons', '=', true ),
        ),
        array(
            'id' => 'proton_social_media_twitter_show',
            'type' => 'checkbox',
            'title' => __('Show Twitter Icon', 'proton'),
            'required' => array( 'proton_footer_social_icons', '=', true ),
        ),
        array(
            'id' => 'proton_social_media_googleplus_show',
            'type' => 'checkbox',
            'title' => __('Show Google Plus Icon', 'proton'),
            'required' => array( 'proton_footer_social_icons', '=', true ),
        ),
        array(
            'id' => 'proton_social_media_vimeo_show',
            'type' => 'checkbox',
            'title' => __('Show Vimeo Icon', 'proton'),
            'required' => array( 'proton_footer_social_icons', '=', true ),
        ),
        array(
            'id' => 'proton_social_media_dribbble_show',
            'type' => 'checkbox',
            'title' => __('Show Dribbble Icon', 'proton'),
            'required' => array( 'proton_footer_social_icons', '=', true ),
        ),
        array(
            'id' => 'proton_social_media_pinterest_show',
            'type' => 'checkbox',
            'title' => __('Show Pinterest Icon', 'proton'),
            'required' => array( 'proton_footer_social_icons', '=', true ),
        ),
        array(
            'id' => 'proton_social_media_youtube_show',
            'type' => 'checkbox',
            'title' => __('Show Youtube Icon', 'proton'),
            'required' => array( 'proton_footer_social_icons', '=', true ),
        ),
        array(
            'id' => 'proton_social_media_tumblr_show',
            'type' => 'checkbox',
            'title' => __('Show Tumblr Icon', 'proton'),
            'required' => array( 'proton_footer_social_icons', '=', true ),
        ),
        array(
            'id' => 'proton_social_media_linkedin_show',
            'type' => 'checkbox',
            'title' => __('Show Linkedin Icon', 'proton'),
            'required' => array( 'proton_footer_social_icons', '=', true ),
        ),
        array(
            'id' => 'proton_social_media_behance_show',
            'type' => 'checkbox',
            'title' => __('Show Behance Icon', 'proton'),
            'required' => array( 'proton_footer_social_icons', '=', true ),
        ),
        array(
            'id' => 'proton_social_media_500px_show',
            'type' => 'checkbox',
            'title' => __('Show 500px Icon', 'proton'),
            'required' => array( 'proton_footer_social_icons', '=', true ),
        ),
        array(
            'id' => 'proton_social_media_flickr_show',
            'type' => 'checkbox',
            'title' => __('Show Flickr Icon', 'proton'),
            'required' => array( 'proton_footer_social_icons', '=', true ),
        ),
        array(
            'id' => 'proton_social_media_spotify_show',
            'type' => 'checkbox',
            'title' => __('Show Spotify Icon', 'proton'),
            'required' => array( 'proton_footer_social_icons', '=', true ),
        ),
        array(
            'id' => 'proton_social_media_instagram_show',
            'type' => 'checkbox',
            'title' => __('Show Instagram Icon', 'proton'),
            'required' => array( 'proton_footer_social_icons', '=', true ),
        ),
        array(
            'id' => 'proton_social_media_github_show',
            'type' => 'checkbox',
            'title' => __('Show GitHub Icon', 'proton'),
            'required' => array( 'proton_footer_social_icons', '=', true ),
        ),
        array(
            'id' => 'proton_social_media_stackexchange_show',
            'type' => 'checkbox',
            'title' => __('Show StackExchange Icon', 'proton'),
            'required' => array( 'proton_footer_social_icons', '=', true ),
        ),
        array(
            'id' => 'proton_social_media_soundcloud_show',
            'type' => 'checkbox',
            'title' => __('Show SoundCloud Icon', 'proton'),
            'required' => array( 'proton_footer_social_icons', '=', true ),
        ),
        array(
            'id' => 'proton_social_media_vk_show',
            'type' => 'checkbox',
            'title' => __('Show VK Icon', 'proton'),
            'required' => array( 'proton_footer_social_icons', '=', true ),
        ),
        array(
            'id' => 'proton_social_media_vine_show',
            'type' => 'checkbox',
            'title' => __('Show Vine Icon', 'proton'),
            'required' => array( 'proton_footer_social_icons', '=', true ),
        ),
    )
));

// Style Settings
Redux::setSection( $opt_name, array(
    'title'            => __( 'Style', 'proton' ),
    'id'               => 'style_settings',
    'desc'             => __( 'All Style Options are listed on this section.', 'proton' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-brush',
    'fields'           => array(
        array(
            'id' => 'proton_body_color',
            'type' => 'color',
            'title' => __('Body Color', 'proton'),
            'subtitle' => __('Change the body color.', 'proton'),
        ),
        array(
            'id' => 'proton_main_color',
            'type' => 'color',
            'title' => __('Main Color', 'proton'),
            'subtitle' => __('Change all main elements color. ', 'proton'),
        ),
        array(
            'id' => 'proton_borders_color',
            'type' => 'color',
            'title' => __('Borders Color', 'proton'),
            'subtitle' => __('Change the borders color.', 'proton'),
        ),
        array(
            'id' => 'proton_header_color',
            'type' => 'color',
            'title' => __('Header Menu Color', 'proton'),
            'subtitle' => __('Change the header menu color.', 'proton'),
        ),
        array(
            'id' => 'proton_dropdown_color',
            'type' => 'color',
            'title' => __('Header Dropdown Color', 'proton'),
            'subtitle' => __('Change the header dropdown color.', 'proton'),
        ),
        array(
            'id' => 'proton_footer_color',
            'type' => 'color',
            'title' => __('Footer Color', 'proton'),
            'subtitle' => __('Change the footer color.', 'proton'),
        ),
    )
));

// Portfolio and Single Settings
Redux::setSection( $opt_name, array(
    'title'            => __( 'Portfolio', 'proton' ),
    'id'               => 'portfolio_settings',
    'desc'             => __( 'All Portfolio Options are listed on this section.', 'proton' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-th',
    'fields'           => array(
        array(
            'id' => 'portfolio_style',
            'type' => 'select',
            'title' => __('Style', 'proton'),
            'subtitle' => __('Select the style layout of Portfolio.', 'proton'),
            'options' => array(
                '1' => __('Hover', 'proton'),
                '2' => __('Hover & NoSpace', 'proton'),
                '3' => __('Meta', 'proton'),
                '4' => __('Meta & NoSpace', 'proton'),
                '5' => __('No Meta', 'proton'),
                '6' => __('No Meta & NoSpace', 'proton')
            ),
            'default' => '1',
        ),
        array(
            'id' => 'portfolio_hover',
            'type' => 'select',
            'title' => __('Hover Style', 'proton'),
            'subtitle' => __('Select the hover style of Portfolio, make sure to select first or second Portfolio style to make hover visible.', 'proton'),
            'options' => array(
                '1' => __('Meta Tags', 'proton'),
                '2' => __('Title', 'proton'),
                '3' => __('Gallery', 'proton'),
                '4' => __('Meta Tags & Boxed', 'proton'),
                '5' => __('Title & Boxed', 'proton'),
                '6' => __('Gallery & Boxed', 'proton')
            ),
            'default' => '1'
        ),
        array(
            'id' => 'portfolio_columns',
            'type' => 'select',
            'title' => __('Columns', 'proton'),
            'subtitle' => __('Select the columns of Portfolio, default is 3 columns.', 'proton'),
            'options' => array(
                '1' => __('2 Columns', 'proton'),
                '2' => __('3 Columns', 'proton'),
                '3' => __('4 Columns', 'proton'),
                '4' => __('5 Columns', 'proton')
            ),
            'default' => '2'
        ),
        array(
            'id' => 'portfolio_meta_position',
            'type' => 'select',
            'title' => __('Text Position', 'proton'),
            'subtitle' => __('Please select text position, default is center.', 'proton'),
            'options' => array(
                '1' => __('Center', 'proton'),
                '2' => __('Top Left', 'proton'),
                '3' => __('Top Right', 'proton'),
                '4' => __('Bottom Left', 'proton'),
                '5' => __('Bottom Right', 'proton')
            ),
            'default' => '1',
        ),
        array(
            'id' => 'portfolio_hover_effect',
            'type' => 'switch',
            'title' => __('Hover effect', 'proton'),
            'subtitle' => __('Switch on if you want to enable portfolio hover effect.', 'proton'),
        ),
        array(
            'id' => 'portfolio_masonry',
            'type' => 'switch',
            'title' => __('Masonry', 'proton'),
            'subtitle' => __('Switch on the Masonry style, the projects will be displayed in opposite of fixed rows.', 'proton')
        ),
        array(
            'id' => 'proton_portfolio_categories_link',
            'type' => 'switch',
            'title' => __('Portfolio Categories', 'proton'),
            'subtitle' => __('Hide links from categories in portfolio.', 'proton'),
            'on' => 'Show',
            'off' => 'Hide',
            'default' => false
        ),
    )
));
Redux::setSection( $opt_name, array(
    'title'            => __( 'Portfolio Item', 'proton' ),
    'id'               => 'portfolio_item_settings',
    'desc'             => __( 'All Portfolio Item Options are listed on this section.', 'proton' ),
    'customizer_width' => '400px',
    'subsection'       => true,
    'fields'           => array(
        array(
            'id' => 'portfolio_item_layout',
            'type' => 'select',
            'title' => __('Portfolio Item layout', 'proton'),
            'subtitle' => __('Select the style layout of Portfolio Item.', 'proton'),
            'options' => array(
                '1' => __('Single v1', 'proton'),
                '2' => __('Single v2', 'proton'),
                '3' => __('Single v3', 'proton'),
                '4' => __('Single v4', 'proton')
            ),
            'default' => '1'
        ),
        array(
            'id' => 'portfolio_item_gallery_columns',
            'type' => 'select',
            'title' => __('Portfolio Item Gallery Columns', 'proton'),
            'subtitle' => __('Select the columns of Gallery.', 'proton'),
            'options' => array(
                '1' => __('Full Width', 'proton'),
                '2' => __('2 Columns', 'proton'),
                '3' => __('3 Columns', 'proton')
            ),
            'default' => '1'
        ),
        array(
            'id' => 'portfolio_item_navigation',
            'type' => 'switch',
            'title' => __('Portfolio Item Navigation', 'proton'),
            'subtitle' => __('Hide or show the navigation on portfolio single.', 'proton'),
            'on' => __("Show","proton"),
            'off' => __("Hide","proton"),
            'default' => true
        ),
        array(
            'id' => 'portfolio_item_categories',
            'type' => 'switch',
            'title' => __('Portfolio Item Categories', 'proton'),
            'subtitle' => __('Hide or show the categories on portfolio single.', 'proton'),
            'on' => __("Show","proton"),
            'off' => __("Hide","proton"),
            'default' => true
        ),
        array(
            'id' => 'portfolio_item_gallery',
            'type' => 'switch',
            'title' => __('Portfolio Item Gallery', 'proton'),
            'subtitle' => __('Switch on the Gallery, the projects will be displayed in fancybox slider.', 'proton')
        ),
        array(
            'id' => 'portfolio_item_embed_position',
            'type' => 'select',
            'title' => __('Embed Video Position', 'proton'),
            'subtitle' => __('Switch on the Gallery, the projects will be displayed in fancybox slider.', 'proton'),
            'options' => array(
                '1' => __('Top', 'proton'),
                '2' => __('Bottom', 'proton'),
            ),
            'default' => '1'
        ),
        array(
            'id' => 'proton_portfolio_item_show_share',
            'type' => 'switch',
            'title' => __('Share', 'proton'),
            'subtitle' => __('Hide or show the share icons on project item.', 'proton'),
            'on' => __('Show', 'proton'),
            'off' => __('Hide', 'proton'),
            'default' => false
        ),
        array(
            'id' => 'proton_portfolio_item_share_type',
            'type' => 'select',
            'title' => __('Share type', 'proton'),
            'subtitle' => __('Select the type you want to display the share social media.', 'proton'),
            'required' => array('proton_portfolio_item_show_share', '=', true),
            'options' => array(
                '1' => __('Icons', 'proton'),
                '2' => __('Text', 'proton')
            ),
            'default' => '1'
        ),
        array(
            'id' => 'proton_portfolio_item_share_layout',
            'type' => 'select',
            'title' => __('Layout', 'proton'),
            'subtitle' => __('Select the layout of social medias.', 'proton'),
            'options' => array(
                '1' => __('Default', 'proton'),
                '2' => __('Background', 'proton')
            ),
            'default' => '1',
            'required' => array('proton_portfolio_item_show_share', '=', true)
        ),
        array(
            'id' => 'proton_portfolio_item_share_style',
            'type' => 'select',
            'title' => __('Style', 'proton'),
            'subtitle' => __('Select the social media style.', 'proton'),
            'options' => array(
                '1' => __('Default', 'proton'),
                '2' => __('Color in Text', 'proton'),
                '3' => __('Color in Hover Text', 'proton'),
                '4' => __('Color in Background', 'proton'),
                '5' => __('Color in Hover Background', 'proton')
            ),
            'default' => '1',
            'required' => array('proton_portfolio_item_show_share', '=', true)
        ),
        array(
            'id' => 'proton_portfolio_item_share_title',
            'type' => 'text',
            'title' => __('Share title', 'proton'),
            'subtitle' => __('Add a title on the share section.', 'proton'),
            'required' => array('proton_portfolio_item_show_share', '=', true)
        ),
        array(
            'id' => 'proton_portfolio_item_share',
            'type' => 'sorter',
            'title' => __('Share icons', 'proton'),
            'subtitle' => __('Select which ones you want to display as share icons in posts.', 'proton'),
            'options' => array(
                'enabled'  => array(
                    'facebook' => __('Facebook', 'proton'),
                    'twitter' => __('Twitter', 'proton'),
                    'google-plus' => __('Google Plus', 'proton'),
                    'linkedin' => __('Linkedin', 'proton')
                ),
                'disabled' => array(
                    'pinterest' => __('Pinterest', 'proton'),
                    'tumblr' => __('Tumblr', 'proton')
                )
            ),
            'required' => array('proton_portfolio_item_show_share', '=', true)
        ),
    )
));

// Blog and Single Settings
Redux::setSection( $opt_name, array(
    'title'            => __( 'Blog', 'proton' ),
    'id'               => 'blog_settings',
    'desc'             => __( 'All Blog Options are listed on this section.', 'proton' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-list-alt',
    'fields'           => array(
        array(
            'id' => 'blog_layout',
            'type' => 'select',
            'title' => __('Blog Layout', 'proton'),
            'subtitle' => __('Select the style layout of Blog.', 'proton'),
            'options' => array(
                '1' => 'Classic',
                '2' => 'Full Width',
                '3' => 'Grid',
                '4' => 'Minimal',
                '5' => 'Creative'
            ),
            'default' => '1'
        ),
        array(
            'id' => 'blog_sidebar',
            'type' => 'select',
            'title' => __('Sidebar', 'proton'),
            'subtitle' => __('Change the position of sidebar, sidebar is placed in Classic and Minimal.', 'proton'),
            'options' => array(
                '1' => __('Left', 'proton'),
                '2' => __('Right', 'proton'),
            ),
            'default' => '2',
        ),
        array(
            'id' => 'blog_pagination_position',
            'type' => 'select',
            'title' => __('Pagination Position', 'proton'),
            'subtitle' => __('Change the position of pagination.', 'proton'),
            'options' => array(
                '1' => __('Left', 'proton'),
                '2' => __('Center', 'proton'),
                '3' => __('Right', 'proton'),
            ),
            'default' => '1',
        ),
        array(
            'id' => 'blog_author_info',
            'type' => 'checkbox',
            'title' => __('Show Author Info', 'proton'),
            'default' => '1',
        ),
        array(
            'id' => 'blog_categories',
            'type' => 'checkbox',
            'title' => __('Show Categories', 'proton'),
            'default' => '1',
        ),
        array(
            'id' => 'blog_post_date',
            'type' => 'checkbox',
            'title' => __('Show Post Date', 'proton'),
            'default' => '1',
        ),
    )
));
Redux::setSection( $opt_name, array(
    'title'            => __( 'Blog Single', 'proton' ),
    'id'               => 'blog_single',
    'desc'             => __( 'All Blog Single Options are listed on this section.', 'proton' ),
    'customizer_width' => '400px',
    'subsection'       => true,
    'fields'           => array(
        array(
            'id' => 'blog_single_layout',
            'type' => 'select',
            'title' => __('Blog Single Layout', 'proton'),
            'subtitle' => __('Select the style layout of Blog Single.', 'proton'),
            'options' => array(
                '1' => 'Classic',
                '2' => 'Full Width'
            ),
            'default' => '1'
        ),
        array(
            'id' => 'blog_single_sidebar',
            'type' => 'select',
            'title' => __('Sidebar', 'proton'),
            'subtitle' => __('Change the position of sidebar or hide it.', 'proton'),
            'options' => array(
                '1' => __('Left', 'proton'),
                '2' => __('Right', 'proton'),
                '3' => __('Hide', 'proton'),
            ),
            'default' => '2',
        ),
        array(
            'id' => 'blog_single_thumbnail',
            'type' => 'checkbox',
            'title' => __('Show Thumbnail', 'proton'),
            'default' => '1',
        ),
        array(
            'id' => 'blog_single_author_info',
            'type' => 'checkbox',
            'title' => __('Show Author Info', 'proton'),
            'default' => '1',
        ),
        array(
            'id' => 'blog_single_categories',
            'type' => 'checkbox',
            'title' => __('Show Categories', 'proton'),
            'default' => '1',
        ),
        array(
            'id' => 'blog_single_post_date',
            'type' => 'checkbox',
            'title' => __('Show Post Date', 'proton'),
            'default' => '1',
        ),
        array(
            'id' => 'blog_single_next_previous',
            'type' => 'checkbox',
            'title' => __('Show Next-Previous Post Links', 'proton'),
        ),
    )
));

// Shop Settings
if(class_exists('WooCommerce')){
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Shop', 'proton' ),
        'id'               => 'shop_settings',
        'desc'             => __( 'All Shop Options are listed on this section.', 'proton' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-shopping-cart',
        'fields'           => array(
            array(
                'id' => 'shop_columns',
                'type' => 'select',
                'title' => __('Columns', 'proton'),
                'subtitle' => __('Select the columns of Shop Page.', 'proton'),
                'options' => array(
                    '1' => 'Classic',
                    '2' => 'Full Width'
                ),
                'default' => '1'
            ),
            array(
                'id' => 'shop_page_title',
                'title' => __('Page Title', 'proton'),
                'subtitle' => __('Write the page title in Shop.', 'proton'),
                'type' => 'editor',
            ),
        )
    ));
}

// Typography
Redux::setSection( $opt_name, array(
    'title'            => __( 'Typography', 'proton' ),
    'id'               => 'typography_settings',
    'desc'             => __( 'All Typography Options are listed on this section.', 'proton' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-font',
));
// Typography > Header & Page Header
Redux::setSection( $opt_name, array(
    'title'            => __( 'Header & Page Header', 'proton' ),
    'id'               => 'typography_settings_header',
    'desc'             => __( 'All Typography Options are listed on this section.', 'proton' ),
    'customizer_width' => '400px',
    'subsection'       => true,
    'fields'           => array(
        array(
            'id' => 'proton_header_font',
            'type' => 'typography',
            'title' => __('Header Font', 'proton'),
            'subtitle' => __('Change the Header font properties.', 'proton'),
            'text-transform' => true,
            'subsets' => false,
            'text-align' => false,
        ),
        array(
            'id' => 'proton_dropdown_font',
            'type' => 'typography',
            'title' => __('Header Dropdown Font', 'proton'),
            'subtitle' => __('Change the Header Dropdown font properties.', 'proton'),
            'text-transform' => true,
            'subsets' => false,
            'text-align' => false,
        ),
        array(
            'id' => 'proton_page_header_font',
            'type' => 'typography',
            'title' => __('Page Header Title Font', 'proton'),
            'subtitle' => __('Change the Page Header font properties.', 'proton'),
            'text-transform' => true,
            'subsets' => false,
            'text-align' => false,
        ),
    )
));
// Typography > Basic HTML Elements
Redux::setSection( $opt_name, array(
    'title'            => __( 'Basic HTML Elements', 'proton' ),
    'id'               => 'typography_settings_basic',
    'customizer_width' => '400px',
    'subsection'       => true,
    'fields'           => array(
        array(
            'id' => 'proton_body_font',
            'type' => 'typography',
            'title' => __('Body Font', 'proton'),
            'subtitle' => __('Change the Body font properties.', 'proton'),
            'text-transform' => true,
            'subsets' => false,
            'text-align' => false,
        ),
        array(
            'id' => 'proton_heading_one_font',
            'type' => 'typography',
            'title' => __('Heading One', 'proton'),
            'subtitle' => __('Change the H1 font properties.', 'proton'),
            'text-transform' => true,
            'subsets' => false,
            'text-align' => false,
        ),
        array(
            'id' => 'proton_heading_two_font',
            'type' => 'typography',
            'title' => __('Heading Two', 'proton'),
            'subtitle' => __('Change the H2 font properties.', 'proton'),
            'text-transform' => true,
            'subsets' => false,
            'text-align' => false,
        ),
        array(
            'id' => 'proton_heading_three_font',
            'type' => 'typography',
            'title' => __('Heading Three', 'proton'),
            'subtitle' => __('Change the H3 font properties.', 'proton'),
            'text-transform' => true,
            'subsets' => false,
            'text-align' => false,
        ),
        array(
            'id' => 'proton_heading_four_font',
            'type' => 'typography',
            'title' => __('Heading Four', 'proton'),
            'subtitle' => __('Change the H4 font properties.', 'proton'),
            'text-transform' => true,
            'subsets' => false,
            'text-align' => false,
        ),
        array(
            'id' => 'proton_heading_five_font',
            'type' => 'typography',
            'title' => __('Heading Five', 'proton'),
            'subtitle' => __('Change the H5 font properties.', 'proton'),
            'text-transform' => true,
            'subsets' => false,
            'text-align' => false,
        ),
        array(
            'id' => 'proton_heading_six_font',
            'type' => 'typography',
            'title' => __('Heading Six', 'proton'),
            'subtitle' => __('Change the H6 font properties.', 'proton'),
            'text-transform' => true,
            'subsets' => false,
            'text-align' => false,
        ),
    )
));

// Google Maps
Redux::setSection($opt_name, array(
    'title'            => __('Google Maps', 'proton'),
    'id'               => 'google-maps',
    'icon'             => 'el el-map-marker',
    'desc'             => '<p class="description">To use the Google Maps JavaScript API, you must register your app project on the <a target="_BLANK" href="https://developers.google.com/maps/documentation/javascript/get-api-key">Google API Console</a> and get a Google API key which you can add to your app, we have included a default one, but it\'s always better to add yours.</p>',
    'fields'           => array(
        array(
            'id' => 'proton_api_key',
            'type' => 'text',
            'title' => __('API Key', 'proton'),
            'subtitle' => __('Enter your API Key.', 'proton')
        ),
    )
));

// Utility
Redux::setSection($opt_name, array(
    'title'            => __('Utility', 'proton'),
    'id'               => 'utility',
    'icon'             => 'el el-cogs'
));
Redux::setSection($opt_name, array(
    'title'            => __('Search Page', 'proton'),
    'id'               => 'search-page',
    'subsection'       => true,
    'fields'           => array(
        array(
            'id' => 'proton_search_page_title',
            'type' => 'text',
            'title' => __('Page title', 'proton'),
            'subtitle' => __('Change the page title of search, default is \'All search results in this critea.\', if you want to remove it enter the string \'empty\'.', 'proton')
        ),
        array(
            'id' => 'proton_search_columns',
            'type' => 'select',
            'title' => __('Columns', 'proton'),
            'subtitle' => __('Select the columns of search page, default is 2 columns.', 'proton'),
            'options' => array(
                '1' => __('Full Width', 'proton'),
                '2' => __('2 Columns', 'proton'),
                '3' => __('3 Columns', 'proton'),
                '4' => __('4 Columns', 'proton')
            ),
            'default' => '3'
        )
    )
));
Redux::setSection($opt_name, array(
    'title'            => __('404 Page', 'proton'),
    'id'               => 'four-o-four',
    'subsection'       => true,
    'fields'           => array(
        array(
            'id' => 'proton_404_title',
            'type' => 'text',
            'title' => __('Title', 'proton'),
            'subtitle' => __('Override the actual title of 404 page.', 'proton')
        ),
        array(
            'id' => 'proton_404_description',
            'type' => 'textarea',
            'title' => __('Description', 'proton'),
            'subtitle' => __('Override the actual description of 404 page.', 'proton')
        ),
    )
));
Redux::setSection($opt_name, array(
    'title'            => __('Maintenance', 'proton'),
    'id'               => 'maintenance',
    'subsection'       => true,
    'fields'           => array(
        array(
            'id' => 'proton_maintenance_mode',
            'type' => 'switch',
            'title' => __('Maintenance Mode', 'proton'),
            'subtitle' => __('Enable the maintenance mode for your website. <p class="description">Note: Only you(admin) will be able to see the preview of website, to view the maintenance click <a href="../?maintenance-mode=true">here</a>.</p>', 'proton'),
            'on' => __('Enable', 'proton'),
            'off' => __('Disable', 'proton'),
            'default' => false
        ),
        array(
            'id' => 'proton_maintenance_title',
            'type' => 'text',
            'title' => __('Title', 'proton'),
            'subtitle' => __('Override the actual title of maintenance page.', 'proton'),
            'required' => array('proton_maintenance_mode', '=', true)
        ),
        array(
            'id' => 'proton_maintenance_description',
            'type' => 'textarea',
            'title' => __('Description', 'proton'),
            'subtitle' => __('Override the actual description of maintenance page.', 'proton'),
            'required' => array('proton_maintenance_mode', '=', true)
        ),
        array(
            'id' => 'proton_maintenance_mode_button',
            'type' => 'switch',
            'title' => __('Button', 'proton'),
            'subtitle' => __('Show or hide a button in maintenance page.', 'proton'),
            'on' => __('Show', 'proton'),
            'off' => __('Hide', 'proton'),
            'default' => false,
            'required' => array('proton_maintenance_mode', '=', true)
        ),
        array(
            'id' => 'proton_maintenance_mode_button_text',
            'type' => 'text',
            'title' => __('Button Text', 'proton'),
            'subtitle' => __('Enter the text of button.', 'proton'),
            'required' => array('proton_maintenance_mode_button', '=', true)
        ),
        array(
            'id' => 'proton_maintenance_mode_button_url',
            'type' => 'text',
            'title' => __('Button URL', 'proton'),
            'subtitle' => __('Enter the url of button.', 'proton'),
            'required' => array('proton_maintenance_mode_button', '=', true)
        ),
    )
));
Redux::setSection($opt_name, array(
    'title'            => __('Coming Soon', 'proton'),
    'id'               => 'coming-soon',
    'subsection'       => true,
    'fields'           => array(
        array(
            'id' => 'proton_coming_soon',
            'type' => 'switch',
            'title' => __('Coming Soon', 'proton'),
            'subtitle' => __('Enable the coming soon mode for your website. <p class="description">Note: Only you(admin) will be able to see the preview of website, to view the coming soon click <a href="../?coming-soon=true">here</a>.</p>', 'proton'),
            'on' => __('Enable', 'proton'),
            'off' => __('Disable', 'proton'),
            'default' => false
        ),
        array(
            'id' => 'proton_coming_soon_date',
            'type' => 'date',
            'title' => __('Date', 'proton'),
            'subtitle' => __('Pickup the date when your website will be ready.', 'proton'),
            'default' => '06/08/2018',
            'required' => array('proton_coming_soon', '=', true)
        ),
        array(
            'id' => 'proton_coming_soon_title',
            'type' => 'text',
            'title' => __('Title', 'proton'),
            'subtitle' => __('Override the actual title of coming soon page.', 'proton'),
            'required' => array('proton_coming_soon', '=', true)
        ),
        array(
            'id' => 'proton_coming_soon_description',
            'type' => 'textarea',
            'title' => __('Description', 'proton'),
            'subtitle' => __('Override the actual description of coming soon page.', 'proton'),
            'required' => array('proton_coming_soon', '=', true)
        ),
        array(
            'id' => 'proton_social_media_enable',
            'type' => 'switch',
            'title' => __('Social Media', 'proton'),
            'subtitle' => __('Show or hide the social medias in coming soon.', 'proton'),
            'on' => __('Show', 'proton'),
            'off' => __('Hide', 'proton'),
            'default' => true
        ),
        array(
            'id' => 'proton_social_media',
            'type' => 'sorter',
            'title' => __('Social Media', 'proton'),
            'subtitle' => __('Select which social medias you want to display in coming soon. <p class="description">Note: Do not forget to add the links at Theme Options > Social Media.</p>', 'proton'),
            'options' => array(
                'enabled'  => array(
                    'facebook' => __('Facebook', 'proton'),
                    'twitter' => __('Twitter', 'proton'),
                    'google-plus' => __('Google Plus', 'proton'),
                    'vimeo' => __('Vimeo', 'proton'),
                    'dribbble' => __('Dribbble', 'proton')
                ),
                'disabled' => array(
                    'pinterest' => __('Pinterest', 'proton'),
                    'youtube' => __('Youtube', 'proton'),
                    'tumblr' => __('Tumblr', 'proton'),
                    'linkedin' => __('Linkedin', 'proton'),
                    'behance' => __('Behance', 'proton'),
                    'flickr' => __('Flickr', 'proton'),
                    'spotify' => __('Spotify', 'proton'),
                    'instagram' => __('Instagram', 'proton'),
                    'github' => __('GitHub', 'proton'),
                    'stackexchange' => __('StackExchange', 'proton'),
                    'soundcloud' => __('SoundCloud', 'proton'),
                    'vk' => __('VK', 'proton'),
                    'vine' => __('Vine', 'proton')
                )
            ),
            'required' => array('proton_social_media_enable', '=', true)
        )
    )
));

// Social Media
Redux::setSection( $opt_name, array(
    'title'            => __( 'Social Media', 'proton' ),
    'id'               => 'social-media',
    'desc'             => __( 'Enter in your social media locations here and then activate which ones you would like to display. <br><b> Remember to include the "http://" in all URLs!</b>', 'proton' ),
    'icon'             => 'el el-share',
    'fields'           => array(
        array(
            'id' => 'proton_social_media_facebook',
            'type' => 'text',
            'title' => __('Facebook URL', 'proton'),
            'subtitle' => __('Please enter your Facebook URL.', 'proton'),
        ),
        array(
            'id' => 'proton_social_media_twitter',
            'type' => 'text',
            'title' => __('Twitter URL', 'proton'),
            'subtitle' => __('Please enter your Twitter URL.', 'proton'),
        ),
        array(
            'id' => 'proton_social_media_googleplus',
            'type' => 'text',
            'title' => __('Google Plus URL', 'proton'),
            'subtitle' => __('Please enter your Google Plus URL.', 'proton'),
        ),
        array(
            'id' => 'proton_social_media_vimeo',
            'type' => 'text',
            'title' => __('Vimeo URL', 'proton'),
            'subtitle' => __('Please enter your Vimeo URL.', 'proton'),
        ),
        array(
            'id' => 'proton_social_media_dribbble',
            'type' => 'text',
            'title' => __('Dribbble URL', 'proton'),
            'subtitle' => __('Please enter your Dribbble URL.', 'proton'),
        ),
        array(
            'id' => 'proton_social_media_pinterest',
            'type' => 'text',
            'title' => __('Pinterest URL', 'proton'),
            'subtitle' => __('Please enter your Pinterest URL.', 'proton'),
        ),
        array(
            'id' => 'proton_social_media_youtube',
            'type' => 'text',
            'title' => __('Youtube URL', 'proton'),
            'subtitle' => __('Please enter your Youtube URL.', 'proton'),
        ),
        array(
            'id' => 'proton_social_media_tumblr',
            'type' => 'text',
            'title' => __('Tumblr URL', 'proton'),
            'subtitle' => __('Please enter your Tumblr URL.', 'proton'),
        ),
        array(
            'id' => 'proton_social_media_linkedin',
            'type' => 'text',
            'title' => __('Linkedin URL', 'proton'),
            'subtitle' => __('Please enter your Linkedin URL.', 'proton'),
        ),
        array(
            'id' => 'proton_social_media_behance',
            'type' => 'text',
            'title' => __('Behance URL', 'proton'),
            'subtitle' => __('Please enter your Behance URL.', 'proton'),
        ),
        array(
            'id' => 'proton_social_media_500px',
            'type' => 'text',
            'title' => __('500px URL', 'proton'),
            'subtitle' => __('Please enter your 500px URL.', 'proton'),
        ),
        array(
            'id' => 'proton_social_media_flickr',
            'type' => 'text',
            'title' => __('Flickr URL', 'proton'),
            'subtitle' => __('Please enter your Flickr URL.', 'proton'),
        ),
        array(
            'id' => 'proton_social_media_spotify',
            'type' => 'text',
            'title' => __('Spotify URL', 'proton'),
            'subtitle' => __('Please enter your Spotify URL.', 'proton'),
        ),
        array(
            'id' => 'proton_social_media_instagram',
            'type' => 'text',
            'title' => __('Instagram URL', 'proton'),
            'subtitle' => __('Please enter your Instagram URL.', 'proton'),
        ),
        array(
            'id' => 'proton_social_media_github',
            'type' => 'text',
            'title' => __('GitHub URL', 'proton'),
            'subtitle' => __('Please enter your GitHub URL.', 'proton'),
        ),
        array(
            'id' => 'proton_social_media_stackexchange',
            'type' => 'text',
            'title' => __('StackExchange URL', 'proton'),
            'subtitle' => __('Please enter your StackExchange URL.', 'proton'),
        ),
        array(
            'id' => 'proton_social_media_soundcloud',
            'type' => 'text',
            'title' => __('SoundCloud URL', 'proton'),
            'subtitle' => __('Please enter your SoundCloud URL.', 'proton'),
        ),
        array(
            'id' => 'proton_social_media_vk',
            'type' => 'text',
            'title' => __('VK URL', 'proton'),
            'subtitle' => __('Please enter your VK URL.', 'proton'),
        ),
        array(
            'id' => 'proton_social_media_vine',
            'type' => 'text',
            'title' => __('Vine URL', 'proton'),
            'subtitle' => __('Please enter your Vine URL.', 'proton'),
        ),
    )
));
