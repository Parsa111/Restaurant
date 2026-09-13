const { execSync } = require('child_process');
const path = require('path');
const fs = require('fs');

const themeDir = path.join(__dirname, '..', 'wp-content', 'themes', 'letoile-luxury-bistro');
const outputZip = path.join(__dirname, '..', 'letoile-luxury-bistro.zip');

console.log('📦 Bundling L\'Étoile Dorée WordPress Theme...');
console.log(`Source: ${themeDir}`);
console.log(`Target: ${outputZip}`);

try {
    if (fs.existsSync(outputZip)) {
        fs.unlinkSync(outputZip);
    }

    // Use PowerShell Compress-Archive for reliable native Windows ZIP creation
    const psCommand = `powershell -NoProfile -Command "Compress-Archive -Path '${themeDir}\\*' -DestinationPath '${outputZip}' -Force"`;
    execSync(psCommand, { stdio: 'inherit' });

    const stats = fs.statSync(outputZip);
    const sizeMB = (stats.size / (1024 * 1024)).toFixed(2);
    console.log(`✅ Successfully generated installable WordPress Theme: letoile-luxury-bistro.zip (${sizeMB} MB)`);
    console.log('🚀 Ready to upload into WordPress Admin -> Appearance -> Themes -> Upload Theme!');
} catch (err) {
    console.error('Error creating ZIP archive:', err);
    process.exit(1);
}
