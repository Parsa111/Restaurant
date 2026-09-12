<?php
/**
 * Master Homepage Template for Parsa Restaurant & Bistro
 * 
 * @package ParsaBistro
 */

get_header(); 
$theme_uri = get_template_directory_uri();
?>

<!-- ==========================================================================
     1. HERO SECTION
     ========================================================================== -->
<section class="hero-section" id="hero">
    <div class="hero-background">
        <img src="<?php echo esc_url( $theme_uri . '/assets/images/hero.jpg' ); ?>" alt="Parsa Restaurant Dining Room" class="hero-bg-img">
        <div class="hero-overlay"></div>
    </div>

    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">
                <span>⭐</span> Top Rated Restaurant • New York
            </div>
            
            <h1 class="hero-title">
                Welcome to <span class="gold-text">Parsa</span>
            </h1>

            <p class="hero-subtitle">
                Enjoy delicious grilled steaks, fresh seafood, handmade pasta, and fine wine in a warm and comfortable atmosphere.
            </p>

            <div class="hero-actions">
                <a href="#reservation" class="btn btn-gold" id="hero-cta-reserve">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    Book a Table
                </a>
                <a href="#menu" class="btn btn-outline-gold" id="hero-cta-menu">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    See Our Menu
                </a>
                <a href="#about" class="btn btn-glass">
                    Our Story ↓
                </a>
            </div>

            <!-- Floating Quick Reservation Bar -->
            <div class="hero-quick-bar">
                <form class="quick-bar-form" id="hero-quick-reserve-form" onsubmit="event.preventDefault(); window.location.href='#reservation';">
                    <div class="quick-input-group">
                        <label class="quick-label">Choose Date</label>
                        <input type="date" class="quick-input" id="quick-date" value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" required>
                    </div>

                    <div class="quick-input-group">
                        <label class="quick-label">Choose Time</label>
                        <select class="quick-select" id="quick-time">
                            <option value="17:30">5:30 PM</option>
                            <option value="18:30">6:30 PM</option>
                            <option value="19:30" selected>7:30 PM</option>
                            <option value="20:30">8:30 PM</option>
                            <option value="21:30">9:30 PM</option>
                        </select>
                    </div>

                    <div class="quick-input-group">
                        <label class="quick-label">Guests</label>
                        <select class="quick-select" id="quick-guests">
                            <option value="1">1 Person</option>
                            <option value="2" selected>2 People</option>
                            <option value="4">4 People</option>
                            <option value="6">6 People</option>
                            <option value="8+">8+ People</option>
                        </select>
                    </div>

                    <div class="quick-input-group">
                        <label class="quick-label">Where to Sit</label>
                        <select class="quick-select" id="quick-seating">
                            <option value="Main Dining Room">Main Dining Room</option>
                            <option value="Chef Counter">Chef's Counter</option>
                            <option value="Private Wine Room">Private Wine Room</option>
                            <option value="Garden Patio">Garden Patio</option>
                        </select>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-gold" style="width: 100%; height: 42px; margin-top: 14px;">
                            Find Table
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     2. ABOUT US SECTION
     ========================================================================== -->
