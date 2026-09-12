<?php
/**
 * 404 Error Page Template (Simple Words)
 * 
 * @package LetoileLuxuryBistro
 */

get_header();
?>

<main class="section" style="min-height: 80vh; display: flex; align-items: center; justify-content: center; text-align: center;">
    <div class="container container-narrow">
        <div class="glass-card" style="padding: 4rem 2rem;">
            <div style="font-family: var(--font-serif); font-size: 6rem; color: var(--gold-primary); line-height: 1; margin-bottom: 1rem;">404</div>
            <h1 class="section-title" style="margin-bottom: 1rem;">Page Not Found</h1>
            <p style="color: var(--text-secondary); max-width: 500px; margin: 0 auto 2.5rem auto; font-size: 1.1rem;">
                Sorry, we could not find the page you are looking for. Please check our menu or head back to the home page.
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-gold">Go to Home Page</a>
                <a href="<?php echo esc_url( home_url( '/#menu' ) ); ?>" class="btn btn-outline-gold">See Menu</a>
                <a href="<?php echo esc_url( home_url( '/#reservation' ) ); ?>" class="btn btn-glass">Book a Table</a>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
