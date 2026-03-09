<?php get_header(); ?>

<section class="bg-white pt-10 sm:pt-12 md:pt-16 lg:pt-16 xl:pt-16 px-4">
    <div class="max-w-[1220px] mx-auto sm:px-4 md:px-5">

        <div class="max-w-[900px] mx-auto text-center px-4 sm:px-6 md:px-8 lg:px-10">
            <p class="font-opensans font-bold text-[#0A2640] text-base sm:text-lg md:text-xl/8 mb-3">
                <?php echo esc_html__( '404 Error', 'tailpress' ); ?>
            </p>

            <h1 class="text-3xl sm:text-4xl md:text-5xl font-normal text-[#000000] font-manrope leading-tight sm:leading-snug md:leading-[72px] mb-4">
                <?php echo esc_html__( 'Page not found', 'tailpress' ); ?>
            </h1>

            <p class="font-opensans font-normal text-[#777777] text-base sm:text-lg md:text-xl/8 mb-8">
                <?php echo esc_html__( 'Sorry, the page you are looking for could not be found.', 'tailpress' ); ?>
            </p>

            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center items-center">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                   class="font-opensans font-bold text-base sm:text-lg md:text-xl/7 px-10 sm:px-12 md:px-14 py-3 sm:py-3.5 md:py-4 border-2 border-[#0A2640] bg-[#0A2640] text-white rounded-full hover:bg-[#65E4A3] hover:text-[#0A2640] transition-colors duration-300 w-full sm:w-auto text-center">
                    <?php echo esc_html__( 'Go Home', 'tailpress' ); ?>
                </a>

                <a href="<?php echo esc_url( home_url( '/' ) ); ?>?s="
                   class="font-opensans font-bold text-base sm:text-lg md:text-xl/7 px-10 sm:px-12 md:px-14 py-3 sm:py-3.5 md:py-4 border-2 border-[#0A2640] text-[#0A2640] rounded-full hover:bg-[#65E4A3] hover:text-[#0A2640] transition-colors duration-300 w-full sm:w-auto text-center">
                    <?php echo esc_html__( 'Search', 'tailpress' ); ?>
                </a>
            </div>
        </div>

    </div>
</section>

<?php get_footer(); ?>
