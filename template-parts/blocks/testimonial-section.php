<?php
// ACF Fields
$bg_color     = get_field('background_color') ?: '#0A2640';
$heading      = get_field('heading');
$testimonials = get_field('testimonials');
?>

<section
    class="lg:pb-[112rpx] py-8 lg:py-[96px] xl:py-[96px] px-5 sm:px-6 lg:px-10 xl:px-[88px]"
    style="
        background-color: <?php echo esc_attr($bg_color); ?>;
        --btn-hover-bg: <?php echo esc_attr($bg_color); ?>;
    "
>
    <div class="max-w-[1220px] mx-auto lg:px-5">

        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-start mb-8 lg:mb-[72px] xl:mb-[72px] relative">

            <h2
                class="font-manrope text-2xl sm:text-4xl lg:text-5xl font-normal lg:leading-[72px] text-white lg:max-w-[716px] text-center lg:text-left mb-8 lg:mb-0">
                <?php echo esc_html($heading); ?>
            </h2>

            <!-- Navigation Buttons -->
            <div class="flex gap-7 flex-shrink-0 lg:pt-20 lg:ml-8 lg:relative lg:left-[50px] justify-center lg:justify-start">

                <!-- Prev -->
                <button id="prevBtn" class="group" aria-label="Previous">
                    <svg class="w-12 h-12 sm:w-[72px] sm:h-[72px] text-[var(--btn-hover-bg)] group-hover:text-white transition-colors duration-300"
                        viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="36" cy="36" r="35"
                            class="fill-white group-hover:fill-[var(--btn-hover-bg)] transition-colors duration-300"
                            stroke="white" stroke-width="2" />
                        <path d="M46.5 35L25.5 35" stroke="currentColor" stroke-width="3"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M36 45.5L25.5 35L36 24.5" stroke="currentColor" stroke-width="3"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>

                <!-- Next -->
                <button id="nextBtn" class="group" aria-label="Next">
                    <svg class="w-12 h-12 sm:w-[72px] sm:h-[72px] text-[var(--btn-hover-bg)] group-hover:text-white transition-colors duration-300"
                        viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="36" cy="36" r="35"
                            class="fill-white group-hover:fill-[var(--btn-hover-bg)] transition-colors duration-300"
                            stroke="white" stroke-width="2" />
                        <path d="M25.5 37H46.5" stroke="currentColor" stroke-width="3"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M36 26.5L46.5 37L36 47.5" stroke="currentColor" stroke-width="3"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Slider -->
        <div id="testimonial-slider" class="splide">
            <div class="splide__track">
                <ul class="splide__list">

                    <?php if ($testimonials): foreach ($testimonials as $item): ?>

                        <li class="splide__slide">
                            <div class="bg-white rounded-lg p-6 sm:p-8 md:p-10 flex flex-col h-full">

                                <p class="font-opensans text-black font-normal text-lg sm:text-xl md:text-2xl leading-7 sm:leading-8 md:leading-9 mb-6 sm:mb-8 md:mb-10 flex-grow">
                                    "<?php echo esc_html($item['quote']); ?>"
                                </p>

                                <div class="flex items-center gap-3 sm:gap-4">
                                    <img src="<?php echo esc_url($item['image']['url']); ?>"
                                        alt="<?php echo esc_attr($item['name']); ?>"
                                        class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 rounded-full bg-gray-200 flex-shrink-0">

                                    <div>
                                        <p class="font-opensans text-sm sm:text-base leading-6 sm:leading-8 font-bold text-[#0A2640]">
                                            <?php echo esc_html($item['name']); ?>
                                        </p>
                                        <p class="font-opensans text-xs sm:text-sm leading-6 sm:leading-8 font-normal text-[#0A2640]">
                                            <?php echo esc_html($item['designation']); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>

                    <?php endforeach; endif; ?>

                </ul>
            </div>
        </div>

    </div>
</section>
