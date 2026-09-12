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
});
