<?php
/**
 * Boldo Theme Functions
 * 
 * Main theme configuration and setup
 * 
 * @package Boldo
 * @version 1.0.0
 */

// ============================================================
// THEME SETUP
// ============================================================

function tailpress_setup() {
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
    add_theme_support('align-wide');
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');
    add_editor_style('css/editor-style.css');

    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    register_nav_menus(array(
        'primary'          => __('Primary Menu', 'tailpress'),
        'footer'           => __('Footer Menu', 'tailpress'),
        'footer_landings'  => __('Footer Landings', 'tailpress'),
        'footer_company'   => __('Footer Company', 'tailpress'),
        'footer_resources' => __('Footer Resources', 'tailpress'),
    ));

    add_image_size('blog-card', 300, 209, true);
    
    error_log('Boldo theme setup completed');
}
add_action('after_setup_theme', 'tailpress_setup');

// ============================================================
// ASSETS ENQUEUE
// ============================================================

function tailpress_enqueue_scripts() {
    $theme = wp_get_theme();

    wp_enqueue_style(
        'boldo-google-fonts',
        'https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&family=Open+Sans:wght@400;600;700&display=swap',
        array(),
        null
    );

    wp_add_inline_style(
        'boldo-google-fonts',
        ".font-manrope{font-family:'Manrope',sans-serif !important;}\n.font-opensans{font-family:'Open Sans',sans-serif !important;}"
    );

    wp_enqueue_style('tailpress', tailpress_asset('css/app.css'), array(), $theme->get('Version'));
    wp_enqueue_style('custom-css', get_stylesheet_directory_uri() . '/css/custom.css', array('tailpress'), '1.0');

    wp_enqueue_script('tailpress', tailpress_asset('js/app.js'), array(), $theme->get('Version'), true);

    // Blog Load More AJAX
    wp_localize_script('tailpress', 'blogAjax', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('blog_load_more_nonce'),
    ]);
}
add_action('wp_enqueue_scripts', 'tailpress_enqueue_scripts');

// ============================================================
// BLOG LOAD MORE — AJAX HANDLER
// ============================================================

add_action('wp_ajax_blog_load_more',        'blog_load_more_handler');
add_action('wp_ajax_nopriv_blog_load_more', 'blog_load_more_handler');

function blog_load_more_handler() {

    if (!check_ajax_referer('blog_load_more_nonce', 'nonce', false)) {
        wp_send_json_error(['message' => 'Invalid nonce'], 403);
    }

    $ajax_offset  = absint($_POST['ajax_offset']  ?? 0);
    $count        = absint($_POST['count']        ?? 3);
    $excluded_raw = sanitize_text_field($_POST['excluded_ids'] ?? '');

    // Parse excluded IDs (manual posts + current page)
    $excluded_ids = [];
    if (!empty($excluded_raw)) {
        $excluded_ids = array_values(array_filter(array_map('absint', explode(',', $excluded_raw))));
    }

    // Get ALL remaining post IDs (excluding manual + current page) ordered by date DESC
    $all_ids = get_posts([
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'fields'         => 'ids',
        'post__not_in'   => $excluded_ids,
    ]);

    // Slice exactly the posts we need at this offset
    $slice_ids = array_slice($all_ids, $ajax_offset, $count);

    if (empty($slice_ids)) {
        wp_send_json_success(['html' => '', 'count' => 0]);
    }

    // Fetch those exact posts preserving date order
    $posts = get_posts([
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => count($slice_ids),
        'post__in'       => $slice_ids,
        'orderby'        => 'post__in',
    ]);

    if (empty($posts)) {
        wp_send_json_success(['html' => '', 'count' => 0]);
    }

    ob_start();
    foreach ($posts as $post_obj) {
        $post_id     = $post_obj->ID;
        $post_link   = get_permalink($post_id);
        $post_title  = get_the_title($post_id);
        $post_date   = get_the_date('F j, Y', $post_id);
        $post_author = get_the_author_meta('display_name', $post_obj->post_author);
        $post_cats   = get_the_category($post_id);
        $post_cat    = !empty($post_cats) ? $post_cats[0]->name : '';
        $thumb       = get_the_post_thumbnail($post_id, 'medium', ['class' => 'w-full h-full object-cover']);
        $avatar      = get_avatar($post_obj->post_author, 32, '', '', ['class' => 'w-8 h-8 rounded-full object-cover']);
        ?>
        <a href="<?php echo esc_url($post_link); ?>"
            class="blog-card group cursor-pointer max-w-[300px] mx-auto lg:mx-0 flex flex-col h-full">

            <div class="mb-4 sm:mb-5 md:mb-6 overflow-hidden rounded-lg aspect-[300/209]">
                <?php if ($thumb): echo $thumb; else: ?>
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-400 text-sm">No Image</span>
                    </div>
                <?php endif; ?>
            </div>

            <div class="flex flex-col flex-1">
                <div class="flex items-center gap-2 mb-2 sm:mb-3">
                    <span class="font-opensans font-bold text-sm sm:text-base/7 text-[#0A2640]">
                        <?php echo esc_html($post_cat); ?>
                    </span>
                    <span class="font-opensans font-normal text-sm sm:text-base/7 text-gray-600">
                        <?php echo esc_html($post_date); ?>
                    </span>
                </div>
                <p class="font-opensans font-normal text-lg sm:text-xl/8 text-[#000000] mb-3 sm:mb-4">
                    <?php echo esc_html($post_title); ?>
                </p>
                <div class="flex items-center gap-3 pt-3 sm:pt-4 md:pt-5 mt-auto">
                    <?php echo $avatar; ?>
                    <span class="font-opensans font-normal text-sm sm:text-base/7 text-[#000000]">
                        <?php echo esc_html($post_author); ?>
                    </span>
                </div>
            </div>

        </a>
        <?php
    }
    $html = ob_get_clean();

    wp_send_json_success([
        'html'  => $html,
        'count' => count($posts),
    ]);
}

