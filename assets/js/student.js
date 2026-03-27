(function () {
    var shell = document.querySelector(".student-shell");
    var sidebar = document.querySelector(".student-sidebar");
    var toggle = document.querySelector("[data-student-menu-toggle]");
    var backdrop = document.querySelector("[data-student-backdrop]");

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

    var showcase = document.querySelector("[data-student-showcase]");
    if (!showcase) return;

    var wrap = showcase.closest(".student-showcase-wrap");
    var slides = showcase.querySelectorAll(".student-showcase-slide");
    var dots = wrap ? wrap.querySelectorAll(".student-showcase-dot") : [];
    var prev = showcase.querySelector(".student-showcase-nav--prev");
    var next = showcase.querySelector(".student-showcase-nav--next");
    var index = 0;
    var timer;

    function show(i) {
        index = (i + slides.length) % slides.length;
        slides.forEach(function (s, j) {
            s.classList.toggle("is-active", j === index);
        });
        dots.forEach(function (d, j) {
            d.classList.toggle("is-active", j === index);
        });
    }

    function nextSlide() {
        show(index + 1);
    }

    if (prev) prev.addEventListener("click", function () { show(index - 1); resetTimer(); });
    if (next) next.addEventListener("click", function () { show(index + 1); resetTimer(); });
    dots.forEach(function (dot, j) {
        dot.addEventListener("click", function () {
            show(j);
            resetTimer();
        });
    });

    function resetTimer() {
        clearInterval(timer);
        timer = setInterval(nextSlide, 5500);
    }

    show(0);
    resetTimer();
})();
