const fs = require('fs');
const path = require('path');

const DISHES = [
    {
        filename: 'dish-wagyu.html',
        name: 'Parsa Special Wagyu Steak',
        price: '$145',
        image: '/assets/images/dish-wagyu.jpg',
        badges: ['⭐ Parsa Special', '🌾 Gluten-Free'],
        subtitle: 'Grilled Japanese A5 Wagyu Beef with Wild Mushroom Sauce',
        description: 'Our signature Wagyu steak is cooked over open wood flame until soft and juicy. We season it with coarse sea salt, garlic butter, and fresh herbs so every bite melts in your mouth. Served with warm mushroom sauce and golden roasted vegetables on the side.',
        ingredients: [
            'A5 Japanese Wagyu Beef (Tender & Soft)',
            'Fresh Roasted Garlic & Creamy Butter',
            'Sautéed Wild Mushrooms',
            'Coarse Sea Salt & Crushed Black Pepper',
            'Fresh Rosemary & Thyme'
        ],
        pairing: 'Pairs best with a glass of rich, warm Red Wine (Cabernet Sauvignon).'
    },
    {
        filename: 'dish-pasta.html',
        name: 'Handmade Truffle Pasta',
        price: '$68',
        image: '/assets/images/dish-pasta.jpg',
        badges: ['⭐ Chef\'s Pick', '🧀 Vegetarian'],
        subtitle: 'Fresh Egg Ribbon Pasta in Parmigiano Cheese Sauce & Shaved Truffles',
        description: 'Freshly rolled egg pasta noodles cooked to soft perfection and tossed in a rich, creamy Parmigiano cheese sauce. Right before serving, our chef shaves generous slices of real aromatic black truffle right over your bowl for a warm, savory flavor.',
        ingredients: [
            'Fresh Handmade Egg Ribbon Pasta',
            'Shaved Aromatic Black Truffles',
            'Aged Parmigiano-Reggiano Cheese',
            'Heavy Cream & Butter Sauce',
            'Fresh Chopped Parsley'
        ],
        pairing: 'Pairs best with a crisp, chilled White Wine (Chardonnay).'
    },
    {
        filename: 'dish-lobster.html',
        name: 'Grilled Lobster Tail',
        price: '$115',
        image: '/assets/images/dish-lobster.jpg',
        badges: ['⭐ Chef\'s Pick', '🌾 Gluten-Free'],
        subtitle: 'Sweet Atlantic Lobster Tail with Garlic Butter & Black Caviar',
        description: 'Fresh sweet Atlantic lobster tail lightly grilled with melted lemon garlic butter. Served with a spoonful of black caviar and warm roasted greens for a clean, rich seafood taste.',
        ingredients: [
            'Fresh Sweet Atlantic Lobster Tail',
            'Premium Black Sturgeon Caviar',
            'Clarified Lemon Garlic Butter',
            'Fresh Lemon Juice & Garden Herbs',
            'Baby Roasted Greens'
        ],
        pairing: 'Pairs best with a glass of chilled French Champagne or Sparkling Wine.'
    },
    {
        filename: 'dish-dessert.html',
        name: 'Chocolate Gold Cake',
        price: '$38',
        image: '/assets/images/dish-dessert.jpg',
        badges: ['👑 House Favorite', '🧀 Vegetarian'],
        subtitle: 'Dark Belgian Chocolate Dome with Warm Hazelnut Cream & Berry Sauce',
        description: 'A rich dark chocolate dome filled with smooth hazelnut cream and sweet red raspberries. When brought to your table, warm berry sauce is poured over the dome to gently melt the chocolate.',
        ingredients: [
            'Dark Belgian Chocolate Dome',
            'Creamy Roasted Hazelnut Center',
            'Fresh Red Raspberries',
            'Warm Sweet Berry Sauce',
            'Edible Gold Leaf Shimmer'
        ],
        pairing: 'Pairs best with Dessert Wine or a warm Espresso.'
    },
    {
        filename: 'dish-caviar.html',
        name: 'Black Caviar Plate',
        price: '$185',
        image: '/assets/images/dish-lobster.jpg',
        badges: ['👑 House Favorite', '🌾 Gluten-Free'],
        subtitle: 'Premium Black Sturgeon Caviar with Mini Pancakes & Whipped Cream',
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
    {
        filename: 'dish-beet.html',
        name: 'Roasted Beet Salad',
        price: '$34',
        image: '/assets/images/dish-dessert.jpg',
        badges: ['🌱 Vegan', '🌾 Gluten-Free'],
        subtitle: 'Oven-Roasted Beets with Almond Cream & Garden Rocket Greens',
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
    {
        filename: 'dish-duck.html',
        name: 'Roasted Duck Breast',
        price: '$78',
        image: '/assets/images/dish-wagyu.jpg',
        badges: ['French Classic'],
        subtitle: 'Crispy Skin Duck Breast with Sweet Cherry Sauce & Parsnip Mash',
        description: 'Tender duck breast cooked with golden crispy skin and a juicy center. Served with sweet cherry reduction sauce and creamy parsnip mash on the side.',
        ingredients: [
            'Fresh Roasted Duck Breast',
            'Sweet Red Cherry Reduction Sauce',
            'Creamy Parsnip Purée',
            'Fresh Thyme & Butter',
            'Crushed Black Pepper'
        ],
        pairing: 'Pairs best with a smooth Red Wine (Pinot Noir).'
    },
    {
        filename: 'dish-cocktail.html',
        name: 'Smoked Old Fashioned Cocktail',
        price: '$28',
        image: '/assets/images/dish-cocktail.jpg',
        badges: ['⭐ Popular Drink', '🌱 Vegan'],
        subtitle: 'Aged Bourbon Whiskey Infused with Toasted Oak Wood Smoke',
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
];

function generateDishHtml(dish) {
    const badgesHtml = dish.badges.map(b => `<span class="badge badge-gold">${b}</span>`).join(' ');
    const ingredientsHtml = dish.ingredients.map(i => `<li style="margin-bottom: 0.4rem;">${i}</li>`).join('');

    return `<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>${dish.name} — Parsa Restaurant & Bistro</title>
    <meta name="description" content="${dish.subtitle}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-primary: #0a0b0e;
            --bg-card: rgba(22, 25, 34, 0.7);
            --gold-primary: #d4af37;
            --gold-light: #f3e5ab;
            --text-primary: #f8f6f0;
            --text-secondary: #b5b0a3;
            --text-muted: #7e7a70;
            --border-gold: rgba(212, 175, 55, 0.35);
            --border-subtle: rgba(212, 175, 55, 0.15);
            --radius-md: 12px;
            --font-serif: 'Playfair Display', serif;
            --font-sans: 'Plus Jakarta Sans', sans-serif;
            --font-accent: 'Cinzel', serif;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: var(--font-sans);
            background-color: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.7;
            padding: 0;
            min-height: 100vh;
        }
        .header {
            padding: 1.25rem 2rem;
            background: rgba(10, 11, 14, 0.95);
            border-bottom: 1px solid var(--border-subtle);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .brand-logo {
            font-family: var(--font-accent);
            font-size: 1.25rem;
            color: var(--gold-light);
            text-decoration: none;
            font-weight: 700;
            letter-spacing: 0.15em;
        }
        .container {
            max-width: 860px;
            margin: 3rem auto;
            padding: 0 1.5rem;
        }
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border-gold);
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.6);
        }
        .hero-img-box {
            position: relative;
            height: 380px;
            width: 100%;
        }
        .hero-img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .price-badge {
            position: absolute;
            bottom: 1.5rem;
            right: 1.5rem;
            background: rgba(10, 11, 14, 0.88);
            border: 1px solid var(--gold-primary);
            padding: 0.5rem 1.25rem;
            border-radius: 30px;
            font-family: var(--font-serif);
            font-size: 1.5rem;
            color: var(--gold-light);
            font-weight: 700;
        }
        .badge {
            display: inline-block;
            padding: 0.3rem 0.65rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .badge-gold {
            background: rgba(212, 175, 55, 0.15);
            color: var(--gold-light);
            border: 1px solid var(--border-gold);
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.85rem 1.75rem;
            font-family: var(--font-accent);
            font-size: 0.85rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-gold {
            background: linear-gradient(135deg, #f7e7b4 0%, #d4af37 50%, #aa820a 100%);
            color: #000;
        }
        .btn-outline {
            background: transparent;
            color: var(--gold-light);
            border: 1px solid var(--border-gold);
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.85rem 1.75rem;
            min-height: 44px;
            font-family: var(--font-accent);
            font-size: 0.85rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            touch-action: manipulation;
        }
        .btn-outline {
            background: transparent;
            color: var(--gold-light);
            border: 1px solid var(--border-gold);
        }
        .btn-outline:hover {
            background: rgba(212, 175, 55, 0.15);
        }
        @media (max-width: 600px) {
            .header { padding: 1rem; flex-direction: column; gap: 0.75rem; text-align: center; }
            .container { margin: 1.25rem auto; padding: 0 1rem; }
            .hero-img-box { height: 220px; }
            .price-badge { font-size: 1.25rem; padding: 0.4rem 1rem; bottom: 1rem; right: 1rem; }
            .card-body { padding: 1.5rem !important; }
            .dish-title { font-size: 1.85rem !important; }
            .action-row { flex-direction: column; width: 100%; gap: 0.75rem; }
            .action-row .btn { width: 100%; text-align: center; }
        }
        @media (max-width: 360px) {
            .header { padding: 0.75rem 0.5rem; }
            .brand-logo { font-size: 1.1rem; }
            .hero-img-box { height: 180px; }
            .dish-title { font-size: 1.5rem !important; }
            .price-badge { font-size: 1.1rem; padding: 0.3rem 0.75rem; }
            .card-body { padding: 1rem !important; }
        }
        @media (min-width: 1440px) {
            .container { max-width: 1000px; }
            .hero-img-box { height: 420px; }
            .dish-title { font-size: 2.75rem !important; }
        }
    </style>
</head>
<body>

<header class="header">
    <a href="/" class="brand-logo">👑 PARSA RESTAURANT</a>
    <a href="/#menu" class="btn btn-outline">← Back to Full Menu</a>
</header>

<div class="container">
    <div class="card">
        <div class="hero-img-box">
            <img src="${dish.image}" alt="${dish.name}">
            <div class="price-badge">${dish.price}</div>
        </div>

        <div class="card-body" style="padding: 2.5rem;">
            <div style="display: flex; gap: 0.5rem; margin-bottom: 1rem; flex-wrap: wrap;">
                ${badgesHtml}
            </div>

            <h1 class="dish-title" style="font-family: var(--font-serif); font-size: 2.5rem; margin-bottom: 0.5rem; color: var(--text-primary);">${dish.name}</h1>
            <p style="color: var(--gold-primary); font-size: 1.05rem; margin-bottom: 2rem;">${dish.subtitle}</p>

            <div style="margin-bottom: 2rem;">
                <h3 style="font-family: var(--font-accent); color: var(--gold-primary); font-size: 0.85rem; letter-spacing: 0.15em; text-transform: uppercase; margin-bottom: 0.75rem;">About This Dish</h3>
                <p style="color: var(--text-secondary); font-size: 1.1rem; line-height: 1.8;">${dish.description}</p>
            </div>

            <div style="margin-bottom: 2rem;">
                <h3 style="font-family: var(--font-accent); color: var(--gold-primary); font-size: 0.85rem; letter-spacing: 0.15em; text-transform: uppercase; margin-bottom: 0.75rem;">Fresh Ingredients Used</h3>
                <ul style="color: var(--text-primary); padding-left: 1.25rem; font-size: 1rem; line-height: 1.8;">
                    ${ingredientsHtml}
                </ul>
            </div>

            <div style="background: rgba(212, 175, 55, 0.08); border: 1px solid var(--border-gold); padding: 1.25rem 1.5rem; border-radius: 8px; margin-bottom: 2.5rem; display: flex; align-items: center; gap: 1rem;">
                <span style="font-size: 2rem;">🍷</span>
                <div>
                    <strong style="color: var(--gold-light); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.1em; display: block;">Recommended Drink Pairing</strong>
                    <span style="color: var(--text-secondary); font-size: 1rem;">${dish.pairing}</span>
                </div>
            </div>

            <div class="action-row" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; padding-top: 1.5rem; border-top: 1px solid var(--border-subtle);">
                <a href="/#menu" class="btn btn-outline">← Explore Full Menu</a>
                <a href="/#reservation" class="btn btn-gold">Book a Table to Enjoy This Dish →</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>`;
}

const rootDir = path.join(__dirname, '..');
const publicDir = path.join(rootDir, 'public');
const previewDir = path.join(rootDir, 'preview');

DISHES.forEach(dish => {
    const htmlContent = generateDishHtml(dish);
    
    // Save to root
    fs.writeFileSync(path.join(rootDir, dish.filename), htmlContent, 'utf8');
    
    // Save to public
    if (fs.existsSync(publicDir)) {
        fs.writeFileSync(path.join(publicDir, dish.filename), htmlContent, 'utf8');
    }

    // Save to preview
    if (fs.existsSync(previewDir)) {
        fs.writeFileSync(path.join(previewDir, dish.filename), htmlContent, 'utf8');
    }

    console.log(`Generated dish detail page: ${dish.filename}`);
});

console.log('Successfully generated all 8 dedicated dish detail HTML pages!');
