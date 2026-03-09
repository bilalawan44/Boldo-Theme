<?php
/**
 * Value Items Block Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Get ACF fields
$section_heading = get_field('section_heading');
$section_heading_color = get_field('section_heading_color') ?: '#FFFFFF';
$section_subheading = get_field('section_subheading');
$section_subheading_color = get_field('section_subheading_color') ?: '#FFFFFF';
$background_color = get_field('background_color') ?: '#0A2640';
$divider_color = get_field('divider_color') ?: '#FFFFFF';
$value_items = get_field('value_items');
?>

<!--Blog Section-->
<section style="background-color: <?php echo esc_attr($background_color); ?>;">
    <div class="max-w-[1220px] mx-auto grid place-items-center px-5 sm:px-5 md:px-8 lg:px-10 xl:px-5 py-12 sm:py-16 md:py-20 lg:py-24 xl:py-[120px]">
        <div class="w-full max-w-[1100px]">
            <!-- Header -->
            <?php if( $section_heading || $section_subheading ): ?>
            <div class="text-center mb-8 sm:mb-10 md:mb-12">
                <?php if( $section_heading ): ?>
                <p class="text-base sm:text-lg md:text-xl/8 font-normal font-opensans mb-2 sm:mb-3 opacity-100" style="color: <?php echo esc_attr($section_heading_color); ?>;">
                    <?php echo esc_html($section_heading); ?>
                </p>
                <?php endif; ?>
                
                <?php if( $section_subheading ): ?>
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-manrope font-normal leading-tight sm:leading-snug md:leading-[1.4] lg:leading-[72px] opacity-100" style="color: <?php echo esc_attr($section_subheading_color); ?>;">
                    <?php echo wp_kses_post($section_subheading); ?>
                </h1>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <!-- Divider -->
            <div class="w-full h-[1px] opacity-100 mb-10 sm:mb-12 md:mb-16 lg:mb-20" style="background-color: <?php echo esc_attr($divider_color); ?>;"></div>

            <!-- Value Propositions Grid -->
            <?php if( $value_items ): ?>
            <div class="grid gap-10 sm:gap-12 md:gap-16 lg:gap-20">
                <?php foreach( $value_items as $item ): 
                    $prefix_color = !empty($item['heading_prefix_color']) ? $item['heading_prefix_color'] : '#FFFFFF';
                    $highlight_color = !empty($item['heading_highlight_color']) ? $item['heading_highlight_color'] : '#65E4A3';
                    $desc_color = !empty($item['description_color']) ? $item['description_color'] : '#F1F1F1';
                ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 md:gap-12 lg:gap-16 xl:gap-20 items-start">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-normal font-manrope leading-tight sm:leading-snug md:leading-[1.4] lg:leading-[72px] opacity-100" style="color: <?php echo esc_attr($prefix_color); ?>;">
                        <?php echo esc_html($item['heading_prefix']); ?> <span style="color: <?php echo esc_attr($highlight_color); ?>;"><?php echo esc_html($item['heading_highlight']); ?></span>
                    </h2>
                    <p class="text-base sm:text-lg md:text-xl/8 font-normal font-opensans opacity-100" style="color: <?php echo esc_attr($desc_color); ?>;">
                        <?php echo esc_html($item['description']); ?>
                    </p>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>