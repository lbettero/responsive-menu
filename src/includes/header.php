<?php
	// Importa las funciones del menú principal desde la carpeta src/functions
	require_once __DIR__ . '/../functions/menu.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title><?= htmlspecialchars($page_title ?? 'MENU RESPONSIBLE') ?></title>

	<!-- ===== Archivos JavaScript principales ===== -->

	<!-- JS del menú dinámico -->
	<script src="/../assets/js/menu.js" defer></script>

	<!-- JS del dashboard -->
	<script src="/../assets/js/dashboard.js" defer></script>

	<!-- ===== Estilos y frameworks ===== -->

	<!-- Tailwind CSS (framework de estilos) -->
	<script src="https://cdn.tailwindcss.com"></script>

	<!-- Alpine.js (control de interactividad reactiva) -->
	<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

	<!-- Fuentes y hoja de estilo personalizada -->
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="/../assets/css/main.css">
</head>

<body class="font-sans flex flex-col min-h-screen bg-white text-gray-800">

	<!-- ====================== ENCABEZADO PRINCIPAL ====================== -->
	<header class="sticky top-0 inset-x-0 z-[100000] py-0 backdrop-blur-md shadow-md isolate">
		<div id="divhead" class="w-full text-center">
			<h1 class="text-2xl font-semibold tracking-wide">MENU RESPONSIVO</h1>
			<p class="text-brand-teal text-sm"><a href="https://github.com/lbettero/responsive-menu" target="_blank">- GitHub -</a><br>Las opcones del menú son ficticias</p>
		</div>

		<!-- ====================== NAVEGACIÓN SUPERIOR ====================== -->
		<nav 
			class="text-gray-800 relative isolate overflow-visible"
			x-data="{ 
				showMenu: window.innerWidth >= 768, 
			}" 
			x-init="
				window.addEventListener('resize', () => {
					if (window.innerWidth >= 768) showMenu = true;
				});
			"
		>
			<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-5">

				<!-- ===== Botón para plegar/desplegar el menú (siempre visible en el header) ===== -->
				<div class="flex justify-end items-center mb-2 relative z-[10010]">
					<button 
						@click="showMenu = !showMenu" 
						class="flex items-center gap-2 text-sm px-2 py-0 text-brand-navy hover:text-brand-teal transition bg-transparent border-none focus:outline-none"
						aria-controls="topmenu"
						:aria-expanded="showMenu.toString()"
					>
						<!-- Íconos de control en vista de escritorio -->
						<img 
							x-show="showMenu" 
							src="/../assets/img/hide.png" 
							alt="Ocultar menú" 
							class="hidden md:inline w-4 h-4 align-middle"
						>
						<img 
							x-show="!showMenu" 
							src="/../assets/img/see.png" 
							alt="Mostrar menú" 
							class="hidden md:inline w-4 h-4 align-middle"
						>

						<!-- Ícono hamburguesa para vista móvil -->
						<svg 
							x-show="!showMenu" 
							xmlns="http://www.w3.org/2000/svg" 
							fill="none" 
							viewBox="0 0 24 24"
							stroke-width="2" 
							stroke="currentColor"
							class="inline md:hidden w-5 h-5 align-middle"
							aria-hidden="true"
						>
							<path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
						</svg>

						<!-- Texto del botón (cambia dinámicamente) -->
						<span class="hidden sm:inline align-middle" x-text="showMenu ? 'Ocultar menú' : 'Mostrar menú'"></span>
					</button>
				</div>

				<!-- ===== Botón de cierre flotante SOLO en mobile cuando el menú está abierto ===== -->
				<button
					x-show="showMenu"
					class="md:hidden fixed top-3 right-4 z-[10020] p-2 rounded-full border border-gray-300 bg-white/90 shadow"
					@click="showMenu = false"
					aria-label="Cerrar menú"
				>
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
						<path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 0 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06z" clip-rule="evenodd"/>
					</svg>
					<span class="sr-only">Cerrar menú</span>
				</button>

				<!-- ===== Contenedor del menú superior (dinámico con Alpine.js) ===== -->
				<div 
					id="topmenu"
					x-show="showMenu" 
					x-transition.opacity.duration.300ms
					class="relative md:z-auto z-[10005] bg-white md:bg-transparent w-full md:w-auto fixed md:static inset-0 flex flex-col md:flex-row justify-center items-center md:gap-x-6 gap-y-4 md:gap-y-0 p-6 md:p-0 md:h-auto h-full md:overflow-visible overflow-y-auto"
					@click.away="if (window.innerWidth < 768) showMenu = false"
				>
					<?php renderMenu(); ?>
				</div>

			</div>
		</nav>
	</header>
