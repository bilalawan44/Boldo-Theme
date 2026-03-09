<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header mb-6 sm:mb-8">
		<div class="flex items-center gap-2 mb-2 sm:mb-3">
			<span class="font-opensans font-bold text-sm sm:text-base/7 text-[#0A2640]">
				<?php
				$cat = get_the_category();
				echo esc_html( $cat[0]->name ?? '' );
				?>
			</span>
			<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished" class="font-opensans font-normal text-sm sm:text-base/7 text-gray-600">
				<?php echo esc_html( get_the_date( 'F j, Y' ) ); ?>
			</time>
		</div>

		<h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-normal text-[#000000] font-manrope leading-tight sm:leading-snug md:leading-[72px] mb-4">
			<?php the_title(); ?>
		</h1>

		<div class="flex items-center gap-3">
			<?php
			echo get_avatar(
				get_the_author_meta( 'ID' ),
				32,
				'',
				'',
				array( 'class' => 'w-8 h-8 rounded-full object-cover' )
			);
			?>
			<span class="font-opensans font-normal text-sm sm:text-base/7 text-[#000000]">
				<?php the_author(); ?>
			</span>
		</div>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="mb-6 sm:mb-8 overflow-hidden rounded-lg">
			<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto object-cover' ) ); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content font-opensans text-[#000000]">
		<?php the_content(); ?>

		<?php
			wp_link_pages(
				array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'tailpress' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'tailpress' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				)
			);
		?>
	</div>

</article>