<section class="section" id="about" style="background-color: var(--bg-secondary);">
    <div class="container">
        <div class="story-grid">
            <!-- Left: Visual Frame -->
            <div class="story-image-wrapper">
                <img src="<?php echo esc_url( $theme_uri . '/assets/images/hero.jpg' ); ?>" alt="Parsa Restaurant" class="story-img-main">
                <div class="story-badge-float">
                    <div class="story-badge-number">15+</div>
                    <div class="story-badge-text">Years of Quality<br>& Happy Guests</div>
                </div>
            </div>

            <!-- Right: Narrative -->
            <div class="story-content">
                <div class="section-subtitle">About Parsa</div>
                <h2 style="font-size: 2.5rem; margin-bottom: 1.25rem;">
                    Fresh Food Made With <span class="gold-text">Care and Love</span>
                </h2>
                
                <p>
                    Welcome to Parsa. We believe that a great meal starts with fresh ingredients. Every morning, our team selects the best meats, fresh seafood, and crisp vegetables to cook delicious dishes for you.
                </p>

                <div class="chef-quote">
                    "Good food brings family and friends together. We prepare every dish with care so you can relax and enjoy your time with us."
                </div>

                <p style="color: var(--text-muted); font-size: 0.95rem;">
                    Whether you are enjoying dinner with family, celebrating a birthday, or meeting friends, our team is here to give you an unforgettable meal.
                </p>

                <div class="awards-row">
                    <div class="award-item">
                        <span style="font-size: 1.3rem;">🏆</span>
                        <div><strong>Top Rated Food</strong><br><span style="font-size: 0.75rem; color: var(--text-muted);">Loved by Guests</span></div>
                    </div>
                    <div class="award-item">
                        <span style="font-size: 1.3rem;">🍷</span>
                        <div><strong>Great Drinks Selection</strong><br><span style="font-size: 0.75rem; color: var(--text-muted);">Wines & Cocktails</span></div>
                    </div>
                    <div class="award-item">
                        <span style="font-size: 1.3rem;">💎</span>
                        <div><strong>5-Star Service</strong><br><span style="font-size: 0.75rem; color: var(--text-muted);">Friendly & Welcoming</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     3. CHEF'S SPECIALS
     ========================================================================== -->
<section class="section" id="specials">
    <div class="container">
        <div class="section-header">
            <div class="section-subtitle">Chef's Recommendations</div>
            <h2 class="section-title">Our Favorite <span class="gold-text">Dishes at Parsa</span></h2>
            <p class="section-desc">
                Here are a few favorite dishes loved by our guests every day.
            </p>
        </div>

        <div class="specials-grid">
            <!-- Special 1: Wagyu -->
            <div class="special-card">
                <div class="special-img-box">
                    <img src="<?php echo esc_url( $theme_uri . '/assets/images/dish-wagyu.jpg' ); ?>" alt="Parsa Special Wagyu Steak">
                    <div class="special-price-tag">$145</div>
                </div>
                <div class="special-card-body">
                    <div class="special-badges">
                        <span class="badge badge-chef">⭐ Parsa Special</span>
                        <span class="badge badge-gluten-free">🌾 Gluten-Free</span>
                    </div>
                    <h3 class="special-title">Parsa Special Wagyu Steak</h3>
                    <p class="special-desc">
                        Tender, juicy Japanese beef grilled to perfection, served with warm savory mushroom sauce and roasted vegetables.
                    </p>
                    <div class="special-pairing">
                        🍷 <em>Pairs well with: Red Wine</em>
                    </div>
                </div>
            </div>

            <!-- Special 2: Truffle Pasta -->
            <div class="special-card">
                <div class="special-img-box">
                    <img src="<?php echo esc_url( $theme_uri . '/assets/images/dish-pasta.jpg' ); ?>" alt="Fresh Truffle Pasta">
                    <div class="special-price-tag">$68</div>
                </div>
                <div class="special-card-body">
                    <div class="special-badges">
                        <span class="badge badge-chef">⭐ Chef's Pick</span>
                        <span class="badge badge-gold">🧀 Vegetarian</span>
                    </div>
                    <h3 class="special-title">Handmade Truffle Pasta</h3>
                    <p class="special-desc">
                        Freshly rolled pasta noodles tossed in creamy parmesan cheese sauce with generous slices of black truffle.
                    </p>
                    <div class="special-pairing">
                        🍷 <em>Pairs well with: White Wine</em>
                    </div>
                </div>
            </div>

            <!-- Special 3: Lobster & Caviar -->
            <div class="special-card">
                <div class="special-img-box">
                    <img src="<?php echo esc_url( $theme_uri . '/assets/images/dish-lobster.jpg' ); ?>" alt="Grilled Lobster Tail">
                    <div class="special-price-tag">$115</div>
                </div>
                <div class="special-card-body">
                    <div class="special-badges">
                        <span class="badge badge-chef">⭐ Chef's Pick</span>
                        <span class="badge badge-gluten-free">🌾 Gluten-Free</span>
                    </div>
                    <h3 class="special-title">Grilled Lobster Tail</h3>
                    <p class="special-desc">
                        Sweet fresh lobster tail cooked in warm butter, served with a spoonful of black caviar and lemon sauce.
                    </p>
                    <div class="special-pairing">
                        🍷 <em>Pairs well with: Sparkling Wine</em>
                    </div>
                </div>
            </div>

            <!-- Special 4: Golden Chocolate Sphere -->
            <div class="special-card">
                <div class="special-img-box">
                    <img src="<?php echo esc_url( $theme_uri . '/assets/images/dish-dessert.jpg' ); ?>" alt="Chocolate Gold Cake">
                    <div class="special-price-tag">$38</div>
                </div>
                <div class="special-card-body">
                    <div class="special-badges">
                        <span class="badge badge-gold">👑 Favorite Dessert</span>
                        <span class="badge badge-vegan">🧀 Vegetarian</span>
                    </div>
                    <h3 class="special-title">Chocolate Gold Cake</h3>
                    <p class="special-desc">
                        Rich dark chocolate dome filled with hazelnut cream, fresh berries, and sweet warm berry sauce.
                    </p>
                    <div class="special-pairing">
                        🍷 <em>Pairs well with: Dessert Wine</em>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     4. INTERACTIVE DIGITAL MENU EXPLORER
     ========================================================================== -->
