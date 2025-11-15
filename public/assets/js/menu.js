/**
 * DESKTOP:
 * Este bloque controla la visualización de los submenús en pantallas grandes.
 */

document.querySelectorAll('[data-submenu]').forEach(li => {
  const panel = li.querySelector('.submenu-block');
  let timer;
  if (!panel) return;

  // Al pasar el cursor sobre el elemento padre → muestra el submenú
  li.addEventListener('mouseenter', () => {
    clearTimeout(timer);
    panel.classList.remove('hidden');
    panel.classList.add('block');
  });

  // Al retirar el cursor → oculta el submenú después de un pequeño retardo
  li.addEventListener('mouseleave', () => {
    timer = setTimeout(() => {
      panel.classList.add('hidden');
      panel.classList.remove('block');
    }, 200); // 200 ms para permitir movimientos suaves del ratón
  });
});


/**
 * MOBILE
 * Este bloque gestiona el comportamiento del botón hamburguesa.
 */

(function () {
  const btn = document.getElementById('btn-mobile');  // Botón hamburguesa
  const panel = document.getElementById('mobileMenu'); // Panel del menú móvil
  if (!btn || !panel) return;

  // Alterna la visibilidad del menú al hacer clic
  btn.addEventListener('click', () => {
    const isHidden = panel.classList.contains('hidden');

    // Muestra u oculta el panel según el estado actual
    panel.classList.toggle('hidden', !isHidden);

    // Actualiza los atributos ARIA (accesibilidad)
    btn.setAttribute('aria-expanded', String(isHidden));
    btn.setAttribute('aria-label', isHidden ? 'Cerrar menú principal' : 'Abrir menú principal');
  });
})();