<?php get_header(); ?>

<?php
$author_id      = get_queried_object_id();
$author_name    = get_the_author_meta( 'display_name', $author_id );
$author_desc    = get_the_author_meta( 'description', $author_id );
$author_email   = get_the_author_meta( 'email', $author_id );
$author_url     = get_the_author_meta( 'url', $author_id );
$author_twitter = get_the_author_meta( 'twitter', $author_id );

// Post count for this author
$post_count = count_user_posts( $author_id, 'post', true );
?>

<section class="bg-white pt-10 sm:pt-12 md:pt-16 px-4">
    <div class="max-w-[1220px] mx-auto sm:px-4 md:px-5">

        <!-- Author Hero -->
        <div class="px-4 sm:px-6 md:px-8 lg:px-10 mb-8 sm:mb-16 md:mb-20">

            <p class="font-opensans font-normal text-[#777777] text-base sm:text-lg md:text-xl/8 mb-2 sm:mb-3 text-center">
                <?php echo esc_html__( 'Author', 'tailpress' ); ?>
            </p>

            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-[#0a2640] font-manrope leading-tight sm:leading-snug md:leading-[72px] text-center">
                <?php echo esc_html( $author_name ); ?>
            </h1>

            <!-- Avatar + Info -->
            <div class="max-w-[600px] mx-auto mt-8 sm:mt-10 flex flex-col items-center">
                <?php echo get_avatar( $author_id, 96, '', $author_name, array(
                    'class' => 'w-20 h-20 sm:w-24 sm:h-24 rounded-full object-cover mb-4 ring-4 ring-gray-100'
                ) ); ?>

                <!-- Post count badge -->
                <span class="font-opensans font-bold text-xs text-white bg-[#0A2640] px-3 py-1 rounded-full mb-4">
                    <?php printf( esc_html__( '%s Articles', 'tailpress' ), number_format_i18n( $post_count ) ); ?>
                </span>

                <?php if ( ! empty( $author_desc ) ) : ?>
                    <p class="font-opensans font-normal text-[#777777] text-base sm:text-lg md:text-xl/8 text-center leading-relaxed">
                        <?php echo esc_html( $author_desc ); ?>
                    </p>
                <?php endif; ?>

                <!-- Social Links -->
                <div class="flex items-center gap-3 mt-5">
                    <?php if ( ! empty( $author_url ) ) : ?>
                    <a href="<?php echo esc_url( $author_url ); ?>"
                       target="_blank" rel="noopener noreferrer"
                       class="w-10 h-10 flex items-center justify-center rounded-full border-2 border-gray-200 text-[#777777] hover:border-[#0A2640] hover:text-[#0A2640] transition-colors duration-200"
                       title="<?php esc_attr_e( 'Website', 'tailpress' ); ?>">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                        </svg>
                    </a>
                    <?php endif; ?>

                    <?php if ( ! empty( $author_twitter ) ) : ?>
                    <a href="https://twitter.com/<?php echo esc_attr( ltrim( $author_twitter, '@' ) ); ?>"
                       target="_blank" rel="noopener noreferrer"
                       class="w-10 h-10 flex items-center justify-center rounded-full border-2 border-gray-200 text-[#777777] hover:border-[#0A2640] hover:text-[#0A2640] transition-colors duration-200">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>
                    <?php endif; ?>

                    <a href="mailto:<?php echo esc_attr( $author_email ); ?>"
                       class="w-10 h-10 flex items-center justify-center rounded-full border-2 border-gray-200 text-[#777777] hover:border-[#0A2640] hover:text-[#0A2640] transition-colors duration-200"
                       title="<?php esc_attr_e( 'Email', 'tailpress' ); ?>">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <?php if ( have_posts() ) : ?>

            <!-- Section title -->
            <div class="max-w-[998px] mx-auto px-4 sm:px-0 mb-6 sm:mb-8">
                <p class="font-opensans font-normal text-[#777777] text-sm sm:text-base">
                    <?php printf(
                        esc_html__( 'All articles by %s', 'tailpress' ),
                        '<span class="font-bold text-[#0A2640]">' . esc_html( $author_name ) . '</span>'
                    ); ?>
                </p>
            </div>

            <!-- Posts Grid -->
            <div class="max-w-[998px] mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7 md:gap-8 mb-8 sm:mb-16 md:mb-20">
                <?php while ( have_posts() ) : the_post(); ?>
                    <a href="<?php the_permalink(); ?>"
                       class="blog-card group cursor-pointer max-w-[300px] mx-auto lg:mx-0 flex flex-col h-full">

                        <!-- Thumbnail -->
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

                        <!-- Card Content -->
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

                            <!-- Excerpt -->
                            <p class="font-opensans font-normal text-sm text-[#777777] mb-3 line-clamp-2">
                                <?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?>
                            </p>

                            <!-- Author -->
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

            <!-- Pagination -->
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

            <!-- No Posts -->
            <div class="max-w-[600px] mx-auto text-center px-4 pb-20">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-[#777777]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2Z"/>
                    </svg>
                </div>
                <h2 class="font-manrope text-2xl sm:text-3xl font-normal text-[#000000] mb-4">
                    <?php echo esc_html__( 'No Posts Yet', 'tailpress' ); ?>
                </h2>
                <p class="font-opensans font-normal text-[#777777] text-base sm:text-lg mb-8">
                    <?php printf(
                        esc_html__( '%s has not published any posts yet.', 'tailpress' ),
                        esc_html( $author_name )
                    ); ?>
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