<section class="section" id="menu" style="background-color: var(--bg-secondary);">
    <div class="container">
        <div class="section-header">
            <div class="section-subtitle">Food & Drinks</div>
            <h2 class="section-title">Explore Our <span class="gold-text">Full Menu</span></h2>
            <p class="section-desc">
                Click a category below to browse our appetizers, main dishes, desserts, and drinks.
            </p>
        </div>

        <!-- Menu Controls -->
        <div class="menu-controls">
            <!-- Category Tabs -->
            <div class="menu-category-tabs" id="menu-category-tabs">
                <button class="menu-tab-btn active" data-category="all">All Items</button>
                <button class="menu-tab-btn" data-category="starters">Appetizers</button>
                <button class="menu-tab-btn" data-category="pasta">Fresh Pasta</button>
                <button class="menu-tab-btn" data-category="mains">Steaks & Meat</button>
                <button class="menu-tab-btn" data-category="seafood">Fresh Seafood</button>
                <button class="menu-tab-btn" data-category="desserts">Desserts</button>
                <button class="menu-tab-btn" data-category="cocktails">Cocktails & Drinks</button>
            </div>

            <!-- Dietary Filters & Search Bar -->
            <div class="menu-filter-bar">
                <div class="dietary-filters">
                    <span class="dietary-label">Dietary:</span>
                    <button class="dietary-chip active" data-diet="all">All</button>
                    <button class="dietary-chip" data-diet="vegan">🌱 Vegan</button>
                    <button class="dietary-chip" data-diet="gluten-free">🌾 Gluten-Free</button>
                    <button class="dietary-chip" data-diet="vegetarian">🧀 Vegetarian</button>
                    <button class="dietary-chip" data-diet="signature">⭐ Chef's Pick</button>
                </div>

                <div class="menu-search-box">
                    <svg class="menu-search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <input type="text" id="menu-search-input" class="menu-search-input" placeholder="Search food, steak, drinks...">
                </div>
            </div>
        </div>

        <!-- Menu Items Grid -->
        <div class="menu-items-grid" id="menu-items-container">
            <!-- Dish 1 -->
            <div class="menu-item-row" data-category="mains" data-diet="gluten-free signature" data-title="Parsa Special Wagyu Steak">
                <div class="menu-item-thumbnail">
                    <img src="<?php echo esc_url( $theme_uri . '/assets/images/dish-wagyu.jpg' ); ?>" alt="Parsa Special Wagyu Steak">
                </div>
                <div class="menu-item-details">
                    <div class="menu-item-header">
                        <span class="menu-item-name">Parsa Special Wagyu Steak</span>
                        <span class="menu-item-dots"></span>
                        <span class="menu-item-price">$145</span>
                    </div>
                    <p class="menu-item-description">
                        Juicy Japanese beef served with rich black truffle sauce and roasted baby greens.
                    </p>
                    <div class="menu-item-footer">
                        <div class="menu-item-tags">
                            <span class="badge badge-chef">⭐ Parsa Special</span>
                            <span class="badge badge-gluten-free">🌾 Gluten-Free</span>
                        </div>
                        <span class="menu-item-pairing-note">Wine Pairing: Red Wine</span>
                    </div>
                </div>
            </div>

            <!-- Dish 2 -->
            <div class="menu-item-row" data-category="pasta" data-diet="vegetarian signature" data-title="Handmade Truffle Pasta">
                <div class="menu-item-thumbnail">
                    <img src="<?php echo esc_url( $theme_uri . '/assets/images/dish-pasta.jpg' ); ?>" alt="Handmade Truffle Pasta">
                </div>
                <div class="menu-item-details">
                    <div class="menu-item-header">
                        <span class="menu-item-name">Handmade Truffle Pasta</span>
                        <span class="menu-item-dots"></span>
                        <span class="menu-item-price">$68</span>
                    </div>
                    <p class="menu-item-description">
                        Fresh ribbon pasta in creamy parmesan cheese sauce with freshly shaved black truffles.
                    </p>
                    <div class="menu-item-footer">
                        <div class="menu-item-tags">
                            <span class="badge badge-chef">⭐ Chef's Pick</span>
                            <span class="badge badge-gold">🧀 Vegetarian</span>
                        </div>
                        <span class="menu-item-pairing-note">Wine Pairing: White Wine</span>
                    </div>
                </div>
            </div>

            <!-- Dish 3 -->
            <div class="menu-item-row" data-category="seafood" data-diet="gluten-free signature" data-title="Grilled Lobster Tail">
                <div class="menu-item-thumbnail">
                    <img src="<?php echo esc_url( $theme_uri . '/assets/images/dish-lobster.jpg' ); ?>" alt="Grilled Lobster Tail">
                </div>
                <div class="menu-item-details">
                    <div class="menu-item-header">
                        <span class="menu-item-name">Grilled Lobster Tail</span>
                        <span class="menu-item-dots"></span>
                        <span class="menu-item-price">$115</span>
                    </div>
                    <p class="menu-item-description">
                        Tender fresh lobster tail cooked in butter, served with black caviar and lemon sauce.
                    </p>
                    <div class="menu-item-footer">
                        <div class="menu-item-tags">
                            <span class="badge badge-chef">⭐ Chef's Pick</span>
                            <span class="badge badge-gluten-free">🌾 Gluten-Free</span>
                        </div>
                        <span class="menu-item-pairing-note">Wine Pairing: Sparkling Wine</span>
                    </div>
                </div>
            </div>

            <!-- Dish 4 -->
            <div class="menu-item-row" data-category="starters" data-diet="gluten-free signature" data-title="Black Caviar Plate">
                <div class="menu-item-thumbnail">
                    <img src="<?php echo esc_url( $theme_uri . '/assets/images/dish-lobster.jpg' ); ?>" alt="Black Caviar Plate">
                </div>
                <div class="menu-item-details">
                    <div class="menu-item-header">
                        <span class="menu-item-name">Black Caviar Plate (50g)</span>
                        <span class="menu-item-dots"></span>
                        <span class="menu-item-price">$185</span>
                    </div>
                    <p class="menu-item-description">
                        Premium black caviar served with warm mini pancakes, whipped cream, and fresh chives.
                    </p>
                    <div class="menu-item-footer">
                        <div class="menu-item-tags">
                            <span class="badge badge-gold">👑 House Favorite</span>
                            <span class="badge badge-gluten-free">🌾 Gluten-Free</span>
                        </div>
                        <span class="menu-item-pairing-note">Wine Pairing: Chilled Champagne</span>
                    </div>
                </div>
            </div>

            <!-- Dish 5 -->
            <div class="menu-item-row" data-category="starters" data-diet="vegan gluten-free" data-title="Roasted Beet Salad">
                <div class="menu-item-thumbnail">
                    <img src="<?php echo esc_url( $theme_uri . '/assets/images/dish-dessert.jpg' ); ?>" alt="Roasted Beet Salad">
                </div>
                <div class="menu-item-details">
                    <div class="menu-item-header">
                        <span class="menu-item-name">Roasted Beet Salad</span>
                        <span class="menu-item-dots"></span>
                        <span class="menu-item-price">$34</span>
                    </div>
                    <p class="menu-item-description">
                        Sweet oven-roasted beets with toasted almond cream, fresh herbs, and olive oil dressing.
                    </p>
                    <div class="menu-item-footer">
                        <div class="menu-item-tags">
                            <span class="badge badge-vegan">🌱 Vegan</span>
                            <span class="badge badge-gluten-free">🌾 Gluten-Free</span>
                        </div>
                        <span class="menu-item-pairing-note">Wine Pairing: White Wine</span>
                    </div>
                </div>
            </div>

            <!-- Dish 6 -->
            <div class="menu-item-row" data-category="mains" data-diet="gluten-free" data-title="Roasted Duck Breast">
                <div class="menu-item-thumbnail">
                    <img src="<?php echo esc_url( $theme_uri . '/assets/images/dish-wagyu.jpg' ); ?>" alt="Roasted Duck Breast">
                </div>
                <div class="menu-item-details">
                    <div class="menu-item-header">
                        <span class="menu-item-name">Roasted Duck Breast</span>
                        <span class="menu-item-dots"></span>
                        <span class="menu-item-price">$78</span>
                    </div>
                    <p class="menu-item-description">
                        Crispy skin tender duck breast with sweet berry sauce and creamy parsnip mash.
                    </p>
                    <div class="menu-item-footer">
                        <div class="menu-item-tags">
                            <span class="badge badge-gold">French Classic</span>
                        </div>
                        <span class="menu-item-pairing-note">Wine Pairing: Red Wine</span>
                    </div>
                </div>
            </div>

            <!-- Dish 7 -->
            <div class="menu-item-row" data-category="desserts" data-diet="vegetarian signature" data-title="Chocolate Gold Cake">
                <div class="menu-item-thumbnail">
                    <img src="<?php echo esc_url( $theme_uri . '/assets/images/dish-dessert.jpg' ); ?>" alt="Chocolate Gold Cake">
                </div>
                <div class="menu-item-details">
                    <div class="menu-item-header">
                        <span class="menu-item-name">Chocolate Gold Cake</span>
                        <span class="menu-item-dots"></span>
                        <span class="menu-item-price">$38</span>
                    </div>
                    <p class="menu-item-description">
                        Dark chocolate sphere with warm hazelnut center, fresh raspberries, and sweet berry sauce.
                    </p>
                    <div class="menu-item-footer">
                        <div class="menu-item-tags">
                            <span class="badge badge-chef">⭐ Chef's Pick</span>
                            <span class="badge badge-gold">🧀 Vegetarian</span>
                        </div>
                        <span class="menu-item-pairing-note">Wine Pairing: Dessert Wine</span>
                    </div>
                </div>
            </div>

            <!-- Dish 8 -->
            <div class="menu-item-row" data-category="cocktails" data-diet="vegan gluten-free signature" data-title="Smoked Old Fashioned Cocktail">
                <div class="menu-item-thumbnail">
                    <img src="<?php echo esc_url( $theme_uri . '/assets/images/dish-cocktail.jpg' ); ?>" alt="Smoked Old Fashioned Cocktail">
                </div>
                <div class="menu-item-details">
                    <div class="menu-item-header">
                        <span class="menu-item-name">Smoked Old Fashioned Cocktail</span>
                        <span class="menu-item-dots"></span>
                        <span class="menu-item-price">$28</span>
                    </div>
                    <p class="menu-item-description">
                        Premium bourbon whiskey, aromatic bitters, fresh orange peel, and toasted rosemary smoke.
                    </p>
                    <div class="menu-item-footer">
                        <div class="menu-item-tags">
                            <span class="badge badge-chef">⭐ Popular Drink</span>
                            <span class="badge badge-vegan">🌱 Vegan</span>
                        </div>
                        <span class="menu-item-pairing-note">Made Fresh at the Bar</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     5. TABLE RESERVATION BOOKING ENGINE
     ========================================================================== -->
