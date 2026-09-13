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

// Copy all root HTML files to public and preview
const files = fs.readdirSync(rootDir);
const previewDir = path.join(rootDir, 'preview');
if (!fs.existsSync(previewDir)) fs.mkdirSync(previewDir, { recursive: true });

files.forEach(file => {
    if (file.endsWith('.html')) {
        fs.copyFileSync(path.join(rootDir, file), path.join(publicDir, file));
        fs.copyFileSync(path.join(rootDir, file), path.join(previewDir, file));
    }
});

console.log('Successfully synced all assets and dish detail HTML pages into public/ and preview/ folders!');
