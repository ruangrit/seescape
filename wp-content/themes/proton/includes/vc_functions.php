<?php

/*
	Visual Composer Elements from NeuronThemes
*/

// Create a new Param
$blog_posts = get_categories();
$types_options = array('All' => 'all');

if ($blog_posts) {
    foreach ($blog_posts as $post) {
        $types_options[$post->name] = $post->slug;
    }
}

vc_add_shortcode_param('multi_select', 'multi_select_settings_field');
function multi_select_settings_field( $param, $value ) {
     $param_line = '';
     $param_line .= '<select multiple name="'. esc_attr( $param['param_name'] ).'" class="wpb_vc_param_value wpb-input wpb-select '. esc_attr( $param['param_name'] ).' '. esc_attr($param['type']).'">';
                foreach ( $param['value'] as $text_val => $val ) {
                    if ( is_numeric($text_val) && (is_string($val) || is_numeric($val)) ) {
                        $text_val = $val;
                    }
                    $text_val = __($text_val, "proton");
                    $selected = '';

                    if(!is_array($value)) {
                        $param_value_arr = explode(',',$value);
                    } else {
                        $param_value_arr = $value;
                    }

                    if ($value!=='' && in_array($val, $param_value_arr)) {
                        $selected = ' selected="selected"';
                    }
                    $param_line .= '<option class="'.$val.'" value="'.$val.'"'.$selected.'>'.$text_val.'</option>';
                }
                $param_line .= '</select>';

                return $param_line;
}

// Page Heading
class WPBakeryShortCode_Proton_Page_Heading extends WPBakeryShortCode {}
vc_map(
    array(
        'name' => __('Page Heading', 'proton'),
        'base' => 'proton_page_heading',
        'description' => __('Display a page heading.', 'proton'),
        'category' => __('NeuronElements', 'proton'),
        'icon' => get_template_directory_uri() . '/includes/options/vc/vc-icon.png',
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __('Title', 'proton'),
                'param_name' => 'title',
                'description' => __('Enter the title of page heading.', 'proton'),
                'admin_label' => true,
            ),
            array(
                'type' => 'textarea_html',
                'heading' => __('Content', 'proton'),
                'param_name' => 'content',
                'description' => __('Enter the content of page heading.', 'proton'),
                'admin_label' => true,
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Extra class name', 'proton'),
                'param_name' => 'el_class',
                'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'proton'),
            ),
            array(
                'type' => 'css_editor',
                'heading' => __('Css', 'proton'),
                'param_name' => 'css',
                'group' => __('Design options', 'proton'),
            ),
        )
    )
);