<section class="section reservation-section" id="reservation">
    <div class="container">
        <div class="section-header">
            <div class="section-subtitle">Online Booking</div>
            <h2 class="section-title">Book a Table at <span class="gold-text">Parsa</span></h2>
            <p class="section-desc">
                Pick a date, time, and table. You will get instant confirmation on your screen.
            </p>
        </div>

        <div class="reservation-wrapper">
            <form id="letoile-reservation-form" class="reservation-form">
                <div class="reservation-form-grid">
                    <!-- Date Picker -->
                    <div class="form-group">
                        <label class="form-label" for="res_date">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            Reservation Date *
                        </label>
                        <input type="date" id="res_date" name="res_date" class="form-input" value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" required>
                    </div>

                    <!-- Party Size -->
                    <div class="form-group">
                        <label class="form-label" for="res_guests">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            Number of Guests *
                        </label>
                        <select id="res_guests" name="res_guests" class="form-select" required>
                            <option value="1">1 Person</option>
                            <option value="2" selected>2 People</option>
                            <option value="3">3 People</option>
                            <option value="4">4 People</option>
                            <option value="5">5 People</option>
                            <option value="6">6 People</option>
                            <option value="8">8 People</option>
                            <option value="12">12+ People (Private Room)</option>
                        </select>
                    </div>

                    <!-- Seating Ambiance Area -->
                    <div class="form-group full-width">
                        <label class="form-label">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            Choose Where to Sit *
                        </label>
                        <div class="seating-options" id="seating-options-group">
                            <div class="seating-card selected" data-area="Main Dining Room">
                                <div style="font-size: 1.5rem;">🥂</div>
                                <div class="seating-title">Main Dining Room</div>
                                <div class="seating-desc">Comfortable tables and booths</div>
                            </div>

                            <div class="seating-card" data-area="Chef's Counter">
                                <div style="font-size: 1.5rem;">🔪</div>
                                <div class="seating-title">Chef's Counter</div>
                                <div class="seating-desc">Watch the chefs cook live</div>
                            </div>

                            <div class="seating-card" data-area="Private Wine Room">
                                <div style="font-size: 1.5rem;">🍷</div>
                                <div class="seating-title">Private Wine Room</div>
                                <div class="seating-desc">Quiet room surrounded by fine wine</div>
                            </div>

                            <div class="seating-card" data-area="Garden Patio">
                                <div style="font-size: 1.5rem;">🌿</div>
                                <div class="seating-title">Garden Patio</div>
                                <div class="seating-desc">Heated outdoor terrace with city views</div>
                            </div>
                        </div>
                        <input type="hidden" id="selected_seating" name="res_seating" value="Main Dining Room">
                    </div>

                    <!-- Time Slots -->
                    <div class="form-group full-width">
                        <label class="form-label">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            Available Times *
                        </label>
                        <div class="time-slots" id="time-slots-group">
                            <button type="button" class="time-slot-btn" data-time="17:00">5:00 PM</button>
                            <button type="button" class="time-slot-btn" data-time="17:30">5:30 PM</button>
                            <button type="button" class="time-slot-btn" data-time="18:00">6:00 PM</button>
                            <button type="button" class="time-slot-btn" data-time="18:30">6:30 PM</button>
                            <button type="button" class="time-slot-btn selected" data-time="19:00">7:00 PM</button>
                            <button type="button" class="time-slot-btn" data-time="19:30">7:30 PM</button>
                            <button type="button" class="time-slot-btn" data-time="20:00">8:00 PM</button>
                            <button type="button" class="time-slot-btn" data-time="20:30">8:30 PM</button>
                            <button type="button" class="time-slot-btn" data-time="21:00">9:00 PM</button>
                            <button type="button" class="time-slot-btn" data-time="21:30">9:30 PM</button>
                        </div>
                        <input type="hidden" id="selected_time" name="res_time" value="19:00">
                    </div>

                    <!-- Guest Contact Details -->
                    <div class="form-group">
                        <label class="form-label" for="guest_name">Your Name *</label>
                        <input type="text" id="guest_name" name="guest_name" class="form-input" placeholder="e.g. John Smith" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="guest_email">Email Address *</label>
                        <input type="email" id="guest_email" name="guest_email" class="form-input" placeholder="e.g. john@example.com" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="guest_phone">Phone Number *</label>
                        <input type="tel" id="guest_phone" name="guest_phone" class="form-input" placeholder="e.g. (212) 555-0199" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="res_occasion">Occasion (Optional)</label>
                        <select id="res_occasion" name="res_occasion" class="form-select">
                            <option value="Dinner with Friends">Dinner with Friends</option>
                            <option value="Birthday">Birthday</option>
                            <option value="Anniversary">Anniversary</option>
                            <option value="Business Dinner">Business Dinner</option>
                            <option value="Special Celebration">Special Celebration</option>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label" for="res_notes">Special Requests or Food Allergies</label>
                        <textarea id="res_notes" name="res_notes" rows="3" class="form-textarea" placeholder="Tell us if anyone has allergies (nuts, gluten, dairy) or if you have any seating preferences..."></textarea>
                    </div>

                    <div class="form-group full-width" style="margin-top: 1rem; text-align: center;">
                        <button type="submit" class="btn btn-gold" id="btn-submit-booking" style="padding: 1.15rem 3rem; font-size: 1rem; width: 100%; max-width: 480px; margin: 0 auto;">
                            Confirm Reservation →
                        </button>
                        <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.75rem;">
                            🔒 Free cancellation up to 24 hours before your booking.
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- ==========================================================================
     6. PHOTO GALLERY
     ========================================================================== -->
