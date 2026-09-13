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
const publicDir = path.join(rootDir, 'public');

// Ensure public directory exists
if (!fs.existsSync(publicDir)) {
    fs.mkdirSync(publicDir, { recursive: true });
}

// Copy assets to public/assets
copyFolderRecursive(path.join(rootDir, 'assets'), path.join(publicDir, 'assets'));

// Copy root html files to public
if (fs.existsSync(path.join(rootDir, 'index.html'))) {
    fs.copyFileSync(path.join(rootDir, 'index.html'), path.join(publicDir, 'index.html'));
}
if (fs.existsSync(path.join(rootDir, 'admin.html'))) {
    fs.copyFileSync(path.join(rootDir, 'admin.html'), path.join(publicDir, 'admin.html'));
}

console.log('Successfully synced all assets, index.html, and admin.html into public/ folder!');
