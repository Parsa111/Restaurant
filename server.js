const http = require('http');
const fs = require('fs');
const path = require('path');

const PORT = process.env.PORT || 3000;

const MIME_TYPES = {
    '.html': 'text/html; charset=utf-8',
    '.css': 'text/css; charset=utf-8',
    '.js': 'application/javascript; charset=utf-8',
    '.json': 'application/json; charset=utf-8',
    '.png': 'image/png',
    '.jpg': 'image/jpeg',
    '.jpeg': 'image/jpeg',
    '.webp': 'image/webp',
    '.svg': 'image/svg+xml',
    '.ico': 'image/x-icon',
    '.woff2': 'font/woff2',
    '.woff': 'font/woff',
    '.ttf': 'font/ttf',
    '.php': 'text/plain; charset=utf-8',
};

const server = http.createServer((req, res) => {
    let cleanUrl = req.url.split('?')[0];

    if (cleanUrl === '/' || cleanUrl === '') {
        cleanUrl = '/preview/index.html';
    }

    let filePath = path.join(__dirname, cleanUrl);

    // Security check: prevent directory traversal
    if (!filePath.startsWith(__dirname)) {
        res.writeHead(403, { 'Content-Type': 'text/plain' });
        return res.end('Forbidden');
    }

    fs.stat(filePath, (err, stats) => {
        if (err || !stats.isFile()) {
            const maybeIndex = path.join(filePath, 'index.html');
            if (fs.existsSync(maybeIndex)) {
                filePath = maybeIndex;
            } else {
                res.writeHead(404, { 'Content-Type': 'text/html; charset=utf-8' });
                return res.end('<h1>404 Not Found</h1><p>Requested file does not exist.</p><p><a href="/preview/index.html">Go to Live Preview</a></p>');
            }
        }

        const ext = path.extname(filePath).toLowerCase();
        const contentType = MIME_TYPES[ext] || 'application/octet-stream';

        fs.readFile(filePath, (readErr, content) => {
            if (readErr) {
                res.writeHead(500, { 'Content-Type': 'text/plain' });
                return res.end('Server Error: ' + readErr.code);
            }
            res.writeHead(200, { 'Content-Type': contentType });
            res.end(content);
        });
    });
});

server.listen(PORT, () => {
    console.log(`✨ Parsa Restaurant Live Preview running at: http://localhost:${PORT}/preview/index.html`);
});
