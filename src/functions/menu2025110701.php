<?php
// Funciones para cargar y renderizar el menú de navegación

function getMenuData(string $path): array
{
    if (!file_exists($path)) {
        return ["error" => "Archivo menu.json no encontrado."];
    }
    $json = file_get_contents($path);
    $data = json_decode($json, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return ["error" => "Error al decodificar el archivo JSON."];
    }
    return $data;
}

// Renderiza el menú de escritorio con:
// Nivel 1: en linea, flexible
// Nivel 2: abajo de cada iten padre
// Nivel 3+: a la derecha de cada iten padre
function renderDesktopMenu(array $nodes, int $depth = 0): void
{
    if (empty($nodes)) return;

    $ulClass = $depth === 0
        ? 'flex items-center gap-2'
        : 'absolute z-20 min-w-52 rounded-lg border bg-white/95 shadow-lg backdrop-blur text-sm p-2';

    // posición por nivel
    if ($depth === 0) {
        $position = '';
    } elseif ($depth === 1) {
        $position = 'mt-1';
    } else {
        $position = 'top-0 left-full ml-1';
    }

    echo "<ul class=\"$ulClass $position\">\n";

    foreach ($nodes as $i => $node) {
        $title = htmlspecialchars($node['title'] ?? '—', ENT_QUOTES, 'UTF-8');
        $url   = htmlspecialchars($node['url'] ?? '#', ENT_QUOTES, 'UTF-8');
        $hasChildren = !empty($node['children']) && is_array($node['children']);
        $id = "submenu-$depth-$i";

        if (!$hasChildren) {
            $pad = $depth === 0 ? 'px-3 py-2' : 'px-2 py-1.5';
            echo "<li><a href=\"$url\" class=\"block rounded-md hover:underline $pad\">$title</a></li>\n";
        } else {
            $pad = $depth === 0 ? 'px-3 py-2' : 'px-2 py-1.5';

            echo "<li class=\"relative\" data-submenu=\"$id\">\n";
            echo "  <div class=\"inline-flex items-center gap-2 rounded-md cursor-pointer $pad hover:underline submenu-btn\" data-target=\"$id\">\n";
            echo "    <span>$title</span>\n";
            echo "    <svg class=\"size-4 transition-transform\" viewBox=\"0 0 20 20\" fill=\"currentColor\" aria-hidden=\"true\">\n";
            echo "      <path fill-rule=\"evenodd\" d=\"M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.08 1.04l-4.25 4.25a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z\" clip-rule=\"evenodd\"/>\n";
            echo "    </svg>\n";
            echo "  </div>\n";

            // Submenús: nivel 2 debajo, nivel 3+ al lado derecho
            if ($depth === 0) {
                // Nivel 2 → debajo del elemento padre
                echo "  <div id=\"$id\" class=\"absolute hidden submenu-block mt-1 left-0\">\n";
            } else {
                // Nivel 3+ → al lado derecho del elemento padre
                echo "  <div id=\"$id\" class=\"absolute hidden submenu-block top-0 left-full ml-1\">\n";
            }

            renderDesktopMenu($node['children'], $depth + 1);
            echo "  </div>\n";

            echo "</li>\n";
        }
    }

    echo "</ul>\n";

    // JS antidesaparición (hover estable)
    if ($depth === 0) {
        echo <<<HTML
<script>
document.querySelectorAll('[data-submenu]').forEach(li => {
  const panel = li.querySelector('.submenu-block');
  let timer;
  if (!panel) return;

  li.addEventListener('mouseenter', () => {
    clearTimeout(timer);
    panel.classList.remove('hidden');
    panel.classList.add('block');
  });

  li.addEventListener('mouseleave', () => {
    timer = setTimeout(() => {
      panel.classList.add('hidden');
      panel.classList.remove('block');
    }, 200);
  });
});
</script>
HTML;
    }
}

// Renderiza el menú móvil (<details>/<summary>)
function renderMobileMenu(array $nodes): void
{
    if (empty($nodes)) return;

    echo "<ul class=\"px-3 space-y-1\">\n";
    foreach ($nodes as $node) {
        $title = htmlspecialchars($node['title'] ?? '—', ENT_QUOTES, 'UTF-8');
        $url   = htmlspecialchars($node['url'] ?? '#', ENT_QUOTES, 'UTF-8');
        $hasChildren = !empty($node['children']) && is_array($node['children']);

        if (!$hasChildren) {
            echo "<li><a href=\"$url\" class=\"block rounded-md px-3 py-2 hover:bg-gray-100\">$title</a></li>\n";
        } else {
            echo "<li>\n";
            echo "  <details class=\"group\">\n";
            echo "    <summary class=\"flex cursor-pointer list-none items-center justify-between rounded-md px-3 py-2 hover:bg-gray-100\">\n";
            echo "      <span>$title</span>\n";
            echo "      <svg class=\"size-4 transition-transform group-open:rotate-180\" viewBox=\"0 0 20 20\" fill=\"currentColor\">\n";
            echo "        <path fill-rule=\"evenodd\" d=\"M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.08 1.04l-4.25 4.25a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z\" clip-rule=\"evenodd\"/>\n";
            echo "      </svg>\n";
            echo "    </summary>\n";
            echo "    <div class=\"pl-4 border-l ml-2 mt-1\">\n";
            renderMobileMenu($node['children']);
            echo "    </div>\n";
            echo "  </details>\n";
            echo "</li>\n";
        }
    }
    echo "</ul>\n";
}

// Imprime el menú completo (escritorio + móvil)
function renderMenu(): void
{
    $menuPath = __DIR__ . '/../../public/assets/data/menu.json';
    $menuData = getMenuData($menuPath);
    $menuError = $menuData['error'] ?? null;
    $items = !isset($menuData['error']) ? $menuData : [];

    echo '<nav class="flex items-center justify-between py-4">';

    echo '  <div class="hidden md:block">';
    if ($menuError) {
        echo '<span class="text-sm text-red-600 italic" role="alert">Error al cargar el menú</span>';
    } elseif (empty($items)) {
        echo '<span class="text-sm text-gray-500 italic">Sin elementos de menú</span>';
    } else {
        renderDesktopMenu($items);
    }
    echo '  </div>';

    echo '  <button id="btn-mobile" class="md:hidden inline-flex items-center rounded-md px-3 py-2" aria-controls="mobileMenu" aria-expanded="false" aria-label="Abrir menú principal" type="button">';
    echo '    <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">';
    echo '      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/>';
    echo '    </svg>';
    echo '  </button>';
    echo '</nav>';

    echo '<div id="mobileMenu" class="md:hidden border-t py-3 hidden" role="region" aria-label="Menú principal">';
    if ($menuError) {
        echo '<p class="px-3 text-sm text-red-600 italic" role="alert">Error al cargar el menú</p>';
    } elseif (empty($items)) {
        echo '<p class="px-3 text-sm text-gray-500 italic">Sin elementos de menú</p>';
    } else {
        renderMobileMenu($items);
    }
    echo '</div>';

    echo '<script>
      (function () {
        const btn = document.getElementById("btn-mobile");
        const panel = document.getElementById("mobileMenu");
        if (!btn || !panel) return;
        btn.addEventListener("click", () => {
          const isHidden = panel.classList.contains("hidden");
          panel.classList.toggle("hidden", !isHidden);
          btn.setAttribute("aria-expanded", String(isHidden));
          btn.setAttribute("aria-label", isHidden ? "Cerrar menú principal" : "Abrir menú principal");
        });
      })();
    </script>';
}
