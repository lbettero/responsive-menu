# Proyecto Coterena — Menú Dinámico (Prueba Técnica)  
**Versión:** `v1.0.0` — *Primera versión estable*

Este proyecto tiene como objetivo desarrollar una página web **dinámica y responsiva** en **PHP + TailwindCSS**, con un **menú principal de hasta tres niveles**, cargado automáticamente desde un archivo `JSON`.

---

## 📦 Estado del Proyecto

**Versión actual:** `v1.0.0`  
Esta versión representa la **primera entrega estable** del sistema, con todas las funciones básicas completas y la estructura modular finalizada.

**Incluye:**
- Menú dinámico y responsivo con tres niveles (padre → hijo → nieto).  
- Carga automática desde `menu.json`.  
- Renderizado en PHP con TailwindCSS para un diseño moderno y adaptable.  
- Separación del código JavaScript (`menu.js`) y estilos personalizados (`main.css`).  
- Documentación y estructura lista para futuras extensiones (buscador y dashboard).

---

## Estructura del Proyecto

coterena/
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

## Reglas de Desarrollo

1. **Estructura Modular:**  
   - `includes/` → fragmentos de página (header, footer)  
   - `functions/` → funciones auxiliares o lógicas del menú  

2. **Menú Dinámico:**  
   - Se carga desde `public/assets/data/menu.json`.  
   - Admite hasta **tres niveles** de profundidad (padre → hijo → nieto).  
   - El menú es **totalmente responsivo** y se adapta a diferentes tamaños de pantalla.  

3. **Tecnologías Base:**  
   - **PHP 8+** → para la estructura modular y renderizado del menú desde el backend.  
   - **TailwindCSS** → para un diseño moderno, ligero y responsivo sin escribir CSS extenso.  
   - **HTML5 + JavaScript nativo** → para la estructura semántica e interactividad del menú.  
   - **JSON** → fuente de datos que define la jerarquía de categorías del menú.  

---

## Motivo de la Elección Tecnológica

Se eligió **PHP** por su facilidad para manejar plantillas modulares y generar contenido dinámico desde el servidor.  
**TailwindCSS** permite prototipar interfaces rápidamente, manteniendo un estilo limpio y adaptable sin depender de un framework pesado.  
El uso de **JSON** facilita la actualización del menú sin necesidad de editar el código fuente.

---

## Partes Implementadas Manualmente

- Lógica PHP para:
  - Carga y validación del archivo `menu.json`.  
  - Renderizado recursivo de menús de 3 niveles.  
- Estructura de carpetas modular (`includes/`, `functions/`).  
- Script **`menu.js`** para controlar:
  - Comportamiento *hover* en escritorio.  
  - Botón hamburguesa y apertura/cierre del menú móvil.  
- Archivo **`main.css`** con variables y colores personalizados.

---

## Ejecución Local

Desde la raíz del proyecto, ejecutar:

```bash
php -S localhost:8000 -t public
