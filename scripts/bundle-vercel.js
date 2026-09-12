const fs = require('fs');
const path = require('path');

const styleCssPath = path.join(__dirname, '../assets/css/style.css');
const mainCssPath = path.join(__dirname, '../assets/css/main.css');
const jsMainPath = path.join(__dirname, '../assets/js/main.js');
const jsResPath = path.join(__dirname, '../assets/js/reservation.js');

const styleCssContent = fs.readFileSync(styleCssPath, 'utf8');
const mainCssContent = fs.readFileSync(mainCssPath, 'utf8');
const jsMainContent = fs.readFileSync(jsMainPath, 'utf8');
const jsResContent = fs.readFileSync(jsResPath, 'utf8');

const fullCombinedCss = styleCssContent + '\n\n' + mainCssContent;

// We start clean from preview/index.html or a baseline template
let html = `<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parsa — Restaurant & Bistro</title>
    <meta name="description" content="Parsa Restaurant & Bistro - Great food, fresh steaks, seafood, handmade pasta, and wine in New York.">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Complete Combined Inlined Styles (style.css + main.css) -->
    <style>
${fullCombinedCss}
    </style>
</head>
<body>
`;

// Now let's extract the body content from index.html
const rawHtml = fs.readFileSync(path.join(__dirname, '../index.html'), 'utf8');
const bodyStart = rawHtml.indexOf('<body>');
const bodyEnd = rawHtml.indexOf('</body>');

let bodyContent = rawHtml.substring(bodyStart + 6, bodyEnd);

// Remove any existing inline <style> or old CSS links in body if any
bodyContent = bodyContent.replace(/<style>[\s\S]*?<\/style>/g, '');
bodyContent = bodyContent.replace(/<script src="[^"]+"><\/script>/g, '');
bodyContent = bodyContent.replace(/<script>[\s\S]*?<\/script>/g, '');

// Ensure all image paths use absolute /assets/images/
bodyContent = bodyContent.replaceAll('src="assets/images/', 'src="/assets/images/');
bodyContent = bodyContent.replaceAll('src="./assets/images/', 'src="/assets/images/');
bodyContent = bodyContent.replaceAll('src="/wp-content/themes/letoile-luxury-bistro/assets/images/', 'src="/assets/images/');

// Append the combined JS
const finalFullHtml = html + bodyContent + `
    <!-- Complete Inlined JS Scripts -->
    <script>
${jsMainContent}

${jsResContent}
    </script>
</body>
</html>
`;

const indexPath = path.join(__dirname, '../index.html');
const previewPath = path.join(__dirname, '../preview/index.html');

fs.writeFileSync(indexPath, finalFullHtml, 'utf8');
fs.writeFileSync(previewPath, finalFullHtml, 'utf8');

console.log('Successfully generated complete self-contained index.html with style.css + main.css + JS!');
