<?php
/**
 * Values Section Block Template
 */

// Get ACF Fields
$section_label = get_field('section_label');
$section_heading = get_field('section_heading');
$section_description = get_field('section_description');
$values_items = get_field('values_items');

// Color Options
$background_color = get_field('background_color') ?: '#0A2640';
$label_color = get_field('label_color') ?: '#FFFFFF';
$heading_color = get_field('heading_color') ?: '#FFFFFF';
$description_color = get_field('description_color') ?: '#F1F1F1';
$item_title_color = get_field('item_title_color') ?: '#FFFFFF';
$item_description_color = get_field('item_description_color') ?: '#F1F1F1';
?>

<!--Value Section-->
<section class="py-12 sm:py-16 md:py-20 lg:py-[120px] px-5"
    style="background-color: <?php echo esc_attr($background_color); ?>;">
    <div class="max-w-[880px] mx-auto pl-0 sm:pl-8 md:pl-12 lg:pl-10">
        
        <!-- Header Section -->
        <div class="mb-12 sm:mb-16 md:mb-20 lg:mb-[72px] max-w-[800px]">
            <?php if ($section_label) : ?>
                <p class="font-opensans font-normal text-base sm:text-lg md:text-xl/8 mb-3"
                   style="color: <?php echo esc_attr($label_color); ?>;">
                    <?php echo esc_html($section_label); ?>
                </p>
            <?php endif; ?>

            <?php if ($section_heading) : ?>
                <h1 class="font-manrope font-normal text-3xl sm:text-4xl md:text-5xl leading-tight sm:leading-[56px] md:leading-[72px] mb-4 sm:mb-5 md:mb-6"
                    style="color: <?php echo esc_attr($heading_color); ?>;">
                    <?php echo esc_html($section_heading); ?>
                </h1>
            <?php endif; ?>

            <?php if ($section_description) : ?>
                <p class="font-opensans font-normal text-base sm:text-lg md:text-xl/8"
                   style="color: <?php echo esc_attr($description_color); ?>;">
                    <?php echo esc_html($section_description); ?>
                </p>
            <?php endif; ?>
        </div>

        <!-- Values Items -->
        <?php if (!empty($values_items)) : ?>
            <div class="space-y-10 sm:space-y-14 md:space-y-16 lg:space-y-[72px] max-w-[800px]">
                
                <?php foreach ($values_items as $item) : 
                    $icon = $item['value_icon'];
                    $title = $item['value_title'];
                    $description = $item['value_description'];
                ?>
                    <div class="flex flex-col sm:flex-row gap-6 sm:gap-8 md:gap-10 lg:gap-[50px] items-start">
                        
                        <!-- Icon -->
                        <?php if ($icon) : ?>
                            <div class="flex-shrink-0">
                                <div class="rounded-2xl flex items-center justify-center">
                                    <img src="<?php echo esc_url($icon['url']); ?>" 
                                         alt="<?php echo esc_attr($title ?: $icon['alt']); ?>"
                                         class="w-20 h-20 sm:w-24 sm:h-24 md:w-auto md:h-auto">
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Content -->
                        <div class="flex-1">
                            <?php if ($title) : ?>
                                <h3 class="font-manrope text-2xl sm:text-[26px] md:text-[28px] font-normal leading-relaxed sm:leading-[44px] md:leading-[48px] mb-3 sm:mb-4"
                                    style="color: <?php echo esc_attr($item_title_color); ?>;">
                                    <?php echo esc_html($title); ?>
                                </h3>
                            <?php endif; ?>

                            <?php if ($description) : ?>
                                <p class="font-opensans text-base sm:text-lg md:text-xl/8 font-normal"
                                   style="color: <?php echo esc_attr($item_description_color); ?>;">
                                    <?php echo esc_html($description); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        <?php endif; ?>

    </div>
</section>