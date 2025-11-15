# Proyecto Menú Dinámico
https://github.com/lbettero/responsive-menu  

Este proyecto implementa una **página web dinámica, modular y responsiva** desarrollada en **PHP + TailwindCSS**, con un **menú principal de hasta tres niveles** cargado automáticamente desde un archivo `JSON`.  
Se incluyen pruebas unitarias en **PHPUnit**, scripts JavaScript separados y documentación completa para su ejecución y mantenimiento.  

---

## 🗓️ Historial de Versiones

| Versión | Fecha | Descripción |
|----------|--------|-------------|
| **v1.0.1** | 8 de noviembre de 2025 | Versión estable del menú dinámico con carga desde `menu.json` y estructura modular PHP. |

---

## 📁 Estructura del Proyecto


responsive-menu/
│
├── public/                        # Archivos accesibles desde el navegador
│ ├── index.php                    # Página principal (incluye header.php, menú y footer.php)
│ ├── assets/                      # Recursos estáticos del frontend
│ │ ├── css/                       # Hojas de estilo personalizadas
│ │ │   └── main.css               # Estilos principales (colores y variables personalizadas)
│ │ ├── js/                        # Scripts JavaScript
│ │ │   └── menu.js                # Controla la interacción del menú (desktop + móvil)
│ │ └── data/                      # Archivos JSON con datos estructurados
│ │     └── menu.json              # Estructura jerárquica del menú de navegación
│ │
│ └── .htaccess                    # (Vacío) — no se utiliza configuración específica en este proyecto
│
├── src/                           # Lógica del lado del servidor (PHP)
│ ├── includes/                    # Archivos incluidos en varias páginas
│ │   ├── header.php               # Cabecera HTML: meta tags, links CSS y scripts
│ │   └── footer.php               # Pie de página HTML
│ │
│ └── functions/                   # Funciones PHP reutilizables
│     └── menu.php                 # Carga el JSON y construye el menú dinámico
│
└── README.md                      # Documentación general del proyecto (instalación, uso, estructura)

---

## 🚀 Instrucciones para Ejecutar la Prueba

1. **Clonar o descomprimir** el proyecto:  
   ```bash
   git clone https://github.com/lbettero/responsive-menu.git
   cd responsivemenu
   ```
2. **Iniciar un servidor local de PHP** (ahora desde la raíz):  
   ```bash
   php -S localhost:8000
   ```
3. **Abrir el navegador y acceder a:**  
   [http://localhost:8000](http://localhost:8000)

---

## 🧪 Ejecución de Pruebas Unitarias

Ejecutar las pruebas desde la raíz del proyecto:

```bash
vendor/bin/phpunit --testdox --colors=always tests/
```

Esto genera los siguientes reportes:  
- `test-report.txt` → resumen plano  
- `test-report.html` → reporte visual detallado  


**Autora:** Livia Pérez Bettero  
**Colaboración técnica:** ChatGPT (OpenAI)
