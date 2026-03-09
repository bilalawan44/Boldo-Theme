<?php
/**
 * About Images Gallery Block Template
 */

// Get ACF Fields
$left_image_1 = get_field('left_image_1');
$left_image_2 = get_field('left_image_2');
$center_image = get_field('center_image');
$right_image_1 = get_field('right_image_1');
$right_image_2 = get_field('right_image_2');

// Background Color
$background_color = get_field('background_color') ?: '#ffffff';
?>

<!--Image Section-->
<section class="max-w-[1102px] mx-auto pb-[18px] md:pb-[20px] lg:pb-[22px] xl:pb-[22px] relative mt-[-96px] px-4 sm:px-6 md:px-8 lg:px-2 xl:px-2">
    <div class="
        grid
        grid-cols-1 gap-4
        sm:grid-cols-3 sm:gap-3
        md:grid-cols-3 md:gap-4 lg:grid-cols-3 lg:gap-4
        xl:grid-cols-[300px_400px_300px] xl:gap-[50px] justify-items-stretch md:justify-items-center 
    ">

        <!-- Left Side -->
        <div class="flex flex-col items-stretch md:items-center gap-[40px] md:gap-[25px] lg:gap-[40px] xl:gap-[40px]">
            <?php if ($left_image_1) : ?>
                <div class="w-full md:w-[200px] lg:w-[250px] xl:w-[300px] max-w-full rounded-xl overflow-hidden">
                    <img src="<?php echo esc_url($left_image_1['url']); ?>" 
                         alt="<?php echo esc_attr($left_image_1['alt']); ?>" 
                         class="w-full h-full object-cover" />
                </div>
            <?php endif; ?>
            
            <?php if ($left_image_2) : ?>
                <div class="w-full md:w-[200px] lg:w-[250px] xl:w-[300px] max-w-full rounded-xl overflow-hidden">
                    <img src="<?php echo esc_url($left_image_2['url']); ?>" 
                         alt="<?php echo esc_attr($left_image_2['alt']); ?>" 
                         class="w-full h-full object-cover" />
                </div>
            <?php endif; ?>
        </div>

        <!-- Center Big Image -->
        <div class="w-full md:w-[264px] lg:w-[337px] xl:w-[400px] flex items-center justify-center">
            <?php if ($center_image) : ?>
                <div class="w-full rounded-xl overflow-hidden">
                    <img src="<?php echo esc_url($center_image['url']); ?>" 
                         alt="<?php echo esc_attr($center_image['alt']); ?>" 
                         class="w-full h-full object-cover" />
                </div>
            <?php endif; ?>
        </div>

        <!-- Right Side -->
        <div class="flex flex-col items-stretch md:items-center gap-[40px] md:gap-[25px] lg:gap-[40px] xl:gap-[40px]">
            <?php if ($right_image_1) : ?>
                <div class="w-full md:w-[200px] lg:w-[250px] xl:w-[302px] max-w-full rounded-xl overflow-hidden">
                    <img src="<?php echo esc_url($right_image_1['url']); ?>" 
                         alt="<?php echo esc_attr($right_image_1['alt']); ?>" 
                         class="w-full h-full object-cover" />
                </div>
            <?php endif; ?>
            
            <?php if ($right_image_2) : ?>
                <div class="w-full md:w-[200px] lg:w-[250px] xl:w-[302px] max-w-full rounded-xl overflow-hidden">
                    <img src="<?php echo esc_url($right_image_2['url']); ?>" 
                         alt="<?php echo esc_attr($right_image_2['alt']); ?>" 
                         class="w-full h-full object-cover" />
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>