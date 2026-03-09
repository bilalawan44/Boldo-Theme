<?php
/**
 * Boldo Comment Template
 *
 * Custom callback for wp_list_comments()
 * Yeh file automatically load hoti hai functions.php se.
 *
 * Usage in single.php:
 *   wp_list_comments( array( 'callback' => 'boldo_comment_template', ... ) );
 *
 * @package Boldo
 * @version 1.0.0
 */

// Direct access block karo
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'boldo_comment_template' ) ) :

/**
 * Single comment ka HTML render karta hai
 *
 * @param WP_Comment $comment Comment object
 * @param array      $args    wp_list_comments() arguments
 * @param int        $depth   Nesting depth
 */
function boldo_comment_template( $comment, $args, $depth ) {

    // li ya div — style argument pe depend karta hai
    $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
    ?>
    <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( 'boldo-comment-item', $comment ); ?>>

        <div class="bg-white border border-gray-100 rounded-2xl p-5 sm:p-6">

            <!-- Author Row: Avatar + Name + Date + Reply -->
            <div class="flex items-start gap-3 sm:gap-4 mb-3">

                <!-- Avatar -->
                <?php echo get_avatar(
                    $comment,
                    $args['avatar_size'],
                    '',
                    '',
                    array(
                        'class' => 'rounded-full object-cover flex-shrink-0',
                        'style' => 'width:44px;height:44px;',
                    )
                ); ?>

                <!-- Name + Date -->
                <div class="flex-1 min-w-0">

                    <div class="flex flex-wrap items-center gap-2">
                        <!-- Author name (linked if URL provided) -->
                        <span class="font-opensans font-bold text-sm sm:text-base text-[#000000]">
                            <?php comment_author_link( $comment ); ?>
                        </span>

                        <!-- Awaiting moderation badge -->
                        <?php if ( '0' === $comment->comment_approved ) : ?>
                        <span class="font-opensans text-xs text-[#856404] bg-[#fff3cd] border border-[#ffe08a] rounded-full px-3 py-0.5">
                            <?php esc_html_e( 'Awaiting moderation', 'tailpress' ); ?>
                        </span>
                        <?php endif; ?>
                    </div>

                    <!-- Comment date & time -->
                    <a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>"
                       class="font-opensans text-xs text-[#777777] hover:text-[#0A2640] transition-colors duration-200 mt-0.5 block">
                        <?php printf(
                            /* translators: 1: date, 2: time */
                            esc_html__( '%1$s at %2$s', 'tailpress' ),
                            get_comment_date( '', $comment ),
                            get_comment_time()
                        ); ?>
                    </a>

                </div>

                <!-- Reply Button -->
                <?php if ( $args['max_depth'] > $depth ) : ?>
                <div class="ml-auto flex-shrink-0">
                    <?php comment_reply_link( array_merge( $args, array(
                        'add_below'  => 'comment',
                        'depth'      => $depth,
                        'max_depth'  => $args['max_depth'],
                        'before'     => '',
                        'after'      => '',
                        'reply_text' =>
                            '<svg style="display:inline;width:12px;height:12px;margin-right:4px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">'
                            . '<path d="M9 15 3 9l6-6"/>'
                            . '<path d="M3 9h13a5 5 0 0 1 0 10h-1"/>'
                            . '</svg>'
                            . esc_html__( 'Reply', 'tailpress' ),
                    ) ) ); ?>
                </div>
                <?php endif; ?>

            </div>

            <!-- Comment Body -->
            <div class="font-opensans text-sm sm:text-base text-[#333333] leading-7 pl-0 sm:pl-[56px]">
                <?php comment_text( $comment ); ?>
            </div>

        </div>

    <?php
    // Note: closing </li> WordPress khud lagate hai — yahan mat likho
}

endif;