# Responsive Menu 4.0.2: stronger security and fewer external dependencies

**Responsive Menu** is a responsive navigation system built with PHP and JavaScript. It loads its structure from a JSON file and can organize items, nested items, tags, and additional fields in a reusable format for different web projects.

Along with navigation designed for desktop and mobile devices, the project provides semantic search and a visual editor for managing the menu structure. After editing, the content can be saved back to JSON.

## What changes in version 4.0.2

Version **4.0.2** focuses on protecting the editor and reducing the application's dependence on executable code loaded directly from external services.

- The server-side menu editor is now disabled by default.
- When enabled, the editor requires administrator authentication.
- Save requests must use the correct HTTP method and come from the same application origin.
- Request size, menu item count, and nesting depth now have defined limits.
- `menu.json` is written atomically, reducing the risk of incomplete or corrupted files.
- Tailwind CSS and Alpine.js are no longer loaded from executable CDN scripts at runtime.
- Frontend dependency versions are pinned and recorded in a lockfile.
- Browser assets are generated and served locally by the project.

## Editor security

The public frontend continues to work without enabling server-side editing. This is the recommended configuration for websites that only use the project to display the menu.

When server-side editing is required, it must be enabled explicitly through configuration. The installation must also provide administrator credentials and use HTTPS. Anonymous requests, cross-origin requests, and payloads outside the defined limits are rejected before any file is written.

These controls reduce the possibility of unauthorized menu changes. They complement, but do not replace, the access policies, monitoring, backups, and update procedures of the server where the project is installed.

## Local dependencies and reproducible builds

Responsive Menu now uses exact versions of **Tailwind CSS 3.4.19** and **Alpine.js 3.17.5**. Tailwind is compiled into a local CSS file, while Alpine.js is copied into the project assets during the build.

The `package-lock.json` file records the direct and transitive dependency versions. This makes it possible to repeat the build with the same dependency set and review future updates before they are incorporated into the application.

## Requirements

To use the menu in a browser:

- a modern browser with JavaScript enabled;
- a web server capable of serving PHP, JavaScript, CSS, and JSON;
- a PHP version compatible with the project. The runtime was validated with PHP 8.2.12, although the project does not yet declare a formal minimum production version.

To install dependencies and rebuild the assets:

- Node.js and npm;
- `npm ci` to install the versions recorded in the lockfile;
- `npm run build` to generate the Tailwind CSS and copy the local Alpine.js runtime.

Running the PHP tests also requires Composer, PHP 8.2 or later—as required by PHPUnit 11—and the extensions required by the development dependencies.

The server-side editor is optional. When enabled, it should run over HTTPS with strong credentials and additional access controls in the hosting environment.

## Availability

Responsive Menu is an open-source project maintained by **LBETTERO**. Version 4.0.2 will be available after the changes are merged and published.

- Project: <https://github.com/lbettero/responsive-menu>
- Releases: <https://github.com/lbettero/responsive-menu/releases>
