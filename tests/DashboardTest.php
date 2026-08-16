<?php
use PHPUnit\Framework\TestCase;

/**
 * Tests the dashboard and menu integration.
 *
 * The tests cover required files, filter events, script loading,
 * and basic JavaScript syntax validation.
 *
 * @author Livia Pérez Bettero
 */
class DashboardTest extends TestCase
{
    private string $dashboardPath;
    private string $menuPath;
    private string $indexPath;

    /**
     * Set the paths used by the tests.
     */
    protected function setUp(): void
    {
        $this->dashboardPath = __DIR__ . '/../public/assets/js/dashboard.js';
        $this->menuPath      = __DIR__ . '/../public/assets/js/menu.js';
        $this->indexPath     = __DIR__ . '/../public/index.php';
    }

    /**
     * Check that the required JavaScript files exist.
     */
    public function testArchivosJsExisten(): void
    {
        $this->assertFileExists($this->dashboardPath, "❌ El archivo dashboard.js no existe.");
        $this->assertGreaterThan(0, filesize($this->dashboardPath), "⚠️ El archivo dashboard.js está vacío.");

        $this->assertFileExists($this->menuPath, "❌ El archivo menu.js no existe.");
        $this->assertGreaterThan(0, filesize($this->menuPath), "⚠️ El archivo menu.js está vacío.");
    }

    /**
     * Check the dashboard functions and events.
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
     * Check that menu.js defines the Alpine component.
     */
    public function testMenuJsContieneComponenteAlpine(): void
    {
        $code = file_get_contents($this->menuPath);

        $this->assertStringContainsString('function menuComponent', $code, "❌ Falta la función principal menuComponent() en menu.js.");
        $this->assertStringContainsString('x-data', file_get_contents(__DIR__ . '/../src/functions/menu.php'), "⚠️ El atributo x-data no se encontró en el HTML generado por renderMenu().");
    }

    /**
     * Check that the page loads the menu and dashboard scripts.
     */
    public function testIndexIncluyeScriptsJs(): void
    {
        $this->assertFileExists($this->indexPath, "❌ El archivo index.php no existe.");

        // Read all files that may load scripts.
        $html = file_get_contents($this->indexPath);

        $headerPath = __DIR__ . '/../src/includes/header.php';
        $footerPath = __DIR__ . '/../src/includes/footer.php';

        if (file_exists($headerPath)) {
            $html .= file_get_contents($headerPath);
        }
        if (file_exists($footerPath)) {
            $html .= file_get_contents($footerPath);
        }

        // menu.js must be loaded by the header.
        $this->assertMatchesRegularExpression(
            '/<script[^>]+menu\.js/i',
            $html,
            "❌ Falta la inclusión de menu.js en header.php."
        );

        // dashboard.js may be loaded by the footer or the page.
        $this->assertMatchesRegularExpression(
            '/<script[^>]+dashboard\.js/i',
            $html,
            "❌ Falta la inclusión de dashboard.js en footer.php o index.php."
        );
    }


    /**
     * Check dashboard.js syntax when Node.js is available.
     */
    public function testDashboardJsSinErroresSintacticos(): void
    {
        $code = file_get_contents($this->dashboardPath);
        $tmp = tempnam(sys_get_temp_dir(), 'jslint_');
        file_put_contents($tmp, $code);

        // Use Node.js when it is available.
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
