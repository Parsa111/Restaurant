<?php
/**
 * Single Post / Dish Template
 * 
 * @package LetoileLuxuryBistro
 */

get_header();
$theme_uri = get_template_directory_uri();
?>

<main class="section" style="min-height: 80vh; padding-top: 5rem;">
    <div class="container container-narrow">
        <?php while ( have_posts() ) : the_post(); 
            $price       = get_post_meta( get_the_ID(), '_menu_price', true );
            $pairing     = get_post_meta( get_the_ID(), '_menu_pairing', true );
            $dietary     = get_post_meta( get_the_ID(), '_menu_dietary', true ) ?: array();
            $calories    = get_post_meta( get_the_ID(), '_menu_calories', true );
        ?>
            <article class="glass-card" style="padding: 3.5rem;">
                <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem;">
                    <h1 class="section-title" style="margin-bottom: 0;"><?php the_title(); ?></h1>
                    <?php if ( $price ) : ?>
                        <span style="font-family: var(--font-serif); font-size: 2.25rem; color: var(--gold-light); font-weight: 700;">$<?php echo esc_html( $price ); ?></span>
                    <?php endif; ?>
                </div>

                <?php if ( has_post_thumbnail() ) : ?>
                    <div style="height: 400px; overflow: hidden; border-radius: var(--radius-md); margin-bottom: 2rem; border: 1px solid var(--border-gold);">
                        <?php the_post_thumbnail( 'full', array( 'style' => 'width: 100%; height: 100%; object-fit: cover;' ) ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( ! empty( $dietary ) ) : ?>
                    <div style="display: flex; gap: 0.5rem; margin-bottom: 1.5rem; flex-wrap: wrap;">
                        <?php foreach ( $dietary as $tag ) : ?>
                            <span class="badge badge-gold"><?php echo esc_html( strtoupper( $tag ) ); ?></span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content" style="color: var(--text-secondary); font-size: 1.1rem; line-height: 1.8; margin-bottom: 2rem;">
                    <?php the_content(); ?>
                </div>

                <?php if ( $pairing ) : ?>
                    <div style="background: rgba(212, 175, 55, 0.08); border: 1px solid var(--border-gold); padding: 1.25rem; border-radius: var(--radius-sm); margin-bottom: 2rem;">
                        <strong class="gold-accent">🍷 Recommended Wine Pairing:</strong><br>
                        <span style="color: var(--text-primary); font-size: 1.05rem;"><?php echo esc_html( $pairing ); ?></span>
                    </div>
                <?php endif; ?>

                <div style="display: flex; gap: 1.5rem; justify-content: space-between; align-items: center; border-top: 1px solid var(--border-subtle); padding-top: 2rem;">
                    <a href="<?php echo esc_url( home_url( '/#menu' ) ); ?>" class="btn btn-outline-gold">← Back to Menu</a>
                    <a href="<?php echo esc_url( home_url( '/#reservation' ) ); ?>" class="btn btn-gold">Book a Table →</a>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>
