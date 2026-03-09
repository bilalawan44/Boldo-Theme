<?php
/**
 * Team Section Block Template
 */

// Get ACF Fields
$section_label = get_field('section_label');
$section_heading = get_field('section_heading');
$section_description = get_field('section_description');
$team_members = get_field('team_members');

// Color Options
$background_color = get_field('background_color') ?: '#ffffff';
$label_color = get_field('label_color') ?: '#777777';
$heading_color = get_field('heading_color') ?: '#000000';
$description_color = get_field('description_color') ?: '#777777';
$member_name_color = get_field('member_name_color') ?: '#000000';
$member_position_color = get_field('member_position_color') ?: '#777777';
?>

<!-- Team Section -->
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

        <!-- Team Cards -->
        <?php if (!empty($team_members)) : ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-[300px_300px_300px] gap-6 sm:gap-8 md:gap-10 lg:gap-12 xl:gap-[51px] justify-center lg:pl-4 xl:pl-4">
                
                <?php foreach ($team_members as $index => $member) : 
                    $photo = $member['member_photo'];
                    $name = $member['member_name'];
                    $position = $member['member_position'];
                    
                    // Third card (index 2) gets special classes
                    $card_class = ($index == 2) ? 'text-center sm:col-span-2 md:col-span-2 lg:col-span-1 sm:max-w-[300px] md:max-w-[300px] lg:max-w-none sm:mx-auto md:mx-auto lg:mx-0' : 'text-center';
                ?>
                    <div class="<?php echo esc_attr($card_class); ?>">
                        <?php if ($photo) : ?>
                            <div class="mb-4 sm:mb-5 md:mb-6 overflow-hidden rounded-3xl">
                                <?php 
                                // Use custom image size 'team-member' (300x354)
                                // Falls back to 'medium' if custom size not available
                                $image_size = 'team-member';
                                $image_alt = $photo['alt'] ?: $name;

                                if ( ! empty( $photo['ID'] ) ) {
                                    $image_src = wp_get_attachment_image_src( $photo['ID'], $image_size );
                                    if ( empty( $image_src ) ) {
                                        $image_src = wp_get_attachment_image_src( $photo['ID'], 'medium' );
                                    }

                                    if ( ! empty( $image_src[0] ) ) {
                                        ?>
                                        <div class="w-full ">
                                            <img src="<?php echo esc_url( $image_src[0] ); ?>"
                                                alt="<?php echo esc_attr( $image_alt ); ?>"
                                                class="object-cover w-full">
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class="w-full">
                                        <img src="<?php echo esc_url($photo['url']); ?>" 
                                            alt="<?php echo esc_attr($image_alt); ?>" 
                                            class="object-cover w-full"
                                           >
                                    </div>
                                    <?php
                                }
                                ?>
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

    </div>
</section>