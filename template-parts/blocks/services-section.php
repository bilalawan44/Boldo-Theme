<?php
$section_label = get_field('section_label');
$section_heading = get_field('section_heading');
$services = get_field('services');

// All Color Options - Individual Control
$background_color = get_field('background_color') ?: '#ffffff';
$label_color = get_field('label_color') ?: '#777777';
$heading_color = get_field('heading_color') ?: '#000000';
$title_color = get_field('title_color') ?: '#000000';
$description_color = get_field('description_color') ?: '#777777';
$link_color = get_field('link_color') ?: '#0A2640';
$link_hover_color = get_field('link_hover_color') ?: '#10b981';
?>

<!-- Services Section -->
<section class="py-8 sm:py-12 lg:py-20 px-4 sm:px-6 lg:px-8" style="background-color: <?php echo esc_attr($background_color); ?>;">
    <div class="max-w-[1140px] mx-auto">

        <!-- Section Header -->
        <div class="text-center mb-10 md:mb-12 lg:mb-16">
            <?php if ($section_label) : ?>
                <p class="font-opensans font-normal text-lg md:text-xl mb-3" 
                   style="color: <?php echo esc_attr($label_color); ?>;">
                    <?php echo esc_html($section_label); ?>
                </p>
            <?php endif; ?>

            <?php if ($section_heading) : ?>
                <h2 class="font-manrope font-normal text-xl md:text-4xl lg:text-5xl leading-tight md:leading-snug lg:leading-[72px] max-w-4xl mx-auto px-4" 
                    style="color: <?php echo esc_attr($heading_color); ?>;">
                    <?php echo esc_html($section_heading); ?>
                </h2>
            <?php endif; ?>
        </div>

        <!-- Cards Grid -->
        <?php if (!empty($services)) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-12 lg:gap-[100px]">

                <?php foreach ($services as $service) : 
                    $image = $service['service_image'];
                    $title = $service['service_title'];
                    $description = $service['service_description'];
                    $link = $service['service_link'];
                ?>
                    <div class="group">
                        <!-- Image -->
                        <?php if ($image) : ?>
                            <div class="max-w-[300px] mb-6 overflow-hidden rounded-lg">
                                <img src="<?php echo esc_url($image['url']); ?>" 
                                     alt="<?php echo esc_attr($image['alt'] ?: $title); ?>">
                            </div>
                        <?php endif; ?>

                        <!-- Content -->
                        <div>
                            <?php if ($title) : ?>
                                <h3 class="font-opensans font-normal text-xl md:text-2xl leading-tight"
                                    style="color: <?php echo esc_attr($title_color); ?>;">
                                    <?php echo esc_html($title); ?>
                                </h3>
                            <?php endif; ?>

                            <?php if ($description) : ?>
                                <p class="font-opensans font-normal text-base md:text-lg lg:text-xl pt-2 lg:pt-3 leading-relaxed"
                                   style="color: <?php echo esc_attr($description_color); ?>;">
                                    <?php echo esc_html($description); ?>
                                </p>
                            <?php endif; ?>

                            <?php if ($link) : ?>
                                <a href="<?php echo esc_url($link['url']); ?>"
                                   target="<?php echo esc_attr($link['target'] ?: '_self'); ?>"
                                   class="service-link inline-flex items-center font-opensans font-bold text-base md:text-lg lg:text-xl transition-colors duration-300 border-b-2 pb-1 pt-7"
                                   style="color: <?php echo esc_attr($link_color); ?>; border-color: <?php echo esc_attr($link_color); ?>;"
                                   onmouseover="this.style.color='<?php echo esc_js($link_hover_color); ?>'; this.style.borderColor='<?php echo esc_js($link_hover_color); ?>';"
                                   onmouseout="this.style.color='<?php echo esc_js($link_color); ?>'; this.style.borderColor='<?php echo esc_js($link_color); ?>';">
                                    <?php echo esc_html($link['title'] ?: 'Explore page'); ?>
                                    <svg class="group-hover:translate-x-1 transition-transform duration-300 ml-3 w-5 h-5 md:w-6 md:h-6"
                                        width="24" height="26" viewBox="0 0 24 26" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 14H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M12 7L19 14L12 21" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        <?php endif; ?>

    </div>
</section>