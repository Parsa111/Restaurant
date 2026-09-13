const fs = require('fs');
const path = require('path');

function copyFolderRecursive(src, dest) {
    if (!fs.existsSync(dest)) {
        fs.mkdirSync(dest, { recursive: true });
    }
    const entries = fs.readdirSync(src, { withFileTypes: true });

    for (let entry of entries) {
        let srcPath = path.join(src, entry.name);
        let destPath = path.join(dest, entry.name);

        if (entry.isDirectory()) {
            copyFolderRecursive(srcPath, destPath);
        } else {
            fs.copyFileSync(srcPath, destPath);
        }
    }
}

const rootDir = path.join(__dirname, '..');
const themeDir = path.join(rootDir, 'wp-content', 'themes', 'letoile-luxury-bistro');

if (!fs.existsSync(themeDir)) {
    fs.mkdirSync(themeDir, { recursive: true });
}

// Copy assets to theme assets
copyFolderRecursive(path.join(rootDir, 'assets'), path.join(themeDir, 'assets'));

console.log('Restored theme directory assets successfully!');
