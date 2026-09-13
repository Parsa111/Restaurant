<?php

 
 // Displays detailed information about a menu item in simple, clear words.


get_header();
?>

<main class="section" style="min-height: 85vh; padding-top: 5rem; background-color: var(--bg-primary);">
    <div class="container container-narrow">
        <?php while ( have_posts() ) : the_post(); 
            $price       = get_post_meta( get_the_ID(), '_menu_price', true ) ?: '38.00';
            $pairing     = get_post_meta( get_the_ID(), '_menu_pairing', true ) ?: 'Red Wine';
            $dietary     = get_post_meta( get_the_ID(), '_menu_dietary', true ) ?: array();
            $signature   = get_post_meta( get_the_ID(), '_menu_is_signature', true ) === '1';
            $calories    = get_post_meta( get_the_ID(), '_menu_calories', true );
            $thumb_url   = get_the_post_thumbnail_url( get_the_ID(), 'full' ) ?: get_template_directory_uri() . '/assets/images/dish-wagyu.jpg';
        ?>
            <article class="glass-card" style="padding: 0; overflow: hidden;">
                <!-- Header Image with Price Tag -->
                <div style="height: 380px; width: 100%; position: relative; overflow: hidden;">
                    <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    <div style="position: absolute; bottom: 1.5rem; right: 1.5rem; background: rgba(10, 11, 14, 0.85); border: 1px solid var(--gold-primary); padding: 0.5rem 1.25rem; border-radius: var(--radius-full); font-family: var(--font-serif); font-size: 1.5rem; color: var(--gold-light); font-weight: 700; backdrop-filter: blur(8px);">
                        $<?php echo esc_html( $price ); ?>
                    </div>
                </div>

                <div style="padding: 2.5rem;">
                    <!-- Dietary Badges -->
                    <div style="display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 1rem;">
                        <?php if ( $signature ) : ?>
                            <span class="badge badge-chef">⭐ Parsa Special</span>
                        <?php endif; ?>
                        <?php foreach ( (array)$dietary as $tag ) : ?>
                            <span class="badge badge-gold"><?php echo esc_html( ucfirst( $tag ) ); ?></span>
                        <?php endforeach; ?>
                    </div>

                    <h1 class="section-title" style="font-size: 2.5rem; margin-bottom: 1rem;"><?php the_title(); ?></h1>

                    <!-- Dish Narrative / Description -->
                    <div style="margin-bottom: 2rem;">
                        <h3 style="font-family: var(--font-accent); color: var(--gold-primary); font-size: 0.85rem; letter-spacing: 0.2em; text-transform: uppercase; margin-bottom: 0.75rem;">
                            About This Dish
                        </h3>
                        <div class="entry-content" style="color: var(--text-secondary); font-size: 1.1rem; line-height: 1.8;">
                            <?php the_content(); ?>
                        </div>
                    </div>

                    <!-- Recommended Drink Pairing -->
                    <?php if ( ! empty( $pairing ) ) : ?>
                        <div style="background: rgba(212, 175, 55, 0.08); border: 1px solid var(--border-gold); padding: 1.25rem 1.5rem; border-radius: var(--radius-sm); margin-bottom: 2rem; display: flex; align-items: center; gap: 1rem;">
                            <span style="font-size: 2rem;">🍷</span>
                            <div>
                                <strong style="color: var(--gold-light); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.12em; display: block;">Recommended Drink Pairing</strong>
                                <span style="color: var(--text-secondary); font-size: 1rem;"><?php echo esc_html( $pairing ); ?></span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Action Buttons -->
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap; justify-content: space-between; align-items: center; padding-top: 1.5rem; border-top: 1px solid var(--border-subtle);">
                        <a href="<?php echo esc_url( home_url( '/#menu' ) ); ?>" class="btn btn-outline-gold">
                            ← Back to Full Menu
                        </a>
                        <a href="<?php echo esc_url( home_url( '/#reservation' ) ); ?>" class="btn btn-gold">
                            Book a Table to Try This Dish →
                        </a>
                    </div>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>
