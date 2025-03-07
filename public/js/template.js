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

document.addEventListener('DOMContentLoaded', function() {
    let alert = document.querySelector('.alert-success');
    if (alert) {
        setTimeout(function () {
            alert.style.display = "none";
        }, 1500);
    }

    function toggleNIDN()
    {
        const role = document.getElementById('role').value;
        const nidnForm = document.getElementById('nidn-form');

        if (role === 'dosen') {
            nidnForm.style.display = 'block';
        } else {
            nidnForm.style.display = 'none';
        }
    }

    function toggleEditLembagaPendana() {
        const sumberDana = document.getElementById('SumberDana').value;
        const namaPendana = document.getElementById('nama_pendana');
        const namaPendanaLabel = document.querySelector('label[for="nama_pendana"]');
    
        if (sumberDana === 'pribadi') {
            namaPendana.value = '';
            namaPendana.disabled = true;
            namaPendanaLabel.style.display = 'none';
            namaPendana.style.display = 'none';
        } else {
            namaPendana.disabled = false;
            namaPendanaLabel.style.display = 'block';
            namaPendana.style.display = 'block';
        }
    }

    toggleNIDN();
    toggleEditLembagaPendana();

    document.getElementById('role').addEventListener('change', toggleNIDN);
    document.getElementById('SumberDana').addEventListener('change', toggleEditLembagaPendana);
});

let sumberDanaDropDown = document.getElementById("SumberDana");
let lembagaPendanaField = document.getElementById("NamaPendana");
let lembagaPendanaLabel = document.getElementById("LabelNamaPendana");

lembagaPendanaLabel.style.display = "none";
lembagaPendanaField.style.display = "none";


function toggleLembagaPendana() {
    if (sumberDanaDropDown.value === "external" || sumberDanaDropDown.value === "internal") {
        lembagaPendanaLabel.style.display = "block";
        lembagaPendanaField.style.display = "block";
    } else {
        lembagaPendanaLabel.style.display = "none";
        lembagaPendanaField.style.display = "none";
        lembagaPendanaField.value = ""; 
    }
}

sumberDanaDropDown.addEventListener('change', toggleLembagaPendana);

document.addEventListener('DOMContentLoaded', toggleLembagaPendana);

function validateForm()
{
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("password_confirmation").value;

    if (password != confirmPassword)
    {
        document.getElementById("message").innerHTML = "Password do not match";
        return false;
    }
    return true;
}

