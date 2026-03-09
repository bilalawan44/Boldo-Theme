<?php
$heading        = get_field('heading');
$subheading     = get_field('description');
$btn1           = get_field('primary_button');
$btn2           = get_field('secondary_button');
$hero_image     = get_field('hero_image');
$logos_carousel = get_field('logos_carousel');

// Background Colors
$bg_color       = get_field('bg_color') ?: '#0A2640';
$circle_color   = get_field('circle_color') ?: '#1C3D5B';

// Text Colors
$heading_color     = get_field('heading_color') ?: '#FFFFFF';
$desc_color        = get_field('description_color') ?: '#FFFFFF';

// Primary Button Colors
$btn1_bg           = get_field('btn1_bg') ?: '#FFFFFF';
$btn1_text         = get_field('btn1_text') ?: '#0A2640';
$btn1_hover_bg     = get_field('btn1_hover_bg') ?: '#65E4A3';
$btn1_hover_text   = get_field('btn1_hover_text') ?: '#0A2640';
$btn1_border       = get_field('btn1_border') ?: 'transparent';
$btn1_hover_border = get_field('btn1_hover_border') ?: 'transparent';

// Secondary Button Colors
$btn2_bg           = get_field('btn2_bg') ?: 'transparent';
$btn2_text         = get_field('btn2_text') ?: '#FFFFFF';
$btn2_hover_bg     = get_field('btn2_hover_bg') ?: '#65E4A3';
$btn2_hover_text   = get_field('btn2_hover_text') ?: '#0A2640';
$btn2_border       = get_field('btn2_border') ?: '#FFFFFF';
$btn2_hover_border = get_field('btn2_hover_border') ?: '#65E4A3';

// Marquee Settings
$show_marquee       = get_field('show_logo_marquee'); // true/false
$marquee_fade_color = get_field('marquee_fade_color') ?: '#0A2640';

// Unique ID for scoped CSS
$section_id = 'hero-' . get_the_ID();
?>

<style>
#<?php echo $section_id; ?> .hero-bg-rect {
    fill: <?php echo esc_attr($bg_color); ?>;
}
#<?php echo $section_id; ?> .hero-bg-circle {
    fill: <?php echo esc_attr($circle_color); ?>;
}
#<?php echo $section_id; ?> .hero-heading {
    color: <?php echo esc_attr($heading_color); ?>;
}
#<?php echo $section_id; ?> .hero-description {
    color: <?php echo esc_attr($desc_color); ?>;
}

/* Primary Button */
#<?php echo $section_id; ?> .btn-primary {
    background-color: <?php echo esc_attr($btn1_bg); ?>;
    color: <?php echo esc_attr($btn1_text); ?>;
    border: 2px solid <?php echo esc_attr($btn1_border); ?>;
}
#<?php echo $section_id; ?> .btn-primary:hover {
    background-color: <?php echo esc_attr($btn1_hover_bg); ?>;
    color: <?php echo esc_attr($btn1_hover_text); ?>;
    border-color: <?php echo esc_attr($btn1_hover_border); ?>;
}

/* Secondary Button */
#<?php echo $section_id; ?> .btn-secondary {
    background-color: <?php echo esc_attr($btn2_bg); ?>;
    color: <?php echo esc_attr($btn2_text); ?>;
    border: 2px solid <?php echo esc_attr($btn2_border); ?>;
}
#<?php echo $section_id; ?> .btn-secondary:hover {
    background-color: <?php echo esc_attr($btn2_hover_bg); ?>;
    color: <?php echo esc_attr($btn2_hover_text); ?>;
    border-color: <?php echo esc_attr($btn2_hover_border); ?>;
}

/* Marquee Fade - Dynamic Color using pseudo elements */
#<?php echo $section_id; ?> .logo-marquee-fade {
    position: relative;
}
#<?php echo $section_id; ?> .logo-marquee-fade::before,
#<?php echo $section_id; ?> .logo-marquee-fade::after {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    width: 15%;
    z-index: 2;
    pointer-events: none;
}
#<?php echo $section_id; ?> .logo-marquee-fade::before {
    left: 0;
    background: linear-gradient(to right, <?php echo esc_attr($marquee_fade_color); ?> 0%, transparent 100%);
}
#<?php echo $section_id; ?> .logo-marquee-fade::after {
    right: 0;
    background: linear-gradient(to left, <?php echo esc_attr($marquee_fade_color); ?> 0%, transparent 100%);
}
#<?php echo $section_id; ?> .logo-marquee-fade:hover .logo-marquee-track {
    animation-play-state: paused;
}

