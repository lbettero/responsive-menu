<?php
  // public/index.php
  $page_title = "Menú Dinámico — Prueba Técnica";
  include __DIR__ . '/../src/includes/header.php';
?>

<!-- CONTENIDO PRINCIPAL -->
<section id="inicio" class="py-5">
  <div class="container mx-auto text-center">
    <h1 class="text-3xl font-bold mb-3">Menú Dinámico en PHP + Tailwind</h1>
    <p class="text-gray-700 max-w-2xl mx-auto">
      Este sitio demuestra un menú dinámico y responsivo generado a partir de un archivo JSON.
      Incluye funcionalidades de búsqueda, plegado y resaltado de coincidencias.
    </p>
  </div>
</section>

<?php include __DIR__ . '/../src/includes/footer.php'; ?>
