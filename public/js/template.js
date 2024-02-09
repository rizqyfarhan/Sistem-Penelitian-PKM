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

let sumberDanaDropDown = document.getElementById("SumberDana");
let lembagaPendanaField = document.getElementById("LembagaPendana");
let lembagaPendanaLabel = document.getElementById("LabelLembagaPendana");

lembagaPendanaLabel.style.display = "none";
lembagaPendanaField.style.display = "none";

function toggleLembagaPendana() {
    if (sumberDanaDropDown.value === "external") {
        lembagaPendanaLabel.style.display = "block";
        lembagaPendanaField.style.display = "block";
    } else if (sumberDanaDropDown.value === "internal") {
        lembagaPendanaLabel.style.display = "block";
        lembagaPendanaField.style.display = "block";
    } else {
        lembagaPendanaLabel.style.display = "none";
        lembagaPendanaField.style.display = "none";
    }

    toggleLembagaPendana();
}

function validateForm()
{
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("password_confirm").value;

    if (password != confirmPassword)
    {
        document.getElementById("message").innerHTML = "Password do not match";
        return false;
    }
    return true;
}