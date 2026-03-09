<?php
/**
 * Blog Section with ACF Fields Integration
 * Field Group: Blog Posts Section
 */

// ─── Get ACF Fields ───────────────────────────────────────────────────────────

$subtitle             = get_field('subtitle')             ?? get_field('subtitle', 'option');
$title                = get_field('title')                ?? get_field('title', 'option');
$initial_posts        = get_field('initial_posts')        ?? get_field('initial_posts', 'option');
$load_more_count      = get_field('load_more_count')      ?? get_field('load_more_count', 'option');
$posts_per_page       = get_field('posts_per_page')       ?? get_field('posts_per_page', 'option');
$show_subtitle        = get_field('show_subtitle')        ?? get_field('show_subtitle', 'option');
$show_title           = get_field('show_title')           ?? get_field('show_title', 'option');
$subtitle_alignment   = get_field('subtitle_alignment')   ?? get_field('subtitle_alignment', 'option');
$title_alignment      = get_field('title_alignment')      ?? get_field('title_alignment', 'option');
$manual_posts         = get_field('manual_posts')         ?? get_field('manual_posts', 'option');
$enable_manual_posts  = get_field('enable_manual_posts')  ?? get_field('enable_manual_posts', 'option');

// ─── Defaults ─────────────────────────────────────────────────────────────────

$initial_posts   = absint($initial_posts)   ?: 6;
$load_more_count = absint($load_more_count) ?: 3;
$posts_per_page  = absint($posts_per_page)  ?: 50;

$show_subtitle       = ($show_subtitle === null || $show_subtitle === '')             ? true  : (bool) $show_subtitle;
$show_title          = ($show_title === null || $show_title === '')                   ? true  : (bool) $show_title;
$enable_manual_posts = ($enable_manual_posts === null || $enable_manual_posts === '') ? false : (bool) $enable_manual_posts;

$subtitle_alignment = $subtitle_alignment ?: 'center';
$title_alignment    = $title_alignment    ?: 'center';

$align = ['left' => 'text-left', 'center' => 'text-center', 'right' => 'text-right'];
$subtitle_align_class = $align[$subtitle_alignment] ?? 'text-center';
$title_align_class    = $align[$title_alignment]    ?? 'text-center';

// ─── Posts Logic ──────────────────────────────────────────────────────────────

$ordered_posts    = [];
$always_exclude   = [get_the_ID()];
$manual_post_ids  = [];

// Manual posts sirf tab use ho jab toggle ON ho aur posts select ki hon
if ($enable_manual_posts && !empty($manual_posts)) {

    foreach ($manual_posts as $row) {
        if (empty($row['post_item'])) continue;
        $p = is_object($row['post_item']) ? $row['post_item'] : get_post(intval($row['post_item']));
        if ($p) {
            $ordered_posts[]  = $p;
            $manual_post_ids[] = $p->ID;
        }
    }

    $all_excluded_ids = array_merge($always_exclude, $manual_post_ids);

    // Remaining posts count for load more
    $remaining_query = new WP_Query([
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'fields'         => 'ids',
        'post__not_in'   => $all_excluded_ids,
    ]);
    $total_posts = count($ordered_posts) + $remaining_query->found_posts;
    wp_reset_postdata();

} else {

    // Toggle OFF ya posts empty — latest posts automatically
    $all_excluded_ids = $always_exclude;

    $auto_query    = new WP_Query([
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => $posts_per_page,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'post__not_in'   => $all_excluded_ids,
    ]);
    $ordered_posts = $auto_query->posts;
    $total_posts   = $auto_query->found_posts;
    wp_reset_postdata();

}

$excluded_ids_str = implode(',', array_map('intval', $all_excluded_ids));
?>

