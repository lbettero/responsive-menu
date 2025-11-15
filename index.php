<?php
	// public/index.php
	$page_title = "MENU RESPONSIBLE";
	include __DIR__ . '/src/includes/header.php';
?>

<!-- ====================== CONTENIDO PRINCIPAL ====================== -->
<section id="inicio" class="py-8">

	<!-- ===== Barra de acciones secundarias (botón y píldora de estado) ===== -->
	<div class="container mx-auto max-w-5xl px-4">
		<button type="button"
				onclick="resetMenu()"
				class="px-3 py-2 bg-brand-teal text-brand-light text-sm rounded-md hover:bg-brand-navy">
			Restaurar menú
		</button>
		<!-- Píldora de estado (opcional: muestra el filtro activo) -->
		<span id="menuFilterPill" class="hidden text-sm px-2 py-1 rounded-full bg-brand-teal/10 text-brand-teal">
			Mostrando: <b id="menuFilterName"></b>
		</span>
	</div>

	<!-- ===== Contenedor principal del panel de acciones ===== -->
	<div class="container mx-auto max-w-5xl px-4">
		<h2 class="text-2xl font-semibold text-brand-navy mb-4">Panel principal — Acciones rápidas</h2>

		<!-- ===== Grid de 4 tarjetas (botones principales del panel) ===== -->
		<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5">

			<!-- --- Tarjeta: Monitoreo de Alarmas --- -->
			<button type="button"
					onclick="sendMenuFilter('Monitoreo')"
					class="group p-5 rounded-xl bg-white border border-gray-200 shadow-sm hover:shadow-md transition-all hover:-translate-y-0.5 text-center">
				<img src="/../assets/img/001.png" alt="Monitoreo de alarmas" class="mx-auto w-14 h-14 mb-3">
				<div class="text-base font-semibold text-brand-navy group-hover:text-brand-teal">Monitoreo de Alarmas</div>
				<p class="text-xs text-gray-500 mt-1">Ver alarmas activas y por criticidad.</p>
			</button>

			<!-- --- Tarjeta: Estado General de Sensores --- -->
			<button type="button"
					onclick="sendMenuFilter('Sensores')"
					class="group p-5 rounded-xl bg-white border border-gray-200 shadow-sm hover:shadow-md transition-all hover:-translate-y-0.5 text-center">
				<img src="/../assets/img/005.png" alt="Estado general de sensores" class="mx-auto w-14 h-14 mb-3">
				<div class="text-base font-semibold text-brand-navy group-hover:text-brand-teal">Estado de Sensores</div>
				<p class="text-xs text-gray-500 mt-1">Temperatura, presión y vibración.</p>
			</button>

			<!-- --- Tarjeta: Alertas de Mantenimiento --- -->
			<button type="button"
					onclick="sendMenuFilter('Mantenimiento')"
					class="group p-5 rounded-xl bg-white border border-gray-200 shadow-sm hover:shadow-md transition-all hover:-translate-y-0.5 text-center">
				<img src="/../assets/img/006.png" alt="Alertas de mantenimiento" class="mx-auto w-14 h-14 mb-3">
				<div class="text-base font-semibold text-brand-navy group-hover:text-brand-teal">Alertas de Mantenimiento</div>
				<p class="text-xs text-gray-500 mt-1">Predictivo y próximas revisiones.</p>
			</button>

			<!-- --- Tarjeta: Mapa de Flota --- -->
			<button type="button"
					onclick="sendMenuFilter('Flota')"
					class="group p-5 rounded-xl bg-white border border-gray-200 shadow-sm hover:shadow-md transition-all hover:-translate-y-0.5 text-center">
				<img src="/../assets/img/003.png" alt="Mapa de flota" class="mx-auto w-14 h-14 mb-3">
				<div class="text-base font-semibold text-brand-navy group-hover:text-brand-teal">Mapa de Flota</div>
				<p class="text-xs text-gray-500 mt-1">Unidades por zona y estado.</p>
			</button>
		</div>
	</div>
</section>

<?php include __DIR__ . '/src/includes/footer.php'; ?>