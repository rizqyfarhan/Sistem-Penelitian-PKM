/*!
 * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
 * Copyright 2013-2023 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */
//
// Scripts
//

let sumberDanaDropDown = document.getElementById("SumberDana");
let lembagaPendanaField = document.getElementById("LembagaPendana");
let lembagaPendanaLabel = document.getElementById("LabelLembagaPendana");

lembagaPendanaLabel.style.display = "none";
lembagaPendanaField.style.display = "none";

window.addEventListener("DOMContentLoaded", (event) => {
    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector("#sidebarToggle");
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener("click", (event) => {
            event.preventDefault();
            document.body.classList.toggle("sb-sidenav-toggled");
            localStorage.setItem(
                "sb|sidebar-toggle",
                document.body.classList.contains("sb-sidenav-toggled")
            );
        });
    }
});

function toggleLembagaPendana() {
    if (sumberDanaDropDown.value === "external") {
        lembagaPendanaLabel.style.display = "block";
        lembagaPendanaField.style.display = "block";
    } else {
        lembagaPendanaLabel.style.display = "none";
        lembagaPendanaField.style.display = "none";
    }

    toggleLembagaPendana();
}
