const fs = require('fs');
const path = require('path');

const cssPath = path.join(__dirname, '../assets/css/main.css');
const jsMainPath = path.join(__dirname, '../assets/js/main.js');
const jsResPath = path.join(__dirname, '../assets/js/reservation.js');
const indexPath = path.join(__dirname, '../index.html');
const previewPath = path.join(__dirname, '../preview/index.html');

const cssContent = fs.readFileSync(cssPath, 'utf8');
const jsMainContent = fs.readFileSync(jsMainPath, 'utf8');
const jsResContent = fs.readFileSync(jsResPath, 'utf8');

let html = fs.readFileSync(indexPath, 'utf8');

// Replace stylesheet links with inline CSS
html = html.replace(
    /<!-- Primary Theme Stylesheets -->[\s\S]*?<link rel="stylesheet" href="[^"]+main.css">/,
    `<!-- Inlined Theme CSS for Vercel -->\n<style>\n${cssContent}\n</style>`
);

// Replace JS scripts with inline JS
html = html.replace(
    /<script src="[^"]+main.js"><\/script>[\s\S]*?<script src="[^"]+reservation.js"><\/script>/,
    `<!-- Inlined Theme JS for Vercel -->\n<script>\n${jsMainContent}\n\n${jsResContent}\n</script>`
);

// Fix image sources to root /assets/images/
html = html.split('src="assets/images/').join('src="/assets/images/');
html = html.split('src="./assets/images/').join('src="/assets/images/');

fs.writeFileSync(indexPath, html, 'utf8');
fs.writeFileSync(previewPath, html, 'utf8');

console.log('Successfully bundled index.html and preview/index.html with inline styles and scripts!');
