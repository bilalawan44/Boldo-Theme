<?php
/* =========================
   ACF HEADER CONTROLS
========================= */

// Detect karo yeh page/post hai ya single/404/search
$is_global_page = (is_single() || is_404() || is_search() || is_archive() || is_tax() || is_category() || is_tag());

// Page ki apni ACF value lo (sirf current page se)
$acf_page = function ($key) {
    if (!function_exists('get_field')) return null;
    $val = get_field($key);
    return (!empty($val)) ? $val : null;
};

// Global options page se value lo
$acf_global = function ($key) {
    if (!function_exists('get_field')) return null;
    $val = get_field($key, 'option');
    return (!empty($val)) ? $val : null;
};

// Smart get: page setting pehle, phir agar global page hai to global setting
$acf_get = function ($key) use ($acf_page, $acf_global, $is_global_page) {
    // Pehle current page check karo
    $val = $acf_page($key);
    if (!empty($val)) return $val;

    // Sirf single/404/search/archive pe global setting use karo
    if ($is_global_page) {
        return $acf_global($key);
    }

    // Home/Pages pe sirf page ki setting (global nahi)
    return null;
};

// Custom header settings
$custom = $acf_get('enable_custom_header');
$transparent = $acf_get('header_transparent');
$bg = $acf_get('header_bg_color');

// Menu colors
$menu_color = $acf_get('menu_text_color');
$menu_hover = $acf_get('menu_hover_color');

// =========================
// HEADER BUTTON COLORS - SAFE ACF + FALLBACK
// =========================
function boldo_acf_option($key) {
    if (!function_exists('get_field')) return null;
    $val = get_field($key, 'option');
    return (!empty($val)) ? $val : null;
}

$btn_text         = $acf_get('header_button_text_color');
$btn_text_hover   = $acf_get('header_button_hover_text_color');
$btn_bg           = $acf_get('header_button_bg_color');
$btn_bg_hover     = $acf_get('header_button_hover_bg_color');
$btn_border             = $acf_get('header_button_border_color');
$btn_border_width       = $acf_get('header_button_border_width');
$btn_border_hover       = $acf_get('header_button_hover_border_color');

// Mobile menu colors
$mob_btn_color          = $acf_get('mobile_menu_button_color');
$mob_btn_hover          = $acf_get('mobile_menu_button_hover_color');
$mob_menu_bg            = $acf_get('mobile_menu_open_bg_color');

// Safe defaults
$btn_text               = $btn_text ?: '#ffffff';
$btn_text_hover         = $btn_text_hover ?: '#ffffff';
$btn_bg                 = $btn_bg ?: '#0A2640';
$btn_bg_hover           = $btn_bg_hover ?: '#092036';
$btn_border             = $btn_border ?: '#0A2640';
$btn_border_width       = intval($btn_border_width ?: 2);
$btn_border_hover       = $btn_border_hover ?: $btn_border;
$mob_btn_color          = $mob_btn_color ?: '#ffffff';
$mob_btn_hover          = $mob_btn_hover ?: '#65E4A3';
$mob_menu_bg            = $mob_menu_bg ?: ($bg ?: '#0A2640');

// Store globally for JS hover script
$boldo_header_btn_styles = [
    'enabled'      => true,
    'text'         => $btn_text,
    'text_hover'   => $btn_text_hover,
    'bg'           => $btn_bg,
    'bg_hover'     => $btn_bg_hover,
    'border'       => $btn_border,
    'border_width' => $btn_border_width,
];

// =========================
// SAFE FALLBACKS FOR OTHER FIELDS
// =========================
$header_val = function ($value, $default = '') {
    return ($value !== null && $value !== '') ? $value : $default;
};

$bg         = $header_val($bg);
$menu_color = $header_val($menu_color, '#0A2640');
$menu_hover = $header_val($menu_hover, '#65E4A3');

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">

    <?php wp_head(); ?>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
</head>

<body <?php body_class('bg-white text-gray-900 antialiased'); ?>>

<!-- =========================
     HEADER
========================= -->
<header class="relative z-20 site-header
<?php if($custom && $transparent): ?>
    bg-transparent absolute w-full
