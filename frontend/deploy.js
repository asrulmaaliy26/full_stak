import { execSync } from 'child_process';
import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

console.log('🚀 Memulai proses build...');
try {
  execSync('npm run build', { stdio: 'inherit', cwd: __dirname });
} catch (error) {
  console.error('❌ Build gagal.');
  process.exit(1);
}

const frontendDistAssets = path.join(__dirname, 'dist', 'assets');
const backendPublicAssets = path.join(__dirname, '..', 'backend', 'public', 'assets');

console.log('📂 Meng-copy file assets ke backend/public/assets...');
if (!fs.existsSync(backendPublicAssets)) {
  fs.mkdirSync(backendPublicAssets, { recursive: true });
}

// Copy assets
const files = fs.readdirSync(frontendDistAssets);
files.forEach(file => {
  const srcFile = path.join(frontendDistAssets, file);
  const destFile = path.join(backendPublicAssets, file);
  fs.copyFileSync(srcFile, destFile);
});

console.log('🔗 Mengupdate referensi di react_app.blade.php...');
const distHtmlPath = path.join(__dirname, 'dist', 'index.html');
const bladePath = path.join(__dirname, '..', 'backend', 'resources', 'views', 'react_app.blade.php');

if (fs.existsSync(distHtmlPath) && fs.existsSync(bladePath)) {
  const distHtml = fs.readFileSync(distHtmlPath, 'utf8');
  let bladeContent = fs.readFileSync(bladePath, 'utf8');

  // Extract script and link tags from dist/index.html
  const scriptMatch = distHtml.match(/<script type="module" crossorigin src="\/assets\/index-[^"]+\.js"><\/script>/);
  const cssMatch = distHtml.match(/<link rel="stylesheet" crossorigin href="\/assets\/index-[^"]+\.css">/);

  if (scriptMatch && cssMatch) {
    // Replace in blade file
    bladeContent = bladeContent.replace(/<script type="module" crossorigin src="\/assets\/index-[^"]+\.js"><\/script>/, scriptMatch[0]);
    bladeContent = bladeContent.replace(/<link rel="stylesheet" crossorigin href="\/assets\/index-[^"]+\.css">/, cssMatch[0]);

    fs.writeFileSync(bladePath, bladeContent);
    console.log('✅ Berhasil mengupdate react_app.blade.php!');
  } else {
    console.log('⚠️ Tidak dapat menemukan tag script/link di dist/index.html');
  }
} else {
  console.log('⚠️ File dist/index.html atau react_app.blade.php tidak ditemukan.');
}

console.log('🎉 Deploy otomatis selesai!');
