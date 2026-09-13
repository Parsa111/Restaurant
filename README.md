# 🍷 Parsa Restaurant & Bistro

![Vercel Status](https://img.shields.io/badge/Vercel-Live-success?style=for-the-badge&logo=vercel&logoColor=white)
![Supabase](https://img.shields.io/badge/Supabase-Database-emerald?style=for-the-badge&logo=supabase&logoColor=white)
![WordPress Theme](https://img.shields.io/badge/WordPress-Theme-21759B?style=for-the-badge&logo=wordpress&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-gold?style=for-the-badge)

An ultra-luxury fine dining, steakhouse, and modern bistro web platform. Engineered with dark obsidian aesthetics (`#0a0b0d`), radiant champagne gold accents (`#d4af37`), an interactive digital menu, individual food detail pages, real-time Supabase table reservation booking engine, live admin manager, and an installable WordPress theme.

---

## 🔗 Live Deployments & Quick Links

- 🌐 **Live Website**: [https://wwwee.vercel.app/](https://wwwee.vercel.app/)
- 👑 **Live Admin Dashboard**: [https://wwwee.vercel.app/admin.html](https://wwwee.vercel.app/admin.html)
- 🗄️ **Supabase Cloud Project**: [praocrdvlavznipehkek](https://supabase.com/dashboard/project/praocrdvlavznipehkek)
- 📦 **Installable WP Theme**: [`parsa.zip`](./parsa.zip)
- 📘 **Backend Developer Guide**: [`BACKEND_DEVELOPER_GUIDE.md`](./BACKEND_DEVELOPER_GUIDE.md)

---

## 🌟 Key Features

### 1. 🍽️ Interactive Digital Menu & Food Detail Pages
- **Categorized Tabs**: *Starters & Caviar*, *Artisanal Pasta*, *Land & Woodfire Grills*, *Ocean & Seafood*, *Decadent Desserts*, *Artisan Cocktails & Cellar*.
- **Dietary Badges**: *🌱 Vegan*, *🌾 Gluten-Free*, *⭐ Chef's Signature*, *🧀 Vegetarian*, *🌶️ Spicy*, *🥜 Nut-Free*.
- **Dedicated Dish Detail Pages**: Clicking any food item opens a dedicated detail page with simple descriptions, fresh ingredients lists, and sommelier drink pairings.

### 2. 📅 Real-Time Reservation Booking Engine
- Select date, service time, party size, and seating area (*Main Dining Room*, *Chef's Counter*, *Private Cellar*, *Outdoor Terrace*).
- Submits directly to **Supabase Cloud PostgreSQL Database**.
- Generates a unique booking code (e.g. `PARSA-9821`) and instant confirmation modal.

### 3. 👑 Live Admin Dashboard (`admin.html`)
- Real-time table rendering fetching guest reservations directly from Supabase.
- **2-Way Synchronized Deletion**: Delete reservations directly in the admin dashboard or via Supabase dashboard.
- **1-Click CSV Export**: Download guest lists formatted for Microsoft Excel.

### 4. 📦 Installable WordPress Theme (`parsa.zip`)
- Complete custom WordPress theme ready for upload via `WP-Admin -> Appearance -> Themes`.
- Custom post types (`menu_item`, `reservation`), custom admin panel, and REST API endpoints (`/wp-json/letoile/v1/menu`).

---

## 🍽️ Food Detail Pages Reference

| Dish | Description | Detail Page |
| :--- | :--- | :--- |
| 🥩 **A5 Miyazaki Wagyu Steak** | Tender Japanese beef with garlic butter & red wine sauce | [`dish-wagyu.html`](./dish-wagyu.html) |
| 🍝 **Hand-Rolled Truffle Tagliolini** | Fresh handmade pasta with Italian black truffles | [`dish-pasta.html`](./dish-pasta.html) |
| 🦞 **Wood-Fired Maine Lobster Tail** | Sweet lobster tail with lemon herbs & garlic butter | [`dish-lobster.html`](./dish-lobster.html) |
| 🍫 **24K Gold Dark Chocolate Sphere** | Warm caramel poured over dark chocolate shell | [`dish-dessert.html`](./dish-dessert.html) |
| 🥞 **Ossetra Royal Caviar Service** | Premium caviar with warm blinis & chive cream | [`dish-caviar.html`](./dish-caviar.html) |
| 🥗 **Roasted Heritage Beetroot Salad** | Sweet roasted beets with goat cheese & walnuts | [`dish-beet.html`](./dish-beet.html) |
| 🦆 **Dry-Aged Duck Breast** | Crispy duck breast with blackberry sauce | [`dish-duck.html`](./dish-duck.html) |
| 🥃 **Smoked Bourbon Old Fashioned** | Classic bourbon cocktail smoked with oak wood | [`dish-cocktail.html`](./dish-cocktail.html) |

---

## 🚀 Local Development & Building

```bash
# 1. Start local server
node server.js
# Open http://localhost:3000

# 2. Re-bundle static pages & public files
node scripts/bundle-vercel.js
node scripts/generate-dish-pages.js
node scripts/copy-public.js

# 3. Re-build WordPress theme zip package
node scripts/build-zip.js
```

---

## 📁 Repository Structure

```
wordpress/
├── index.html                   # Main static website homepage
├── admin.html                   # Live admin dashboard for Supabase reservations
├── BACKEND_DEVELOPER_GUIDE.md   # Complete technical backend documentation
├── README.md                    # Project overview & guide
├── dish-*.html                  # Dedicated dish detail pages
├── public/                      # Static assets root served by Vercel
├── assets/                      # CSS, JS, and high-res photography assets
├── parsa.zip                    # Installable WordPress theme package
├── scripts/                     # Build & bundle scripts
├── server.js                    # Zero-dependency local preview server
└── wp-content/themes/           # WordPress theme source code
```

---

## 📜 License

MIT License &copy; 2026 Parsa Restaurant & Bistro.