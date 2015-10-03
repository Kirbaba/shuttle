<?php
get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php the_content(); ?>

					</div><!-- .entry-content -->


				</article><!-- #post -->

				<?php /*comments_template(); */?>
			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->


<?php get_footer(); ?>