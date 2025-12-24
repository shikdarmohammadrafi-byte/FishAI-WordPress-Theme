<?php get_header(); ?>

<main class="container mx-auto px-4 py-8">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article <?php post_class(); ?>>
            <h2 class="text-3xl font-bold mb-4"><?php the_title(); ?></h2>
            <div class="prose max-w-none"><?php the_content(); ?></div>
        </article>
    <?php endwhile; else : ?>
        <p><?php esc_html_e( 'No content found.', 'fishai' ); ?></p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>