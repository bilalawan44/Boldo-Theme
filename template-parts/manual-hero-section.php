<?php
/**
 * Manual Hero Section
 * Add this code directly to your homepage template
 */

// Manual hero content - you can edit these values
$heading = "Funding handshake buyer business-to-business metrics iPad partnership. First mover advantage innovator success deployment non-disclosure.";
$primary_button = array(
    'title' => 'Buy template',
    'url' => '#buy-template'
);
$secondary_button = array(
    'title' => 'Explore',
    'url' => '#explore'
);
?>

<section class="relative overflow-hidden mt-[-68px] md:mt-[-82px] lg:mt-[-99px]">
    <!-- Default SVG Background -->
    <svg class="absolute inset-0 w-full h-full" viewBox="0 0 1400 798" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
        <rect width="1400" height="798" fill="#0A2640" />
        <circle cx="1423.5" cy="-142.5" r="646.5" fill="#1C3D5B" />
    </svg>

    <!-- Hero Content -->
    <div class="max-w-[1220px] mx-auto px-5 relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12 lg:gap-[70px] pt-24 sm:pt-32 md:pt-40 lg:pt-[162px]">
        
        <!-- Left Content -->
        <div class="max-w-full lg:max-w-[567px] pt-0 md:pt-8 lg:pt-[58px]">
            <h1 class="font-manrope text-white font-normal text-3xl sm:text-4xl md:text-[42px] lg:text-5xl leading-tight sm:leading-snug md:leading-[60px] lg:leading-[72px]">
                <?php echo esc_html($heading); ?>
            </h1>

            <div class="flex flex-col sm:flex-row gap-4 pt-6 md:pt-8 lg:pt-10">
                <a href="<?php echo esc_url($primary_button['url']); ?>" 
                   class="bg-white font-opensans text-center text-base sm:text-lg md:text-xl/7 text-[#0A2640] px-8 sm:px-10 md:px-12 lg:px-14 py-3 md:py-4 rounded-full font-bold hover:bg-[#65E4A3] hover:text-[#0A2640] transition">
                    <?php echo esc_html($primary_button['title']); ?>
                </a>

                <a href="<?php echo esc_url($secondary_button['url']); ?>" 
                   class="font-opensans text-center text-base sm:text-lg md:text-xl/7 border-2 border-[#FFFFFF] text-white px-8 sm:px-10 md:px-12 lg:px-14 py-3 md:py-4 rounded-full font-bold hover:bg-[#65E4A3] hover:border-[#65E4A3] transition hover:text-[#0A2640] inline-block">
                    <?php echo esc_html($secondary_button['title']); ?>
                </a>
            </div>
        </div>

        <!-- Right Content - Hero Image -->
        <div class="max-w-full relative sm:max-w-[450px] md:max-w-[400px] lg:max-w-[493px] left-0 xl:left-[70px] mx-auto lg:mx-0 mt-8 lg:mt-0">
            <!-- You can add an image here if needed -->
        </div>

    </div>

</section>
