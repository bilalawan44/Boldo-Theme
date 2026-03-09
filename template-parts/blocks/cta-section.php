<?php
$heading            = get_field('heading');
$email_placeholder = get_field('email_placeholder');
$button_link        = get_field('button_link');
?>

<section class="bg-white">
    <div class="w-full flex items-start justify-center pt-14 xl:pt-[124px] pb-8 sm:pb-12 md:pb-16 lg:pb-20 px-5">
        <div class="relative w-[1180px] overflow-hidden rounded-xl sm:rounded-2xl">

            <!-- SVG Background -->
            <svg class="absolute inset-0" width="1200" height="391" viewBox="0 0 1200 391" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <rect width="1200" height="391" rx="12" fill="#0A2640" />
                <circle cx="1112.5" cy="-407.5" r="646.5" fill="#1C3D5B" />
            </svg>

            <!-- Content -->
            <div
                class="relative z-10 w-full px-6 sm:px-8 md:px-12 lg:px-16 xl:px-[208px] py-8 md:pt-20 lg:pt-[72px] lg:pb-[60px] text-center">

                <!-- Heading -->
                <h2
                    class="font-manrope font-normal text-2xl sm:text-3xl md:text-4xl lg:text-5xl text-[#ffffff] mb-8 sm:mb-10 md:mb-12 leading-tight sm:leading-snug md:leading-[1.4] lg:leading-[72px] px-2 sm:px-4">
                    <?php echo wp_kses_post($heading); ?>
                </h2>

                <!-- Form -->
                <div
                    class="flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-6 max-w-2xl mx-auto px-2 sm:px-4">

                    <input type="email"
                        placeholder="<?php echo esc_attr($email_placeholder); ?>"
                        class="font-opensans font-normal w-full sm:max-w-[370px] sm:flex-1 px-6 sm:px-8 py-3 sm:py-4 rounded-full bg-white text-[#000000] text-base sm:text-lg md:text-xl focus:outline-none focus:ring-2 focus:ring-[#65E4A3] transition-all" />

                    <button
                        class="font-opensans text-base sm:text-lg md:text-xl w-full sm:w-auto px-10 sm:px-12 md:px-14 py-3 sm:py-4 border-2 border-[#65E4A3] bg-[#65E4A3] text-[#0A2640] font-bold rounded-full hover:bg-[#0A2640] hover:border-[#ffffff] hover:text-[#ffffff] transition-all">
                        <?php echo esc_html($button_link['title']); ?>
                    </button>

                </div>
            </div>
        </div>
    </div>
</section>
