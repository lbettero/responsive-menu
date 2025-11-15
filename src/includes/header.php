<?php
require_once __DIR__ . '/../../src/functions/menu.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= htmlspecialchars($page_title ?? 'MENÚ RESPONSIBLE') ?></title>


  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="/assets/css/main.css">
  
  <!-- JS para leer el menu -->
  <script src="assets/js/menu.js" defer></script>

</head>

<body class="font-sans flex flex-col min-h-screen bg-white text-gray-800">
  <!-- Encabezado principal -->
  <header class="bg-brand-navy text-white py-4 shadow-md">
		<div id="divhead" class="w-full text-center">
			<h1 class="text-2xl font-semibold tracking-wide">MENU RESPONSIVO</h1>
			<p class="text-brand-teal text-sm"><a href="https://github.com/lbettero/responsive-menu" target="_blank">- GitHub -</a><br>Las opcones del menú son ficticias</p>
		</div>

    <!-- Contenedor del menú -->
    <div class="bg-white text-gray-800">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <?php renderMenu(); ?>
      </div>
    </div>
  </header>
