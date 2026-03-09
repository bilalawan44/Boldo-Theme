<?php
/**
 * Counter Section Block
 */

$background_color     = get_field('background_color') ?: '#0A2640';
$label_text           = get_field('label_text');
$label_color          = get_field('label_color') ?: '#ffffff';

$heading_text         = get_field('heading_text');
$heading_color        = get_field('heading_color') ?: '#ffffff';

$counter_color        = get_field('counter_color') ?: '#4FE9A4';
$feature_color        = get_field('feature_color') ?: '#ffffff';

$counters = get_field('counters');
?>

<section class="m-0 px-4 py-10 sm:px-6 sm:py-14 md:px-8 md:py-16 lg:px-10 lg:py-20 xl:py-24"
    style="background-color: <?php echo esc_attr($background_color); ?>">

    <!-- Heading -->
    <div class="max-w-[842px] mx-auto mb-8 sm:mb-10 md:mb-12 lg:mb-14 xl:mb-16 text-center px-5 md:px-4 lg:px-0">

        <?php if ($label_text): ?>
            <p class="font-opensans text-sm sm:text-base md:text-lg lg:text-xl font-normal mb-2 sm:mb-3"
               style="color: <?php echo esc_attr($label_color); ?>">
                <?php echo esc_html($label_text); ?>
            </p>
        <?php endif; ?>

        <?php if ($heading_text): ?>
            <h2 class="font-manrope font-normal
                text-md leading-[32px]
                sm:text-3xl sm:leading-[40px]
                md:text-4xl md:leading-[48px]
                lg:text-5xl lg:leading-[60px]
                xl:text-5xl xl:leading-[72px]
                mb-10 sm:mb-12 md:mb-14 lg:mb-16 xl:mb-20"
                style="color: <?php echo esc_attr($heading_color); ?>">
                <?php echo esc_html($heading_text); ?>
            </h2>
        <?php endif; ?>

    </div>

    <!-- Counters -->
    <?php if ($counters): ?>
        <div class="max-w-[1060px] mx-auto 
            flex flex-col 
            md:flex md:flex-row md:justify-center md:gap-[142px] md:pl-0
            lg:flex lg:flex-row lg:justify-center lg:gap-[142px] lg:px-0
            xl:gap-[142px]
            items-center md:items-center 
            gap-8 sm:gap-10">

            <?php $counter_index = 0; ?>
            <?php foreach ($counters as $counter): ?>
                <?php $is_left_on_lg = ($counter_index < 2); ?>
                <div class="flex flex-col items-center w-full md:flex-1 md:min-w-0 text-center <?php echo $is_left_on_lg ? 'lg:items-start lg:text-left' : 'lg:items-center lg:text-center'; ?>">

                    <div class="mb-4 sm:mb-4 md:mb-4 lg:mb-6 xl:mb-8 min-h-[56px] sm:min-h-[64px] md:min-h-[72px] lg:min-h-[88px] xl:min-h-[96px] flex items-end justify-center">
                        <span class="font-manrope font-normal counter-number
                            text-5xl leading-[56px]
                            sm:text-6xl sm:leading-[64px]
                            md:text-7xl md:leading-[72px]
                            lg:text-8xl lg:leading-[88px]
                            xl:text-8xl xl:leading-[96px]"
                            style="color: <?php echo esc_attr($counter_color); ?>"
                            data-target="<?php echo esc_attr($counter['number']); ?>"
                            <?php if (!empty($counter['suffix'])): ?>
                                data-suffix="<?php echo esc_attr($counter['suffix']); ?>"
                            <?php endif; ?>
                            <?php if (!empty($counter['separator'])): ?>
                                data-separator="<?php echo esc_attr($counter['separator']); ?>"
                            <?php endif; ?>
                        >
                            <?php echo esc_html($counter['display_value']); ?>
                        </span>
                    </div>

                    <p class="font-opensans font-normal w-full <?php echo $is_left_on_lg ? 'lg:text-left' : 'lg:text-center'; ?>
                        text-sm leading-[18px]
                        sm:text-base sm:leading-[22px]
                        md:text-base md:leading-[22px]
                        lg:text-2xl/9
                        xl:text-2xl/9"
                        style="color: <?php echo esc_attr($feature_color); ?>">
                        <?php echo esc_html($counter['title']); ?>
                    </p>

                </div>
                <?php $counter_index++; ?>
            <?php endforeach; ?>

        </div>
    <?php endif; ?>

</section>