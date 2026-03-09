<?php
/**
 * Register ACF Blocks
 */

if ( ! function_exists('acf_register_block_type') ) {
    return;
}

add_action('acf/init', function () {

    // Hero Section Block
    acf_register_block_type([
        'name'            => 'hero-section',
        'title'           => __('Hero Section', 'tailpress'),
        'description'     => __('Professional Hero Section', 'tailpress'),
        'render_template' => get_template_directory() . '/template-parts/blocks/hero-section.php',
        'category'        => 'layout',
        'icon'            => 'cover-image',
        'mode'            => 'edit',
        'supports'        => [
            'align' => false,
        ],
    ]);
      // Services Section Block
    acf_register_block_type([
        'name'            => 'services-section',
        'title'           => __('Services Section', 'tailpress'),
        'description'     => __('Services section with repeatable cards', 'tailpress'),
        'render_template' => get_template_directory() . '/template-parts/blocks/services-section.php',
        'category'        => 'layout',
        'icon'            => 'grid-view',
        'mode'            => 'edit',
        'supports'        => [
            'align' => false,
        ],
    ]);
    // Feature Section Block
    acf_register_block_type([
            'name'            => 'features-section',
            'title'           => __('Features Section'),
            'description'     => __('Custom Features Section with icons'),
            'render_template' => get_template_directory() . '/template-parts/blocks/features-section.php',
            'category'        => 'layout',
            'icon'            => 'grid-view',
            'keywords'        => ['features', 'icons', 'section'],
        ]);
   
   // Register Testimonial Section Block
  acf_register_block_type([
        'name'              => 'testimonial-section',
        'title'             => __('Testimonials Section'),
        'description'       => __('Testimonials slider section'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/testimonial-section.php',
        'category'          => 'formatting',
        'icon'              => 'format-quote',
        'keywords'          => ['testimonial', 'slider'],
        'mode'              => 'edit',
        'supports'          => [
            'align' => false,
        ],
    ]);
    // Banner Section Block
     acf_register_block_type([
        'name'            => 'banner-accordion-section',
        'title'           => __('Banner Accordion Section'),
        'description'     => __('Banner image with heading and accordion'),
        'render_template' => get_template_directory() . '/template-parts/blocks/banner-accordion-section.php',
        'category'        => 'formatting',
        'icon'            => 'align-wide',
        'keywords'        => ['banner', 'accordion'],
        'mode'            => 'edit',
        'supports'        => [
            'align' => false,
        ],
    ]);
    //Call to Action Section Block
  acf_register_block_type([
    'name'            => 'cta-section',
    'title'           => __('CTA Section'),
    'description'     => __('Call to action email section'),
    'render_template' => get_template_directory() . '/template-parts/blocks/cta-section.php',
    'category'        => 'formatting',
    'icon'            => 'megaphone',
    'keywords'        => ['cta', 'email'],
    'mode'            => 'edit',
    'supports'        => [
        'align' => false,
    ],
]);
//Blog Section
acf_register_block_type([
    'name'            => 'blog-posts-section',
    'title'           => __('Blog Posts Section'),
    'description'     => __('Blog posts grid with load more'),
    'render_template' => get_template_directory() . '/template-parts/blocks/blog-posts-section.php',
    'category'        => 'formatting',
    'icon'            => 'admin-post',
    'keywords'        => ['blog', 'posts'],
    'mode'            => 'edit',
    'supports'        => [
        'align' => false,
    ],
]);
// Register About Hero Block
        acf_register_block_type(array(
            'name'              => 'about-hero',
            'title'             => __('About Hero Section'),
            'description'       => __('Hero section for About page with customizable colors'),
            'render_template'   => 'template-parts/blocks/about-hero.php',
            'category'          => 'formatting',
            'icon'              => 'cover-image',
            'keywords'          => array( 'hero', 'about', 'banner' ),
            'mode'              => 'edit',
            'supports'          => array(
                'align' => false,
                'mode' => false,
                'jsx' => true
            ),
        ));
              // Register About Images Gallery Block
        acf_register_block_type(array(
            'name'              => 'about-images-gallery',
            'title'             => __('About Images Gallery'),
            'description'       => __('Image gallery with 5 images layout'),
            'render_template'   => 'template-parts/blocks/about-images-gallery.php',
            'category'          => 'media',
            'icon'              => 'format-gallery',
            'keywords'          => array( 'images', 'gallery', 'about' ),
            'mode'              => 'edit',
            'supports'          => array(
                'align' => false,
                'mode' => false,
                'jsx' => true
            ),
        ));
          // Register Our Story Block
        acf_register_block_type(array(
            'name'              => 'our-story',
            'title'             => __('Our Story Section'),
            'description'       => __('Story section with label, heading and description'),
            'render_template'   => 'template-parts/blocks/our-story.php',
            'category'          => 'formatting',
            'icon'              => 'editor-alignleft',
            'keywords'          => array( 'story', 'about', 'text' ),
            'mode'              => 'edit',
            'supports'          => array(
                'align' => false,
                'mode' => false,
                'jsx' => true
            ),
        ));
        // Counter Section Block
           acf_register_block_type([
        'name'            => 'counter-section',
        'title'           => __('Counter Section'),
        'description'     => __('Counters with heading and colors'),
        'render_template' => 'template-parts/blocks/counter-section.php',
        'category'        => 'formatting',
        'icon'            => 'chart-bar',
        'keywords'        => ['counter', 'stats'],
        'mode'            => 'edit',
        'supports'        => [
            'align' => false,
        ],
    ]);
       // Register Team Section Block
        acf_register_block_type(array(
            'name'              => 'team-section',
            'title'             => __('Team Section'),
            'description'       => __('Team members grid with customizable colors'),
            'render_template'   => 'template-parts/blocks/team-section.php',
            'category'          => 'formatting',
            'icon'              => 'groups',
            'keywords'          => array( 'team', 'members', 'staff' ),
            'mode'              => 'edit',
            'supports'          => array(
                'align' => false,
                'mode' => false,
                'jsx' => true
            ),
        ));
          // Register Values Section Block
        acf_register_block_type(array(
            'name'              => 'values-section',
            'title'             => __('Values Section'),
            'description'       => __('Values/principles section with icons and descriptions'),
            'render_template'   => 'template-parts/blocks/values-section.php',
            'category'          => 'formatting',
            'icon'              => 'star-filled',
            'keywords'          => array( 'values', 'principles', 'beliefs' ),
            'mode'              => 'edit',
            'supports'          => array(
                'align' => false,
                'mode' => false,
                'jsx' => true
            ),
        ));
         // Register About Hero Alternative Block
        acf_register_block_type(array(
            'name'              => 'about-hero-alt',
            'title'             => __('About Hero Alternative'),
            'description'       => __('Hero section with two-column layout'),
            'render_template'   => 'template-parts/blocks/about-hero-alt.php',
            'category'          => 'formatting',
            'icon'              => 'cover-image',
            'keywords'          => array( 'hero', 'about', 'header' ),
            'mode'              => 'edit',
            'supports'          => array(
                'align' => false,
                'mode' => false,
                'jsx' => true
            ),
        ));
           // Register Team Alt Section Block
        acf_register_block_type(array(
            'name'              => 'team-alt-section',
            'title'             => __('Team Alt Section'),
            'description'       => __('Team section with large and small members'),
            'render_template'   => 'template-parts/blocks/team-alt-section.php',
            'category'          => 'formatting',
            'icon'              => 'groups',
            'keywords'          => array( 'team', 'members', 'staff', 'alternative' ),
            'mode'              => 'edit',
            'supports'          => array(
                'align' => false,
                'mode' => false,
                'jsx' => true
            ),
        ));
         // Register Value Items Block
    acf_register_block_type(array(
        'name'              => 'value-items',
        'title'             => __('Value Items'),
        'description'       => __('A custom block for displaying value proposition items'),
        'render_template'   => 'template-parts/blocks/value-items.php',
        'category'          => 'formatting',
        'icon'              => 'star-filled',
        'keywords'          => array('value', 'proposition', 'commitment'),
        'mode'              => 'edit',
        'supports'          => array(
            'align' => false,
            'mode' => true,
            'jsx' => true
        ),
    ));
        // Register Value Items Block
    acf_register_block_type(array(
        'name'              => 'value-items',
        'title'             => __('Value Items'),
        'description'       => __('A custom block for displaying value proposition items'),
        'render_template'   => 'template-parts/blocks/value-items.php',
        'category'          => 'formatting',
        'icon'              => 'star-filled',
        'keywords'          => array('value', 'proposition', 'commitment'),
        'mode'              => 'edit',
        'supports'          => array(
            'align' => false,
            'mode' => true,
            'jsx' => true
        ),
    ));
      // Register Blog Hero Block
    acf_register_block_type(array(
        'name'              => 'blog-hero',
        'title'             => __('Blog Hero'),
        'description'       => __('A custom block for displaying blog hero section with featured post'),
        'render_template'   => 'template-parts/blocks/blog-hero.php',
        'category'          => 'formatting',
        'icon'              => 'admin-page',
        'keywords'          => array('blog', 'hero', 'featured', 'post'),
        'mode'              => 'edit',
        'supports'          => array(
            'align' => false,
            'mode' => true,
            'jsx' => true
        ),
    ));
       


   

});

