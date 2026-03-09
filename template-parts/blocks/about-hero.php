<?php
/**
 * About Hero Block Template
 */

// Get ACF Fields
$label_text = get_field('label_text');
$main_heading = get_field('main_heading');
$description_text = get_field('description_text');

// Color Options
$background_color = get_field('background_color') ?: '#0A2640';
$label_color = get_field('label_color') ?: '#F1F1F1';
$heading_color = get_field('heading_color') ?: '#ffffff';
$description_color = get_field('description_color') ?: '#F1F1F1';
?>

<!-- Hero Section -->
<section class="mx-auto px-5 flex items-center justify-center pb-[166px] pt-[140px] sm:pt-[150px] md:pt-[160px] lg:pt-[170px] xl:pt-[170px] relative overflow-hidden mt-[-68px] md:mt-[-82px] lg:mt-[-99px] xl-[-99px]"
    style="background-color: <?php echo esc_attr($background_color); ?>;">
    <div class="w-full max-w-[888px] mx-auto lg:px-5 text-center">
        
        <!-- About Label -->
        <?php if ($label_text) : ?>
            <p class="font-opensans font-normal text-base sm:text-lg md:text-xl/8 mb-4 sm:mb-5 md:mb-6"
               style="color: <?php echo esc_attr($label_color); ?>;">
                <?php echo esc_html($label_text); ?>
            </p>
        <?php endif; ?>

        <!-- Main Heading -->
        <?php if ($main_heading) : ?>
            <h1 class="font-manrope text-3xl sm:text-4xl md:text-5xl lg:text-[56px] xl:text-[64px] font-normal leading-tight sm:leading-[1.3] md:leading-[1.3] lg:leading-[72px] xl:leading-[84px] mb-4 sm:mb-5 md:mb-6"
                style="color: <?php echo esc_attr($heading_color); ?>;">
                <?php echo esc_html($main_heading); ?>
            </h1>
        <?php endif; ?>

        <!-- Description Text -->
        <?php if ($description_text) : ?>
            <p class="font-opensans font-normal text-sm sm:text-base/7 px-0 sm:px-4 md:px-8 lg:px-10 xl:px-12"
               style="color: <?php echo esc_attr($description_color); ?>;">
                <?php echo esc_html($description_text); ?>
            </p>
        <?php endif; ?>
        
    </div>
</section>
