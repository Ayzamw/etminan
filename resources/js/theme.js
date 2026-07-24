document.addEventListener("DOMContentLoaded", function () {

    const html = document.documentElement;
    const toggleBtn = document.getElementById("theme-toggle");

    if (localStorage.getItem("theme") === "dark") {
        html.classList.add("dark");
    }

    if (toggleBtn) {
        toggleBtn.addEventListener("click", function () {
            html.classList.toggle("dark");

            if (html.classList.contains("dark")) {
                localStorage.setItem("theme", "dark");
            } else {
                localStorage.setItem("theme", "light");
            }
        });
    }

});