<?php
use PHPUnit\Framework\TestCase;

/**
 * ==========================================================
 *  PRUEBAS UNITARIAS — Proyecto Coterena v2.0.0
 * ==========================================================
 * 
 * 🧩 RESUMEN GENERAL:
 * Este conjunto de pruebas valida la correcta integración entre el archivo 
 * JavaScript `dashboard.js`, el menú dinámico (`menu.js`) y el archivo `index.php`.
 * 
 * En concreto:
 * 1. Comprueba que los archivos existen y contienen código.
 * 2. Verifica que las funciones clave (`sendMenuFilter` y `resetMenu`) estén 
 *    definidas correctamente dentro de `dashboard.js`.
 * 3. Garantiza que los eventos personalizados (`menu:filter` y `menu:reset`) 
 *    estén presentes para la comunicación con el menú dinámico.
 * 4. Asegura que el `index.php` incluya los scripts necesarios 
 *    (`menu.js` y `dashboard.js`).
 * 5. (Opcional) Realiza una validación básica de sintaxis usando Node.js.
 * 
 * Estas pruebas garantizan que el sistema de filtrado y reinicio del menú 
 * funcione como se espera y que la integración entre front-end y back-end 
 * se mantenga estable.
 * 
 * @autor Livia Pérez Bettero
 * @colaboración Asistencia técnica: ChatGPT (OpenAI)
 * ----------------------------------------------------------
 */
class DashboardTest extends TestCase
{
    private string $dashboardPath;
    private string $menuPath;
    private string $indexPath;

    /**
     * Define las rutas base de los archivos que serán probados.
     */
    protected function setUp(): void
    {
        $this->dashboardPath = __DIR__ . '/../public/assets/js/dashboard.js';
        $this->menuPath      = __DIR__ . '/../public/assets/js/menu.js';
        $this->indexPath     = __DIR__ . '/../public/index.php';
    }

    /**
     * Verifica que los archivos JS esenciales existan y no estén vacíos.
     */
    public function testArchivosJsExisten(): void
    {
        $this->assertFileExists($this->dashboardPath, "❌ El archivo dashboard.js no existe.");
        $this->assertGreaterThan(0, filesize($this->dashboardPath), "⚠️ El archivo dashboard.js está vacío.");

        $this->assertFileExists($this->menuPath, "❌ El archivo menu.js no existe.");
        $this->assertGreaterThan(0, filesize($this->menuPath), "⚠️ El archivo menu.js está vacío.");
    }

    /**
     * Verifica que las funciones clave estén definidas en dashboard.js.
     */
    public function testDashboardJsDefineFunciones(): void
    {
        $code = file_get_contents($this->dashboardPath);

        $this->assertStringContainsString('function sendMenuFilter', $code, "❌ Falta la función sendMenuFilter() en dashboard.js.");
        $this->assertStringContainsString('function resetMenu', $code, "❌ Falta la función resetMenu() en dashboard.js.");
        $this->assertStringContainsString('menu:filter', $code, "⚠️ No se encontró el evento 'menu:filter' en dashboard.js.");
        $this->assertStringContainsString('menu:reset', $code, "⚠️ No se encontró el evento 'menu:reset' en dashboard.js.");
    }

    /**
     * Verifica que el archivo menu.js contenga la definición del componente Alpine.js.
     */
    public function testMenuJsContieneComponenteAlpine(): void
    {
        $code = file_get_contents($this->menuPath);

        $this->assertStringContainsString('function menuComponent', $code, "❌ Falta la función principal menuComponent() en menu.js.");
        $this->assertStringContainsString('x-data', file_get_contents(__DIR__ . '/../src/functions/menu.php'), "⚠️ El atributo x-data no se encontró en el HTML generado por renderMenu().");
    }

    /**
     * Verifica que el proyecto incluya correctamente los scripts del menú y del dashboard.
     * Los scripts pueden estar en header.php y/o footer.php, según la arquitectura del proyecto.
     */
    public function testIndexIncluyeScriptsJs(): void
    {
        $this->assertFileExists($this->indexPath, "❌ El archivo index.php no existe.");

        // Combina el contenido de index.php, header.php y footer.php
        $html = file_get_contents($this->indexPath);

        $headerPath = __DIR__ . '/../src/includes/header.php';
        $footerPath = __DIR__ . '/../src/includes/footer.php';

        if (file_exists($headerPath)) {
            $html .= file_get_contents($headerPath);
        }
        if (file_exists($footerPath)) {
            $html .= file_get_contents($footerPath);
        }

        // menu.js debe estar en header.php
        $this->assertMatchesRegularExpression(
            '/<script[^>]+menu\.js/i',
            $html,
            "❌ Falta la inclusión de menu.js en header.php."
        );

        // dashboard.js debe estar en footer.php o en index.php
        $this->assertMatchesRegularExpression(
            '/<script[^>]+dashboard\.js/i',
            $html,
            "❌ Falta la inclusión de dashboard.js en footer.php o index.php."
        );
    }


    /**
     * (Opcional) Verifica que dashboard.js no contenga errores sintácticos simples.
     * 
     * Si Node.js está disponible en el entorno, ejecuta una comprobación de sintaxis.
     */
    public function testDashboardJsSinErroresSintacticos(): void
    {
        $code = file_get_contents($this->dashboardPath);
        $tmp = tempnam(sys_get_temp_dir(), 'jslint_');
        file_put_contents($tmp, $code);

        // Usa Node.js, si está disponible, para validar la sintaxis del archivo JS
        $nodeExists = shell_exec('which node');
        if ($nodeExists) {
            $output = shell_exec("node --check {$tmp} 2>&1");
            $this->assertStringNotContainsString('SyntaxError', $output, "❌ Error de sintaxis detectado en dashboard.js:\n$output");
        } else {
            $this->markTestSkipped("⚠️ Node.js no está disponible para validar la sintaxis JS.");
        }

        unlink($tmp);
    }
}