<section class="section" id="gallery" style="background-color: var(--bg-primary);">
    <div class="container">
        <div class="section-header">
            <div class="section-subtitle">Photo Gallery</div>
            <h2 class="section-title">Inside <span class="gold-text">Parsa</span></h2>
            <p class="section-desc">
                A look at our dining rooms, delicious dishes, and kitchen team.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
            <div class="glass-card" style="overflow: hidden; height: 260px; border-radius: var(--radius-md);">
                <img src="<?php echo esc_url( $theme_uri . '/assets/images/hero.jpg' ); ?>" alt="Dining Room" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
            </div>
            <div class="glass-card" style="overflow: hidden; height: 260px; border-radius: var(--radius-md);">
                <img src="<?php echo esc_url( $theme_uri . '/assets/images/dish-wagyu.jpg' ); ?>" alt="Grilled Steak" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
            </div>
            <div class="glass-card" style="overflow: hidden; height: 260px; border-radius: var(--radius-md);">
                <img src="<?php echo esc_url( $theme_uri . '/assets/images/dish-pasta.jpg' ); ?>" alt="Fresh Pasta" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
            </div>
            <div class="glass-card" style="overflow: hidden; height: 260px; border-radius: var(--radius-md);">
                <img src="<?php echo esc_url( $theme_uri . '/assets/images/dish-lobster.jpg' ); ?>" alt="Fresh Lobster" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
            </div>
            <div class="glass-card" style="overflow: hidden; height: 260px; border-radius: var(--radius-md);">
                <img src="<?php echo esc_url( $theme_uri . '/assets/images/dish-dessert.jpg' ); ?>" alt="Chocolate Dessert" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
            </div>
            <div class="glass-card" style="overflow: hidden; height: 260px; border-radius: var(--radius-md);">
                <img src="<?php echo esc_url( $theme_uri . '/assets/images/dish-cocktail.jpg' ); ?>" alt="Bar Drinks" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     7. CUSTOMER REVIEWS
     ========================================================================== -->
