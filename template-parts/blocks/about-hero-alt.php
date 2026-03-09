<?php
/**
 * About Hero Alternative Block Template
 * Two-column layout with label, heading, and description
 */

// Get ACF Fields
$label_text = get_field('label_text');
$heading_text = get_field('heading_text');
$description_text = get_field('description_text');

// Color Options
$background_color = get_field('background_color') ?: '#65E4A3';
$label_color = get_field('label_color') ?: '#0A2640';
$heading_color = get_field('heading_color') ?: '#000000';
$description_color = get_field('description_color') ?: '#0A2640';
?>

<!----Hero Section-->
<section class="pt-[128px] lg:pt-[150px] xl:pt-[194px] pb-12 sm:pb-16 md:pb-20 lg:pb-[96px] mt-[-99px]"
    style="background-color: <?php echo esc_attr($background_color); ?>;">
    <div class="max-w-[1220px] mx-auto px-5">
        
        <?php if ($label_text) : ?>
            <p class="font-opensans font-normal text-base sm:text-lg lg:text-xl/8 mb-3"
               style="color: <?php echo esc_attr($label_color); ?>;">
                <?php echo esc_html($label_text); ?>
            </p>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 sm:gap-10 md:gap-12 lg:gap-[50px] xl:gap-[100px] items-start">
            
            <!-- Left Column - Heading -->
            <div class="w-full lg:w-auto xl:w-[600px]">
                <?php if ($heading_text) : ?>
                    <h1 class="font-manrope font-normal 
                               text-3xl leading-[42px]
                               sm:text-4xl sm:leading-[52px]
                               md:text-[42px] md:leading-[60px]
                               lg:text-4xl lg:leading-[52px]
                               xl:text-5xl xl:leading-[72px]"
                        style="color: <?php echo esc_attr($heading_color); ?>;">
                        <?php echo esc_html($heading_text); ?>
                    </h1>
                <?php endif; ?>
            </div>

            <!-- Right Column - Description -->
            <div class="w-full lg:w-auto lg:pt-5 xl:w-[500px]">
                <?php if ($description_text) : ?>
                    <p class="font-opensans font-normal 
                              text-sm leading-[22px]
                              sm:text-base sm:leading-[26px]
                              lg:text-base/7"
                       style="color: <?php echo esc_attr($description_color); ?>;">
                        <?php echo esc_html($description_text); ?>
                    </p>
                <?php endif; ?>
            </div>
            
        </div>
    </div>
</section>