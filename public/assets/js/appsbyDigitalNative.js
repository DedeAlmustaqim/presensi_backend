$(document).ready(function(){
    $("#modalTambahUnit").on('hide.bs.modal', function (e) {
        $(this).find('form')[0].reset();
    });
    $("#modalTambahAdministrator").on('hide.bs.modal', function (e) {
        $(this).find('form')[0].reset();
    });
    $("#modalTambahPeg").on('hide.bs.modal', function (e) {
        $(this).find('form')[0].reset();
    });
})
function devProgress(){
    Swal.fire('Lagi dalam pengembangan!', '.', 'warning');
}

var namaBulan = [
    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
];

// Fungsi untuk mengonversi angka menjadi nama bulan
function konversiBulan(angkaBulan) {
    return namaBulan[angkaBulan - 1];
}