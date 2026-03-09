<?php get_header(); ?>

<?php
// Archive type detect karo
$archive_title       = '';
$archive_subtitle    = '';
$archive_description = '';
$archive_image       = '';

if ( is_category() ) {
    $archive_subtitle    = esc_html__( 'Category', 'tailpress' );
    $archive_title       = single_cat_title( '', false );
    $archive_description = category_description();
    $term_obj            = get_queried_object();
    if ( $term_obj && function_exists( 'get_field' ) ) {
        $archive_image = get_field( 'category_image', $term_obj );
    }

} elseif ( is_tag() ) {
    $archive_subtitle = esc_html__( 'Tag', 'tailpress' );
    $archive_title    = single_tag_title( '', false );

} elseif ( is_tax() ) {
    $archive_subtitle    = get_queried_object()->taxonomy ?? '';
    $archive_title       = single_term_title( '', false );
    $archive_description = term_description();

} elseif ( is_date() ) {
    if ( is_year() ) {
        $archive_subtitle = esc_html__( 'Archive', 'tailpress' );
        $archive_title    = get_the_date( 'Y' );
    } elseif ( is_month() ) {
        $archive_subtitle = esc_html__( 'Archive', 'tailpress' );
        $archive_title    = get_the_date( 'F Y' );
    } else {
        $archive_subtitle = esc_html__( 'Archive', 'tailpress' );
        $archive_title    = get_the_date();
    }

} elseif ( is_author() ) {
    $archive_subtitle = esc_html__( 'Author', 'tailpress' );
    $archive_title    = get_the_author();

} else {
    $archive_subtitle = esc_html__( 'Archive', 'tailpress' );
    $archive_title    = post_type_archive_title( '', false );
    if ( empty( $archive_title ) ) {
        $archive_title = esc_html__( 'All Posts', 'tailpress' );
    }
}
?>

<section class="bg-white pt-10 sm:pt-12 md:pt-16 px-4">
    <div class="max-w-[1220px] mx-auto sm:px-4 md:px-5">

        <!-- Archive Header -->
        <div class="px-4 sm:px-6 md:px-8 lg:px-10 mb-8 sm:mb-16 md:mb-20">

            <?php if ( ! empty( $archive_subtitle ) ) : ?>
            <p class="font-opensans font-normal text-[#777777] text-base sm:text-lg md:text-xl/8 mb-2 sm:mb-3 text-center">
                <?php echo esc_html( $archive_subtitle ); ?>
            </p>
            <?php endif; ?>

            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-normal text-[#000000] font-manrope leading-tight sm:leading-snug md:leading-[72px] text-center">
                <?php echo esc_html( $archive_title ); ?>
            </h1>

            <?php if ( ! empty( $archive_description ) ) : ?>
            <div class="max-w-[680px] mx-auto mt-6 text-center">
                <p class="font-opensans font-normal text-[#777777] text-base sm:text-lg md:text-xl/8">
                    <?php echo wp_kses_post( $archive_description ); ?>
                </p>
            </div>
            <?php endif; ?>

            <!-- Category Pills - Related Categories -->
            <?php if ( is_category() ) : ?>
            <?php
            $siblings = get_categories( array(
                'parent'  => get_queried_object()->parent ?? 0,
                'exclude' => get_queried_object_id(),
                'number'  => 6,
                'hide_empty' => true,
            ) );
            ?>
            <?php if ( ! empty( $siblings ) ) : ?>
            <div class="flex flex-wrap justify-center gap-2 sm:gap-3 mt-6 sm:mt-8">
                <a href="<?php echo esc_url( get_category_link( get_queried_object_id() ) ); ?>"
                   class="font-opensans font-bold text-sm px-4 py-2 rounded-full bg-[#0A2640] text-white transition-colors duration-200">
                    <?php echo esc_html( single_cat_title( '', false ) ); ?>
                </a>
                <?php foreach ( $siblings as $sibling ) : ?>
                <a href="<?php echo esc_url( get_category_link( $sibling->term_id ) ); ?>"
                   class="font-opensans font-normal text-sm px-4 py-2 rounded-full border-2 border-gray-200 text-[#777777] hover:border-[#0A2640] hover:text-[#0A2640] transition-colors duration-200">
                    <?php echo esc_html( $sibling->name ); ?>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <?php endif; ?>

        </div>

        <?php if ( have_posts() ) : ?>

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

                            <!-- Short excerpt -->
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

            <!-- No Posts Found -->
            <div class="max-w-[600px] mx-auto text-center px-4 pb-20">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-[#777777]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2Z"/>
                    </svg>
                </div>
                <h2 class="font-manrope text-2xl sm:text-3xl font-normal text-[#000000] mb-4">
                    <?php echo esc_html__( 'No Posts Found', 'tailpress' ); ?>
                </h2>
                <p class="font-opensans font-normal text-[#777777] text-base sm:text-lg mb-8">
                    <?php echo esc_html__( 'No posts found in this archive yet. Check back later.', 'tailpress' ); ?>
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