<?php
/**
 * Our Story Block Template
 */

// Get ACF Fields
$story_label = get_field('story_label');
$story_heading = get_field('story_heading');
$story_description = get_field('story_description');

// Color Options
$background_color = get_field('background_color') ?: '#ffffff';
$label_color = get_field('label_color') ?: '#777777';
$heading_color = get_field('heading_color') ?: '#000000';
$description_color = get_field('description_color') ?: '#777777';
?>

<!--Our Story Section-->
<section class="px-5 py-10 sm:px-5 sm:py-14 md:py-20 lg:py-24 xl:py-[120px]"
    style="background-color: <?php echo esc_attr($background_color); ?>;">
    <div class="max-w-[801px] mx-auto">

        <!-- Our Story Label -->
        <?php if ($story_label) : ?>
            <p class="font-opensans font-normal text-sm/5 sm:text-base/6 md:text-lg/7 xl:text-xl/8 mb-2 sm:mb-2.5 xl:mb-3"
               style="color: <?php echo esc_attr($label_color); ?>;">
                <?php echo esc_html($story_label); ?>
            </p>
        <?php endif; ?>

        <!-- Heading -->
        <?php if ($story_heading) : ?>
            <h2 class="font-manrope font-normal text-lg leading-[34px] sm:text-3xl sm:leading-[40px] md:text-4xl md:leading-[52px] lg:text-[42px] lg:leading-[60px] xl:text-5xl xl:leading-[72px] mb-4 sm:mb-5 md:mb-6 xl:mb-7"
                style="color: <?php echo esc_attr($heading_color); ?>;">
                <?php echo esc_html($story_heading); ?>
            </h2>
        <?php endif; ?>

        <!-- Paragraph -->
        <?php if ($story_description) : ?>
            <div class="font-opensans font-normal text-sm/5 sm:text-base/6 md:text-lg/7 xl:text-xl/8"
                 style="color: <?php echo esc_attr($description_color); ?>;">
                <?php echo wp_kses_post($story_description); ?>
            </div>
        <?php endif; ?>

    </div>
</section>