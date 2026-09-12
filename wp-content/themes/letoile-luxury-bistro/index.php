<?php
/**
 * Main Index Fallback Template
 * 
 * @package LetoileLuxuryBistro
 */

get_header();
?>

<main class="section" style="min-height: 70vh; padding-top: 5rem;">
    <div class="container">
        <?php if ( have_posts() ) : ?>
            <header class="section-header">
                <h1 class="section-title"><?php single_post_title(); ?></h1>
            </header>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem;">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article class="glass-card" style="padding: 2rem;">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div style="height: 200px; overflow: hidden; border-radius: var(--radius-sm); margin-bottom: 1rem;">
                                <?php the_post_thumbnail( 'medium_large', array( 'style' => 'width: 100%; height: 100%; object-fit: cover;' ) ); ?>
                            </div>
                        <?php endif; ?>
                        <h2 style="font-size: 1.5rem; margin-bottom: 0.75rem;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div style="color: var(--text-secondary); font-size: 0.95rem; margin-bottom: 1.25rem;">
                            <?php the_excerpt(); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="btn btn-outline-gold" style="font-size: 0.75rem; padding: 0.5rem 1rem;">Read Article →</a>
                    </article>
                <?php endwhile; ?>
            </div>

            <div style="margin-top: 3rem; text-align: center;">
                <?php the_posts_pagination(); ?>
            </div>
        <?php else : ?>
            <div style="text-align: center; padding: 4rem 0;">
                <h2>No culinary articles found.</h2>
                <p style="color: var(--text-secondary); margin-top: 1rem;">Please return to our <a href="<?php echo esc_url( home_url( '/' ) ); ?>">homepage</a>.</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
