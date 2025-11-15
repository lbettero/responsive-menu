// assets/js/dashboard.js

// --- Envía un evento personalizado para filtrar el menú según una etiqueta (tag) ---
function sendMenuFilter(tag) {
	// Dispara un evento global que otros componentes pueden escuchar
	window.dispatchEvent(new CustomEvent('menu:filter', { detail: tag }));

	// --- Retroalimentación visual rápida (muestra una píldora con el nombre del filtro) ---
	const pill = document.getElementById('menuFilterPill');
	const name = document.getElementById('menuFilterName');

	// Si existen los elementos de la interfaz, actualiza el texto y muestra la píldora
	if (pill && name) {
		name.textContent = tag;
		pill.classList.remove('hidden');
	}
}

// --- Restaura el estado original del menú (elimina filtros activos) ---
function resetMenu() {
	// Dispara un evento global para reiniciar los filtros del menú
	window.dispatchEvent(new CustomEvent('menu:reset'));

	// Oculta la píldora visual del filtro, si existe
	const pill = document.getElementById('menuFilterPill');
	if (pill) pill.classList.add('hidden');
}
