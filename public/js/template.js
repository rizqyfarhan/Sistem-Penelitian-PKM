let sumberDanaDropDown = document.getElementById("SumberDana");
let lembagaPendanaField = document.getElementById("LembagaPendana");
let lembagaPendanaLabel = document.getElementById("LabelLembagaPendana");

lembagaPendanaLabel.style.display = "none";
lembagaPendanaField.style.display = "none";

// $(document).ready(function () {
//     $("#statusSelect").on("change", function () {
//         $("#updateStatusForm").submit();
//     });
// });

$(document).ready(function () {
    let selectedValue = "";

    $("#statusSelect").on("change", function () {
        selectedValue = $(this).val();
        $("#updateStatusForm").submit();
    });

    $(document).ajaxComplete(function () {
        console.log("Selected value after form submission:", selectedValue);
        $("#statusSelect").val(selectedValue);
    });
});

window.addEventListener("DOMContentLoaded", (event) => {
    const sidebarToggle = document.body.querySelector("#sidebarToggle");
    if (sidebarToggle) {
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