<?php endif; ?>
">
    <div class="max-w-[1220px] mx-auto px-5 pt-6 md:pt-10 flex items-center justify-between relative z-10">

        <!-- LOGO -->
        <div>
        <?php
        $acf_logo = $acf_get('header_custom_logo');
        $acf_logo_url = '';

        if (is_string($acf_logo)) {
            $acf_logo_url = $acf_logo;
        } elseif (is_numeric($acf_logo)) {
            $acf_logo_url = wp_get_attachment_image_url((int) $acf_logo, 'full') ?: '';
        } elseif (is_array($acf_logo)) {
            if (!empty($acf_logo['url']) && is_string($acf_logo['url'])) {
                $acf_logo_url = $acf_logo['url'];
            } elseif (!empty($acf_logo['ID'])) {
                $acf_logo_url = wp_get_attachment_image_url((int) $acf_logo['ID'], 'full') ?: '';
            }
        }

        $theme_logo = get_theme_mod('boldo_header_logo', '');
        ?>

        <?php if ($custom && !empty($acf_logo_url)): ?>
          <a href="<?php echo esc_url(home_url('/')); ?>">
            <img src="<?php echo esc_url($acf_logo_url); ?>" alt="<?php bloginfo('name'); ?> Logo">
          </a>

        <?php elseif (!empty($theme_logo)) : ?>
          <a href="<?php echo esc_url(home_url('/')); ?>">
            <img src="<?php echo esc_url($theme_logo); ?>" alt="<?php bloginfo('name'); ?> Logo">
          </a>

        <?php elseif (function_exists('the_custom_logo') && has_custom_logo()) : ?>
          <?php the_custom_logo(); ?>

        <?php else : ?>
          <a href="<?php echo esc_url(home_url('/')); ?>">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Logo.svg" alt="<?php bloginfo('name'); ?> Logo">
          </a>
        <?php endif; ?>
        </div>

        <!-- NAV -->
        <nav>
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container'      => false,
                'menu_id'        => 'mainMenu',
                // CHANGED: md -> lg so tablet (768-1023px) also shows hamburger
                'menu_class'     => 'main-menu bg-[#0A2640] hidden lg:flex items-center gap-6 lg:gap-10 flex-col lg:flex-row absolute lg:static top-24 lg:top-auto left-0 w-full lg:w-auto lg:bg-transparent p-6 lg:p-0 space-y-6 lg:space-y-0',
                'fallback_cb'    => false,
                'depth'          => 1,
            ]);
            ?>

            <!-- Mobile + Tablet Menu Button (hidden only on lg and above) -->
            <button id="menuBtn"
                class="lg:hidden border-2 rounded-full p-2 transition-colors duration-300"
                style="border-color:<?php echo esc_attr($mob_btn_color); ?>;color:<?php echo esc_attr($mob_btn_color); ?>;"
                data-color="<?php echo esc_attr($mob_btn_color); ?>"
                data-hover="<?php echo esc_attr($mob_btn_hover); ?>">
                <svg width="24" height="24">
                    <path d="M3 6h18M3 12h18M3 18h18"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round" />
                </svg>
            </button>
        </nav>
    </div>
</header>

<!-- =========================
     ACF INLINE STYLES
========================= -->
<?php if($custom): ?>
<style>
/* HEADER BACKGROUND */
.site-header {
<?php if(!$transparent && $bg): ?>
    background-color: <?php echo esc_attr($bg); ?>;
<?php endif; ?>
}

/* MENU COLORS (DESKTOP) */
.site-header #mainMenu > li > a {
  color: <?php echo esc_attr($menu_color); ?> !important;
}
.site-header #mainMenu > li > a:hover {
  color: <?php echo esc_attr($menu_hover); ?> !important;
}

/* MENU BACKGROUND (MOBILE + TABLET) */
@media (max-width: 1023px) {
    .site-header .main-menu {
        background-color: <?php echo esc_attr($mob_menu_bg); ?>;
    }
}

/* MOBILE + TABLET MENU BUTTON */
@media (max-width: 1023px) {
    #menuBtn {
        border-color: <?php echo esc_attr($mob_btn_color); ?> !important;
        color: <?php echo esc_attr($mob_btn_color); ?> !important;
    }
    #menuBtn:hover {
        border-color: <?php echo esc_attr($mob_btn_hover); ?> !important;
        color: <?php echo esc_attr($mob_btn_hover); ?> !important;
    }
}

/* HEADER BUTTON */
.site-header .header-btn,
.site-header #mainMenu .header-btn,
.site-header .main-menu .header-btn,
.site-header a.header-btn,
#mainMenu .header-btn,
#mainMenu a.header-btn,
.main-menu .header-btn,
.main-menu a.header-btn,
a.header-btn,
.site-header #mainMenu > li > a.header-btn,
.site-header .main-menu > li > a.header-btn,
.site-header #mainMenu li.menu-item-cta > a,
.site-header .main-menu li.menu-item-cta > a,
#mainMenu li.menu-item-cta > a {
  color: <?php echo esc_attr($btn_text); ?> !important;
  background-color: <?php echo esc_attr($btn_bg); ?> !important;
  border: <?php echo intval($btn_border_width); ?>px solid <?php echo esc_attr($btn_border); ?> !important;
  border-radius: 9999px !important;
  padding: 0.5rem 2.5rem !important;
  font-weight: 700 !important;
  font-family: 'Open Sans', sans-serif !important;
  font-size: 1rem !important;
  line-height: 1.5rem !important;
  transition: all 0.3s ease !important;
  display: inline-block !important;
}

.site-header .header-btn:hover,
.site-header #mainMenu .header-btn:hover,
.site-header .main-menu .header-btn:hover,
.site-header a.header-btn:hover,
#mainMenu .header-btn:hover,
#mainMenu a.header-btn:hover,
.main-menu .header-btn:hover,
.main-menu a.header-btn:hover,
a.header-btn:hover,
.site-header #mainMenu > li > a.header-btn:hover,
.site-header .main-menu > li > a.header-btn:hover,
.site-header #mainMenu li.menu-item-cta > a:hover,
.site-header .main-menu li.menu-item-cta > a:hover,
#mainMenu li.menu-item-cta > a:hover {
  color: <?php echo esc_attr($btn_text_hover); ?> !important;
  background-color: <?php echo esc_attr($btn_bg_hover); ?> !important;
  border-color: <?php echo esc_attr($btn_border_hover); ?> !important;
}

/* Mobile + Tablet responsive button */
@media (max-width: 1023px) {
    .site-header .header-btn,
    .site-header a.header-btn,
    #mainMenu .header-btn,
    .main-menu .header-btn,
    #mainMenu li.menu-item-cta > a,
    .main-menu li.menu-item-cta > a {
        padding: 0.5rem 1.5rem !important;
        font-size: 0.875rem !important;
    }
}
</style>
<?php endif; ?>