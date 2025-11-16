<?php
    // public/index.php
    $page_title = "SMART SMALL THINGS";
    include __DIR__ . '/src/includes/header.php';
?>

<!-- ====================== MAIN CONTENT ====================== -->
<section id="start" class="py-8">

    <!-- ===== Secondary action bar (button and status pill) ===== -->
    <div class="container mx-auto max-w-5xl px-4">
        <button type="button"
                onclick="resetMenu()"
                class="px-3 py-2 bg-brand-teal text-brand-light text-sm rounded-md hover:bg-brand-navy">
            Restore menu
        </button>
        <!-- Status pill (optional: shows the active filter) -->
        <span id="menuFilterPill" class="hidden text-sm px-2 py-1 rounded-full bg-brand-teal/10 text-brand-teal">
            Showing: <b id="menuFilterName"></b>
        </span>
    </div>

    <!-- ===== Main actions panel container ===== -->
    <div class="container mx-auto max-w-5xl px-4">
        <h2 class="text-2xl font-semibold text-brand-navy mb-4">Main Panel — Quick Actions</h2>

        <!-- ===== Grid of 4 cards (main dashboard buttons) ===== -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5">

            <!-- --- Card: Maintenance Alerts --- -->
            <button type="button"
                    onclick="sendMenuFilter('Maintenance')"
                    class="group p-5 rounded-xl bg-white border border-gray-200 shadow-sm hover:shadow-md transition-all hover:-translate-y-0.5 text-center">
                <img src="/assets/img/006.png" alt="Maintenance alerts" class="mx-auto w-14 h-14 mb-3">
                <div class="text-base font-semibold text-brand-navy group-hover:text-brand-teal">Maintenance Alerts</div>
                <p class="text-xs text-gray-500 mt-1">Predictive and upcoming inspections.</p>
            </button>

        </div>
    </div>
</section>

<?php include __DIR__ . '/src/includes/footer.php'; ?>
