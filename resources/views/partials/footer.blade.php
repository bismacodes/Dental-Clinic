<script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
<script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

<script src="{{ asset('assets/compiled/js/app.js') }}"></script>

<script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/static/js/pages/datatables.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    document.addEventListener("DOMContentLoaded", function() {

        // Find all sidebar items with submenus
        document.querySelectorAll(".sidebar-item.has-sub").forEach(function(item) {

            // Check if any child submenu-item is active
            const hasActiveChild = item.querySelector(".submenu-item.active");

            if (hasActiveChild) {
                item.classList.add("active");

                const submenu = item.querySelector(".submenu");
                if (submenu) {
                    submenu.classList.add("submenu-open");
                }
            }
        });

    });
</script>


@stack('scripts')

</body>

</html>