<section class="section" id="reviews" style="background-color: var(--bg-secondary);">
    <div class="container">
        <div class="section-header">
            <div class="section-subtitle">Customer Reviews</div>
            <h2 class="section-title">What Our Guests <span class="gold-text">Say About Parsa</span></h2>
            <p class="section-desc">
                Read real reviews from people who dined with us recently.
            </p>
        </div>

        <div class="reviews-grid">
            <!-- Review 1 -->
            <div class="review-card">
                <div class="review-stars">★★★★★</div>
                <div class="review-text">
                    "The Wagyu steak at Parsa was so tender and full of flavor. The staff made our anniversary feel extra special. We will definitely come back soon!"
                </div>
                <div class="review-author">
                    <div class="author-avatar">MS</div>
                    <div>
                        <div class="author-name">Michael & Sarah</div>
                        <div class="author-title">Local Diners</div>
                    </div>
                </div>
            </div>

            <!-- Review 2 -->
            <div class="review-card">
                <div class="review-stars">★★★★★</div>
                <div class="review-text">
                    "Best pasta I have tasted in New York. The truffle noodles and the warm chocolate dessert were absolutely amazing."
                </div>
                <div class="review-author">
                    <div class="author-avatar">ER</div>
                    <div>
                        <div class="author-name">Emily Roberts</div>
                        <div class="author-title">Food Blogger</div>
                    </div>
                </div>
            </div>

            <!-- Review 3 -->
            <div class="review-card">
                <div class="review-stars">★★★★★</div>
                <div class="review-text">
                    "Great atmosphere, friendly service, and delicious food. We booked a table in the private wine room at Parsa for a family birthday and had a wonderful night."
                </div>
                <div class="review-author">
                    <div class="author-avatar">DK</div>
                    <div>
                        <div class="author-name">David Kim</div>
                        <div class="author-title">Verified Guest</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     8. LOCATION, HOURS & PRIVATE EVENTS
     ========================================================================== -->
