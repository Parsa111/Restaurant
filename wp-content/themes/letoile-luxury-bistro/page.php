<?php
/**
 * Default Page Template
 * 
 * @package LetoileLuxuryBistro
 */

get_header();
?>

<main class="section" style="min-height: 70vh; padding-top: 5rem;">
    <div class="container container-narrow">
        <?php while ( have_posts() ) : the_post(); ?>
            <article class="glass-card" style="padding: 3.5rem;">
                <header class="section-header" style="margin-bottom: 2rem;">
                    <h1 class="section-title"><?php the_title(); ?></h1>
                </header>

                <?php if ( has_post_thumbnail() ) : ?>
                    <div style="height: 350px; overflow: hidden; border-radius: var(--radius-md); margin-bottom: 2.5rem; border: 1px solid var(--border-gold);">
                        <?php the_post_thumbnail( 'full', array( 'style' => 'width: 100%; height: 100%; object-fit: cover;' ) ); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content" style="color: var(--text-secondary); font-size: 1.05rem; line-height: 1.8;">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>
