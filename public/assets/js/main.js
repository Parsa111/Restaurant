/**
 * L'Étoile Dorée - Main JavaScript
 */
document.addEventListener('DOMContentLoaded', () => {
    // 1. Sticky Header Scroll Effect
    const siteHeader = document.getElementById('site-header');
    if (siteHeader) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 40) {
                siteHeader.classList.add('scrolled');
            } else {
                siteHeader.classList.remove('scrolled');
            }
        });
    }

    // 2. Mobile Menu Drawer Toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileDrawer = document.getElementById('mobile-drawer');
    const mobileDrawerClose = document.getElementById('mobile-drawer-close');
    const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');

    if (mobileMenuBtn && mobileDrawer) {
        mobileMenuBtn.addEventListener('click', () => {
            mobileDrawer.style.display = 'flex';
        });

        if (mobileDrawerClose) {
            mobileDrawerClose.addEventListener('click', () => {
                mobileDrawer.style.display = 'none';
            });
        }

        mobileNavLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileDrawer.style.display = 'none';
            });
        });
    }

    // 3. Interactive Digital Menu Category & Dietary Filtering
    const categoryTabs = document.querySelectorAll('.menu-tab-btn');
    const dietaryChips = document.querySelectorAll('.dietary-chip');
    const searchInput = document.getElementById('menu-search-input');
    const menuItems = document.querySelectorAll('.menu-item-row');

    let currentCategory = 'all';
    let currentDiet = 'all';
    let currentSearch = '';

    function filterMenuItems() {
        menuItems.forEach(item => {
            const itemCat = item.getAttribute('data-category') || '';
            const itemDiet = item.getAttribute('data-diet') || '';
            const itemTitle = (item.getAttribute('data-title') || '').toLowerCase();
            const itemDesc = (item.querySelector('.menu-item-description')?.textContent || '').toLowerCase();

            const matchCat = (currentCategory === 'all' || itemCat.includes(currentCategory));
            const matchDiet = (currentDiet === 'all' || itemDiet.includes(currentDiet));
            const matchSearch = (!currentSearch || itemTitle.includes(currentSearch) || itemDesc.includes(currentSearch));

            if (matchCat && matchDiet && matchSearch) {
                item.style.display = 'flex';
                item.style.animation = 'fadeIn 0.35s ease forwards';
            } else {
                item.style.display = 'none';
            }
        });
    }

    // Category click handler
    categoryTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            categoryTabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            currentCategory = tab.getAttribute('data-category');
            filterMenuItems();
        });
    });

    // Dietary click handler
    dietaryChips.forEach(chip => {
        chip.addEventListener('click', () => {
            dietaryChips.forEach(c => c.classList.remove('active'));
            chip.classList.add('active');
            currentDiet = chip.getAttribute('data-diet');
            filterMenuItems();
        });
    });

    // Search input handler
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            currentSearch = e.target.value.toLowerCase().trim();
            filterMenuItems();
        });
    }

    // 4. Smooth Anchor Scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId && targetId !== '#') {
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    e.preventDefault();
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });

    // 5. Interactive Dish Detail Modal (Simple Clear Words & Detailed Food Info)
    const DISH_DETAILS = {
        'Parsa Special Wagyu Steak': {
            price: '$145',
            image: '/assets/images/dish-wagyu.jpg',
            badges: ['⭐ Parsa Special', '🌾 Gluten-Free'],
            description: 'Our signature Wagyu steak is cooked over open wood flame until soft and juicy. We season it with sea salt, garlic butter, and fresh herbs so every bite melts in your mouth. Served with warm mushroom sauce and golden roasted vegetables on the side.',
            ingredients: [
                'A5 Japanese Wagyu Beef (Tender & Juicy)',
                'Fresh Garlic & Butter',
                'Sautéed Wild Mushrooms',
                'Coarse Sea Salt & Black Pepper',
                'Fresh Rosemary & Thyme'
            ],
            pairing: 'Pairs best with a glass of rich, warm Red Wine (Cabernet Sauvignon).'
        },
        'Handmade Truffle Pasta': {
            price: '$68',
            image: '/assets/images/dish-pasta.jpg',
            badges: ['⭐ Chef\'s Pick', '🧀 Vegetarian'],
            description: 'Freshly rolled egg pasta noodles cooked to soft perfection and tossed in a rich, creamy Parmigiano cheese sauce. Right before serving, our chef shaves generous slices of real aromatic black truffle right over your bowl for a warm, savory flavor.',
            ingredients: [
                'Fresh Handmade Egg Ribbon Pasta',
                'Shaved Aromatic Black Truffle',
                'Aged Parmigiano-Reggiano Cheese',
                'Heavy Cream & Butter Sauce',
                'Fresh Chopped Parsley'
            ],
            pairing: 'Pairs best with a crisp, chilled White Wine (Chardonnay).'
        },
        'Grilled Lobster Tail': {
            price: '$115',
            image: '/assets/images/dish-lobster.jpg',
            badges: ['⭐ Chef\'s Pick', '🌾 Gluten-Free'],
            description: 'Fresh sweet Atlantic lobster tail lightly grilled with melted lemon garlic butter. Served with a spoonful of black caviar and warm roasted greens for a clean, rich seafood taste.',
            ingredients: [
                'Fresh Sweet Atlantic Lobster Tail',
                'Premium Black Sturgeon Caviar',
                'Clarified Lemon Garlic Butter',
                'Fresh Lemon Juice & Herbs',
                'Baby Roasted Greens'
            ],
            pairing: 'Pairs best with a glass of chilled French Champagne or Sparkling Wine.'
        },
        'Chocolate Gold Cake': {
            price: '$38',
            image: '/assets/images/dish-dessert.jpg',
            badges: ['👑 House Favorite', '🧀 Vegetarian'],
            description: 'A rich dark chocolate dome filled with smooth hazelnut cream and sweet red raspberries. When brought to your table, warm berry sauce is poured over the dome to gently melt the chocolate.',
            ingredients: [
                'Dark Belgian Chocolate',
                'Creamy Roasted Hazelnut Center',
                'Fresh Red Raspberries',
                'Warm Sweet Berry Sauce',
                'Edible Gold Leaf Shimmer'
            ],
            pairing: 'Pairs best with Dessert Wine or a warm Espresso.'
        },
        'Black Caviar Plate': {
            price: '$185',
            image: '/assets/images/dish-lobster.jpg',
            badges: ['👑 House Favorite', '🌾 Gluten-Free'],
            description: 'Premium chilled black caviar served with warm mini pancakes, smooth lemon cream, and fresh chopped chives. A simple, elegant dish loved by our guests.',
            ingredients: [
                'Premium Black Sturgeon Caviar (50g)',
                'Warm Soft Mini Pancakes (Blinis)',
                'Whipped Lemon Cream',
                'Fresh Chopped Chives',
                'Clarified Butter'
            ],
            pairing: 'Pairs best with Ice Cold Vodka or Chilled Champagne.'
        },
        'Roasted Beet Salad': {
            price: '$34',
            image: '/assets/images/dish-dessert.jpg',
            badges: ['🌱 Vegan', '🌾 Gluten-Free'],
            description: 'Sweet oven-roasted red and golden beets sliced thin and served over creamy almond sauce with fresh garden greens and extra virgin olive oil.',
            ingredients: [
                'Oven-Roasted Red & Golden Beets',
                'Whipped Almond Cream',
                'Fresh Baby Rocket Greens',
                'Extra Virgin Olive Oil',
                'Toasted Sea Salt'
            ],
            pairing: 'Pairs best with a crisp White Wine (Sauvignon Blanc).'
        },
        'Roasted Duck Breast': {
            price: '$78',
            image: '/assets/images/dish-wagyu.jpg',
            badges: ['French Classic'],
            description: 'Tender duck breast cooked with golden crispy skin and a juicy center. Served with sweet cherry reduction sauce and creamy parsnip mash on the side.',
            ingredients: [
                'Fresh Roasted Duck Breast',
                'Sweet Red Cherry Reduction Sauce',
                'Creamy Parsnip Purée',
                'Fresh Thyme & Butter',
                'Black Pepper'
            ],
            pairing: 'Pairs best with a smooth Red Wine (Pinot Noir).'
        },
        'Smoked Old Fashioned Cocktail': {
            price: '$28',
            image: '/assets/images/dish-cocktail.jpg',
            badges: ['⭐ Popular Drink', '🌱 Vegan'],
            description: 'Smooth bourbon whiskey stirred with natural cane sugar and aromatic bitters. Infused with toasted oak wood smoke right at your table for a warm, rich flavor.',
            ingredients: [
                'Premium Aged Bourbon Whiskey',
                'Angostura Aromatic Bitters',
                'Raw Cane Sugar Syrup',
                'Fresh Orange Peel',
                'Toasted Oak Wood Smoke'
            ],
            pairing: 'Pairs best with our Grilled Steaks and Wagyu Beef.'
        }
    };

    const dishModal = document.getElementById('dish-detail-modal');
    const closeDishModalBtn = document.getElementById('close-dish-modal-btn');
    const dishModalImg = document.getElementById('dish-modal-img');
    const dishModalPrice = document.getElementById('dish-modal-price');
    const dishModalBadges = document.getElementById('dish-modal-badges');
    const dishModalTitle = document.getElementById('dish-modal-title');
    const dishModalDesc = document.getElementById('dish-modal-desc');
    const dishModalIngredients = document.getElementById('dish-modal-ingredients');
    const dishModalPairing = document.getElementById('dish-modal-pairing');
    const dishReserveBtn = document.getElementById('dish-reserve-btn');

    const DISH_URL_MAP = {
        'Parsa Special Wagyu Steak': 'dish-wagyu.html',
        'Handmade Truffle Pasta': 'dish-pasta.html',
        'Grilled Lobster Tail': 'dish-lobster.html',
        'Chocolate Gold Cake': 'dish-dessert.html',
        'Black Caviar Plate': 'dish-caviar.html',
        'Roasted Beet Salad': 'dish-beet.html',
        'Roasted Duck Breast': 'dish-duck.html',
        'Smoked Old Fashioned Cocktail': 'dish-cocktail.html'
    };

    function openDishModal(dishName) {
        const targetUrl = DISH_URL_MAP[dishName];
        if (targetUrl) {
            window.location.href = targetUrl;
            return;
        }

        const info = DISH_DETAILS[dishName] || {
            price: '$45',
            image: '/assets/images/hero.jpg',
            badges: ['⭐ Fresh Food'],
            description: 'Delicious dish prepared fresh daily by our kitchen team with high quality ingredients.',
            ingredients: ['Fresh Meat & Vegetables', 'House Seasoning', 'Garlic & Olive Oil'],
            pairing: 'Pairs well with your favorite cold drink or wine.'
        };

        if (dishModalTitle) dishModalTitle.textContent = dishName;
        if (dishModalPrice) dishModalPrice.textContent = info.price;
        if (dishModalImg) dishModalImg.src = info.image;
        if (dishModalDesc) dishModalDesc.textContent = info.description;
        if (dishModalPairing) dishModalPairing.textContent = info.pairing;

        if (dishModalBadges) {
            dishModalBadges.innerHTML = info.badges.map(b => `<span class="badge badge-gold">${b}</span>`).join('');
        }

        if (dishModalIngredients) {
            dishModalIngredients.innerHTML = info.ingredients.map(i => `<li>${i}</li>`).join('');
        }

        if (dishModal) {
            dishModal.style.display = 'flex';
        }
    }

    // Attach click handlers to all food cards and menu rows
    document.querySelectorAll('.special-card, .menu-item-row').forEach(card => {
        card.style.cursor = 'pointer';
        card.addEventListener('click', (e) => {
            if (e.target.closest('a, button')) return; // Ignore inside buttons
            const title = card.getAttribute('data-title') || 
                          card.querySelector('.special-title, .menu-item-name')?.textContent?.trim();
            if (title) {
                openDishModal(title);
            }
        });
    });

    if (closeDishModalBtn && dishModal) {
        closeDishModalBtn.addEventListener('click', () => {
            dishModal.style.display = 'none';
        });
        dishModal.addEventListener('click', (e) => {
            if (e.target === dishModal) {
                dishModal.style.display = 'none';
            }
        });
    }

    if (dishReserveBtn) {
        dishReserveBtn.addEventListener('click', () => {
            if (dishModal) dishModal.style.display = 'none';
            const notesField = document.getElementById('res_notes');
            if (notesField && dishModalTitle) {
                notesField.value = `Interested in ordering: ${dishModalTitle.textContent}`;
            }
            const resSection = document.getElementById('reservation');
            if (resSection) {
                resSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    }
});

