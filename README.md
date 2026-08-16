🧩 SMART SMALL THINGS — Dynamic Responsive Menu (v4.0.0)

https://github.com/lbettero/responsive-menu

This project has evolved into a highly modular, metadata-driven responsive menu system built with
PHP + Alpine.js + TailwindCSS, featuring:

✔ Multi-level dynamic menu (up to 3 levels)
✔ Full visual JSON menu editor
✔ Global Fields system (v4.0.0)
✔ JSON auto-normalization with pretty printing
✔ Intelligent semantic search engine
✔ Interactive admin dashboard
✔ Mobile/desktop responsive behavior
✔ Clean PHP architecture (functions + includes)
✔ Decoupled JavaScript modules
✔ Full UI/UX rewritten in English

🗓️ Version History
Version	Date	Description
v1.0.1	Nov 8,  2025	Initial stable version, dynamic JSON-based menu.
v2.0.0	Nov 11, 2025	Refactor, Alpine.js compatibility, improved z-index structure.
v3.0.0	Nov 16, 2025	Full menu editor, redesigned UI, search engine v2, JSON download, PHP architecture cleanup.
v4.0.0	Nov 17, 2025	Global Fields with rigid propagation, advanced metadata system, field types, defaults, full JSON schema enforcement.
⭐ What’s New in Version 4.0.0 (Major Update)
1. Global Fields System

The menu editor now includes a Global Fields Manager, allowing you to define metadata that is automatically added to every item in the menu, on all levels.

You can now:

Add global fields (e.g., icon, showInHeader, showInFooter, weight, color)

Choose value type (string, number, boolean, JSON)

Define a default value

Remove fields

Use metadata anywhere (header, footer, routing, icons, permissions)

Rigid propagation

Every menu item will always contain all global fields, ensuring structural consistency across the entire menu tree.

⚠ User instruction added

Below the global fields editor, a message guides users:

“After adding or removing global fields, save the menu so that these fields appear in all items.”

This prevents confusion regarding when the new fields propagate through the form.

2. Updated menu-editor.php

Includes:

Global fields UI block

Type selector

Default value input

Field removal button

Automatic rendering in each item

Automatic JSON-safe encoding for complex fields

Contextual grouping of field types

3. Updated menu-editor.js

Now supports:

Adding global fields dynamically

Removing global fields

Re-rendering them inside ALL items in real time

Full compatibility with the existing move/indent/outdent logic

Full integration with the reindexing system

This ensures that new fields are displayed in every existing or newly created menu item.

4. Updated save-menu.php

Now includes:

Extraction of global schema from POST

Rigid propagation of fields

Automatic removal of deleted global fields

Type casting (string/number/boolean/json)

Recursive normalizing and encoding

Final fully consistent JSON output

5. Enhanced JSON Structure

Every menu item now supports unlimited metadata fields, including:

Display behavior

Icon paths

UI attributes

Visibility

Permissions

Sorting weights

Arbitrary custom metadata

Your menu becomes a structured data source, not just a navigation list.

🧠 Intelligent Search Engine (Inherited from v3)

Features:

Accent-insensitive matching

Tokenization

Quoted phrase search

Partial token matching

Tag inheritance for relevance

Weighted scoring

Highlighting using <mark>

Works transparently with global fields

📁 Project Structure (v4.0.0)
RESPONSIVEMENU/
│
├── assets/
│   ├── css/
│   │   └── main.css
│   ├── data/
│   │   └── menu.json
│   ├── icons/
│   │   ├── additem.png
│   │   ├── deleteitem.png
│   │   ├── downloadjson.png
│   │   ├── recordjson.png
│   │   ├── setaback.png
│   │   └── info.png
│   └── js/
│       ├── dashboard.js
│       ├── menu.js
│       ├── menu-editor.js   ← NEW v4.0.0
│       └── menu-manager.js
│
├── src/
│   ├── functions/
│   │   ├── menu.php
│   │   ├── menu-editor.php  ← UPDATED v4.0.0
│   │   └── save-menu.php    ← UPDATED v4.0.0
│   └── includes/
│       ├── header.php
│       └── footer.php
│
├── tests/
│   ├── MenuTest.php
│   └── DashboardScriptTest.php
│
├── composer.json
├── phpunit.xml
├── index.php
├── menu-manager.php
└── README.md

🚀 Running the Project
php -S localhost:8000


Then visit:

http://localhost:8000

🧪 Running Unit Tests
vendor/bin/phpunit --testdox --colors=always tests/


Outputs:

test-report.txt

test-report.html

✨ Author

Livia Pérez Bettero
