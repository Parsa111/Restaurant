# 🛠️ Parsa Restaurant — Backend Developer Integration Guide

This guide is for the **Backend Developer** connecting the Parsa Restaurant website to a custom backend, database, REST API, or WordPress server.

---

## 📁 Repository Overview

- **WordPress Theme Source**: [`wp-content/themes/letoile-luxury-bistro/`](file:///c:/Users/DELL/Desktop/wordpress/wp-content/themes/letoile-luxury-bistro/)
- **Installable WP Theme ZIP**: [`letoile-luxury-bistro.zip`](file:///c:/Users/DELL/Desktop/wordpress/letoile-luxury-bistro.zip)
- **Frontend App (Vercel Ready)**: [`preview/index.html`](file:///c:/Users/DELL/Desktop/wordpress/preview/index.html)
- **Vercel Config**: [`vercel.json`](file:///c:/Users/DELL/Desktop/wordpress/vercel.json)

---

## ⚡ 1. Where to Connect Your Backend API URL

In the frontend JavaScript file [`wp-content/themes/letoile-luxury-bistro/assets/js/reservation.js`](file:///c:/Users/DELL/Desktop/wordpress/wp-content/themes/letoile-luxury-bistro/assets/js/reservation.js), configure line 6:

```javascript
// ⚙️ BACKEND API ENDPOINT CONFIGURATION
const WORDPRESS_BACKEND_URL = 'https://YOUR-BACKEND-API-DOMAIN.com/api/reservations';
```

---

## 📩 2. Table Reservation API Spec

### Request Payload (`POST`)

```json
{
  "guest_name": "John Smith",
  "guest_email": "john@example.com",
  "guest_phone": "+1 (212) 555-0199",
  "res_date": "2026-09-18",
  "res_time": "19:00",
  "res_guests": 2,
  "res_seating": "Main Dining Room",
  "res_occasion": "Dinner with Friends",
  "res_notes": "Allergic to peanuts"
}
```

### Expected Success Response (`200 OK`)

```json
{
  "success": true,
  "data": {
    "bookingCode": "PARSA-8492",
    "status": "Confirmed",
    "message": "Table reserved successfully."
  }
}
```

---

## 🍕 3. Food Menu REST API Spec (`GET`)

### Endpoint

```http
GET /wp-json/letoile/v1/menu
```

### Expected Response

```json
[
  {
    "categoryId": 1,
    "categorySlug": "mains",
    "categoryName": "Steaks & Meat",
    "items": [
      {
        "id": 101,
        "title": "Parsa Special Wagyu Steak",
        "description": "Juicy Japanese beef served with rich black truffle sauce.",
        "price": "145",
        "pairing": "Red Wine",
        "dietary": ["gluten-free", "signature"],
        "isSignature": true,
        "image": "https://your-domain.com/wp-content/uploads/wagyu.jpg"
      }
    ]
  }
]
```

---

## 🗄️ 4. WordPress Custom Post Types Registered

- `menu_item`: Managed in WP-Admin with meta fields `_menu_price`, `_menu_pairing`, `_menu_dietary`, `_menu_is_signature`.
- `reservation`: Managed in WP-Admin with meta fields `_res_date`, `_res_time`, `_res_guests`, `_res_seating`, `_res_email`, `_res_phone`, `_res_status`.
- `testimonial`: Customer review post type.
- `menu_category`: Custom taxonomy for course categorization.

---

## 🚢 Deployment Instructions

1. **WordPress Deployment**: Upload `letoile-luxury-bistro.zip` to WP-Admin > Appearance > Themes.
2. **Vercel Frontend Deployment**: Run `npx vercel` or connect repo to Vercel dashboard.