<section class="bg-white pt-0 sm:pt-12 md:pt-16 lg:pt-16 xl:pt-16 px-4">
    <div class="max-w-[1120px] mx-auto sm:px-4 md:px-5">

        <!-- Header -->
        <div class="px-4 sm:px-6 md:px-8 lg:px-10 mb-8 sm:mb-16 md:mb-20">

            <?php if ($show_subtitle && $subtitle): ?>
                <p class="font-opensans font-normal text-[#777777] text-base sm:text-lg md:text-xl/8 mb-2 sm:mb-3 <?php echo esc_attr($subtitle_align_class); ?>">
                    <?php echo esc_html($subtitle); ?>
                </p>
            <?php endif; ?>

            <?php if ($show_title && $title): ?>
                <h2 class="text-xl sm:text-3xl md:text-4xl lg:text-5xl font-normal text-[#000000] font-manrope leading-tight sm:leading-snug md:leading-[72px] lg:leading-[72px] <?php echo esc_attr($title_align_class); ?>">
                    <?php echo esc_html($title); ?>
                </h2>
            <?php endif; ?>

        </div>

        <!-- Blog Cards Grid -->
        <div id="blogGrid"
            class="max-w-[998px] mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7 md:gap-8 mb-8 sm:mb-16 md:mb-20 lg:mb-20 xl:mb-20"
            data-initial-posts="<?php echo esc_attr($initial_posts); ?>"
            data-load-more-count="<?php echo esc_attr($load_more_count); ?>"
            data-total-posts="<?php echo esc_attr($total_posts); ?>"
            data-excluded-ids="<?php echo esc_attr($excluded_ids_str); ?>">

            <?php
            $post_index = 0;
            foreach ($ordered_posts as $post_obj):
                $post_index++;
                $hidden_class = ($post_index > $initial_posts) ? 'hidden' : '';
                $post_id      = $post_obj->ID;
                $post_link    = get_permalink($post_id);
                $post_title   = get_the_title($post_id);
                $post_date    = get_the_date('F j, Y', $post_id);
                $post_author  = get_the_author_meta('display_name', $post_obj->post_author);
                $post_cats    = get_the_category($post_id);
                $post_cat     = !empty($post_cats) ? $post_cats[0]->name : '';
                $thumb        = get_the_post_thumbnail($post_id, 'medium', ['class' => 'w-full h-full object-cover']);
                $avatar       = get_avatar($post_obj->post_author, 32, '', '', ['class' => 'w-8 h-8 rounded-full object-cover']);
            ?>

                <a href="<?php echo esc_url($post_link); ?>"
                    class="blog-card group cursor-pointer max-w-[300px] mx-auto lg:mx-0 flex flex-col h-full <?php echo $hidden_class; ?>"
                    data-post-index="<?php echo $post_index; ?>">

                    <div class="mb-4 sm:mb-5 md:mb-6 overflow-hidden rounded-lg aspect-[300/209]">
                        <?php if ($thumb): echo $thumb; else: ?>
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-400 text-sm">No Image</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="flex flex-col flex-1">
                        <div class="flex items-center gap-2 mb-2 sm:mb-3">
                            <span class="font-opensans font-bold text-sm sm:text-base/7 text-[#0A2640]">
                                <?php echo esc_html($post_cat); ?>
                            </span>
                            <span class="font-opensans font-normal text-sm sm:text-base/7 text-gray-600">
                                <?php echo esc_html($post_date); ?>
                            </span>
                        </div>
                        <p class="font-opensans font-normal text-lg sm:text-xl/8 text-[#000000] mb-3 sm:mb-4">
                            <?php echo esc_html($post_title); ?>
                        </p>
                        <div class="flex items-center gap-3 pt-3 sm:pt-4 md:pt-5 mt-auto">
                            <?php echo $avatar; ?>
                            <span class="font-opensans font-normal text-sm sm:text-base/7 text-[#000000]">
                                <?php echo esc_html($post_author); ?>
                            </span>
                        </div>
                    </div>

                </a>

            <?php endforeach; ?>

        </div>

        <!-- Load More / Offload Buttons -->
        <?php if ($total_posts > $initial_posts): ?>
        <div class="text-center flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center items-center">
            <button id="loadMoreBtn"
                class="font-opensans font-bold text-base sm:text-lg md:text-xl/7 px-10 sm:px-12 md:px-14 py-3 sm:py-3.5 md:py-4 border-2 border-[#0A2640] text-[#0A2640] rounded-full hover:bg-[#65E4A3] hover:text-[#0A2640] transition-colors duration-300 w-full sm:w-auto">
                Load more
            </button>
            <button id="offloadBtn"
                class="hidden font-opensans font-bold text-base sm:text-lg md:text-xl/7 px-10 sm:px-12 md:px-14 py-3 sm:py-3.5 md:py-4 border-2 border-[#0A2640] text-[#0A2640] rounded-full hover:bg-[#0A2640] hover:text-white transition-colors duration-300 w-full sm:w-auto">
                Offload
            </button>
        </div>
        <?php endif; ?>

    </div>
</section>