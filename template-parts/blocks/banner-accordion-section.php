<?php
$banner_image = get_field('banner_image');
$heading      = get_field('heading');
$accordions   = get_field('accordions');
?>

<section
    class="bg-white py-8 sm:pt-12 md:pt-14 lg:pt-[128px] px-5 sm:px-6 lg:px-10 xl:px-[88px] lg:pb-[90px] xl:pb-[90px]">

    <div class="max-w-[1220px] mx-auto md:px-5">

        <!-- Image -->
        <?php if ($banner_image): ?>
            <div class="mb-8 sm:mb-10 md:mb-12 lg:mb-14">
                <img src="<?php echo esc_url($banner_image['url']); ?>"
                    alt="<?php echo esc_attr($banner_image['alt']); ?>"
                    class="w-full h-auto">
            </div>
        <?php endif; ?>

        <!-- Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 lg:gap-[184px]">

            <!-- Heading -->
            <div>
                <h2
                    class="font-manrope font-normal text-xl sm:text-3xl md:text-4xl text-black leading-[1.4] sm:leading-[1.5] md:leading-[56px]">
                    <?php echo esc_html($heading); ?>
                </h2>
            </div>

            <!-- Accordions -->
            <div>
                <div class="space-y-4 sm:space-y-5 md:space-y-6 max-w-full sm:max-w-[480px] md:max-w-[500px]">

                    <?php if ($accordions): foreach ($accordions as $item): ?>

                        <div class="border-b border-[#c4c4c4]">
                            <button
                                class="accordion-trigger w-full flex items-center justify-between text-left group gap-3 sm:gap-4"
                                data-accordion-trigger>

                                <span
                                    class="font-opensans text-base sm:text-lg md:text-xl leading-6 sm:leading-7 md:leading-8 font-normal text-black">
                                    <?php echo esc_html($item['question']); ?>
                                </span>

                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 sm:w-7 sm:h-7 md:w-[28px] md:h-[28px] rotate-icon"
                                        viewBox="0 0 28 28" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="14" cy="14" r="14" fill="#0A2640" />
                                        <path d="M8 12L14 18L20 12" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>

                            <div class="accordion-content mt-3 sm:mt-4">
                                <p class="font-opensans text-sm sm:text-base leading-6 sm:leading-8 text-gray-600">
                                    <?php echo esc_html($item['answer']); ?>
                                </p>
                            </div>
                        </div>

                    <?php endforeach; endif; ?>

                </div>
            </div>

        </div>
    </div>
</section>
