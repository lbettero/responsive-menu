import { copyFile, mkdir } from 'node:fs/promises';
import { dirname, resolve } from 'node:path';
import { fileURLToPath } from 'node:url';

const root = resolve(dirname(fileURLToPath(import.meta.url)), '..');
const source = resolve(root, 'node_modules/alpinejs/dist/cdn.min.js');
const destination = resolve(root, 'assets/vendor/alpinejs-3.17.5.min.js');

await mkdir(dirname(destination), { recursive: true });
await copyFile(source, destination);
