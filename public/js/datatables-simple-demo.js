window.addEventListener("DOMContentLoaded", (event) => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById("datatablesSimple");
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }

    const datatablesSimpleHKI = document.getElementById("datatablesSimpleHKI");
    if (datatablesSimpleHKI) {
        new simpleDatatables.DataTable(datatablesSimpleHKI);
    }

    const datatablesSimpleMedia = document.getElementById(
        "datatablesSimpleMedia"
    );
    if (datatablesSimpleMedia) {
        new simpleDatatables.DataTable(datatablesSimpleMedia);
    }

    const datatablesSimpleJurnal = document.getElementById(
        "datatablesSimpleJurnal"
    );
    if (datatablesSimpleJurnal) {
        new simpleDatatables.DataTable(datatablesSimpleJurnal);
    }

    const datatablesSimpleKemajuan = document.getElementById(
        "datatablesSimpleKemajuan"
    );
    if (datatablesSimpleKemajuan) {
        new simpleDatatables.DataTable(datatablesSimpleKemajuan);
    }

    const datatablesSimpleArtikel = document.getElementById(
        "datatablesSimpleArtikel"
    );
    if (datatablesSimpleArtikel) {
        new simpleDatatables.DataTable(datatablesSimpleArtikel);
    }
});
