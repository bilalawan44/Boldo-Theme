<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php
// Reading time
$content      = get_the_content();
$word_count   = str_word_count( strip_tags( $content ) );
$reading_time = max( 1, ceil( $word_count / 200 ) );

// Category
$cat = get_the_category();

// Related posts
$category_ids  = wp_list_pluck( $cat, 'term_id' );
$related_query = new WP_Query( array(
    'category__in'        => $category_ids,
    'post__not_in'        => array( get_the_ID() ),
    'posts_per_page'      => 3,
    'orderby'             => 'rand',
    'ignore_sticky_posts' => 1,
) );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'bg-white' ); ?>>

    <!-- ========== SECTION 1: TWO COLUMN HERO ========== -->
    <section class="pt-10 sm:pt-12 md:pt-14 px-4">
        <div class="max-w-[1220px] mx-auto sm:px-4 md:px-5">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                
                <!-- LEFT COLUMN - Text Content -->
                <div>
                    <?php if ( ! empty( $cat ) ) : ?>
                    <div class="mb-4">
                        <a href="<?php echo esc_url( get_category_link( $cat[0]->term_id ) ); ?>"
                           class="font-opensans font-bold text-sm sm:text-base text-[#0A2640] hover:text-[#65E4A3] transition-colors duration-200 uppercase tracking-wider">
                            <?php echo esc_html( $cat[0]->name ); ?>
                        </a>
                    </div>
                    <?php endif; ?>
                    
                    <h1 class="font-manrope font-bold text-2xl sm:text-3xl md:text-4xl lg:text-4xl text-[#0A2640] lg:leading-[60px] sm:leading-snug mb-6">
                        <?php the_title(); ?>
                    </h1>
                    
                    <div class="font-opensans text-base sm:text-lg text-[#0a2640] leading-relaxed mb-8">
                        <?php echo wp_trim_words( get_the_excerpt(), 40, '...' ); ?>
                    </div>
                    
                    <div class="flex items-center gap-3 sm:gap-4">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 48, '', '', array(
                            'class' => 'w-10 h-10 sm:w-12 sm:h-12 rounded-full object-cover flex-shrink-0'
                        ) ); ?>
                        <div>
                            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
                               class="font-opensans font-bold text-sm sm:text-base text-[#0a2640] hover:text-[#0A2640] transition-colors duration-200">
                                <?php the_author(); ?>
                            </a>
                            <div class="font-opensans text-xs sm:text-sm text-[#777777]">
                                <?php echo esc_html( get_the_date( 'F j, Y' ) ); ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- RIGHT COLUMN - Featured Image -->
                <div class="mt-6 lg:mt-0">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="overflow-hidden rounded-2xl aspect-[5/3]">
                            <?php the_post_thumbnail( 'full', array(
                                'class' => 'w-full h-full object-cover'
                            ) ); ?>
                        </div>
                    <?php else : ?>
                        <div class="bg-[#F7F9FC] rounded-2xl aspect-[5/3] flex items-center justify-center">
                            <svg class="w-24 h-24 text-[#0A2640] opacity-20" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                                <rect x="3" y="3" width="18" height="18" rx="2" stroke="currentColor"/>
                                <circle cx="8.5" cy="8.5" r="1.5" fill="currentColor"/>
                                <polyline points="21 15 16 10 5 21" stroke="currentColor"/>
                            </svg>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== SECTION 2: THREE COLUMN LAYOUT ========== -->
    <section class="px-4 py-16 sm:py-20">
        <div class="max-w-[1220px] mx-auto sm:px-4 md:px-5">

            <!-- ─── MOBILE / TABLET: Table of Contents (shown above content, hidden on lg) ─── -->
            <div class="lg:hidden mb-8">
                <button id="toc-toggle"
                    onclick="var b=document.getElementById('toc-mobile');var a=document.getElementById('toc-arrow');b.classList.toggle('hidden');a.classList.toggle('rotate-180');"
                    class="w-full flex items-center justify-between bg-[#F7F9FC] border rounded-2xl px-4 py-3">
                    <span class="font-manrope font-bold text-base text-[#0A2640]">Table of Contents</span>
                    <svg id="toc-arrow" class="w-4 h-4 text-[#0A2640] transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </button>
                <div id="toc-mobile" class="hidden bg-[#F7F9FC] border border-t-0 rounded-b-2xl px-4 pb-4">
                    <div id="table-of-contents-mobile" class="pt-3">
                        <p class="text-xs text-[#777777]">Loading...</p>
                    </div>
                </div>
            </div>

            <!-- ─── DESKTOP: three-column flex row ─── -->
            <div class="flex flex-col lg:flex-row lg:gap-[45px] lg:justify-between">

                <!-- LEFT COLUMN - Table of Contents (desktop only, sticky) -->
                <div class="hidden lg:block lg:flex-shrink-0">
                    <div class="sticky top-8 w-[260px]">
                        <div class="font-manrope font-bold text-lg text-[#0A2640] mb-4">
                            Table of Contents
                        </div>
                        <div id="table-of-contents" class="bg-[#F7F9FC] border rounded-2xl p-4">
                            <p class="text-xs text-[#777777]">Loading...</p>
                        </div>
                    </div>
                </div>
                
                <!-- MIDDLE COLUMN - Main Content -->
                <div class="w-full lg:flex-1 min-w-0">
                    <div class="prose-boldo w-full lg:max-w-[570px]">
                        <?php the_content(); ?>
                        
                        <?php wp_link_pages( array(
                            'before' => '<div class="mt-8 flex items-center gap-2 font-opensans font-bold text-sm text-[#0A2640]">' . esc_html__( 'Pages:', 'tailpress' ),
                            'after'  => '</div>',
                        ) ); ?>
                    </div>

                    <!-- ========== COMMENTS SECTION ========== -->
                    <?php if ( comments_open() || get_comments_number() ) : ?>
                    <section class="pt-10 bg-white" id="comments-section">
                        <div class="pb-12">

                            <h2 class="font-manrope font-normal text-2xl text-[#0a2640] mb-3">
                                <?php esc_html_e( 'Leave a Reply', 'tailpress' ); ?>
                            </h2>

                            <p class="font-opensans text-sm text-[#777777] mb-6 leading-relaxed">
                                <?php esc_html_e( 'Your email address will not be published. Required fields are marked *', 'tailpress' ); ?>
                            </p>

                            <?php if ( comments_open() ) : ?>
                                <?php if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ) : ?>
                                    <p class="font-opensans text-base text-[#777777] py-6">
                                        <?php printf(
                                            esc_html__( 'You must be %s to post a comment.', 'tailpress' ),
                                            '<a href="' . esc_url( wp_login_url( get_permalink() ) ) . '" class="text-[#0A2640] font-bold hover:underline">' . esc_html__( 'logged in', 'tailpress' ) . '</a>'
                                        ); ?>
                                    </p>
                                <?php else : ?>
                                    <div id="respond" class="comment-respond">
                                        <?php comment_form( array(
                                            'title_reply'          => '',
                                            'title_reply_before'   => '',
                                            'title_reply_after'    => '',
                                            'cancel_reply_before'  => '<p class="mb-4">',
                                            'cancel_reply_after'   => '</p>',
                                            'cancel_reply_link'    => esc_html__( 'Cancel reply', 'tailpress' ),
                                            'label_submit'         => esc_html__( 'Post Comment', 'tailpress' ),

                                            'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="%3$s bg-[#2563eb] hover:bg-[#1d4ed8] text-white font-opensans font-bold text-sm px-8 py-3 rounded transition-colors duration-200">%4$s</button>',
                                            'submit_field'  => '<div class="flex justify-end">%1$s %2$s</div>',

                                            'comment_field' =>
                                                '<div class="mb-5">' .
                                                    '<textarea id="comment" name="comment" rows="5" required ' .
                                                        'class="w-full border border-gray-200 rounded-lg p-3 font-opensans text-sm bg-[#f5f8fc] focus:border-[#0A2640] focus:outline-none resize-y">' .
                                                    '</textarea>' .
                                                '</div>',

                                            'fields' => array(
                                                'author' =>
                                                    '<div class="mb-5">' .
                                                        '<label for="author" class="font-opensans font-bold text-sm text-[#0A2640] block mb-2">Name *</label>' .
                                                        '<input id="author" name="author" type="text" required ' .
                                                            'class="w-full border border-gray-200 rounded-lg p-3 font-opensans text-sm bg-[#f5f8fc] focus:border-[#0A2640] focus:outline-none">' .
                                                    '</div>',

                                                'email' =>
                                                    '<div class="mb-5">' .
                                                        '<label for="email" class="font-opensans font-bold text-sm text-[#0A2640] block mb-2">Email *</label>' .
                                                        '<input id="email" name="email" type="email" required ' .
                                                            'class="w-full border border-gray-200 rounded-lg p-3 font-opensans text-sm bg-[#f5f8fc] focus:border-[#0A2640] focus:outline-none">' .
                                                    '</div>',

                                                'url' =>
                                                    '<div class="mb-5">' .
                                                        '<label for="url" class="font-opensans font-bold text-sm text-[#0A2640] block mb-2">Website</label>' .
                                                        '<input id="url" name="url" type="url" ' .
                                                            'class="w-full border border-gray-200 rounded-lg p-3 font-opensans text-sm bg-[#f5f8fc] focus:border-[#0A2640] focus:outline-none">' .
                                                    '</div>',

                                                'cookies' =>
                                                    '<div class="flex items-start gap-3 mb-7">' .
                                                        '<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" ' .
                                                            'class="mt-1 w-4 h-4 accent-[#0A2640] cursor-pointer flex-shrink-0">' .
                                                        '<label for="wp-comment-cookies-consent" class="font-opensans text-sm text-[#555] leading-relaxed cursor-pointer">' .
                                                            esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'tailpress' ) .
                                                        '</label>' .
                                                    '</div>',
                                            ),

                                            'comment_notes_before' => '',
                                            'comment_notes_after'  => '',
                                        ) ); ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                        </div>
                    </section>
                    <?php endif; ?>

                </div>
                
                <!-- RIGHT COLUMN - Share + Written By + Related Posts -->
                <!-- On mobile/tablet: shown below content as full-width block -->
                <!-- On desktop: sticky sidebar -->
                <div class="mt-10 lg:mt-0 lg:flex-shrink-0">
                    <div class="lg:sticky lg:top-8 lg:space-y-0 lg:w-[260px] w-full">

                        <!-- ===== SHARE THE ARTICLE SECTION ===== -->
                        <div class="py-6">
                            <div class="font-opensans font-bold text-md text-[#0A2640] mb-4">
                                Share The Article
                            </div>
                            <div class="flex items-center gap-4">
                                <!-- Twitter -->
                                <a href="https://twitter.com/intent/tweet?url=<?php echo rawurlencode( get_permalink() ); ?>&text=<?php echo rawurlencode( get_the_title() ); ?>"
                                   target="_blank" rel="noopener noreferrer"
                                   class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-[#777777] hover:text-[#0A2640] hover:border-[#0A2640] transition-all duration-200">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                    </svg>
                                </a>
                                <!-- Facebook -->
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode( get_permalink() ); ?>"
                                   target="_blank" rel="noopener noreferrer"
                                   class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-[#777777] hover:text-[#0A2640] hover:border-[#0A2640] transition-all duration-200">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/>
                                    </svg>
                                </a>
                                <!-- LinkedIn -->
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo rawurlencode( get_permalink() ); ?>"
                                   target="_blank" rel="noopener noreferrer"
                                   class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-[#777777] hover:text-[#0A2640] hover:border-[#0A2640] transition-all duration-200">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                </a>
                                <!-- Copy Link -->
                                <button onclick="navigator.clipboard.writeText('<?php echo esc_js( get_permalink() ); ?>').then(function() { alert('Link copied!'); });"
                                   class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-[#777777] hover:text-[#0A2640] hover:border-[#0A2640] transition-all duration-200 cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Separator -->
                        <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 0;">

                        <!-- ===== WRITTEN BY SECTION ===== -->
                        <div class="py-6">
                            <div class="font-opensans font-bold text-md text-[#0A2640] mb-4">
                                Written By
                            </div>
                            <div class="flex items-center gap-3 mb-4">
                                <?php echo get_avatar( get_the_author_meta( 'ID' ), 56, '', '', array(
                                    'class' => 'w-14 h-14 rounded-full object-cover flex-shrink-0'
                                ) ); ?>
                                <div>
                                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
                                       class="font-opensans font-bold text-base text-[#0A2640] transition-colors duration-200 block">
                                        <?php the_author(); ?>
                                    </a>
                                    <div class="font-opensans text-sm text-[#777777]">
                                        <?php echo esc_html( get_the_date( 'F j, Y' ) ); ?>
                                    </div>
                                </div>
                            </div>
                            <?php $bio = get_the_author_meta( 'description' ); ?>
                            <p class="font-opensans text-sm text-[#1a1a1a] leading-relaxed mb-4">
                                <?php if ( $bio ) : ?>
                                    <?php echo esc_html( $bio ); ?>
                                <?php else : ?>
                                    <?php the_author(); ?> is a contributor at <?php echo get_bloginfo('name'); ?>.
                                <?php endif; ?>
                            </p>
                            <div class="flex items-center gap-4">
                                <?php $facebook = get_the_author_meta('facebook'); ?>
                                <a href="<?php echo $facebook ? esc_url($facebook) : '#'; ?>" class="text-[#0A2640] transition-colors duration-200">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/>
                                    </svg>
                                </a>
                                <?php $quora = get_the_author_meta('quora'); ?>
                                <a href="<?php echo $quora ? esc_url($quora) : '#'; ?>" class="text-[#0A2640] transition-colors duration-200">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 0C5.373 0 0 5.373 0 12c0 6.628 5.373 12 12 12 6.628 0 12-5.372 12-12 0-6.627-5.372-12-12-12zm4.466 17.638c-.532-.617-1.098-1.199-1.76-1.682-.23-.164-.469-.312-.716-.445.459-.87.707-1.927.707-3.136 0-3.363-1.944-5.375-4.697-5.375-2.754 0-4.699 2.012-4.699 5.375 0 3.348 1.945 5.353 4.699 5.353.516 0 1.007-.07 1.464-.2.16.122.312.253.457.392.548.524 1.01 1.131 1.383 1.788C11.907 20.481 10.478 21 9 21c-4.418 0-8-3.582-8-8s3.582-8 8-8 8 3.582 8 8c0 1.747-.559 3.362-1.534 4.638z"/>
                                    </svg>
                                </a>
                                <?php $medium = get_the_author_meta('medium'); ?>
                                <a href="<?php echo $medium ? esc_url($medium) : '#'; ?>" class="text-[#0A2640] transition-colors duration-200">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M2.846 6.887c.03-.295-.083-.586-.303-.784l-2.24-2.7v-.403h6.958l5.378 11.795 4.728-11.795h6.633v.403l-1.916 1.837c-.165.126-.247.333-.213.538v13.498c-.034.204.048.411.213.537l1.871 1.837v.403h-9.412v-.403l1.939-1.882c.19-.19.19-.246.19-.537v-10.91l-5.389 13.688h-.728l-6.275-13.688v9.174c-.052.385.076.774.347 1.052l2.521 3.058v.404h-7.148v-.404l2.521-3.058c.27-.279.39-.67.325-1.052v-10.608z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Separator -->
                        <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 0;">

                        <!-- ===== RELATED POSTS SECTION ===== -->
                        <?php if ( $related_query->have_posts() ) : ?>
                            <div class="py-6">
                                <div class="font-opensans font-bold text-md text-[#0A2640] mb-4">
                                    Related Posts
                                </div>
                                <div>
                                    <?php $post_count = 0; while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
                                        <?php if ( $post_count > 0 ) : ?>
                                            <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 12px 0;">
                                        <?php endif; ?>
                                        <a href="<?php the_permalink(); ?>" class="group flex gap-3 items-center">
                                            <div class="w-[120px] h-[80px] flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden">
                                                <?php if ( has_post_thumbnail() ) : ?>
                                                    <?php the_post_thumbnail( 'thumbnail', array(
                                                        'class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-300'
                                                    ) ); ?>
                                                <?php else : ?>
                                                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                                        <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="flex-1 flex items-center">
                                                <h4 class="font-opensans text-sm text-[#000000] group-hover:text-[#0A2640] transition-colors duration-200 line-clamp-2 leading-snug">
                                                    <?php the_title(); ?>
                                                </h4>
                                            </div>
                                        </a>
                                    <?php $post_count++; endwhile; wp_reset_postdata(); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>

            </div>
        </div>
    </section>
    
</article>

<!-- JavaScript for Table of Contents -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const content = document.querySelector('.prose-boldo');

    function buildTOC(container) {
        if (!content) {
            container.innerHTML = '<p class="text-xs text-[#777777]">No content found</p>';
            return;
        }

        const headings = content.querySelectorAll('h2, h3');

        if (!container || headings.length === 0) {
            container.innerHTML = '<p class="text-xs text-[#777777]">No headings found</p>';
            return;
        }

        let tocHTML = '<ol class="list-none p-0 m-0">';
        let mainCounter = 0;
        let subCounter = 0;
        let inSubList = false;

        headings.forEach(function(heading, index) {
            var tagName = heading.tagName;
            var headingText = heading.textContent.trim();
            if (!headingText) return;

            if (!heading.id) {
                heading.id = 'heading-' + index + '-' + headingText.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
            }

            if (tagName === 'H2') {
                if (inSubList) {
                    tocHTML += '</ol></li>';
                    inSubList = false;
                }
                mainCounter++;
                subCounter = 0;

                tocHTML += '<li style="margin-bottom:10px;list-style:none;">' +
                    '<a href="#' + heading.id + '" style="font-family:\'Open Sans\',sans-serif;font-size:12.5px;font-weight:400;color:#0a2640;text-decoration:none;line-height:1.4;display:flex;gap:0;">' +
                    '<span style="flex-shrink:0;min-width:22px;">' + mainCounter + '.</span>' +
                    '<span style="flex:1;">' + headingText + '</span>' +
                    '</a>';

                var next = headings[index + 1];
                if (!next || next.tagName === 'H2') {
                    tocHTML += '</li>';
                }

            } else if (tagName === 'H3') {
                subCounter++;

                if (!inSubList) {
                    tocHTML += '<ol class="list-none p-0 m-0" style="margin-top:6px;margin-left:12px;">';
                    inSubList = true;
                }

                tocHTML += '<li style="margin-bottom:7px;list-style:none;">' +
                    '<a href="#' + heading.id + '" style="font-family:\'Open Sans\',sans-serif;font-size:12.5px;font-weight:400;color:#0a2640;text-decoration:none;line-height:1.4;display:flex;gap:0;">' +
                    '<span style="flex-shrink:0;min-width:32px;">' + mainCounter + '.' + subCounter + '.</span>' +
                    '<span style="flex:1;">' + headingText + '</span>' +
                    '</a></li>';

                var nextH = headings[index + 1];
                if (!nextH || nextH.tagName === 'H2') {
                    tocHTML += '</ol></li>';
                    inSubList = false;
                }
            }
        });

        if (inSubList) tocHTML += '</ol></li>';
        tocHTML += '</ol>';
        container.innerHTML = tocHTML;

        container.querySelectorAll('a').forEach(function(anchor) {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                var target = document.querySelector(this.getAttribute('href'));
                if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                // Close mobile TOC after click
                var mob = document.getElementById('toc-mobile');
                if (mob && !mob.classList.contains('hidden')) mob.classList.add('hidden');
            });
        });
    }

    // Build desktop TOC
    var desktopTOC = document.getElementById('table-of-contents');
    if (desktopTOC) buildTOC(desktopTOC);

    // Build mobile TOC
    var mobileTOC = document.getElementById('table-of-contents-mobile');
    if (mobileTOC) buildTOC(mobileTOC);
});
</script>

