# 🧩 SMART SMALL THINGS — Dynamic Responsive Menu (v3.0.0)

https://github.com/lbettero/responsive-menu  

This project evolves into a **fully modular, responsive and intelligent system** built with  
**PHP + Alpine.js + TailwindCSS**, featuring:

✔ Dynamic multi-level menu (up to 3 levels)  
✔ Visual menu editor  
✔ JSON saving with normalization and automatic download button  
✔ Advanced intelligent search engine  
✔ Interactive dashboard with filters  
✔ Full desktop/mobile compatibility  
✔ Modular PHP structure (includes + functions)  
✔ Decoupled JavaScript and custom brand CSS  
✔ Full UI and codebase translated to English  

---

## 🗓️ Version History

| Version | Date | Description |
|--------|------|-------------|
| **v1.0.1** | Nov 8, 2025 | Stable version with menu loaded from `menu.json`. |
| **v2.0.0** | Nov 11, 2025 | File structure cleanup, z-index fixes, Alpine.js compatibility. |
| **v3.0.0** | Nov 16, 2025 | **Major upgrade**: full menu editor, JSON saving with download, new search engine, full UI redesign, PHP refactor, English translation. |

---

## 🆕 New Features in Version 3.0.0

### 1. Visual Menu Editor
- Add/edit/remove items at all levels  
- Add siblings and subitems  
- Automatic name generation for nested structures  
- Up to 3 levels supported  

### 2. New `save-menu.php`
- Normalizes the menu tree  
- Removes empty items  
- Converts tag strings into arrays  
- Pretty-printed JSON saved to disk  
- **Download button for updated menu.json**  
- Visual success/error messages  

### 3. Intelligent Search Engine
Features:
- Accent-insensitive  
- Tokenized search  
- Quoted phrase search  
- Partial match detection  
- Relevance ranking  
- Tag inheritance for weighted search  
- Highlighting with `<mark>`  

### 4. Responsive Menu Redesign
- Desktop: multilevel dropdown menu  
- Mobile: collapsible nested structure  
- Smart submenu alignment depending on viewport  

### 5. Dashboard Integration
- Quick action buttons  
- Category filtering  
- Visual filter pill  
- Event-driven architecture via `CustomEvent`  

### 6. Refactored UI & CSS
- Brand color variables  
- Modern layout  
- Accessible text and better contrast  
- Unified shadow and border system  

### 7. PHP Architecture Improvements
- `header.php` and `footer.php` fully rewritten  
- `menu.php` outputs desktop+mobile+search  
- Safer escaping everywhere  
- JSON injected directly for Alpine.js  

### 8. Full English Translation
- All UI strings  
- JS comments  
- PHP comments  
- HTML content  
- Documentation  

---

## 📁 Project Structure (v3.0.0)

```
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
│   │   ├── hide.png
│   │   └── see.png
│   ├── img/
│   └── js/
│       ├── dashboard.js
│       ├── menu.js
│       └── menu-manager.js
│
├── src/
│   ├── functions/
│   │   ├── menu.php
│   │   ├── menu-editor.php
│   │   └── save-menu.php
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
├── test-report.html
├── test-report.txt
└── README.md
```

---

## 🚀 How to Run the Project

```bash
php -S localhost:8000
```

Then open:

http://localhost:8000

---

## 🧪 Running Unit Tests

```bash
vendor/bin/phpunit --testdox --colors=always tests/
```

Generates:  
- `test-report.txt` – summary  
- `test-report.html` – visual report  

---

## 👩‍💻 Author
**Livia Pérez Bettero**

## 🤖 Technical Collaboration  
ChatGPT (OpenAI)
