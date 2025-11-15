<?php
use PHPUnit\Framework\TestCase;

// Incluye el archivo principal que contiene las funciones del menú
require_once __DIR__ . '/../src/functions/menu.php';

/**
 * ==========================================================
 *  ARCHIVO DE PRUEBAS UNITARIAS — Proyecto Coterena v1.0.0
 * ==========================================================
 * 
 * Este conjunto de pruebas valida las funciones principales
 * del menú dinámico desarrollado en PHP.
 * 
 * ----------------------------------------------------------
 *  Autoría y colaboración:
 *  - Desarrollado por: [Tu nombre o alias profesional]
 *  - Asistencia técnica y generación inicial: ChatGPT (OpenAI)
 * ----------------------------------------------------------
 * 
 * Propósito:
 * Verificar la correcta carga del archivo JSON del menú,
 * la generación de la salida HTML y el manejo de errores
 * en el módulo de renderización del proyecto.
 * 
 * Nota:
 * Este archivo fue generado con ayuda del modelo ChatGPT
 * de OpenAI, adaptado y revisado manualmente para integrarse
 * a la estructura del proyecto Coterena.
 */
class MenuTest extends TestCase
{
    /**
     * Verifica que el archivo JSON del menú exista.
     */
    public function testMenuJsonExiste(): void
    {
        $path = __DIR__ . '/../public/assets/data/menu.json';
        $this->assertFileExists($path, "El archivo menu.json no existe en la ruta esperada.");
    }

    /**
     * Verifica que el contenido del archivo JSON sea válido.
     */
    public function testMenuJsonValido(): void
    {
        $path = __DIR__ . '/../public/assets/data/menu.json';
        $json = file_get_contents($path);
        $data = json_decode($json, true);

        $this->assertNotNull($data, "El contenido del menu.json no se pudo decodificar correctamente.");
        $this->assertIsArray($data, "El contenido decodificado no es un array.");
    }

    /**
     * Comprueba que la función renderMenu() genere salida HTML sin errores.
     */
    public function testRenderMenuGeneraHtml(): void
    {
        ob_start();
        renderMenu();
        $output = ob_get_clean();

        $this->assertIsString($output, "El contenido renderizado no es una cadena.");
        $this->assertStringContainsString('<nav', $output, "La salida no contiene una etiqueta <nav>.");
        $this->assertStringContainsString('<ul', $output, "La salida no contiene una etiqueta <ul>.");
    }

    /**
     * Valida que la función getMenuData() maneje correctamente archivos inexistentes.
     */
    public function testMenuDataArchivoInexistente(): void
    {
        $resultado = getMenuData(__DIR__ . '/archivo_que_no_existe.json');
        $this->assertArrayHasKey('error', $resultado, "No se generó un mensaje de error al faltar el archivo.");
    }
}
