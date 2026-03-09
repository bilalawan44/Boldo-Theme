<li class="flex items-start sm:items-center gap-3 group cursor-pointer">
                    <div class="w-8 h-8 sm:w-9 sm:h-9 bg-navy group-hover:bg-mint rounded-full flex items-center justify-center flex-shrink-0 transition-colors duration-300">
                        <svg class="w-6 h-6 text-white group-hover:text-navy transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    
                    <?php if ($text): ?>
                    <span class="text-black font-normal font-opensans leading-7 sm:leading-8 text-base sm:text-lg lg:text-[20px]">
                        <?php echo esc_html($text); ?>
                    </span>
                    <?php endif; ?>
                </li>