<?php
/**
 * Blog Hero Block Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Get ACF fields for customization
$background_color = get_field('background_color') ?: '#FFFFFF';
$blog_label = get_field('blog_label') ?: 'Blog';
$blog_label_color = get_field('blog_label_color') ?: '#0A2640';
$main_heading = get_field('main_heading') ?: 'Thoughts and words';
$main_heading_color = get_field('main_heading_color') ?: '#0A2640';
$category_color = get_field('category_color') ?: '#0A2640';
$date_color = get_field('date_color') ?: '#777777';
$post_title_color = get_field('post_title_color') ?: '#000000';
$author_name_color = get_field('author_name_color') ?: '#000000';
$divider_color = get_field('divider_color') ?: '#0A2640';

// Check if manual post selection is enabled
$enable_manual = get_field('enable_manual_post');
$featured_post = get_field('featured_post');

if ($enable_manual && !empty($featured_post)) {
    // Use manually selected post
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 1,
        'post_status'    => 'publish',
        'p'              => $featured_post->ID,
    );
} else {
    // Default: latest post
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 1,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC'
    );
}

$latest_post_query = new WP_Query($args);

if ($latest_post_query->have_posts()) :
    while ($latest_post_query->have_posts()) : $latest_post_query->the_post();
        
        // Get post data
        $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
        $categories = get_the_category();
        $category_name = !empty($categories) ? $categories[0]->name : 'Category';
        $post_date = get_the_date('F j, Y');
        $post_title = get_the_title();
        $author_id = get_the_author_meta('ID');
        $author_name = get_the_author();
        $author_avatar = get_avatar_url($author_id, array('size' => 96));
        
?>

<!--Blog Hero-->
<section class="pt-8 pb-6 sm:pt-12 md:pt-20 lg:pt-32 xl:pt-[72px] sm:pb-6 md:pb-8 lg:pb-10 xl:pb-[48px]" style="background-color: <?php echo esc_attr($background_color); ?>;">
    <div class="mx-auto max-w-[1200px] px-5 lg:px-0 xl:px-0 lg:pl-5 xl:pl-5">
        <!-- Blog Label -->
        <div class="text-center mb-2 sm:mb-3">
            <p class="font-opensans font-normal text-base sm:text-lg md:text-xl" style="color: <?php echo esc_attr($blog_label_color); ?>;">
                <?php echo esc_html($blog_label); ?>
            </p>
        </div>

        <!-- Main Heading -->
        <h1 class="font-manrope font-normal text-2xl sm:text-3xl md:text-4xl lg:text-[56px] xl:text-[64px] leading-tight sm:leading-[40px] md:leading-[48px] lg:leading-[72px] xl:leading-[84px] text-center mb-6 sm:mb-8 md:mb-10 lg:mb-12 xl:mb-[67px]" style="color: <?php echo esc_attr($main_heading_color); ?>;">
            <?php echo esc_html($main_heading); ?>
        </h1>

        <!-- Content Container -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 md:gap-10 lg:gap-16 xl:gap-[100px]">
            <!-- Left Card -->
            <div class="w-full lg:max-w-none lg:w-full order-1 lg:order-1">
                <?php if ($featured_image): ?>
                <div class="rounded-2xl overflow-hidden">
                    <img src="<?php echo esc_url($featured_image); ?>" alt="<?php echo esc_attr($post_title); ?>" class="w-full h-auto">
                </div>
                <?php else: ?>
                <div class="rounded-2xl overflow-hidden bg-gray-200 aspect-video flex items-center justify-center">
                    <p class="text-gray-500">No featured image</p>
                </div>
                <?php endif; ?>
            </div>

            <!-- Right Content -->
            <div class="w-full lg:max-w-none lg:w-full pt-4 lg:pt-12 xl:pt-[70px] order-2 lg:order-2">
                <div>
                    <!-- Category and Date -->
                    <div class="flex items-center gap-2 mb-2 sm:mb-3">
                        <?php
                        $cat = get_the_category();
                        if ( ! empty( $cat ) ) : ?>
                        <a href="<?php echo esc_url( get_category_link( $cat[0]->term_id ) ); ?>"
                           class="font-opensans font-bold text-sm sm:text-base/7 text-[#0A2640] "
                           onclick="event.stopPropagation();">
                        <?php echo esc_html( $cat[0]->name ); ?>
                         </a>
                        <span class="text-[#777777]">·</span>
                        <?php endif; ?>
                        <a href="<?php echo esc_url( get_day_link( get_the_date( 'Y' ), get_the_date( 'm' ), get_the_date( 'd' ) ) ); ?>"
                           class="font-opensans font-normal text-sm sm:text-base/7 text-gray-600  hover:text-[#0A2640] transition-colors duration-200"
                           onclick="event.stopPropagation();">
                        <?php echo esc_html( get_the_date( 'F j, Y' ) ); ?>
                        </a>
                    </div>
                    

                    <!-- Post Title -->
                    <h2 class="font-manrope font-normal text-xl sm:text-2xl md:text-3xl lg:text-[44px] xl:text-5xl leading-tight sm:leading-[32px] md:leading-[40px] lg:leading-[60px] xl:leading-[72px]" style="color: <?php echo esc_attr($post_title_color); ?>;">
                        <?php echo esc_html($post_title); ?>
                    </h2>

                    <!-- Author -->
                    <div class="flex items-center gap-3 pt-4 sm:pt-5">
                        <div class="rounded-full overflow-hidden flex-shrink-0 w-8 h-8">
                            <img src="<?php echo esc_url($author_avatar); ?>" alt="<?php echo esc_attr($author_name); ?>" class="w-full h-full object-cover">
                        </div>
                        <p class="font-opensans font-normal text-sm sm:text-base" style="color: <?php echo esc_attr($author_name_color); ?>;">
                            <?php echo esc_html($author_name); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Horizontal Line -->
        <div class="mt-6 sm:mt-8 md:mt-12 lg:mt-14 xl:mt-[72px]">
            <hr class="border-t" style="border-color: <?php echo esc_attr($divider_color); ?>;">
        </div>
    </div>
</section>

<?php
    endwhile;
    wp_reset_postdata();
else:
?>
<section class="pt-8 pb-6 sm:pt-12 md:pt-20 lg:pt-32 xl:pt-[72px] sm:pb-6 md:pb-8 lg:pb-10 xl:pb-[48px]" style="background-color: <?php echo esc_attr($background_color); ?>;">
    <div class="mx-auto max-w-[1200px] px-5">
        <p class="text-center text-gray-500">No posts found.</p>
    </div>
</section>
<?php
endif;
?>