(function () {
    var shell = document.querySelector(".admin-shell");
    var sidebar = document.querySelector(".admin-sidebar");
    var toggle = document.querySelector("[data-admin-menu-toggle]");
    var backdrop = document.querySelector("[data-admin-backdrop]");

    function closeSidebar() {
        if (!shell || !sidebar) return;
        shell.classList.remove("sidebar-open");
        sidebar.classList.remove("is-open");
        if (toggle) toggle.setAttribute("aria-expanded", "false");
        if (backdrop) backdrop.hidden = true;
    }

    function openSidebar() {
        if (!shell || !sidebar) return;
        shell.classList.add("sidebar-open");
        sidebar.classList.add("is-open");
        if (toggle) toggle.setAttribute("aria-expanded", "true");
        if (backdrop) backdrop.hidden = false;
    }

    if (toggle && sidebar && shell) {
        toggle.addEventListener("click", function () {
            if (sidebar.classList.contains("is-open")) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });

        if (backdrop) {
            backdrop.addEventListener("click", closeSidebar);
        }

        document.addEventListener("keydown", function (e) {
            if (e.key === "Escape") closeSidebar();
        });
    }

    var toast = document.getElementById("adminToast");
    var msg = typeof window.__ADMIN_TOAST__ === "string" ? window.__ADMIN_TOAST__.trim() : "";
    if (toast && msg) {
        toast.textContent = msg;
        toast.hidden = false;
        requestAnimationFrame(function () {
            toast.classList.add("is-visible");
        });
        setTimeout(function () {
            toast.classList.remove("is-visible");
        }, 3800);
    }
})();