// Portfolio
class WPBakeryShortCode_Proton_Portfolio extends WPBakeryShortCode {}
vc_map(
    array(
        'name' => __('Portfolio', 'proton'),
        'base' => 'proton_portfolio',
        'description' => __('Display a portfolio.', 'proton'),
        'category' => __('NeuronElements', 'proton'),
        'icon' => get_template_directory_uri() . '/includes/options/vc/vc-icon.png',
        'params' => array(
            array(
                'type' => 'loop',
                'heading' => __('Portfolio Categories', 'proton'),
                'param_name' => 'loop',
                'settings' => array(
                    'order_by' => array('value' => 'date'),
                    'order' => array('hidden' => true),
                    'post_type' => array('hidden' => true),
                    'categories' => array('hidden' => true),
                    'size' => array('hidden' => true),
                    'authors' => array('hidden' => true),
                    'by_id' => array('hidden' => true),
                    'tags' => array('hidden' => true)
                ),
                'description' => __('Build the portfolio query.<br><small>Note: If nothing is selected all portfolios items will be displayed.</small>', 'proton'),
                'group' => __('Functionality', 'proton'),
                'save_always' => true
            ),
            array(
                'type' => 'checkbox',
                'heading' => __('Sortable', 'proton'),
                'param_name' => 'sortable',
                'description' => __('Make portfolio items sortable, filters are represented by portfolio categories. <br><small>Note: If no taxonomies are selected while building the query, filters wont be displayed.</small>', 'proton'),
                'group' => __('Functionality', 'proton')
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Filters String', 'proton'),
                'param_name' => 'filters_string',
                'description' => __('Override the string \'Filters:\', if you want to remove it, enter the word empty.', 'proton'),
                'group' => __('Functionality', 'proton'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Posts per Page', 'proton'),
                'param_name' => 'posts_per_page',
                'description' => __('Enter the number of how many portfolio items per page you want to display, default is 9. <br><small>Note: If want all the portfolio items to be displayed, write only -1.</small>', 'proton'),
                'group' => __('Functionality', 'proton'),
                'admin_label' => true
            ),
            array(
                'type' => 'vc_link',
                'heading' => __('Button Link', 'proton'),
                'param_name' => 'button_link',
                'description' => __('Add the link of a button at the bottom.', 'proton'),
                'group' => __('Functionality', 'proton'),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Style', 'proton'),
                'param_name' => 'style',
                'description' => __('Select the type that you want to show your portfolio items.', 'proton'),
                'value' => array(
                    __('Inherit from Theme Options', 'proton') => '1',
                    __('Hover', 'proton') => '2',
                    __('Hover & No Space', 'proton') => '3',
                    __('Meta', 'proton') => '4',
                    __('Meta & No Space', 'proton') => '5',
                    __('No Meta', 'proton') => '6',
                    __('No Meta & No Space', 'proton') => '7'
                ),
                'std' => '1',
                'admin_label' => true,
                'group' => __('Style', 'proton'),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Hover Style', 'proton'),
                'param_name' => 'hover_style',
                'description' => __('Select the hover style that you want to show the projects.', 'proton'),
                'value' => array(
                    __('Inherit from Theme Options', 'proton') => '1',
                    __('Meta Tags', 'proton') => '2',
                    __('Title', 'proton') => '3',
                    __('Gallery', 'proton') => '4',
                    __('Meta Tags & Boxed', 'proton') => '5',
                    __('Title & Boxed', 'proton') => '6',
                    __('Gallery & Boxed', 'proton') => '7'
                ),
                'std' => '1',
                'admin_label' => true,
                'group' => __('Style', 'proton'),
            ),
            array(
                'type' => 'checkbox',
                'heading' => __('Metro Layout', 'proton'),
                'param_name' => 'metro_layout',
                'description' => __('Enable metro layout for portfolio items. <br><small>Note: Columns can be selected for each portfolio item while creating or editing them.</small>', 'proton'),
                'group' => __('Style', 'proton'),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Columns', 'proton'),
                'param_name' => 'columns',
                'description' => __('Select the columns that you want to show your portfolio items.', 'proton'),
                'value' => array(
                     __('Inherit from Theme Options', 'proton') => '1',
                     __('2 Columns', 'proton') => '2',
                     __('3 Columns', 'proton') => '3',
                     __('4 Columns', 'proton') => '4',
                ),
                'std' => '1',
                'admin_label' => true,
                'group' => __('Style', 'proton'),
                'dependency' => array('element' => 'metro_layout', 'is_empty' => true)
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Text Position', 'proton'),
                'param_name' => 'text_position',
                'description' => __('Select the text position of portfolio, default is center.', 'proton'),
                'value' => array(
                    __('Inherit from Theme Options', 'proton') => '1',
                    __('Center', 'proton') => '2',
                    __('Top Left', 'proton') => '3',
                    __('Top Right', 'proton') => '4',
                    __('Bottom Left', 'proton') => '5',
                    __('Bottom Right', 'proton') => '6',
                ),
                'std' => '1',
                'group' => __('Style', 'proton'),
                'admin_label' => true,
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Hover Effect', 'proton'),
                'param_name' => 'hover_effect',
                'description' => __('Switch on if you want to enable portfolio hover effect.', 'proton'),
                'value' => array(
                    __('Inherit from Theme Options', 'proton') => '1',
                    __('On', 'proton') => '2',
                    __('Off', 'proton') => '3',
                ),
                'std' => '1',
                'group' => __('Style', 'proton'),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Pagination', 'proton'),
                'param_name' => 'pagination',
                'description' => __('Select the pagination style of this portfolio element.', 'proton'),
                'value' => array(
                    __('Normal Pagination', 'proton') => '1',
                    __('Show More Button', 'proton') => '2',
                ),
                'std' => '1',
                'group' => __('Style', 'proton')
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Show More Text', 'proton'),
                'param_name' => 'show_more',
                'description' => __('Change the show more button text, default is \'Show More\'.', 'proton'),
                'group' => __('Style', 'proton'),
                'dependency' => array('element' => 'pagination', 'value' => '2'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Extra class name', 'proton'),
                'param_name' => 'el_class',
                'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'proton'),
                'group' => __('Style', 'proton'),
            ),
            array(
                'type' => 'css_editor',
                'heading' => __('Css', 'proton'),
                'param_name' => 'css',
                'group' => __('Design Options', 'proton'),
            ),
        )
    )
);

// Blog
class WPBakeryShortCode_Proton_Blog extends WPBakeryShortCode {}
vc_map(
    array(
        'name' => __('Blog', 'proton'),
        'base' => 'proton_blog',
        'description' => __('Display a blog.', 'proton'),
        'category' => __('NeuronElements', 'proton'),
        'icon' => get_template_directory_uri() . '/includes/options/vc/vc-icon.png',
        'params' => array(
            array(
    		  'type' => 'multi_select',
    		  'heading' => __('Categories', 'proton'),
    		  'param_name' => 'category',
    		  'admin_label' => true,
    		  'value' => $types_options,
    		  'save_always' => true,
    		  'description' => __('Select the categories you want to get the posts from.', 'proton'),
              'group' => __('Functionality', 'proton')
        	),
            array(
                'type' => 'textfield',
                'heading' => __('Posts per Page', 'proton'),
                'param_name' => 'posts_per_page',
                'description' => __('Enter the number of how many blog posts per page you want to display, default is 10. <br><small>Note: If want all the blog posts to be displayed, write only -1.</small>', 'proton'),
                'admin_label' => true,
                'group' => __('Functionality', 'proton'),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Layout', 'proton'),
                'param_name' => 'layout',
                'description' => __('Select the layout that you want to show your blog posts.', 'proton'),
                'value' => array(
                    __('Classic', 'proton') => '1',
                    __('Minimal', 'proton') => '2',
                    __('Creative', 'proton') => '3'
                ),
                'std' => '1',
                'admin_label' => true,
                'group' => __('Style', 'proton'),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Columns', 'proton'),
                'param_name' => 'columns',
                'description' => __('Select the columns that you want to show your blog posts.', 'proton'),
                'value' => array(
                    __('Full Width', 'proton') => '1',
                    __('2 Columns', 'proton') => '2',
                    __('3 Columns', 'proton') => '3',
                    __('4 Columns', 'proton') => '4'
                ),
                'std' => '1',
                'admin_label' => true,
                'group' => __('Style', 'proton'),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Sidebar', 'proton'),
                'param_name' => 'sidebar',
                'description' => __('Select the position of sidebar, or hide it.', 'proton'),
                'value' => array(
                     __('Left', 'proton') => '1',
                     __('Right', 'proton') => '2',
                     __('Hide', 'proton') => '3'
                ),
                'std' => '2',
                'group' => __('Style', 'proton'),
                'admin_label' => true,
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Pagination Position', 'proton'),
                'param_name' => 'pagination_position',
                'description' => __('Select the position of pagination.', 'proton'),
                'value' => array(
                     __('Inherit from Theme Options', 'proton') => '1',
                     __('Left', 'proton') => '2',
                     __('Center', 'proton') => '3',
                     __('Right', 'proton') => '4',
                ),
                'std' => '1',
                'group' => __('Style', 'proton'),
                'admin_label' => true,
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Show Author', 'proton'),
                'param_name' => 'show_author',
                'description' => __('Show or hide Author meta in blog.', 'proton'),
                'value' => array(
                     __('Inherit from Theme Options', 'proton') => '1',
                     __('Show', 'proton') => '2',
                     __('Hide', 'proton') => '3',
                ),
                'std' => '1',
                'group' => __('Style', 'proton'),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Show Categories', 'proton'),
                'param_name' => 'show_categories',
                'description' => __('Show or hide Categories meta in blog.', 'proton'),
                'value' => array(
                     __('Inherit from Theme Options', 'proton') => '1',
                     __('Show', 'proton') => '2',
                     __('Hide', 'proton') => '3',
                ),
                'std' => '1',
                'group' => __('Style', 'proton'),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Show Date', 'proton'),
                'param_name' => 'show_date',
                'description' => __('Show or hide Date meta in blog.', 'proton'),
                'value' => array(
                     __('Inherit from Theme Options', 'proton') => '1',
                     __('Show', 'proton') => '2',
                     __('Hide', 'proton') => '3',
                ),
                'std' => '1',
                'group' => __('Style', 'proton'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Extra class name', 'proton'),
                'param_name' => 'el_class',
                'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'proton'),
                'group' => __('Style', 'proton'),
            ),
            array(
                'type' => 'css_editor',
                'heading' => __('Css', 'proton'),
                'param_name' => 'css',
                'group' => __('Design Options', 'proton'),
            ),
        )
    )
);

// Button
class WPBakeryShortCode_Proton_Button extends WPBakeryShortCode {}
vc_map(
    array(
        'name' => __('Button', 'proton'),
        'base' => 'proton_button',
        'category' => __('NeuronElements', 'proton'),
        'description' => __('Display a button.', 'proton'),
        'icon' => get_template_directory_uri() . '/includes/options/vc/vc-icon.png',
        'params' => array(
            array(
                'type' => 'vc_link',
                'heading' => __('Link', 'proton'),
                'param_name' => 'link',
                'description' => __('Select the link of button.', 'proton'),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Style', 'proton'),
                'param_name' => 'style',
                'description' => __('Select the style of button.', 'proton'),
                'value' => array(
                    __('Normal', 'proton') => '1',
                    __('Outline', 'proton') => '2',
                ),
                'std' => '1',
                'admin_label' => true
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Shape', 'proton'),
                'param_name' => 'shape',
                'description' => __('Select the shape of button.', 'proton'),
                'value' => array(
                    __('Default', 'proton') => '1',
                    __('Rounded', 'proton') => '2',
                    __('Round', 'proton') => '3'
                ),
                'std' => '1',
                'admin_label' => true
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Size', 'proton'),
                'param_name' => 'size',
                'description' => __('Select the size of button.', 'proton'),
                'value' => array(
                    __('Small', 'proton') => '1',
                    __('Normal', 'proton') => '2',
                    __('Large', 'proton') => '3',
                    __('Extra Large', 'proton') => '4',
                ),
                'std' => '2',
                'admin_label' => true
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Fluid', 'proton'),
                'param_name' => 'fluid',
                'description' => __('Make the button fluid, button width will be the same as column.', 'proton'),
                'value' => array(
                    __('Yes', 'proton') => '1',
                    __('No', 'proton') => '2',
                ),
                'std' => '2',
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Color', 'proton'),
                'param_name' => 'color',
                'description' => __('Select the color of button.', 'proton'),
                'value' => array(
                    __('Primary', 'proton') => '1',
                    __('Grey Color', 'proton') => '2',
                    __('White Color', 'proton') => '3',
                    __('Red Color', 'proton') => '4',
                    __('Green Color', 'proton') => '5',
                    __('Blue Color', 'proton') => '6',
                    __('Custom', 'proton') => '7'
                ),
                'std' => '1',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __('Text Color', 'proton'),
                'param_name' => 'text_color',
                'description' => __('Select the color of text.', 'proton'),
                'dependency' => array('element' => 'color', 'value' => '7'),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __('Background Color', 'proton'),
                'param_name' => 'background_color',
                'description' => __('Select the color of background.', 'proton'),
                'dependency' => array('element' => 'color', 'value' => '7'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Extra class name', 'proton'),
                'param_name' => 'el_class',
                'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'proton'),
            ),
            array(
                'type' => 'css_editor',
                'heading' => __('Css', 'proton'),
                'param_name' => 'css',
                'group' => __('Design Options', 'proton'),
            ),
        )
    )
);

// Map
$proton_google_api_warning = '<br><br>
<div class="wpb_element_wrapper">
    <div class="vc_message_box vc_message_box-standard vc_color-warning">
    	<div class="vc_message_box-icon"><i class="fa fa-info-circle"></i>
    	</div><p style="margin-top:0;">To use the Google Maps JavaScript API, you must register your app project on the <a target="_BLANK" href="https://developers.google.com/maps/documentation/javascript/get-api-key">Google API Console</a> and get a Google API key which you can add to your app. Assign the API key at Theme Options > Google Maps.</p>
    </div>
</div>';

class WPBakeryShortCode_Proton_Map extends WPBakeryShortCodesContainer {}
vc_map(
    array(
        'name' => __('Map', 'proton'),
        'base' => 'proton_map',
        'description' => __('Display a map.', 'proton'),
        'category' => __('NeuronElements', 'proton'),
        'as_parent' => array('only' => 'proton_map_marker'),
        'is_container' => true,
        'js_view' => 'VcColumnView',
        'icon' => get_template_directory_uri() . '/includes/options/vc/vc-icon.png',
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __('Map Height', 'proton'),
                'param_name' => 'proton_map_height',
                'description' => __('Enter the map height size.', 'proton'),
                'dependency' => array('element' => 'proton_map_full_height', 'is_empty' => true)
            ),
            array(
                'type' => 'checkbox',
                'heading' => __('Map Full Height', 'proton'),
                'param_name' => 'proton_map_full_height',
                'description' => __('Set map to full height.', 'proton'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Map Zoom', 'proton'),
                'param_name' => 'proton_map_zoom',
                'description' => __('Enter the map zoom perspective.</small>', 'proton'),
            ),
            array(
                'type' => 'checkbox',
                'heading' => __('Map Scroll Zoom', 'proton'),
                'param_name' => 'proton_map_scroll_zoom',
                'description' => __('Enable scroll in the map.', 'proton'),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Map Style', 'proton'),
                'param_name' => 'proton_map_style',
                'description' => __('Select the style of the map.', 'proton'),
                'value' => array(
                    __('Default', 'proton') => '1',
                    __('Classic', 'proton') => '2',
                    __('Custom', 'proton') => '3',
                ),
                'std' => '1',
            ),
            array(
                'type' => 'textarea',
                'heading' => __('Map Custom Style', 'proton'),
                'param_name' => 'proton_map_custom_style',
                'description' => __('Enter the custom style, get custom style <a target="_BLANK" href="https://snazzymaps.com/">here</a>.', 'proton'),
                'dependency' => array('element' => 'proton_map_style', 'value' => '3'),
            ),
            array(
                'type' => 'checkbox',
                'heading' => __('Map Controls', 'proton'),
                'param_name' => 'proton_map_controls',
                'description' => __('Toogle map controls.', 'proton'),
                'value' => array(
                    __('Type</br>', 'proton') => 'type-control',
                    __('Zoom</br>', 'proton') => 'zoom-control',
                    __('Fullscreen</br>', 'proton') => 'fullscreen-control',
                    __('Street View</br>', 'proton') => 'street-view-control',
                    __('Draggable</br>', 'proton') => 'draggable',
                ),
                'std' => 'zoom-control,draggable'
            ),
            array(
                'type' => 'checkbox',
                'heading' => __('Marker Animation', 'proton'),
                'param_name' => 'proton_map_marker_animation',
                'description' => __('Enable scroll in the map.', 'proton'),
                'value' => array( __('Enable', 'proton') => 'marker-animation'),
                'std' => 'marker-animation'
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Extra class name', 'proton'),
                'param_name' => 'el_class',
                'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'proton'),
            ),
            array(
                'type' => 'css_editor',
                'heading' => __('Css', 'proton'),
                'param_name' => 'proton_css',
                'group' => __('Design options', 'proton'),
            ),
        )
    )
);
class WPBakeryShortCode_Proton_Map_Marker extends WPBakeryShortCode {}
vc_map(
    array(
        'name' => __('Map Marker', 'proton'),
        'base' => 'proton_map_marker',
        'category' => __('NeuronElements', 'proton'),
        'as_child' => array('only' => 'proton_map'),
        'icon' => get_template_directory_uri() . '/includes/options/vc/vc-icon.png',
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __('Map Latitude', 'proton'),
                'param_name' => 'proton_map_latitude',
                'description' => __('Enter the map latitude coordinates, to get map coordinates <a target="_BLANK" href="http://www.latlong.net/">click here</a>.', 'proton'),
                'admin_label' => true,
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Map Longitude', 'proton'),
                'param_name' => 'proton_map_longitude',
                'description' => sprintf( __('Enter the map longitude coordinates. '. $proton_google_api_warning .'', 'proton') ),
                'admin_label' => true,
            ),
            array(
                'type' => 'attach_image',
                'heading' => __('Marker Image', 'proton'),
                'param_name' => 'proton_map_marker',
                'description' => __('Upload a custom marker image or use the default one.', 'proton'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Marker Title', 'proton'),
                'param_name' => 'proton_map_marker_title',
                'description' => __('Enter the title of map marker.', 'proton'),
            ),
            array(
                'type' => 'textarea',
                'heading' => __('Marker Description', 'proton'),
                'param_name' => 'proton_map_marker_description',
                'description' => __('Enter the description of map marker.', 'proton'),
            ),
        )
    )
);

// Pricing Table
class WPBakeryShortCode_Proton_Pricing_Table extends WPBakeryShortCode {}
vc_map(
    array(
        'name' => __('Pricing Table', 'proton'),
        'base' => 'proton_pricing_table',
        'category' => __('NeuronElements', 'proton'),
        'description' => __('Display a pricing table.', 'proton'),
        'icon' => get_template_directory_uri() . '/includes/options/vc/vc-icon.png',
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __('Title', 'proton'),
                'param_name' => 'proton_pricing_table_title',
                'description' => __('Enter the title of table.', 'proton'),
                'admin_label' => true
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Subtitle', 'proton'),
                'param_name' => 'proton_pricing_table_subtitle',
                'description' => __('Enter the subtitle of table.', 'proton'),
                'admin_label' => true
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Price', 'proton'),
                'param_name' => 'proton_pricing_table_price',
                'description' => __('Enter the price of table.', 'proton'),
                'admin_label' => true
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Currency Symbol', 'proton'),
                'param_name' => 'proton_pricing_table_currency_symbol',
                'description' => __('Enter the currency symbol of table.', 'proton'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Pricing Unit', 'proton'),
                'param_name' => 'proton_pricing_table_pricing_unit',
                'description' => __('Enter the pricing unit of table.', 'proton'),
            ),
            array(
                'type' => 'textarea',
                'heading' => __('Description', 'proton'),
                'param_name' => 'proton_pricing_table_description',
                'description' => __('Enter the description of table.', 'proton'),
            ),
            array(
                'type' => 'textarea',
                'heading' => __('Text Lines', 'proton'),
                'param_name' => 'proton_pricing_table_text_lines',
                'description' => __('Enter table text lines, separate them in new lines to create the list.', 'proton'),
            ),
            array(
                'type' => 'vc_link',
                'heading' => __('Button', 'proton'),
                'param_name' => 'proton_pricing_table_button',
                'description' => __('Add a button to the bottom of table.', 'proton'),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __('Text Color', 'proton'),
                'param_name' => 'proton_pricing_table_text_color',
                'description' => __('Select the text color.', 'proton'),
                'group' => __('Style', 'proton'),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __('Borders Color', 'proton'),
                'param_name' => 'proton_pricing_table_borders_color',
                'description' => __('Select the borders color.', 'proton'),
                'group' => __('Style', 'proton'),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Background Color', 'proton'),
                'param_name' => 'proton_pricing_table_bgc',
                'description' => __('Select the background color of table.', 'proton'),
                'value' => array(
                    __('Primary', 'proton') => '1',
                    __('Transparent', 'proton') => '2',
                    __('Custom', 'proton') => '3',
                ),
                'std' => '1',
                'group' => __('Style', 'proton'),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __('Custom Background Color', 'proton'),
                'param_name' => 'proton_pricing_table_custom_bgc',
                'description' => __('Select the custom background color.', 'proton'),
                'group' => __('Style', 'proton'),
                'dependency' => array('element' => 'proton_pricing_table_bgc', 'value' => '3'),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Button Color', 'proton'),
                'param_name' => 'proton_pricing_table_button_color',
                'description' => __('Select the color of button.', 'proton'),
                'value' => array(
                    __('Primary', 'proton') => '1',
                    __('Grey Color', 'proton') => '2',
                    __('White Color', 'proton') => '3',
                    __('Dark Color', 'proton') => '4',
                    __('Red Color', 'proton') => '5',
                    __('Green Color', 'proton') => '6',
                    __('Blue Color', 'proton') => '7',
                    __('Custom', 'proton') => '8',
                ),
                'std' => '1',
                'group' => __('Style', 'proton'),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __('Text Color', 'proton'),
                'param_name' => 'proton_pricing_table_button_text_color',
                'description' => __('Select the color of text.', 'proton'),
                'dependency' => array('element' => 'proton_pricing_table_button_color', 'value' => '8'),
                'group' => __('Style', 'proton'),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __('Background Color', 'proton'),
                'param_name' => 'proton_pricing_table_button_background_color',
                'description' => __('Select the color of background.', 'proton'),
                'dependency' => array('element' => 'proton_pricing_table_button_color', 'value' => '8'),
                'group' => __('Style', 'proton'),
            ),
            array(
                'type' => 'checkbox',
                'heading' => __('Highlight', 'proton'),
                'param_name' => 'proton_pricing_table_highlight',
                'description' => __('Highlight this table.', 'proton'),
                'group' => __('Style', 'proton'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Extra class name', 'proton'),
                'param_name' => 'el_class',
                'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'proton'),
            ),
            array(
                'type' => 'css_editor',
                'heading' => __('Css', 'proton'),
                'param_name' => 'proton_css',
                'group' => __('Design options', 'proton'),
            ),
        )
    )
);

// Carousel
class WPBakeryShortCode_Proton_Carousel extends WPBakeryShortCode {}
vc_map(
    array(
        'name' => __('Carousel', 'proton'),
        'base' => 'proton_carousel',
        'category' => __('NeuronElements', 'proton'),
        'description' => __('Display a carousel slider.', 'proton'),
        'icon' => get_template_directory_uri() . '/includes/options/vc/vc-icon.png',
        'params' => array(
            array(
                'type' => 'attach_images',
                'heading' => __('Images', 'proton'),
                'param_name' => 'proton_carousel_images',
                'description' => __('Upload the images to carousel slider.', 'proton'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Items', 'proton'),
                'param_name' => 'proton_carousel_items',
                'description' => __('The number of items you want to see on the screen.', 'proton'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Margin', 'proton'),
                'param_name' => 'proton_carousel_margin',
                'description' => __('Enter the margin space, number will be represented in pixels.', 'proton'),
            ),
            array(
                'type' => 'checkbox',
                'heading' => __('Controls', 'proton'),
                'param_name' => 'proton_carousel_controls',
                'description' => __('Toogle carousel controls.', 'proton'),
                'value' => array(
                    __('Auto Height</br>', 'proton') => 'auto-height',
                    __('Loop</br>', 'proton') => 'loop',
                    __('Mouse Drag</br>', 'proton') => 'mousedrag',
                    __('Touch Drag</br>', 'proton') => 'touchdrag',
                    __('Navigation</br>', 'proton') => 'navigation',
                    __('Dots</br>', 'proton') => 'dots',
                    __('Autoplay</br>', 'proton') => 'autoplay',
                    __('Pause on mouse hover</br>', 'proton') => 'autoplay-hover-pause',
                ),
                'std' => 'auto-height,loop,mousedrag,touchdrag,navigation'
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Stage Padding', 'proton'),
                'param_name' => 'proton_carousel_stage_padding',
                'description' => __('Padding left and right on stage (can see neighbours).', 'proton'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Start Position', 'proton'),
                'param_name' => 'proton_carousel_start_position',
                'description' => __('Enter from which element you want to start the position of carousel.', 'proton'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Auto Play Timeout', 'proton'),
                'param_name' => 'proton_carousel_auto_play_timeout',
                'description' => __('Autoplay interval timeout, number is represented in seconds.', 'proton'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Smart Speed', 'proton'),
                'param_name' => 'proton_carousel_smart_speed',
                'description' => __('Speed Calculate, number is represented in seconds.', 'proton'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Extra class name', 'proton'),
                'param_name' => 'el_class',
                'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'proton'),
            ),
            array(
                'type' => 'css_editor',
                'heading' => __('Css', 'proton'),
                'param_name' => 'proton_css',
                'group' => __('Design options', 'proton'),
            ),
        )
    )
);

// Social Media
class WPBakeryShortCode_Proton_Social_Media extends WPBakeryShortCode {}
vc_map(
    array(
        'name' => __('Social Media', 'proton'),
        'base' => 'proton_social_media',
        'description' => __('Display social media.', 'proton'),
        'category' => __('NeuronElements', 'proton'),
        'icon' => get_template_directory_uri() . '/includes/options/vc/vc-icon.png',
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => __('Type', 'proton'),
                'param_name' => 'proton_social_media_type',
                'description' => __('Select the type you want to display the social media.', 'proton'),
                'value' => array(
                    __('Icons', 'proton') => '1',
                    __('Text', 'proton') => '2'
                ),
                'std' => '1',
                'group' => __('Style', 'proton'),
                'admin_label' => true
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Layout', 'proton'),
                'param_name' => 'proton_social_media_layout',
                'description' => __('Select the social media layout.', 'proton'),
                'value' => array(
                    __('Default', 'proton') => '1',
                    __('Background', 'proton') => '2'
                ),
                'std' => '1',
                'group' => __('Style', 'proton'),
                'admin_label' => true
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Style', 'proton'),
                'param_name' => 'proton_social_media_style',
                'description' => __('Select the social media style.', 'proton'),
                'value' => array(
                    __('Default', 'proton') => '1',
                    __('Color in Text', 'proton') => '2',
                    __('Color in Hover Text', 'proton') => '3',
                    __('Color in Background', 'proton') => '4',
                    __('Color in Hover Background', 'proton') => '5'
                ),
                'std' => '1',
                'group' => __('Style', 'proton'),
                'admin_label' => true
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('URL Inheritance', 'proton'),
                'param_name' => 'proton_social_media_url_inheritance',
                'description' => __('Select if you want to inherit the URLs from theme options.', 'proton'),
                'value' => array(
                    __('Inherit from Theme Options', 'proton') => '1',
                    __('Custom URLs', 'proton') => '2',
                ),
                'std' => '1',
                'group' => __('URL', 'proton'),
                'admin_label' => true
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Facebook URL', 'proton'),
                'param_name' => 'proton_social_media_facebook_url',
                'description' => __('Enter your Facebook URL.', 'proton'),
                'group' => __('URL', 'proton'),
                'dependency' => array('element' => 'proton_social_media_url_inheritance', 'value' => '2'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Twitter URL', 'proton'),
                'param_name' => 'proton_social_media_twitter_url',
                'description' => __('Enter your Twitter URL.', 'proton'),
                'group' => __('URL', 'proton'),
                'dependency' => array('element' => 'proton_social_media_url_inheritance', 'value' => '2'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('500px URL', 'proton'),
                'param_name' => 'proton_social_media_500px_url',
                'description' => __('Enter your 500px URL.', 'proton'),
                'group' => __('URL', 'proton'),
                'dependency' => array('element' => 'proton_social_media_url_inheritance', 'value' => '2'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Google Plus URL', 'proton'),
                'param_name' => 'proton_social_media_google_plus_url',
                'description' => __('Enter your Google Plus URL.', 'proton'),
                'group' => __('URL', 'proton'),
                'dependency' => array('element' => 'proton_social_media_url_inheritance', 'value' => '2'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Vimeo URL', 'proton'),
                'param_name' => 'proton_social_media_vimeo_url',
                'description' => __('Enter your Vimeo URL.', 'proton'),
                'group' => __('URL', 'proton'),
                'dependency' => array('element' => 'proton_social_media_url_inheritance', 'value' => '2'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Dribbble URL', 'proton'),
                'param_name' => 'proton_social_media_dribbble_url',
                'description' => __('Enter your Dribbble URL.', 'proton'),
                'group' => __('URL', 'proton'),
                'dependency' => array('element' => 'proton_social_media_url_inheritance', 'value' => '2'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Pinterest URL', 'proton'),
                'param_name' => 'proton_social_media_pinterest_url',
                'description' => __('Enter your Pinterest URL.', 'proton'),
                'group' => __('URL', 'proton'),
                'dependency' => array('element' => 'proton_social_media_url_inheritance', 'value' => '2'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Youtube URL', 'proton'),
                'param_name' => 'proton_social_media_youtube_url',
                'description' => __('Enter your Youtube URL.', 'proton'),
                'group' => __('URL', 'proton'),
                'dependency' => array('element' => 'proton_social_media_url_inheritance', 'value' => '2'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Tumblr URL', 'proton'),
                'param_name' => 'proton_social_media_tumblr_url',
                'description' => __('Enter your Tumblr URL.', 'proton'),
                'group' => __('URL', 'proton'),
                'dependency' => array('element' => 'proton_social_media_url_inheritance', 'value' => '2'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Linkedin URL', 'proton'),
                'param_name' => 'proton_social_media_linkedin_url',
                'description' => __('Enter your Linkedin URL.', 'proton'),
                'group' => __('URL', 'proton'),
                'dependency' => array('element' => 'proton_social_media_url_inheritance', 'value' => '2'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Behance URL', 'proton'),
                'param_name' => 'proton_social_media_behance_url',
                'description' => __('Enter your Behance URL.', 'proton'),
                'group' => __('URL', 'proton'),
                'dependency' => array('element' => 'proton_social_media_url_inheritance', 'value' => '2'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Flickr URL', 'proton'),
                'param_name' => 'proton_social_media_flickr_url',
                'description' => __('Enter your Flickr URL.', 'proton'),
                'group' => __('URL', 'proton'),
                'dependency' => array('element' => 'proton_social_media_url_inheritance', 'value' => '2'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Spotify URL', 'proton'),
                'param_name' => 'proton_social_media_spotify_url',
                'description' => __('Enter your Spotify URL.', 'proton'),
                'group' => __('URL', 'proton'),
                'dependency' => array('element' => 'proton_social_media_url_inheritance', 'value' => '2'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Instagram URL', 'proton'),
                'param_name' => 'proton_social_media_instagram_url',
                'description' => __('Enter your Instagram URL.', 'proton'),
                'group' => __('URL', 'proton'),
                'dependency' => array('element' => 'proton_social_media_url_inheritance', 'value' => '2'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('GitHub URL', 'proton'),
                'param_name' => 'proton_social_media_github_url',
                'description' => __('Enter your GitHub URL.', 'proton'),
                'group' => __('URL', 'proton'),
                'dependency' => array('element' => 'proton_social_media_url_inheritance', 'value' => '2'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Houzz URL', 'proton'),
                'param_name' => 'proton_social_media_houzz_url',
                'description' => __('Enter your Houzz URL.', 'proton'),
                'group' => __('URL', 'proton'),
                'dependency' => array('element' => 'proton_social_media_url_inheritance', 'value' => '2'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('StackExchange  URL', 'proton'),
                'param_name' => 'proton_social_media_stackexchange_url',
                'description' => __('Enter your StackExchange URL.', 'proton'),
                'group' => __('URL', 'proton'),
                'dependency' => array('element' => 'proton_social_media_url_inheritance', 'value' => '2'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('SoundCloud  URL', 'proton'),
                'param_name' => 'proton_social_media_soundcloud_url',
                'description' => __('Enter your SoundCloud URL.', 'proton'),
                'group' => __('URL', 'proton'),
                'dependency' => array('element' => 'proton_social_media_url_inheritance', 'value' => '2'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('VK  URL', 'proton'),
                'param_name' => 'proton_social_media_vk_url',
                'description' => __('Enter your VK URL.', 'proton'),
                'group' => __('URL', 'proton'),
                'dependency' => array('element' => 'proton_social_media_url_inheritance', 'value' => '2'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Vine  URL', 'proton'),
                'param_name' => 'proton_social_media_vine_url',
                'description' => __('Enter your Vine URL.', 'proton'),
                'group' => __('URL', 'proton'),
                'dependency' => array('element' => 'proton_social_media_url_inheritance', 'value' => '2'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Extra class name', 'proton'),
                'param_name' => 'el_class',
                'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'proton'),
                'group' => __('Style', 'proton'),
            ),
            array(
                'type' => 'css_editor',
                'heading' => __('Css', 'proton'),
                'param_name' => 'proton_css',
                'group' => __('Design options', 'proton'),
            ),
        )
    )
);

// Service
class WPBakeryShortCode_Proton_Service extends WPBakeryShortCode {}
vc_map(
    array(
        'name' => __('Service', 'proton'),
        'base' => 'proton_service',
        'description' => __('Display a service.', 'proton'),
        'category' => __('NeuronElements', 'proton'),
        'icon' => get_template_directory_uri() . '/includes/options/vc/vc-icon.png',
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => __('Icon Position', 'proton'),
                'param_name' => 'proton_service_icon_position',
                'description' => __('Select the position of icon.', 'proton'),
                'value' => array(
                    __('Left', 'proton') => '1',
                    __('Right', 'proton') => '2',
                    __('Top', 'proton') => '3',
                    __('Bottom', 'proton') => '4',
                ),
                'std' => '3',
                'admin_label' => true,
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Service Alignment', 'proton'),
                'param_name' => 'proton_service_alignment',
                'description' => __('Select the alignment of service.', 'proton'),
                'value' => array(
                    __('Left', 'proton') => '1',
                    __('Center', 'proton') => '2',
                    __('Right', 'proton') => '3',
                ),
                'std' => '1',
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Icon', 'proton'),
                'param_name' => 'proton_service_icon',
                'description' => __('Select the alignment of service.', 'proton'),
                'value' => array(
                    __('Font Awesome', 'proton') => '1',
                    __('Open Iconic', 'proton') => '2',
                    __('Typicons', 'proton') => '3',
                    __('Entypo', 'proton') => '4',
                    __('Linecons', 'proton') => '5',
                    __('Mono Social', 'proton') => '6',
                    __('Material', 'proton') => '7'
                ),
                'std' => '1',
                'admin_label' => true,
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __('Font Awesome', 'proton'),
                'param_name' => 'proton_service_icon_font_awesome',
                'settings' => array(
                    'iconsPerPage' => 100,
                    'type' => 'fontawesome',
                ),
                'description' => __('Select the font awesome for your service.', 'proton'),
                'dependency' => array('element' => 'proton_service_icon', 'value' => '1')
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __('Open Iconic', 'proton'),
                'param_name' => 'proton_service_icon_open_iconic',
                'settings' => array(
                    'iconsPerPage' => 100,
                    'type' => 'openiconic',
                ),
                'description' => __('Select the opcenic icon for your service.', 'proton'),
                'dependency' => array('element' => 'proton_service_icon', 'value' => '2')
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __('Typicons', 'proton'),
                'param_name' => 'proton_service_icon_typicons',
                'settings' => array(
                    'iconsPerPage' => 100,
                    'type' => 'typicons',
                ),
                'description' => __('Select the typicons icon for your service.', 'proton'),
                'dependency' => array('element' => 'proton_service_icon', 'value' => '3')
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __('Entypo', 'proton'),
                'param_name' => 'proton_service_icon_entypo',
                'settings' => array(
                    'iconsPerPage' => 100,
                    'type' => 'entypo',
                ),
                'description' => __('Select the entypo icon for your service.', 'proton'),
                'dependency' => array('element' => 'proton_service_icon', 'value' => '4')
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __('Linecons', 'proton'),
                'param_name' => 'proton_service_icon_linecons',
                'settings' => array(
                    'iconsPerPage' => 100,
                    'type' => 'linecons',
                ),
                'description' => __('Select the linecons icon for your service.', 'proton'),
                'dependency' => array('element' => 'proton_service_icon', 'value' => '5')
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __('Mono Social', 'proton'),
                'param_name' => 'proton_service_icon_mono_social',
                'settings' => array(
                    'iconsPerPage' => 100,
                    'type' => 'monosocial',
                ),
                'description' => __('Select the monosocial icon for your service.', 'proton'),
                'dependency' => array('element' => 'proton_service_icon', 'value' => '6')
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __('Material', 'proton'),
                'param_name' => 'proton_service_icon_material',
                'settings' => array(
                    'iconsPerPage' => 100,
                    'type' => 'material',
                ),
                'description' => __('Select the material icon for your service.', 'proton'),
                'dependency' => array('element' => 'proton_service_icon', 'value' => '7')
            ),
            array(
                'type' => 'attach_image',
                'heading' => __('Image', 'proton'),
                'param_name' => 'proton_service_image',
                'description' => __('Upload an image as icon.', 'proton'),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __('Icon Color', 'proton'),
                'param_name' => 'proton_service_icon_color',
                'description' => __('Select the icon color.', 'proton'),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Icon Size', 'proton'),
                'param_name' => 'proton_service_icon_size',
                'description' => __('Select the size of icon.', 'proton'),
                'value' => array(
                    __('Extra Small', 'proton') => '1',
                    __('Small', 'proton') => '2',
                    __('Medium', 'proton') => '3',
                    __('Large', 'proton') => '4',
                    __('Extra Large', 'proton') => '5',
                ),
                'std' => '2',
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Title', 'proton'),
                'param_name' => 'proton_service_title',
                'description' => __('Enter the title of your service.', 'proton'),
                'admin_label' => true
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Title Size', 'proton'),
                'param_name' => 'proton_service_title_size',
                'description' => __('Select the size of title.', 'proton'),
                'value' => array(
                    __('Heading 1', 'proton') => '1',
                    __('Heading 2', 'proton') => '2',
                    __('Heading 3', 'proton') => '3',
                    __('Heading 4', 'proton') => '4',
                    __('Heading 5', 'proton') => '5',
                    __('Heading 6', 'proton') => '6',
                    __('Custom', 'proton') => '7',
                ),
                'std' => '5',
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Title Custom Size', 'proton'),
                'param_name' => 'proton_service_title_custom_size',
                'description' => __('Enter the font size of title, number is represented in pixels.', 'proton'),
                'dependency' => array('element' => 'proton_service_title_size', 'value' => '7'),
            ),
            array(
                'type' => 'textarea_html',
                'heading' => __('Description', 'proton'),
                'param_name' => 'content',
                'description' => __('Write the description of this service.', 'proton'),
            ),
            array(
                'type' => 'vc_link',
                'heading' => __('URL', 'proton'),
                'param_name' => 'proton_service_url',
                'description' => __('Select a url to make the service a link. <br><small>Note: Only the url will be available, not the text of link.</small>', 'proton'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Extra class name', 'proton'),
                'param_name' => 'el_class',
                'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'proton'),
            ),
            array(
                'type' => 'css_editor',
                'heading' => __('Css', 'proton'),
                'param_name' => 'proton_css',
                'group' => __('Design options', 'proton'),
            ),
        )
    )
);


// Row
$proton_custom_rows = array(
    array(
        'type' => 'dropdown',
    	'heading' => __('Left and Right Spacing', 'proton'),
        'group' => __('Extra Options', 'proton'),
        'description' => __('Select the left and right spacing of this row.', 'proton'),
    	'param_name' => 'row_side_spacing',
    	'value' => array(
    		__('0 pixel', 'proton') => '1',
    		__('30 pixels', 'proton') => '2',
    		__('50 pixels', 'proton') => '3',
    		__('70 pixels', 'proton') => '4',
    		__('100 pixels', 'proton') => '5',
    		__('150 pixels', 'proton') => '6'
    	),
        'std' => '1'
    ),
    array(
        'type' => 'dropdown',
    	'heading' => __('Top Spacing', 'proton'),
        'group' => __('Extra Options', 'proton'),
        'description' => __('Select the top spacing of this row.', 'proton'),
    	'param_name' => 'row_top_spacing',
    	'value' => array(
    		__('0 pixel', 'proton') => '1',
    		__('30 pixels', 'proton') => '2',
    		__('50 pixels', 'proton') => '3',
            __('70 pixels', 'proton') => '4',
    		__('100 pixels', 'proton') => '5',
    		__('150 pixels', 'proton') => '6'
    	),
        'std' => '2'
    ),
    array(
        'type' => 'dropdown',
    	'heading' => __('Bottom Spacing', 'proton'),
        'group' => __('Extra Options', 'proton'),
        'description' => __('Select the bottom spacing of this row.', 'proton'),
    	'param_name' => 'row_bottom_spacing',
    	'value' => array(
    		__('0 pixel', 'proton') => '1',
    		__('30 pixels', 'proton') => '2',
    		__('50 pixels', 'proton') => '3',
            __('70 pixels', 'proton') => '4',
    		__('100 pixels', 'proton') => '5',
    		__('150 pixels', 'proton') => '6'
    	),
        'std' => '2'
    ),
    array(
        'type' => 'dropdown',
    	'heading' => __('Alignment', 'proton'),
        'group' => __('Extra Options', 'proton'),
        'description' => __('Select the alignment of this row.', 'proton'),
    	'param_name' => 'row_alignment',
    	'value' => array(
    		__('Left', 'proton') => '1',
    		__('Center', 'proton') => '2',
            __('Right', 'proton') => '3'
    	),
        'std' => '1'
    ),
    array(
        'type' => 'dropdown',
    	'heading' => __('Mobile', 'proton'),
        'group' => __('Extra Options', 'proton'),
        'description' => __('Select the visibiliy of this row in mobile layout mode (< 768px).', 'proton'),
    	'param_name' => 'row_mobile',
    	'value' => array(
    		__('Visible', 'proton') => '1',
    		__('Hidden', 'proton') => '2'
    	),
        'std' => '1'
    ),
);
vc_add_params('vc_row', $proton_custom_rows);
