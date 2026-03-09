<?php get_header(); ?>

<section class="bg-white pt-10 sm:pt-12 md:pt-16 px-4">
    <div class="max-w-[1220px] mx-auto sm:px-4 md:px-5">

        <!-- Hero Header -->
        <div class="px-4 sm:px-6 md:px-8 lg:px-10 mb-8 sm:mb-16 md:mb-20">
            <p class="font-opensans font-normal text-[#777777] text-base sm:text-lg md:text-xl/8 mb-2 sm:mb-3 text-center">
                <?php echo esc_html__( 'Search Results', 'tailpress' ); ?>
            </p>

            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-normal text-[#000000] font-manrope leading-tight sm:leading-snug md:leading-[72px] text-center">
                <?php
                printf(
                    esc_html__( 'Results for: %s', 'tailpress' ),
                    '<span class="text-[#0A2640] font-bold">' . esc_html( get_search_query() ) . '</span>'
                );
                ?>
            </h1>

            <!-- Search Count -->
            <?php if ( have_posts() ) : ?>
            <p class="font-opensans text-sm text-[#777777] text-center mt-3">
                <?php
                global $wp_query;
                printf(
                    esc_html__( '%s results found', 'tailpress' ),
                    '<span class="font-bold text-[#0A2640]">' . number_format_i18n( $wp_query->found_posts ) . '</span>'
                );
                ?>
            </p>
            <?php endif; ?>

            <!-- Search Form — FIXED: name="s" -->
            <div class="max-w-[680px] mx-auto mt-6 sm:mt-8">
                <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-3 sm:gap-4">
                    <div class="relative flex-1">
                        <input
                            type="search"
                            name="s"
                            value="<?php echo esc_attr( get_search_query() ); ?>"
                            placeholder="<?php echo esc_attr__( 'Search articles...', 'tailpress' ); ?>"
                            class="w-full pl-12 pr-4 py-3 sm:py-4 border-2 border-gray-200 rounded-full font-opensans text-base text-[#000000] placeholder-[#777777] focus:outline-none focus:border-[#0A2640] transition-colors duration-200"
                        >
                    </div>
                    <button
                        type="submit"
                        class="bg-[#0A2640] text-white font-opensans font-bold text-sm sm:text-xl/7 px-6 sm:px-14 py-3 sm:py-4 rounded-full hover:bg-white hover:text-[#0A2640] border-2 border-[#0A2640] transition-colors duration-200 whitespace-nowrap">
                        <?php echo esc_html__( 'Search', 'tailpress' ); ?>
                    </button>
                </form>
            </div>
        </div>

        <?php if ( have_posts() ) : ?>

            <!-- Posts Grid -->
            <div class="max-w-[998px] mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7 md:gap-8 mb-8 sm:mb-16 md:mb-20">
                <?php while ( have_posts() ) : the_post(); ?>
                    <a href="<?php the_permalink(); ?>"
                       class="blog-card group cursor-pointer max-w-[300px] mx-auto lg:mx-0 flex flex-col h-full">

                        <div class="mb-4 sm:mb-5 md:mb-6 overflow-hidden rounded-lg aspect-[300/209] bg-gray-100">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'blog-card', array(
                                    'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300'
                                ) ); ?>
                            <?php else : ?>
                                <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                                        <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/>
                                        <polyline points="21 15 16 10 5 21"/>
                                    </svg>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="flex flex-col flex-1">
                            <div class="flex items-center gap-2 mb-2 sm:mb-3">
                                <span class="font-opensans font-bold text-sm sm:text-base/7 text-[#0A2640]">
                                    <?php
                                    $cat = get_the_category();
                                    echo esc_html( $cat[0]->name ?? '' );
                                    ?>
                                </span>
                                <?php if ( ! empty( $cat ) ) : ?>
                                <span class="text-[#777777]">·</span>
                                <?php endif; ?>
                                <span class="font-opensans font-normal text-sm sm:text-base/7 text-gray-600">
                                    <?php echo esc_html( get_the_date( 'F j, Y' ) ); ?>
                                </span>
                            </div>

                            <p class="font-opensans font-normal text-lg sm:text-xl/8 text-[#000000] mb-3 sm:mb-4 group-hover:text-[#0A2640] transition-colors duration-200">
                                <?php the_title(); ?>
                            </p>

                            <p class="font-opensans font-normal text-sm text-[#777777] mb-3 line-clamp-2">
                                <?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?>
                            </p>

                            <div class="flex items-center gap-3 pt-3 sm:pt-4 md:pt-5 mt-auto border-t border-gray-100">
                                <?php echo get_avatar( get_the_author_meta( 'ID' ), 32, '', '', array(
                                    'class' => 'w-8 h-8 rounded-full object-cover'
                                ) ); ?>
                                <span class="font-opensans font-normal text-sm sm:text-base/7 text-[#000000]">
                                    <?php the_author(); ?>
                                </span>
                            </div>
                        </div>
                    </a>
                <?php endwhile; ?>
            </div>

            <div class="text-center mb-16">
                <?php
                the_posts_pagination( array(
                    'mid_size'  => 1,
                    'prev_text' => '&larr; ' . esc_html__( 'Previous', 'tailpress' ),
                    'next_text' => esc_html__( 'Next', 'tailpress' ) . ' &rarr;',
                ) );
                ?>
            </div>

        <?php else : ?>

            <div class="max-w-[600px] mx-auto text-center px-4 pb-20">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-[#777777]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                    </svg>
                </div>
                <h2 class="font-manrope text-2xl sm:text-3xl font-normal text-[#000000] mb-4">
                    <?php echo esc_html__( 'No Results Found', 'tailpress' ); ?>
                </h2>
                <p class="font-opensans font-normal text-[#777777] text-base sm:text-lg mb-8">
                    <?php echo esc_html__( 'No results found for your search. Try different keywords or browse our latest articles.', 'tailpress' ); ?>
                </p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                   class="inline-block bg-[#0A2640] text-white font-opensans font-bold text-base px-8 py-3 rounded-full hover:bg-[#092036] transition-colors duration-200">
                    <?php echo esc_html__( 'Back to Home', 'tailpress' ); ?>
                </a>
            </div>

        <?php endif; ?>

    </div>
</section>

<?php get_footer(); ?>