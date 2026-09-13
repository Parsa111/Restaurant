const { execSync } = require('child_process');
const path = require('path');
const fs = require('fs');

const rootDir = path.join(__dirname, '..');
const outputZip = path.join(rootDir, 'parsa.zip');

console.log('📦 Bundling Parsa Restaurant & Bistro Theme Package...');
console.log(`Target: ${outputZip}`);

try {
    if (fs.existsSync(outputZip)) {
        fs.unlinkSync(outputZip);
    }

    // Use PowerShell Compress-Archive to package public and assets into parsa.zip
    const psCommand = `powershell -NoProfile -Command "Compress-Archive -Path '${rootDir}\\index.html', '${rootDir}\\admin.html', '${rootDir}\\assets', '${rootDir}\\public', '${rootDir}\\dish-*.html' -DestinationPath '${outputZip}' -Force"`;
    execSync(psCommand, { stdio: 'inherit' });

    const stats = fs.statSync(outputZip);
    const sizeMB = (stats.size / (1024 * 1024)).toFixed(2);
    console.log(`✅ Successfully generated installable WordPress Theme package: parsa.zip (${sizeMB} MB)`);
} catch (err) {
    console.error('Error creating ZIP archive:', err);
    process.exit(1);
}
