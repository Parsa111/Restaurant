<?php
/**
 * L'Étoile Dorée - Theme Functions & Setup
 * 
 * @package LetoileLuxuryBistro
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Theme Setup
 */
function letoile_theme_setup() {
    // Make theme available for translation
    load_theme_textdomain( 'letoile-luxury-bistro', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );

    // Title tag support
    add_theme_support( 'title-tag' );

    // Post thumbnails
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'letoile-menu-thumb', 300, 300, true );
    add_image_size( 'letoile-special-card', 600, 400, true );
    add_image_size( 'letoile-hero-banner', 1920, 1080, true );

    // Custom Logo
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // HTML5 markup support
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Block editor features
    add_theme_support( 'align-wide' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'editor-styles' );

    // Register Navigation Menus
    register_nav_menus( array(
        'primary-menu' => __( 'Primary Navigation', 'letoile-luxury-bistro' ),
        'footer-menu'  => __( 'Footer Navigation', 'letoile-luxury-bistro' ),
    ) );
}
add_action( 'after_setup_theme', 'letoile_theme_setup' );

/**
 * Enqueue Scripts and Styles
 */
function letoile_enqueue_assets() {
    // Google Fonts
    wp_enqueue_style( 
        'letoile-google-fonts', 
        'https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap', 
        array(), 
        null 
    );

    // Primary Theme Stylesheet
    wp_enqueue_style( 'letoile-style', get_stylesheet_uri(), array(), '1.0.0' );

    // Main App Stylesheet
    wp_enqueue_style( 
        'letoile-main-css', 
        get_template_directory_uri() . '/assets/css/main.css', 
        array( 'letoile-style' ), 
        '1.0.0' 
    );

    // Core Theme JS
    wp_enqueue_script( 
        'letoile-main-js', 
        get_template_directory_uri() . '/assets/js/main.js', 
        array( 'jquery' ), 
        '1.0.0', 
        true 
    );

    // Reservation Engine JS
    wp_enqueue_script( 
        'letoile-reservation-js', 
        get_template_directory_uri() . '/assets/js/reservation.js', 
        array( 'jquery', 'letoile-main-js' ), 
        '1.0.0', 
        true 
    );

    // Pass data to JavaScript
    wp_localize_script( 'letoile-reservation-js', 'letoileSettings', array(
        'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
        'nonce'     => wp_create_nonce( 'letoile_reservation_nonce' ),
        'restUrl'   => esc_url_raw( rest_url( 'letoile/v1/' ) ),
        'themeUrl'  => get_template_directory_uri(),
    ) );
}
add_action( 'wp_enqueue_scripts', 'letoile_enqueue_assets' );

/**
 * Register Custom Post Types and Taxonomies
 */
