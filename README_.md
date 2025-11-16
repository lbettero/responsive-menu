# Proyecto Menú Dinámico
https://github.com/lbettero/responsive-menu  

Este proyecto implementa una **página web dinámica, modular y responsiva** desarrollada en **PHP + TailwindCSS**, con un **menú principal de hasta tres niveles** cargado automáticamente desde un archivo `JSON`.  
Se incluyen pruebas unitarias en **PHPUnit**, scripts JavaScript separados y documentación completa para su ejecución y mantenimiento.  

---

## 🗓️ Historial de Versiones

| Versión | Fecha | Descripción |
|----------|--------|-------------|
| **v1.0.1** | 8 de noviembre de 2025 | Versión estable del menú dinámico con carga desde `menu.json` y estructura modular PHP. |
| **v2.0.0** | 11 de noviembre de 2025 | Eliminación de carpeta `public/` duplicada y ajuste general de rutas. Corrección definitiva del bug de visibilidad de submenús mediante actualización de `header.php`, `menu.php` y `main.css`.. Integración del dashboard interactivo con Alpine.js |
---
## 🔧 Cambios de la versión 2.0.0

- **Eliminación de la carpeta duplicada `public/`**: ahora los archivos se sirven directamente desde la raíz del proyecto.  
- **Corrección de contexto de apilamiento (z-index)** en `menu.php`, `header.php` y `main.css`, asegurando que los submenús se muestren correctamente en primer plano.  
- **Refactorización de rutas relativas** en `require` y `assets` para ajustarse a la nueva estructura sin `public/`.   
- **Ajustes visuales en `header.php` para compatibilidad con Alpine.js y TailwindCSS.  

---


## 📁 Nueva Estructura del Proyecto

```
RESPONSIVEMENU/
│
├── assets/
│   ├── css/
│   │   └── main.css              # Estilos principales personalizados (ajustado)
│   ├── data/
│   │   └── menu.json             # Datos estructurados del menú
│   ├── img/                      # Íconos y recursos gráficos
│   └── js/
│       ├── dashboard.js          # Controla el dashboard y sus eventos
│       └── menu.js               # Controla la interacción del menú dinámico
│
├── src/
│   ├── functions/
│   │   └── menu.php              # Lógica PHP para cargar y renderizar el menú
│   └── includes/
│       ├── header.php            # Encabezado HTML (meta, scripts, estilos)
│       └── footer.php            # Pie de página HTML
│
├── tests/
│   ├── MenuTest.php              # Pruebas de las funciones PHP del menú
│   └── DashboardScriptTest.php   # Pruebas de integración JS y HTML
│
├── index.php                     # Página principal del sitio (punto de entrada)
├── test-report.html              # Reporte visual de PHPUnit
├── test-report.txt               # Resumen de resultados de pruebas
├── composer.json                 # Configuración de dependencias
├── composer.lock                 # Versión bloqueada de dependencias
├── phpunit.xml                   # Configuración de PHPUnit
├── .phpunit.result.cache         # Cache interna de resultados
└── README.md                     # Este archivo
```

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
