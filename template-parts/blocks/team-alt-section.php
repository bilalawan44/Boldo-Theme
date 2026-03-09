<?php
/**
 * Team Alt Section Block Template
 * 3 large cards + 4 small cards layout
 * Fixed tablet responsive layout
 */

// Get ACF Fields
$section_label = get_field('section_label');
$section_heading = get_field('section_heading');
$section_description = get_field('section_description');
$large_team_members = get_field('large_team_members'); // Top 3
$small_team_members = get_field('small_team_members'); // Bottom 4

// Color Options
$background_color = get_field('background_color') ?: '#ffffff';
$label_color = get_field('label_color') ?: '#777777';
$heading_color = get_field('heading_color') ?: '#000000';
$description_color = get_field('description_color') ?: '#777777';
$member_name_color = get_field('member_name_color') ?: '#000000';
$member_position_color = get_field('member_position_color') ?: '#777777';
?>

<!--Our Team Section-->
<section style="background-color: <?php echo esc_attr($background_color); ?>;">
    <div class="mx-auto px-5 sm:px-8 md:px-10 lg:px-12 py-12 sm:py-16 md:py-20 lg:py-[96px] max-w-[1000px]">
        
        <!-- Header Section -->
        <div class="mb-8 sm:mb-10 md:mb-12 lg:mb-[52px] max-w-[800px] mx-auto">
            <?php if ($section_label) : ?>
                <p class="font-opensans font-normal text-base sm:text-lg md:text-xl lg:text-xl/8 mb-2 sm:mb-3"
                   style="color: <?php echo esc_attr($label_color); ?>;">
                    <?php echo esc_html($section_label); ?>
                </p>
            <?php endif; ?>

            <?php if ($section_heading) : ?>
                <h2 class="font-manrope text-xl sm:text-4xl md:text-[44px] lg:text-5xl font-normal leading-tight sm:leading-[56px] md:leading-[64px] lg:leading-[72px] mb-4 sm:mb-5 md:mb-6"
                    style="color: <?php echo esc_attr($heading_color); ?>;">
                    <?php echo esc_html($section_heading); ?>
                </h2>
            <?php endif; ?>

            <?php if ($section_description) : ?>
                <p class="font-opensans text-base sm:text-lg md:text-xl lg:text-xl/8 font-normal"
                   style="color: <?php echo esc_attr($description_color); ?>;">
                    <?php echo esc_html($section_description); ?>
                </p>
            <?php endif; ?>
        </div>

        <!-- Top 3 Team Cards (Large) -->
        <?php if (!empty($large_team_members)) : 
            $member_count = count($large_team_members);
        ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-[250px_250px_250px] gap-6 sm:gap-8 md:gap-10 lg:gap-12 xl:gap-[75px] justify-center mb-8 sm:mb-10 md:mb-12 lg:mb-[110px]">
                
                <?php foreach ($large_team_members as $index => $member) : 
                    $photo = $member['member_photo'];
                    $name = $member['member_name'];
                    $position = $member['member_position'];
                    
                    // Dynamic card classes based on position and total count
                    $card_class = 'text-center';
                    
                    // For 3 cards: 3rd card spans 2 columns on sm and md (centered)
                    if ($member_count == 3 && $index == 2) {
                        $card_class .= ' sm:col-span-2 md:col-span-2 lg:col-span-1 sm:max-w-[250px] md:max-w-[250px] lg:max-w-none sm:mx-auto md:mx-auto lg:mx-0';
                    }
                    // For 5 cards: 5th card spans 2 columns on sm and md (centered)
                    elseif ($member_count == 5 && $index == 4) {
                        $card_class .= ' sm:col-span-2 md:col-span-2 lg:col-span-1 sm:max-w-[250px] md:max-w-[250px] lg:max-w-none sm:mx-auto md:mx-auto lg:mx-0';
                    }
                    // For 4 cards: all cards stay in 2 column grid (no special handling needed)
                ?>
                    <div class="<?php echo esc_attr($card_class); ?>">
                        <?php if ($photo) : ?>
                            <div class="mb-4 sm:mb-5 md:mb-6 overflow-hidden rounded-3xl max-w-full mx-auto">
                                <img src="<?php echo esc_url($photo['url']); ?>" 
                                     alt="<?php echo esc_attr($name ?: $photo['alt']); ?>" 
                                     class="object-cover w-full h-auto">
                            </div>
                        <?php endif; ?>

                        <?php if ($name) : ?>
                            <h3 class="font-manrope text-2xl sm:text-[26px] md:text-[28px] lg:text-[28px]/[48px] font-normal mb-2 sm:mb-3"
                                style="color: <?php echo esc_attr($member_name_color); ?>;">
                                <?php echo esc_html($name); ?>
                            </h3>
                        <?php endif; ?>

                        <?php if ($position) : ?>
                            <p class="font-opensans font-normal text-base sm:text-lg md:text-xl lg:text-xl/8"
                               style="color: <?php echo esc_attr($member_position_color); ?>;">
                                <?php echo esc_html($position); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

            </div>
        <?php endif; ?>

        <!-- Bottom 4 Team Cards (Small/Compact) -->
        <?php if (!empty($small_team_members)) : ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-6 sm:gap-x-16 sm:gap-y-8 md:gap-x-24 md:gap-y-10 lg:gap-x-[101px] lg:gap-y-[46px] max-w-[900px] mx-auto">
                
                <?php foreach ($small_team_members as $member) : 
                    $photo = $member['member_photo'];
                    $name = $member['member_name'];
                    $position = $member['member_position'];
                ?>
                    <div class="flex items-center gap-4 sm:gap-5 md:gap-6 lg:gap-8 xl:gap-8">
                        <?php if ($photo) : ?>
                            <div class="flex-shrink-0 overflow-hidden rounded-3xl w-20 h-20 sm:w-24 sm:h-24 md:w-18 md:h-18 lg:w-[120px] lg:h-[120px]">
                                <img src="<?php echo esc_url($photo['url']); ?>" 
                                     alt="<?php echo esc_attr($name ?: $photo['alt']); ?>" 
                                     class="object-cover w-full h-full"
                                     width="120"
                                     height="120">
                            </div>
                        <?php endif; ?>

                        <div>
                            <?php if ($name) : ?>
                                <h4 class="font-manrope text-lg sm:text-xl md:text-2xl lg:text-[28px] font-normal mb-3 sm:mb-2 lg:leading-[48px] xl:leading-[48px]"
                                    style="color: <?php echo esc_attr($member_name_color); ?>;">
                                    <?php echo esc_html($name); ?>
                                </h4>
                            <?php endif; ?>

                            <?php if ($position) : ?>
                                <p class="font-opensans font-normal text-sm sm:text-base md:text-lg lg:text-xl/8"
                                   style="color: <?php echo esc_attr($member_position_color); ?>;">
                                    <?php echo esc_html($position); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        <?php endif; ?>

    </div>
</section>