<section class="section" id="contact" style="background-color: var(--bg-primary);">
    <div class="container">
        <div class="story-grid">
            <!-- Left Info -->
            <div>
                <div class="section-subtitle">Visit Us</div>
                <h2 style="font-size: 2.5rem; margin-bottom: 1.25rem;">
                    Location & <span class="gold-text">Contact Information</span>
                </h2>
                <p style="color: var(--text-secondary); margin-bottom: 2rem;">
                    Parsa is located on Madison Avenue in Manhattan. Come visit us for an unforgettable lunch or dinner.
                </p>

                <div style="display: flex; flex-direction: column; gap: 1.25rem; margin-bottom: 2.5rem;">
                    <div style="display: flex; gap: 1rem; align-items: flex-start;">
                        <div style="color: var(--gold-primary); font-size: 1.25rem;">📍</div>
                        <div>
                            <strong>Restaurant Address</strong><br>
                            <span style="color: var(--text-secondary);">740 Madison Avenue (between 64th & 65th St), New York, NY 10065</span>
                        </div>
                    </div>

                    <div style="display: flex; gap: 1rem; align-items: flex-start;">
                        <div style="color: var(--gold-primary); font-size: 1.25rem;">📞</div>
                        <div>
                            <strong>Phone Number</strong><br>
                            <span style="color: var(--gold-light);">+1 (212) 555-8900</span>
                        </div>
                    </div>

                    <div style="display: flex; gap: 1rem; align-items: flex-start;">
                        <div style="color: var(--gold-primary); font-size: 1.25rem;">✉️</div>
                        <div>
                            <strong>Email Address</strong><br>
                            <span style="color: var(--text-secondary);">info@parsa-restaurant.com</span>
                        </div>
                    </div>

                    <div style="display: flex; gap: 1rem; align-items: flex-start;">
                        <div style="color: var(--gold-primary); font-size: 1.25rem;">👔</div>
                        <div>
                            <strong>Dress Code</strong><br>
                            <span style="color: var(--text-secondary);">Smart Casual. Please no beachwear or workout clothes.</span>
                        </div>
                    </div>
                </div>

                <a href="#reservation" class="btn btn-gold">Book a Table Now →</a>
            </div>

            <!-- Right: Interactive Private Inquiries Card -->
            <div class="glass-card" style="padding: 2.5rem;">
                <h3 class="gold-text" style="font-size: 1.5rem; margin-bottom: 1rem;">Host a Party at Parsa</h3>
                <p style="font-size: 0.9rem; color: var(--text-secondary); margin-bottom: 1.5rem;">
                    Planning a birthday party, wedding dinner, or business gathering? Let us host your special event.
                </p>
                <form onsubmit="event.preventDefault(); alert('Thank you! Our events manager will call you shortly to help plan your party at Parsa.');">
                    <div class="form-group" style="margin-bottom: 1rem;">
                        <label class="form-label">Your Name</label>
                        <input type="text" class="form-input" placeholder="Your name..." required>
                    </div>
                    <div class="form-group" style="margin-bottom: 1rem;">
                        <label class="form-label">Party Type & Number of People</label>
                        <input type="text" class="form-input" placeholder="e.g. Birthday Party for 20 people" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 1.5rem;">
                        <label class="form-label">Phone or Email</label>
                        <input type="text" class="form-input" placeholder="How can we reach you..." required>
                    </div>
                    <button type="submit" class="btn btn-outline-gold" style="width: 100%;">
                        Send Event Request
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