function letoile_register_custom_content() {
    // 1. Menu Items Custom Post Type
    $menu_labels = array(
        'name'               => _x( 'Menu Items', 'post type general name', 'letoile-luxury-bistro' ),
        'singular_name'      => _x( 'Menu Item', 'post type singular name', 'letoile-luxury-bistro' ),
        'menu_name'          => _x( 'Culinary Menu', 'admin menu', 'letoile-luxury-bistro' ),
        'add_new'            => _x( 'Add New Dish', 'menu item', 'letoile-luxury-bistro' ),
        'add_new_item'       => __( 'Add New Menu Item', 'letoile-luxury-bistro' ),
        'edit_item'          => __( 'Edit Menu Item', 'letoile-luxury-bistro' ),
        'all_items'          => __( 'All Menu Items', 'letoile-luxury-bistro' ),
    );

    register_post_type( 'menu_item', array(
        'labels'             => $menu_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'menu-item' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-food',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
    ) );

    // Menu Category Taxonomy
    register_taxonomy( 'menu_category', array( 'menu_item' ), array(
        'hierarchical'      => true,
        'labels'            => array(
            'name'              => _x( 'Menu Categories', 'taxonomy general name', 'letoile-luxury-bistro' ),
            'singular_name'     => _x( 'Menu Category', 'taxonomy singular name', 'letoile-luxury-bistro' ),
            'search_items'      => __( 'Search Categories', 'letoile-luxury-bistro' ),
            'all_items'         => __( 'All Categories', 'letoile-luxury-bistro' ),
            'edit_item'         => __( 'Edit Category', 'letoile-luxury-bistro' ),
            'add_new_item'      => __( 'Add New Category', 'letoile-luxury-bistro' ),
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'menu-category' ),
    ) );

    // 2. Table Reservations Custom Post Type
    $res_labels = array(
        'name'               => _x( 'Reservations', 'post type general name', 'letoile-luxury-bistro' ),
        'singular_name'      => _x( 'Reservation', 'post type singular name', 'letoile-luxury-bistro' ),
        'menu_name'          => _x( 'Reservations', 'admin menu', 'letoile-luxury-bistro' ),
        'all_items'          => __( 'All Bookings', 'letoile-luxury-bistro' ),
        'add_new'            => __( 'New Reservation', 'letoile-luxury-bistro' ),
    );

    register_post_type( 'reservation', array(
        'labels'             => $res_labels,
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-calendar-alt',
        'supports'           => array( 'title', 'custom-fields' ),
    ) );

    // 3. Testimonials Custom Post Type
    register_post_type( 'testimonial', array(
        'labels'             => array(
            'name'          => __( 'Critic Reviews', 'letoile-luxury-bistro' ),
            'singular_name' => __( 'Review', 'letoile-luxury-bistro' ),
        ),
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-star-filled',
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
    ) );
}
add_action( 'init', 'letoile_register_custom_content' );

/**
 * Custom Admin Meta Boxes for Menu Items
 */
