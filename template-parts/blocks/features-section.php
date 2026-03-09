<?php
/**
 * Two-Row Feature Section Template
 * Displays features with images in a responsive two-column layout
 */

if (!defined('ABSPATH')) {
    exit;
}

// ===== FIRST ROW - Image & Features =====
$first_row_image    = get_field('first_row_image');
$first_row_heading  = get_field('first_row_heading');
$first_row_features = get_field('first_row_features');

// ===== SECOND ROW - List & CTA =====
$second_row_heading = get_field('second_row_heading');
$second_row_list    = get_field('second_row_list');
$second_row_button  = get_field('second_row_button');
$second_row_image   = get_field('second_row_image');
?>

<section class="feature-section">
    <div class="max-w-[1220px] mx-auto bg-white mt-4 lg:mt-8 xl:mt-[112px] mb-8 lg:mb-[96px] xl:mb-[120px] px-5 lg:px-[60px] xl:px-10">

        <!-- ================= FIRST ROW - Features ================= -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-[150px] mb-12 lg:mb-[96px] xl:mb-[120px] items-center">

            <!-- Image Column -->
            <?php if ($first_row_image): ?>
                <div class="w-full mx-auto">
                    <img 
                        src="<?php echo esc_url($first_row_image['url']); ?>"
                        alt="<?php echo esc_attr($first_row_image['alt']); ?>"
                        class="w-full h-auto object-cover rounded-lg"
                    >
                </div>
            <?php endif; ?>

            <!-- Features Column -->
            <div class="features-content">
                
                <!-- Heading -->
                <?php if ($first_row_heading): ?>
                    <h2 class="font-manrope text-xl md:text-3xl lg:text-4xl font-normal text-black mb-6 lg:mb-10 leading-tight lg:leading-[56px] text-center lg:text-left">
                        <?php echo esc_html($first_row_heading); ?>
                    </h2>
                <?php endif; ?>

                <!-- Features List -->
                <?php if ($first_row_features): ?>
                    <ul class="space-y-4 lg:space-y-6">
                        <?php foreach ($first_row_features as $item):
                            $feature_color = !empty($item['feature_color']) ? $item['feature_color'] : '#0A2640';
                            $icon = $item['feature_icon'];
                            
                            // Ensure SVG uses currentColor for proper theming
                            $icon = str_replace(
                                ['stroke="#0A2640"', 'stroke="#000000"'],
                                'stroke="currentColor"',
                                $icon
                            );
                            $icon = str_replace(
                                ['fill="#0A2640"', 'fill="#000000"'],
                                'fill="currentColor"',
                                $icon
                            );
                            
                            // Add hover classes for smooth transitions
                            $icon = preg_replace(
                                '/stroke="currentColor"/',
                                'stroke="currentColor" class="group-hover:stroke-white transition-colors duration-300"',
                                $icon
                            );
                            $icon = preg_replace(
                                '/fill="currentColor"/',
                                'fill="currentColor" class="group-hover:fill-white transition-colors duration-300"',
                                $icon
                            );
                        ?>
                            <li 
                                class="group rounded-md flex items-start px-4 lg:px-6 py-4 lg:py-5 shadow-md hover:text-white hover:bg-[#0A2640] transition-colors duration-300 gap-3"
                                style="color: <?php echo esc_attr($feature_color); ?>;"
                            >
                                <?php if (!empty($icon)): ?>
                                    <div class="flex-shrink-0 transition-colors duration-300" style="color: inherit;">
                                        <div class="transition-colors duration-300 group-hover:fill-white group-hover:stroke-white">
                                            <?php echo $icon; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($item['feature_text'])): ?>
                                    <span class="font-opensans text-sm lg:text-base/7 font-semibold group-hover:text-white transition-colors duration-300">
                                        <?php echo esc_html($item['feature_text']); ?>
                                    </span>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

            </div>
        </div>

        <!-- ================= SECOND ROW - List & CTA ================= -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-[150px] items-center">

            <!-- Text Column -->
            <div class="text-content order-2 lg:order-1">
                
                <!-- Heading -->
                <?php if ($second_row_heading): ?>
                    <h2 class="font-manrope text-xl md:text-3xl lg:text-4xl font-normal text-black mb-6 lg:mb-10 leading-tight lg:leading-[56px] text-center lg:text-left">
                        <?php echo esc_html($second_row_heading); ?>
                    </h2>
                <?php endif; ?>

                <!-- Checklist -->
                <?php if ($second_row_list): ?>
                    <ul class="space-y-4 lg:space-y-6">
                        <?php foreach ($second_row_list as $row): ?>
                            <li class="flex items-start gap-4 lg:gap-6">
                                
                                <!-- Check Icon -->
                               <div class="w-9 h-9 bg-[#0a2640] rounded-full flex items-center justify-center flex-shrink-0 transition-colors duration-300">
                                    <svg class="w-6 h-6 text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>

                                <span class="font-opensans font-normal text-base lg:text-xl/9 text-black">
                                    <?php echo esc_html($row['list_text']); ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <!-- CTA Button -->
                <?php if ($second_row_button): ?>
                    <div class="text-center lg:text-left">
                        <a 
                            href="<?php echo esc_url($second_row_button['url']); ?>"
                            target="<?php echo esc_attr($second_row_button['target'] ?: '_self'); ?>"
                            class="font-opensans inline-flex mt-[36px] lg:mt-[56px] text-base lg:text-xl/7 border-2 border-[#0A2640] bg-[#0A2640] text-white px-10 lg:px-14 py-3 lg:py-4 rounded-full font-bold hover:bg-white hover:text-[#0A2640] transition-colors duration-300 shadow-lg"
                        >
                            <?php echo esc_html($second_row_button['title']); ?>
                        </a>
                    </div>
                <?php endif; ?>

            </div>

            <!-- Image Column -->
            <?php if ($second_row_image): ?>
                <div class="w-full order-1 lg:order-2">
                    <img 
                        src="<?php echo esc_url($second_row_image['url']); ?>"
                        alt="<?php echo esc_attr($second_row_image['alt']); ?>"
                        class="w-full h-auto object-cover rounded-lg"
                    >
                </div>
            <?php endif; ?>

        </div>

    </div>
</section>