<style>
.prose-boldo { font-family:'Open Sans',sans-serif; font-size:1.0625rem; line-height:1.85; color:#0a2640; }
.prose-boldo h1,.prose-boldo h2,.prose-boldo h3,.prose-boldo h4 { font-family:'Manrope',sans-serif; color:#0a2640; font-weight:400; margin-top:2.25rem; margin-bottom:1rem; line-height:1.25; }
.prose-boldo h2{font-size:1.75rem;} .prose-boldo h3{font-size:1.375rem;} .prose-boldo h4{font-size:1.125rem;font-weight:600;}
.prose-boldo p{margin-bottom:1.6rem;}
.prose-boldo a{color:#0A2640;text-decoration:underline;text-underline-offset:3px;} .prose-boldo a:hover{color:#65E4A3;}
.prose-boldo ul,.prose-boldo ol{padding-left:1.5rem;margin-bottom:1.5rem;} .prose-boldo li{margin-bottom:.5rem;}
.prose-boldo ul li{list-style-type:disc;} .prose-boldo ol li{list-style-type:decimal;}
.prose-boldo blockquote{border-left:4px solid #0A2640;padding:1rem 1.5rem;margin:2rem 0;background:#f8f9fa;border-radius:0 .75rem .75rem 0;}
.prose-boldo blockquote p{font-style:italic;color:#0A2640;margin-bottom:0;font-size:1.1rem;}
.prose-boldo img{border-radius:.75rem;width:100%;height:auto;margin:2rem 0;}
.prose-boldo pre{background:#0A2640;color:#65E4A3;padding:1.5rem;border-radius:.75rem;overflow-x:auto;margin:2rem 0;font-size:.875rem;}
.prose-boldo code{background:#f0f4f8;color:#0A2640;padding:.15rem .4rem;border-radius:.25rem;font-size:.9em;}
.prose-boldo pre code{background:transparent;color:inherit;padding:0;}
.prose-boldo hr{border:none;border-top:2px solid #f0f0f0;margin:2.5rem 0;}
.prose-boldo table{width:100%;border-collapse:collapse;margin:2rem 0;font-size:.9rem;}
.prose-boldo th{background:#0A2640;color:#fff;padding:.75rem 1rem;text-align:left;font-family:'Open Sans',sans-serif;font-weight:700;}
.prose-boldo td{padding:.75rem 1rem;border-bottom:1px solid #f0f0f0;}
.prose-boldo tr:hover td{background:#f8f9fa;}
.prose-boldo .wp-block-image.alignleft{float:left;margin-right:1.5rem;}
.prose-boldo .wp-block-image.alignright{float:right;margin-left:1.5rem;}
.prose-boldo .wp-block-image.aligncenter{margin-left:auto;margin-right:auto;}
.prose-boldo::after{content:"";display:table;clear:both;}
.line-clamp-2{display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}

/* Mobile table overflow fix */
@media (max-width: 1023px) {
    .prose-boldo table { display: block; overflow-x: auto; -webkit-overflow-scrolling: touch; }
}
</style>

<?php endwhile; ?>

<?php get_footer(); ?>