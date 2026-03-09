


<!-- Footer Section -->
        <section class="bg-white">
            <footer id="boldoFooter" class="max-w-[1220px] mx-auto bg-white py-4 sm:py-12 md:py-16 lg:py-16 xl:py-16 px-5">
                <div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8 sm:gap-10 md:gap-0">
                        <!-- Brand Section -->
                        <div class="max-w-[300px] sm:col-span-2 lg:col-span-2">
                            <div class="mb-6 sm:mb-8 md:mb-10">
                                <div>
                                    <?php $boldo_footer_logo = get_theme_mod( 'boldo_footer_logo', '' ); ?>
                                    <?php if ( ! empty( $boldo_footer_logo ) ) : ?>
                                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                            <img src="<?php echo esc_url( $boldo_footer_logo ); ?>" alt="<?php bloginfo( 'name' ); ?> Footer Logo">
                                        </a>
                                    <?php elseif ( function_exists('the_custom_logo') ) : ?>
                                        <?php 
                                        $custom_logo_id = get_theme_mod('custom_logo');
                                        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                                        if (has_custom_logo()) : ?>
                                            <a href="<?php echo esc_url(home_url('/')); ?>">
                                                <img src="<?php echo esc_url($logo[0]); ?>" alt="<?php bloginfo('name'); ?> Footer Logo">
                                            </a>
                                        <?php else : ?>
                                            <a href="<?php echo esc_url(home_url('/')); ?>">
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Footer Logo.svg" alt="<?php bloginfo('name'); ?> Footer Logo">
                                            </a>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <a href="<?php echo esc_url(home_url('/')); ?>">
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Footer Logo.svg" alt="<?php bloginfo('name'); ?> Footer Logo">
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <p
                                class="font-opensans text-lg sm:text-base leading-7 font-normal mb-0 sm:mb-12 md:mb-16 lg:mb-16 xl:mb-16 text-[#777777]">
                                <?php echo esc_html( get_theme_mod( 'boldo_footer_description', 'Social media validation business model canvas graphical user interface launch party creative facebook iPad twitter.' ) ); ?>
                            </p>
                            <p
                                class="font-opensans font-normal text-lg sm:text-base leading-7 text-[#777777] hidden lg:block">
                                <?php echo esc_html( get_theme_mod( 'boldo_footer_rights_text', 'All rights reserved.' ) ); ?></p>
                        </div>

                        <!-- Landings Section -->
                        <div>
                            <h3
                                class="font-opensans text-2xl sm:text-xl leading-8 text-[#000000] font-bold mb-4 md:mb-8 lg:mb-8 xl:mb-8">
                                <?php echo esc_html( get_theme_mod( 'boldo_footer_landings_title', 'Landings' ) ); ?></h3>
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'footer_landings',
                                    'container'      => false,
                                    'menu_class'     => 'space-y-2 md:space-y-8 lg:space-y-8 xl:space-y-8',
                                    'fallback_cb'    => false,
                                    'depth'          => 1,
                                )
                            );
                            ?>
                        </div>

                        <!-- Company Section - Hidden on small screens -->
                        <div>
                            <h3
                                class="font-opensans text-xl leading-8 text-[#000000] font-bold mb-4 md:mb-8 lg:mb-8 xl:mb-8">
                                <?php echo esc_html( get_theme_mod( 'boldo_footer_company_title', 'Company' ) ); ?>
                            </h3>
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'footer_company',
                                    'container'      => false,
                                    'menu_class'     => 'space-y-4 md:space-y-8 lg:space-y-8 xl:space-y-8',
                                    'fallback_cb'    => false,
                                    'depth'          => 1,
                                )
                            );
                            ?>
                        </div>

                        <!-- Resources Section - Hidden on small screens -->
                        <div>
                            <h3
                                class="font-opensans text-xl leading-8 text-[#000000] font-bold mb-4 md:mb-8 lg:mb-8 xl:mb-8">
                                <?php echo esc_html( get_theme_mod( 'boldo_footer_resources_title', 'Resources' ) ); ?>
                            </h3>
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'footer_resources',
                                    'container'      => false,
                                    'menu_class'     => 'space-y-4 md:space-y-8 lg:space-y-8 xl:space-y-8',
                                    'fallback_cb'    => false,
                                    'depth'          => 1,
                                )
                            );
                            ?>
                        </div>
                    </div>

                    <!-- All rights reserved - visible only on small/medium screens at bottom -->
                    <div class="lg:hidden mt-4 sm:mt-12">
                        <p class="font-opensans font-normal text-lg sm:text-base leading-7 text-[#777777]"><?php echo esc_html( get_theme_mod( 'boldo_footer_rights_text', 'All rights reserved.' ) ); ?></p>
                    </div>
                </div>
            </footer>
        </section>

</div>

<?php wp_footer(); ?>

</body>
</html>
