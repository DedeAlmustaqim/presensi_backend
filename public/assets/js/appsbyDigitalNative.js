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