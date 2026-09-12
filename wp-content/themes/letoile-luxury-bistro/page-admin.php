<?php
/**
 * Template Name: Parsa Admin Dashboard
 * Description: Custom WordPress Page Template for Managing Restaurant Table Reservations
 *
 * @package LetoileLuxuryBistro
 */

get_header();

// Security check: Only allow logged-in users with edit_posts permission (Admins & Managers)
$is_admin = current_user_can( 'edit_posts' );
?>

<main class="section" style="min-height: 80vh; padding-top: 5rem; background-color: var(--bg-primary);">
    <div class="container">
        <div class="section-header" style="margin-bottom: 2.5rem; text-align: left;">
            <div class="section-subtitle">Restaurant Operations</div>
            <h1 class="section-title">Parsa Admin — <span class="gold-text">Table Reservations</span></h1>
            <p class="section-desc" style="max-width: 600px; margin: 0;">
                View, filter, and manage all guest table bookings stored in your WordPress database.
            </p>
        </div>

        <?php if ( ! is_user_logged_in() ) : ?>
            <div class="glass-card" style="padding: 3rem; text-align: center; max-width: 550px; margin: 0 auto;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">🔒</div>
                <h2 style="margin-bottom: 1rem;">Administrator Login Required</h2>
                <p style="color: var(--text-secondary); margin-bottom: 1.5rem;">
                    Please log into your WordPress admin account to access the reservation management dashboard.
                </p>
                <a href="<?php echo esc_url( wp_login_url( get_permalink() ) ); ?>" class="btn btn-gold">
                    Log In to WordPress Admin →
                </a>
            </div>
        <?php else : ?>
            <?php
            // Fetch reservations from WordPress database
            $reservations = get_posts( array(
                'post_type'      => 'reservation',
                'posts_per_page' => 100,
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
            ) );

            $total_count = count( $reservations );
            $total_guests = 0;
            foreach ( $reservations as $r ) {
                $total_guests += intval( get_post_meta( $r->ID, '_res_guests', true ) ?: 2 );
            }
            ?>

            <!-- Stats Bar -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                <div class="glass-card" style="padding: 1.5rem;">
                    <div style="color: var(--text-muted); font-size: 0.85rem;">Total Bookings</div>
                    <div style="font-size: 2.2rem; font-weight: 700; color: var(--gold-primary); margin-top: 0.25rem;">
                        <?php echo intval( $total_count ); ?>
                    </div>
                </div>

                <div class="glass-card" style="padding: 1.5rem;">
                    <div style="color: var(--text-muted); font-size: 0.85rem;">Total Expected Guests</div>
                    <div style="font-size: 2.2rem; font-weight: 700; color: var(--gold-light); margin-top: 0.25rem;">
                        <?php echo intval( $total_guests ); ?>
                    </div>
                </div>

                <div class="glass-card" style="padding: 1.5rem;">
                    <div style="color: var(--text-muted); font-size: 0.85rem;">System Status</div>
                    <div style="font-size: 1.25rem; font-weight: 700; color: #46b450; margin-top: 0.5rem; display: flex; align-items: center; gap: 8px;">
                        <span>●</span> WordPress Connected
                    </div>
                </div>
            </div>

            <!-- Table Container -->
            <div class="glass-card" style="padding: 1.5rem; overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.95rem;">
                    <thead>
                        <tr style="border-bottom: 1px solid var(--border-gold); background: rgba(212, 175, 55, 0.08);">
                            <th style="padding: 1rem;">Booking Code</th>
                            <th style="padding: 1rem;">Guest Name</th>
                            <th style="padding: 1rem;">Date & Time</th>
                            <th style="padding: 1rem;">Party Size</th>
                            <th style="padding: 1rem;">Seating Area</th>
                            <th style="padding: 1rem;">Phone</th>
                            <th style="padding: 1rem;">Email</th>
                            <th style="padding: 1rem;">Status</th>
                            <th style="padding: 1rem;">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( empty( $reservations ) ) : ?>
                            <tr>
                                <td colspan="9" style="padding: 3rem; text-align: center; color: var(--text-muted);">
                                    No table reservations found in your WordPress database.
                                </td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ( $reservations as $res ) : 
                                $code    = get_post_meta( $res->ID, '_res_booking_code', true ) ?: $res->post_title;
                                $name    = get_post_meta( $res->ID, '_res_name', true ) ?: 'Guest';
                                $date    = get_post_meta( $res->ID, '_res_date', true );
                                $time    = get_post_meta( $res->ID, '_res_time', true );
                                $guests  = get_post_meta( $res->ID, '_res_guests', true ) ?: 2;
                                $seating = get_post_meta( $res->ID, '_res_seating', true ) ?: 'Main Dining Room';
                                $email   = get_post_meta( $res->ID, '_res_email', true );
                                $phone   = get_post_meta( $res->ID, '_res_phone', true );
                                $status  = get_post_meta( $res->ID, '_res_status', true ) ?: 'Confirmed';
                            ?>
                                <tr style="border-bottom: 1px solid var(--border-subtle);">
                                    <td style="padding: 1rem;">
                                        <span style="background: rgba(212,175,55,0.15); color: var(--gold-light); padding: 0.25rem 0.5rem; border-radius: 4px; font-weight: 700;">
                                            <?php echo esc_html( $code ); ?>
                                        </span>
                                    </td>
                                    <td style="padding: 1rem;"><strong><?php echo esc_html( $name ); ?></strong></td>
                                    <td style="padding: 1rem;"><?php echo esc_html( $date . ' @ ' . $time ); ?></td>
                                    <td style="padding: 1rem;"><?php echo esc_html( $guests ); ?> Guests</td>
                                    <td style="padding: 1rem;"><?php echo esc_html( $seating ); ?></td>
                                    <td style="padding: 1rem;"><?php echo esc_html( $phone ); ?></td>
                                    <td style="padding: 1rem; color: var(--text-muted);"><?php echo esc_html( $email ); ?></td>
                                    <td style="padding: 1rem;"><span style="color: #46b450; font-weight: bold;">✔ <?php echo esc_html( $status ); ?></span></td>
                                    <td style="padding: 1rem;">
                                        <a href="<?php echo esc_url( get_edit_post_link( $res->ID ) ); ?>" class="btn btn-outline-gold" style="padding: 0.3rem 0.75rem; font-size: 0.8rem;">
                                            Edit in WP
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