</style>

<!-- Hero Section -->
<section id="<?php echo $section_id; ?>" class="relative overflow-hidden mt-[-68px] md:mt-[-86px] lg:mt-[-99px]">

    <!-- SVG Background -->
    <svg class="absolute inset-0 w-full h-full" viewBox="0 0 1400 798" preserveAspectRatio="xMidYMid slice"
        xmlns="http://www.w3.org/2000/svg">
        <rect class="hero-bg-rect" width="1400" height="798" fill="<?php echo esc_attr($bg_color); ?>" />
        <circle class="hero-bg-circle" cx="1423.5" cy="-142.5" r="646.5" fill="<?php echo esc_attr($circle_color); ?>" />
    </svg>

    <!-- Hero Content -->
    <div class="max-w-[1220px] mx-auto px-5 relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12 lg:gap-[70px] pt-24 sm:pt-32 md:pt-40 lg:pt-[162px]">

        <!-- Left Content -->
        <div class="max-w-full lg:max-w-[567px] pt-0 md:pt-8 lg:pt-[58px]">

            <?php if ($heading) : ?>
                <h1 class="hero-heading font-manrope font-normal text-3xl sm:text-4xl md:text-[42px] lg:text-5xl leading-tight sm:leading-snug md:leading-[60px] lg:leading-[72px]">
                    <?php echo esc_html($heading); ?>
                </h1>
            <?php endif; ?>

            <?php if ($subheading) : ?>
                <div class="hero-description font-opensans font-normal text-sm sm:text-base/6 md:text-base/7 pt-3 md:pt-4">
                    <?php echo $subheading; ?>
                </div>
            <?php endif; ?>

            <div class="flex flex-col sm:flex-row gap-4 pt-6 md:pt-8 lg:pt-10">

                <?php if ($btn1) : ?>
                    <a href="<?php echo esc_url($btn1['url']); ?>"
                        class="btn-primary font-opensans text-center text-base sm:text-lg md:text-xl/7 px-8 sm:px-10 md:px-12 lg:px-14 py-3 md:py-4 rounded-full font-bold transition-all duration-300 inline-block">
                        <?php echo esc_html($btn1['title']); ?>
                    </a>
                <?php endif; ?>

                <?php if ($btn2) : ?>
                    <a href="<?php echo esc_url($btn2['url']); ?>"
                        class="btn-secondary font-opensans text-center text-base sm:text-lg md:text-xl/7 px-8 sm:px-10 md:px-12 lg:px-14 py-3 md:py-4 rounded-full font-bold transition-all duration-300 inline-block">
                        <?php echo esc_html($btn2['title']); ?>
                    </a>
                <?php endif; ?>

            </div>

        </div>

        <!-- Right Content -->
        <div class="max-w-full relative sm:max-w-[450px] md:max-w-[400px] lg:max-w-[493px] left-0 xl:left-[70px] mx-auto lg:mx-0 mt-8 lg:mt-0">

            <?php if ($hero_image) : ?>
                <img src="<?php echo esc_url($hero_image['url']); ?>"
                     alt="<?php echo esc_attr($hero_image['alt']); ?>"
                     class="w-full h-auto">
            <?php endif; ?>

        </div>

    </div>

    <!-- Logo Carousel - Show/Hide via ACF Toggle -->
    <?php if ($show_marquee && !empty($logos_carousel) && is_array($logos_carousel)) :
        $total_logos = count($logos_carousel);
    ?>
        <div class="max-w-[1220px] mx-auto px-5 pt-12 md:pt-16 lg:pt-20 pb-12 md:pb-16 lg:pb-[64px] relative z-10">
            <div class="logo-marquee-fade overflow-hidden">
                <div class="logo-marquee-track gap-10">
                    <div class="logo-marquee-group gap-10">
                        <?php
                        for ($i = 0; $i < ($total_logos * 4); $i++) :
                            $index = $i % $total_logos;
                            $item  = $logos_carousel[$index];
                            if (isset($item['logos']) && !empty($item['logos']['url'])) :
                                $logo = $item['logos'];
                        ?>
                            <img src="<?php echo esc_url($logo['url']); ?>"
                                 alt="<?php echo esc_attr($logo['alt'] ?? ''); ?>"
                                 class="w-auto object-contain opacity-100 hover:opacity-100 transition-all duration-300">
                        <?php
                            endif;
                        endfor;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

</section>