// ============================================================
// HEADER BUTTON HOVER SCRIPT
// ============================================================

function boldo_header_button_hover_script() {
    global $boldo_header_btn_styles;

    if (!empty($boldo_header_btn_styles) && !empty($boldo_header_btn_styles['enabled'])) {
        ?>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const headerBtns = document.querySelectorAll('.header-btn');
            headerBtns.forEach(function(btn) {
                const hoverColor    = btn.getAttribute('data-hover-color');
                const hoverBg       = btn.getAttribute('data-hover-bg');
                const originalColor = btn.style.color;
                const originalBg    = btn.style.backgroundColor;
                if (hoverColor && hoverBg) {
                    btn.addEventListener('mouseenter', function() {
                        this.style.color           = hoverColor + ' !important';
                        this.style.backgroundColor = hoverBg    + ' !important';
                    });
                    btn.addEventListener('mouseleave', function() {
                        this.style.color           = originalColor;
                        this.style.backgroundColor = originalBg;
                    });
                }
            });
        });
        </script>
        <?php
    }
}
add_action('wp_footer', 'boldo_header_button_hover_script');

function boldo_resource_hints($urls, $relation_type) {
    if ($relation_type === 'preconnect') {
        $urls[] = 'https://fonts.googleapis.com';
        $urls[] = array(
            'href'        => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        );
    }
    return $urls;
}
add_filter('wp_resource_hints', 'boldo_resource_hints', 10, 2);

// ============================================================
// IMAGE HANDLING
// ============================================================

function boldo_custom_image_sizes_names($sizes) {
    return array_merge($sizes, array(
        'blog-card'   => __('Blog Card (300x209)', 'tailpress'),
        'team-member' => __('Team Member Photo (300x354)', 'tailpress'),
    ));
}
add_filter('image_size_names_choose', 'boldo_custom_image_sizes_names');

function boldo_set_image_quality($quality) {
    return 85;
}
add_filter('wp_editor_set_quality', 'boldo_set_image_quality');
add_filter('jpeg_quality', 'boldo_set_image_quality');

// ============================================================
// NAVIGATION MENU CUSTOMIZATION
// ============================================================

