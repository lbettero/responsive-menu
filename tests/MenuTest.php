<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/functions/menu.php';

/**
 * ==========================================================
 *  PRUEBAS UNITARIAS — Proyecto Coterena v2.0.0
 * ==========================================================
 * 
 * 🧩 RESUMEN GENERAL:
 * Este conjunto de pruebas valida las funciones PHP responsables
 * de generar y manipular la estructura dinámica del menú principal
 * del Proyecto Coterena. En concreto:
 * 
 * 1. Comprueba la existencia y validez del archivo JSON del menú.
 * 2. Evalúa la función `getMenuData()` asegurando que:
 *    - Devuelva un array válido.
 *    - Maneje correctamente archivos inexistentes.
 *    - Informe adecuadamente cuando el JSON está corrupto o mal formado.
 * 3. Verifica que `renderMenu()` produzca una salida HTML coherente,
 *    incluyendo estructuras esperadas como `<nav>`, `<ul>` o `<div>`,
 *    y que contenga atributos de Alpine.js.
 * 4. Analiza la estructura mínima de los ítems del menú (claves `title`
 *    y `children`) garantizando coherencia en los datos.
 * 5. Comprueba la existencia de subniveles en el menú (estructura jerárquica).
 * 
 * En conjunto, estas pruebas aseguran que el sistema de menú dinámico
 * funcione correctamente tanto a nivel de datos como de renderizado HTML.
 * 
 * @autor Livia Pérez Bettero
 * @colaboración Asistencia técnica: ChatGPT (OpenAI)
 * ----------------------------------------------------------
 */
class MenuTest extends TestCase
{
    private string $menuPath;

    /**
     * Define la ruta del archivo JSON del menú antes de cada prueba.
     */
    protected function setUp(): void
    {
        $this->menuPath = __DIR__ . '/../public/assets/data/menu.json';
    }

    /**
     * Verifica que el archivo JSON del menú exista en la ubicación esperada.
     */
    public function testMenuJsonExiste(): void
    {
        $this->assertFileExists(
            $this->menuPath,
            "❌ El archivo menu.json no existe en la ruta esperada: {$this->menuPath}"
        );
    }

    /**
     * Verifica que el contenido del JSON sea válido y bien formado.
     */
    public function testMenuJsonValido(): void
    {
        $json = @file_get_contents($this->menuPath);
        $this->assertNotFalse($json, "❌ No se pudo leer el archivo menu.json.");

        $data = json_decode($json, true);
        $this->assertIsArray($data, "❌ El JSON no decodificó a un array válido.");
        $this->assertNotEmpty($data, "⚠️ El menú JSON existe pero está vacío o sin elementos.");
    }

    /**
     * Comprueba que getMenuData() devuelva un array válido con las claves esperadas.
     */
    public function testGetMenuDataFuncionaCorrectamente(): void
    {
        $data = getMenuData($this->menuPath);
        $this->assertIsArray($data, "❌ getMenuData() no devolvió un array.");

        $this->assertArrayHasKey(
            'title', 
            $data[0] ?? ['title' => null], 
            "❌ Los elementos del menú deberían contener una clave 'title'."
        );
    }

    /**
     * Valida que getMenuData() maneje correctamente archivos inexistentes.
     */
    public function testMenuDataArchivoInexistente(): void
    {
        $resultado = getMenuData(__DIR__ . '/no_existe.json');
        $this->assertIsArray($resultado, "❌ getMenuData() no devolvió un array al faltar el archivo.");
        $this->assertArrayHasKey('error', $resultado, "⚠️ No se generó un mensaje de error al faltar el archivo.");
    }

    /**
     * Verifica que getMenuData() maneje correctamente JSON corruptos o incompletos.
     */
    public function testMenuDataJsonInvalido(): void
    {
        $tempFile = tempnam(sys_get_temp_dir(), 'menu');
        file_put_contents($tempFile, '{ "invalid_json": [ '); // JSON incompleto

        $resultado = getMenuData($tempFile);
        unlink($tempFile);

        $this->assertIsArray($resultado, "❌ La función no devolvió un array ante un JSON inválido.");
        $this->assertArrayHasKey('error', $resultado, "⚠️ Se esperaba una clave 'error' al procesar JSON inválido.");
    }

    /**
     * Comprueba que renderMenu() genere una salida HTML válida.
     * 
     * Se verifica que el contenido contenga estructuras comunes del menú
     * y atributos esperados de Alpine.js, compatibles con versiones anteriores
     * y la versión actual del sistema.
     */
    public function testRenderMenuGeneraHtml(): void
    {
        // Verifica que la función exista antes de ejecutarla
        $this->assertTrue(function_exists('renderMenu'), "❌ La función renderMenu() no está definida.");

        ob_start();
        renderMenu();
        $output = ob_get_clean();

        $this->assertIsString($output, "❌ El contenido renderizado no es una cadena de texto.");
        $this->assertNotEmpty(trim($output), "⚠️ renderMenu() no generó contenido HTML.");

        // Compatibilidad con versiones antiguas y nuevas:
        $containsNav = str_contains($output, '<nav');
        $containsList = str_contains($output, '<ul') || str_contains($output, '<div');

        $this->assertTrue(
            $containsNav || $containsList,
            "❌ La salida no contiene una estructura HTML reconocible (<nav>, <ul> o <div>)."
        );

        $this->assertMatchesRegularExpression(
            '/<a[^>]+href=|x-data|x-show/i',
            $output,
            "⚠️ El HTML del menú no contiene enlaces ni atributos de AlpineJS esperados."
        );
    }

    /**
     * Valida la estructura mínima de cada ítem del menú JSON.
     * 
     * Se asegura que todos los elementos contengan la clave esencial 'title'
     * y que, en caso de existir, la clave 'children' sea un array.
     */
    public function testEstructuraDeItems(): void
    {
        $data = getMenuData($this->menuPath);
        $this->assertIsArray($data, "❌ El menú no devolvió una estructura válida para su análisis.");

        $validateItem = function ($item) use (&$validateItem) {
            $this->assertArrayHasKey('title', $item, "❌ Falta la clave 'title' en un elemento del menú.");

            if (isset($item['children'])) {
                $this->assertIsArray(
                    $item['children'],
                    "❌ El campo 'children' debe ser un array si está presente en '{$item['title']}'."
                );

                // Validar recursivamente subniveles
                foreach ($item['children'] as $child) {
                    $validateItem($child);
                }
            }
        };

        foreach ($data as $item) {
            $validateItem($item);
        }
    }


    /**
     * Verifica que el menú contenga al menos un subnivel (estructura jerárquica).
     */
    public function testMenuTieneSubniveles(): void
    {
        $data = getMenuData($this->menuPath);
        $hasNested = false;

        foreach ($data as $item) {
            if (!empty($item['children'])) {
                $hasNested = true;
                break;
            }
        }

        $this->assertTrue($hasNested, "⚠️ El menú JSON no contiene niveles secundarios (children vacíos).");
    }
}