function letoile_add_menu_meta_boxes() {
    add_meta_box(
        'letoile_dish_details',
        __( 'Dish Culinary Details & Pricing', 'letoile-luxury-bistro' ),
        'letoile_render_dish_meta_box',
        'menu_item',
        'normal',
        'high'
    );

    add_meta_box(
        'letoile_reservation_details',
        __( 'Booking Details', 'letoile-luxury-bistro' ),
        'letoile_render_reservation_meta_box',
        'reservation',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'letoile_add_menu_meta_boxes' );

function letoile_render_dish_meta_box( $post ) {
    wp_nonce_field( 'letoile_dish_meta_save', 'letoile_dish_meta_nonce' );
    $price       = get_post_meta( $post->ID, '_menu_price', true );
    $pairing     = get_post_meta( $post->ID, '_menu_pairing', true );
    $dietary     = get_post_meta( $post->ID, '_menu_dietary', true ) ?: array();
    $signature   = get_post_meta( $post->ID, '_menu_is_signature', true );
    $calories    = get_post_meta( $post->ID, '_menu_calories', true );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="menu_price"><?php _e( 'Price ($ USD)', 'letoile-luxury-bistro' ); ?></label></th>
            <td><input type="text" id="menu_price" name="menu_price" value="<?php echo esc_attr( $price ); ?>" class="regular-text" placeholder="e.g. 48.00" /></td>
        </tr>
        <tr>
            <th><label for="menu_pairing"><?php _e( 'Sommelier Wine Pairing', 'letoile-luxury-bistro' ); ?></label></th>
            <td><input type="text" id="menu_pairing" name="menu_pairing" value="<?php echo esc_attr( $pairing ); ?>" class="regular-text" placeholder="e.g. 2018 Château Margaux Premier Grand Cru" /></td>
        </tr>
        <tr>
            <th><label><?php _e( 'Dietary Badges', 'letoile-luxury-bistro' ); ?></label></th>
            <td>
                <label><input type="checkbox" name="menu_dietary[]" value="vegan" <?php checked( in_array( 'vegan', (array)$dietary ) ); ?> /> 🌱 Vegan</label><br>
                <label><input type="checkbox" name="menu_dietary[]" value="gluten-free" <?php checked( in_array( 'gluten-free', (array)$dietary ) ); ?> /> 🌾 Gluten-Free</label><br>
                <label><input type="checkbox" name="menu_dietary[]" value="vegetarian" <?php checked( in_array( 'vegetarian', (array)$dietary ) ); ?> /> 🧀 Vegetarian</label><br>
                <label><input type="checkbox" name="menu_dietary[]" value="spicy" <?php checked( in_array( 'spicy', (array)$dietary ) ); ?> /> 🌶️ Spicy</label><br>
                <label><input type="checkbox" name="menu_dietary[]" value="nut-free" <?php checked( in_array( 'nut-free', (array)$dietary ) ); ?> /> 🥜 Nut-Free</label>
            </td>
        </tr>
        <tr>
            <th><label for="menu_is_signature"><?php _e( "Chef's Signature Selection", 'letoile-luxury-bistro' ); ?></label></th>
            <td><label><input type="checkbox" id="menu_is_signature" name="menu_is_signature" value="1" <?php checked( $signature, '1' ); ?> /> ⭐ Highlight as Signature Tasting Special</label></td>
        </tr>
        <tr>
            <th><label for="menu_calories"><?php _e( 'Calories / Nutrition Info', 'letoile-luxury-bistro' ); ?></label></th>
            <td><input type="text" id="menu_calories" name="menu_calories" value="<?php echo esc_attr( $calories ); ?>" class="regular-text" placeholder="e.g. 480 kcal" /></td>
        </tr>
    </table>
    <?php
}

function letoile_render_reservation_meta_box( $post ) {
    $date    = get_post_meta( $post->ID, '_res_date', true );
    $time    = get_post_meta( $post->ID, '_res_time', true );
    $guests  = get_post_meta( $post->ID, '_res_guests', true );
    $seating = get_post_meta( $post->ID, '_res_seating', true );
    $email   = get_post_meta( $post->ID, '_res_email', true );
    $phone   = get_post_meta( $post->ID, '_res_phone', true );
    $notes   = get_post_meta( $post->ID, '_res_special_requests', true );
    $status  = get_post_meta( $post->ID, '_res_status', true ) ?: 'Confirmed';
    ?>
    <table class="form-table">
        <tr><th>Status</th><td><strong><?php echo esc_html( $status ); ?></strong></td></tr>
        <tr><th>Date & Time</th><td><?php echo esc_html( $date . ' at ' . $time ); ?></td></tr>
        <tr><th>Party Size</th><td><?php echo esc_html( $guests . ' Guests' ); ?></td></tr>
        <tr><th>Seating Area</th><td><?php echo esc_html( $seating ); ?></td></tr>
        <tr><th>Guest Email</th><td><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></td></tr>
        <tr><th>Guest Phone</th><td><?php echo esc_html( $phone ); ?></td></tr>
        <tr><th>Special Notes</th><td><?php echo esc_html( $notes ?: 'None' ); ?></td></tr>
    </table>
    <?php
}

function letoile_save_dish_meta( $post_id ) {
    if ( ! isset( $_POST['letoile_dish_meta_nonce'] ) || ! wp_verify_nonce( $_POST['letoile_dish_meta_nonce'], 'letoile_dish_meta_save' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['menu_price'] ) ) {
        update_post_meta( $post_id, '_menu_price', sanitize_text_field( $_POST['menu_price'] ) );
    }
    if ( isset( $_POST['menu_pairing'] ) ) {
        update_post_meta( $post_id, '_menu_pairing', sanitize_text_field( $_POST['menu_pairing'] ) );
    }
    $dietary = isset( $_POST['menu_dietary'] ) ? array_map( 'sanitize_text_field', (array)$_POST['menu_dietary'] ) : array();
    update_post_meta( $post_id, '_menu_dietary', $dietary );

    $signature = isset( $_POST['menu_is_signature'] ) ? '1' : '0';
    update_post_meta( $post_id, '_menu_is_signature', $signature );

    if ( isset( $_POST['menu_calories'] ) ) {
        update_post_meta( $post_id, '_menu_calories', sanitize_text_field( $_POST['menu_calories'] ) );
    }
}
add_action( 'save_post_menu_item', 'letoile_save_dish_meta' );

/**
 * AJAX Table Reservation Booking Handler
 */
function letoile_handle_reservation_booking() {
    check_ajax_referer( 'letoile_reservation_nonce', 'security' );

    $name     = sanitize_text_field( $_POST['guest_name'] ?? '' );
    $email    = sanitize_email( $_POST['guest_email'] ?? '' );
    $phone    = sanitize_text_field( $_POST['guest_phone'] ?? '' );
    $date     = sanitize_text_field( $_POST['res_date'] ?? '' );
    $time     = sanitize_text_field( $_POST['res_time'] ?? '' );
    $guests   = intval( $_POST['res_guests'] ?? 2 );
    $seating  = sanitize_text_field( $_POST['res_seating'] ?? 'Main Dining Hall' );
    $notes    = sanitize_textarea_field( $_POST['res_notes'] ?? '' );

    if ( empty( $name ) || empty( $email ) || empty( $date ) || empty( $time ) ) {
        wp_send_json_error( array( 'message' => __( 'Please fill in all required fields.', 'letoile-luxury-bistro' ) ) );
    }

    $booking_code = 'PARSA-' . strtoupper( substr( md5( uniqid( rand(), true ) ), 0, 6 ) );

    // Insert Reservation Post
    $res_id = wp_insert_post( array(
        'post_title'  => sprintf( '%s - %s (%s Guests)', $booking_code, $name, $guests ),
        'post_type'   => 'reservation',
        'post_status' => 'publish',
    ) );

    if ( $res_id && ! is_wp_error( $res_id ) ) {
        update_post_meta( $res_id, '_res_booking_code', $booking_code );
        update_post_meta( $res_id, '_res_name', $name );
        update_post_meta( $res_id, '_res_email', $email );
        update_post_meta( $res_id, '_res_phone', $phone );
        update_post_meta( $res_id, '_res_date', $date );
        update_post_meta( $res_id, '_res_time', $time );
        update_post_meta( $res_id, '_res_guests', $guests );
        update_post_meta( $res_id, '_res_seating', $seating );
        update_post_meta( $res_id, '_res_special_requests', $notes );
        update_post_meta( $res_id, '_res_status', 'Confirmed' );

        wp_send_json_success( array(
            'bookingCode' => $booking_code,
            'name'        => $name,
            'date'        => $date,
            'time'        => $time,
            'guests'      => $guests,
            'seating'     => $seating,
            'message'     => __( 'Your luxury dining table has been reserved. A confirmation concierge notification has been dispatched.', 'letoile-luxury-bistro' ),
        ) );
    } else {
        wp_send_json_error( array( 'message' => __( 'Unable to process table reservation. Please call our concierge.', 'letoile-luxury-bistro' ) ) );
    }
}
add_action( 'wp_ajax_letoile_submit_reservation', 'letoile_handle_reservation_booking' );
add_action( 'wp_ajax_nopriv_letoile_submit_reservation', 'letoile_handle_reservation_booking' );

/**
 * REST API Endpoint: Get Menu Data
 */
function letoile_register_rest_routes() {
    register_rest_route( 'letoile/v1', '/menu', array(
        'methods'             => 'GET',
        'callback'            => 'letoile_get_menu_api_data',
        'permission_callback' => '__return_true',
    ) );
}
add_action( 'rest_api_init', 'letoile_register_rest_routes' );

function letoile_get_menu_api_data() {
    $categories = get_terms( array(
        'taxonomy'   => 'menu_category',
        'hide_empty' => false,
    ) );

    $result = array();
    foreach ( $categories as $cat ) {
        $posts = get_posts( array(
            'post_type'      => 'menu_item',
            'posts_per_page' => -1,
            'tax_query'      => array(
                array(
                    'taxonomy' => 'menu_category',
                    'field'    => 'term_id',
                    'terms'    => $cat->term_id,
                ),
            ),
        ) );

        $cat_items = array();
        foreach ( $posts as $p ) {
            $cat_items[] = array(
                'id'          => $p->ID,
                'title'       => $p->post_title,
                'description' => $p->post_content,
                'price'       => get_post_meta( $p->ID, '_menu_price', true ) ?: '38.00',
                'pairing'     => get_post_meta( $p->ID, '_menu_pairing', true ),
                'dietary'     => get_post_meta( $p->ID, '_menu_dietary', true ) ?: array(),
                'isSignature' => get_post_meta( $p->ID, '_menu_is_signature', true ) === '1',
                'image'       => get_the_post_thumbnail_url( $p->ID, 'large' ) ?: get_template_directory_uri() . '/assets/images/dish-wagyu.jpg',
            );
        }

        $result[] = array(
            'categoryId'   => $cat->term_id,
            'categorySlug' => $cat->slug,
            'categoryName' => $cat->name,
            'items'        => $cat_items,
        );
    }

    return rest_ensure_response( $result );
}

/**
 * Add WordPress Admin Menu Pages for Parsa Bistro Management & Supabase Sync
 */
function letoile_add_admin_menu_pages() {
    // Top-level Admin Menu
    add_menu_page(
        __( 'Parsa Reservations', 'letoile-luxury-bistro' ),
        __( 'Parsa Bistro', 'letoile-luxury-bistro' ),
        'edit_posts',
        'parsa-bistro-reservations',
        'letoile_render_admin_reservations_page',
        'dashicons-food',
        6
    );

    // Submenu: All Reservations
    add_submenu_page(
        'parsa-bistro-reservations',
        __( 'Table Reservations', 'letoile-luxury-bistro' ),
        __( 'All Reservations', 'letoile-luxury-bistro' ),
        'edit_posts',
        'parsa-bistro-reservations',
        'letoile_render_admin_reservations_page'
    );

    // Submenu: Supabase Database Settings
    add_submenu_page(
        'parsa-bistro-reservations',
        __( 'Supabase Settings', 'letoile-luxury-bistro' ),
        __( 'Supabase Database', 'letoile-luxury-bistro' ),
        'manage_options',
        'parsa-supabase-settings',
        'letoile_render_supabase_settings_page'
    );
}
add_action( 'admin_menu', 'letoile_add_admin_menu_pages' );

/**
 * Render WordPress Admin Reservations Management Page
 */
function letoile_render_admin_reservations_page() {
    // Handle Delete/Status action
    if ( isset( $_GET['action'] ) && $_GET['action'] === 'delete' && isset( $_GET['res_id'] ) ) {
        check_admin_referer( 'parsa_delete_res_' . $_GET['res_id'] );
        wp_delete_post( intval( $_GET['res_id'] ), true );
        echo '<div class="notice notice-success is-dismissible"><p>Reservation deleted successfully.</p></div>';
    }

    $reservations = get_posts( array(
        'post_type'      => 'reservation',
        'posts_per_page' => 50,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ) );
    ?>
    <div class="wrap">
        <h1 style="display:flex; align-items:center; gap: 10px;">
            <span class="dashicons dashicons-food" style="font-size: 32px; width: 32px; height: 32px; color: #d4af37;"></span>
            Parsa Restaurant — Table Reservations Manager
        </h1>
        <p>Manage all guest table bookings submitted from your website or Supabase database.</p>
        
        <table class="wp-list-table widefat fixed striped table-view-list" style="margin-top: 15px;">
            <thead>
                <tr>
                    <th style="width: 120px;">Code</th>
                    <th>Guest Name</th>
                    <th>Date & Time</th>
                    <th>Guests</th>
                    <th>Seating Area</th>
                    <th>Contact</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ( empty( $reservations ) ) : ?>
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 20px;">No table reservations booked yet.</td>
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
                        $delete_url = wp_nonce_url( admin_url( 'admin.php?page=parsa-bistro-reservations&action=delete&res_id=' . $res->ID ), 'parsa_delete_res_' . $res->ID );
                    ?>
                        <tr>
                            <td><strong style="color: #d4af37;"><?php echo esc_html( $code ); ?></strong></td>
                            <td><strong><?php echo esc_html( $name ); ?></strong></td>
                            <td><?php echo esc_html( $date . ' @ ' . $time ); ?></td>
                            <td><span class="badge" style="background:#2271b1; color:#fff; padding:2px 8px; border-radius:10px;"><?php echo esc_html( $guests ); ?> Guests</span></td>
                            <td><?php echo esc_html( $seating ); ?></td>
                            <td>
                                <div><?php echo esc_html( $phone ); ?></div>
                                <div style="font-size: 11px; color: #666;"><?php echo esc_html( $email ); ?></div>
                            </td>
                            <td><span style="color: #46b450; font-weight: bold;">✔ <?php echo esc_html( $status ); ?></span></td>
                            <td>
                                <a href="<?php echo esc_url( get_edit_post_link( $res->ID ) ); ?>" class="button button-small">View / Edit</a>
                                <a href="<?php echo esc_url( $delete_url ); ?>" class="button button-small button-link-delete" onclick="return confirm('Delete this reservation?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}

/**
 * Render Supabase Settings Admin Page
 */
function letoile_render_supabase_settings_page() {
    if ( isset( $_POST['parsa_save_supabase'] ) ) {
        check_admin_referer( 'parsa_supabase_nonce' );
        update_option( 'parsa_supabase_url', sanitize_text_field( $_POST['parsa_supabase_url'] ) );
        update_option( 'parsa_supabase_key', sanitize_text_field( $_POST['parsa_supabase_key'] ) );
        echo '<div class="notice notice-success is-dismissible"><p>Supabase database credentials saved successfully!</p></div>';
    }

    $sb_url = get_option( 'parsa_supabase_url', '' );
    $sb_key = get_option( 'parsa_supabase_key', '' );
    ?>
    <div class="wrap">
        <h1>⚡ Supabase Database Settings</h1>
        <p>Connect your Parsa WordPress site to your free <strong>Supabase</strong> PostgreSQL cloud database.</p>
        
        <form method="post" action="">
            <?php wp_nonce_field( 'parsa_supabase_nonce' ); ?>
            <table class="form-table">
                <tr>
                    <th><label for="parsa_supabase_url">Supabase Project URL</label></th>
                    <td>
                        <input type="url" id="parsa_supabase_url" name="parsa_supabase_url" value="<?php echo esc_attr( $sb_url ); ?>" class="large-text" placeholder="https://your-project-id.supabase.co" />
                        <p class="description">Found in your Supabase Dashboard -> Project Settings -> API</p>
                    </td>
                </tr>
                <tr>
                    <th><label for="parsa_supabase_key">Supabase Anon API Key</label></th>
                    <td>
                        <input type="password" id="parsa_supabase_key" name="parsa_supabase_key" value="<?php echo esc_attr( $sb_key ); ?>" class="large-text" placeholder="eyJhYmdj... anon key" />
                        <p class="description">Found in your Supabase Dashboard -> Project Settings -> API -> Project API Keys (anon public key)</p>
                    </td>
                </tr>
            </table>
            <p class="submit">
                <input type="submit" name="parsa_save_supabase" class="button button-primary" value="Save Supabase Settings" />
            </p>
        </form>
    </div>
    <?php
}