function tailpress_nav_menu_add_li_class($classes, $item, $args, $depth) {
    if (isset($args->li_class)) {
        $classes[] = $args->li_class;
    }
    if (isset($args->{"li_class_$depth"})) {
        $classes[] = $args->{"li_class_$depth"};
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'tailpress_nav_menu_add_li_class', 10, 4);

function tailpress_nav_menu_add_submenu_class($classes, $args, $depth) {
    if (isset($args->submenu_class)) {
        $classes[] = $args->submenu_class;
    }
    if (isset($args->{"submenu_class_$depth"})) {
        $classes[] = $args->{"submenu_class_$depth"};
    }
    return $classes;
}
add_filter('nav_menu_submenu_css_class', 'tailpress_nav_menu_add_submenu_class', 10, 3);

function boldo_add_header_btn_class($atts, $item, $args, $depth) {
    global $boldo_header_btn_styles;

    $title         = isset($item->title) ? trim(wp_strip_all_tags($item->title)) : '';
    $button_titles = array('Login', 'Log In', 'Sign Up', 'Register', 'Get Started');

    $is_button = false;
    foreach ($button_titles as $btn_title) {
        if (strcasecmp($title, $btn_title) === 0) {
            $is_button = true;
            break;
        }
    }

    if ($is_button) {
        $existing = isset($atts['class']) ? (string) $atts['class'] : '';
        $classes  = array_filter(preg_split('/\s+/', trim($existing)));
        if (!in_array('header-btn', $classes, true)) {
            $classes[] = 'header-btn';
        }
        $atts['class'] = trim(implode(' ', $classes));

        if (!empty($boldo_header_btn_styles) && !empty($boldo_header_btn_styles['enabled'])) {
            $inline_style = sprintf(
                'color: %s !important; background-color: %s !important; border: %dpx solid %s !important; border-radius: 9999px !important; padding: 0.5rem 2.5rem !important; font-weight: 700 !important; font-family: "Open Sans", sans-serif !important; font-size: 1rem !important; line-height: 1.5rem !important; transition: all 0.3s ease !important; display: inline-block !important; text-decoration: none !important;',
                esc_attr($boldo_header_btn_styles['text']),
                esc_attr($boldo_header_btn_styles['bg']),
                intval($boldo_header_btn_styles['border_width']),
                esc_attr($boldo_header_btn_styles['border'])
            );
            $atts['style']            = $inline_style;
            $atts['data-hover-color'] = esc_attr($boldo_header_btn_styles['text_hover']);
            $atts['data-hover-bg']    = esc_attr($boldo_header_btn_styles['bg_hover']);
        }
    }

    return $atts;
}
add_filter('nav_menu_link_attributes', 'boldo_add_header_btn_class', 10, 4);

function boldo_clean_menu_classes($classes, $item, $args, $depth) {
    if (isset($args->theme_location) && $args->theme_location === 'primary') {
        $allowed_classes = array('menu-item', 'current-menu-item', 'current_page_item', 'menu-item-has-children');
        $classes         = array_intersect($classes, $allowed_classes);
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'boldo_clean_menu_classes', 20, 4);

// ============================================================
// ACF INTEGRATION
// ============================================================

if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'      => 'Blog Settings',
        'menu_title'      => 'Blog Settings',
        'menu_slug'       => 'blog-settings',
        'capability'      => 'edit_posts',
        'redirect'        => false,
        'icon_url'        => 'dashicons-admin-post',
        'position'        => 30,
        'update_button'   => __('Update Settings', 'tailpress'),
        'updated_message' => __('Blog Settings Updated', 'tailpress'),
    ));

    acf_add_options_page(array(
        'page_title'      => 'Global Header Settings',
        'menu_title'      => 'Global Header',
        'menu_slug'       => 'global-header-settings',
        'capability'      => 'edit_posts',
        'redirect'        => false,
        'icon_url'        => 'dashicons-layout',
        'position'        => 31,
        'update_button'   => __('Update Settings', 'tailpress'),
        'updated_message' => __('Global Header Settings Updated', 'tailpress'),
    ));
}

add_filter('acf/settings/save_json', function ($path) {
    return get_stylesheet_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function ($paths) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
});

function get_blog_field($field_name) {
    $defaults = array(
        'subtitle'           => 'Our Blog',
        'title'              => 'Value proposition accelerator product management venture',
        'initial_posts'      => 6,
        'load_more_count'    => 3,
        'posts_per_page'     => 50,
        'show_subtitle'      => true,
        'show_title'         => true,
        'subtitle_alignment' => 'center',
        'title_alignment'    => 'center',
    );

    $value = get_field($field_name, 'option');

    if (empty($value) && isset($defaults[$field_name])) {
        return $defaults[$field_name];
    }

    return $value;
}

// ============================================================
// UTILITY FUNCTIONS
// ============================================================

function tailpress_asset($path) {
    if (wp_get_environment_type() === 'production') {
        return get_stylesheet_directory_uri() . '/' . $path;
    }
    return add_query_arg('time', time(), get_stylesheet_directory_uri() . '/' . $path);
}

add_action('after_switch_theme', function () {
    flush_rewrite_rules();
});

// ============================================================
// REQUIRE FILES
// ============================================================

require_once get_template_directory() . '/acf-blocks.php';
require_once get_template_directory() . '/customizer.php';
require_once get_template_directory() . '/inc/comment-template.php';
