$(document).ready(function () {
    $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };
    $('#TabelUnit').DataTable({
        processing: true,
        serverSide: true,

        destroy: true,
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": true,
        "bAutoWidth": true,
        "columnDefs": [{
            "visible": false,

        }],
        "order": [
            [0, 'asc']
        ],

        "language": {
            "lengthMenu": "Tampilkan _MENU_ item per halaman",
            "zeroRecords": "Tidak ada data yang ditampilkan",
            "info": "Menampilkan Halaman _PAGE_ dari _PAGES_",
            "infoEmpty": "Tidak ada data yang ditampilkan",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search": "Cari ",
            "paginate": {
                "first": "Awal",
                "last": "Akhir",
                "next": "Selanjutnya",
                "previous": "Sebelumnya"
            },
        },
        "displayLength": 25,
        "ajax": {

            "url": BASE_URL + "admin/json_unit",
            // "dataSrc": "data",
            // "dataType": "json",
        },
        "columns": [
            {
                "orderable": false,
                "data": function (data,) {
                    return '<div class="text-left">' + data[0] + '</div>'

                }
            },

            {
                "orderable": false,
                "data": function (data,) {
                    return '<div class="text-left">' + data[1] + '</div>'

                }
            },
            {
                "orderable": false,
                "data": function (data,) {
                    return '<div class="text-left">' + data[5] + '</div>'

                }
            },
            {
                "orderable": false,
                "data": function (data,) {
                    return '<div class="text-left">' + data[6] + '</div>'

                }
            },
            {
                "orderable": false,
                "data": function (data,) {
                    return '<div class="text-left">' + data[7] + ' Meter</div>'

                }
            },

            {

                "orderable": false,
                "data": function (data,) {
                    return '<div class="text-center">' +
                        '<a  onclick="editUnit(this)" data-id="' + data[0] + '" class="btn  btn-outline-primary">Edit</a>&nbsp;' +
                        '<a  onclick="delUnit(this)" data-id="' + data[0] + '" class="btn  btn-outline-danger">Hapus</a>&nbsp;' +

                        '</div>'



                }
            },


        ],
        rowCallback: function (row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        },


    });

    $('#tabelAdministrator').DataTable({
        processing: true,
        serverSide: true,

        destroy: true,
        "bPaginate": false,
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": true,
        "bAutoWidth": true,
        "columnDefs": [{
            "visible": false,

        }],
        "order": [
            [0, 'asc']
        ],

        "language": {
            "lengthMenu": "Tampilkan _MENU_ item per halaman",
            "zeroRecords": "Tidak ada data yang ditampilkan",
            "info": "Menampilkan Halaman _PAGE_ dari _PAGES_",
            "infoEmpty": "Tidak ada data yang ditampilkan",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search": "Cari ",
            "paginate": {
                "first": "Awal",
                "last": "Akhir",
                "next": "Selanjutnya",
                "previous": "Sebelumnya"
            },
        },
        "displayLength": 25,
        "ajax": {

            "url": BASE_URL + "admin/json_administrator",
            // "dataSrc": "data",
            // "dataType": "json",
        },
        "columns": [

            {
                "orderable": false,
                "data": function (data,) {
                    return '<div class="text-left">' + data[0] + '</div>'

                }
            },
            {
                "orderable": false,
                "data": function (data,) {
                    return '<div class="text-left">' + data[1] + '</div>'

                }
            },
            {
                "orderable": false,
                "data": function (data,) {
                    return '<div class="text-left">' + data[2] + '</div>'

                }
            },
            {
                "orderable": false,
                "data": function (data,) {
                    return '<div class="text-left">' + data[10] + '</div>'

                }
            },

            {

                "orderable": false,
                "data": function (data,) {
                    return '<div class="text-center">' +
                        '<a  onclick="editAdm(this)" data-id="' + data[0] + '" class="btn  btn-primary">Edit</a>&nbsp;' +
                        '<a  onclick="editAdm(this)" data-id="' + data[0] + '" class="btn  btn-secondary">Reset Password</a>&nbsp;' +
                        '<a  onclick="delAdm(this)" data-id="' + data[0] + '" class="btn btn-dim  btn-outline-danger">Hapus</a>&nbsp;' +
                        '</div>'
                }
            },


        ],
        rowCallback: function (row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        },


    });

    $('#tabelOpQr').DataTable({
        processing: true,
        serverSide: true,

        destroy: true,
        "bPaginate": false,
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": true,
        "bAutoWidth": true,
        "columnDefs": [{
            "visible": false,

        }],
        "order": [
            [0, 'asc']
        ],

        "language": {
            "lengthMenu": "Tampilkan _MENU_ item per halaman",
            "zeroRecords": "Tidak ada data yang ditampilkan",
            "info": "Menampilkan Halaman _PAGE_ dari _PAGES_",
            "infoEmpty": "Tidak ada data yang ditampilkan",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search": "Cari ",
            "paginate": {
                "first": "Awal",
                "last": "Akhir",
                "next": "Selanjutnya",
                "previous": "Sebelumnya"
            },
        },
        "displayLength": 25,
        "ajax": {

            "url": BASE_URL + "admin/json_op_qr",
            // "dataSrc": "data",
            // "dataType": "json",
        },
        "columns": [

            {
                "orderable": false,
                "data": function (data,) {
                    return '<div class="text-left">' + data[0] + '</div>'

                }
            },
            {
                "orderable": false,
                "data": function (data,) {
                    return '<div class="text-left">' + data[1] + '</div>'

                }
            },
            {
                "orderable": false,
                "data": function (data,) {
                    return '<div class="text-left">' + data[2] + '</div>'

                }
            },
            {
                "orderable": false,
                "data": function (data,) {
                    return '<div class="text-left">' + data[10] + '</div>'

                }
            },

            {

                "orderable": false,
                "data": function (data,) {
                    return '<div class="text-center">' +
                        '<a  onclick="editOpQr(this)" data-id="' + data[0] + '" class="btn  btn-outline-primary" title="Edit"><em class="icon ni ni-edit-alt"></em></a>&nbsp;' +
                        '<a  onclick="resPassOpQr(this)" data-id="' + data[0] + '" class="btn  btn-outline-secondary" title="Reset Password"><em class="icon ni ni-lock"></em></a>&nbsp;' +
                        '<a  onclick="delOpQr(this)" data-id="' + data[0] + '" class="btn btn-dim  btn-outline-danger" title="Hapus"><em class="icon ni ni-trash"></em></a>&nbsp;' +
                        '</div>'
                }
            },


        ],
        rowCallback: function (row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        },


    });
})


///UNIT
function tambahUnit() {
    $('#modalTambahUnit').modal('show');
}

$('#formTambahUnit').on('submit', function (e) {
    var postData = new FormData($("#formTambahUnit")[0]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "admin/tambah_unit",
        processData: false,
        contentType: false,
        data: postData,
        dataType: "JSON",
        success: function (data) {


            if (data.success == false) {
                toastr.clear();
                if (data.nm_unit_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.nm_unit_error + '</p>', 'error');
                }

                if (data.latt_error) {
                    NioApp.Toast('<h5>Gagal Tambah Data</h5><p class="text-danger">' + data.latt_error + '</p>', 'error');
                }
                if (data.long_error) {
                    NioApp.Toast('<h5>Gagal Tambah Data</h5><p class="text-danger">' + data.long_error + '</p>', 'error');
                }
            } else if (data.success == true) {

                Swal.fire('Berhasil Tambah Data!', 'Data telah ditambah.', 'success');
                $('#modalTambahUnit').modal('hide');
                $('#TabelUnit').DataTable().ajax.reload(null, false);
            }

        },

    })
    return false;
});

function editUnit(elem) {
    var id = $(elem).data("id");
    // console.log(id)
    $('#modalEditUnit').modal('show');
    $('#id_unit').val(id)

    $.ajax({
        type: "get",
        "url": BASE_URL + "admin/get_unit/" + id,

        contentType: false,
        dataType: "JSON",
        async: true,

        success: function (data) {
            console.log(data.nm_unit)
            $('#nm_unit_edit').val(data.nm_unit)
            $('#lat_edit').val(data.lat)
            $('#long_edit').val(data.long)
            $('#radius_edit').val(data.radius)
        },
    })
    return false;


}

$('#formEditUnit').on('submit', function (e) {
    var id = $('#id_unit').val()
    var postData = new FormData($("#formEditUnit")[0]);
    $.ajax({
        type: "POST",
        "url": BASE_URL + "admin/update_unit",
        processData: false,
        contentType: false,
        data: postData,
        dataType: "JSON",
        success: function (data) {


            if (data.success == false) {
                toastr.clear();
                if (data.nm_unit_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.nm_unit_error + '</p>', 'error');
                }
                if (data.latt_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.latt_error + '</p>', 'error');
                }
                if (data.long_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.long_error + '</p>', 'error');
                }
            } else if (data.success == true) {
                toastr.clear();
                Swal.fire('Berhasil Ubah Data!', 'Data telah diubah.', 'success');
                $('#modalEditUnit').modal('hide');
                $('#TabelUnit').DataTable().ajax.reload(null, false);
            }

        },

    })
    return false;
});

function delUnit(elem) {
    var id = $(elem).data("id");
    Swal.fire({
        title: 'Apakah anda yakin??',
        text: "Anda tidak akan dapat mengembalikan ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!'
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: BASE_URL + 'admin/del_unit/' + id,
                type: "POST",
                data: {

                    id: id,

                },
                success: function () {
                    Swal.fire('Terhapus!', 'Data Anda telah dihapus.', 'success');
                    $('#TabelUnit').DataTable().ajax.reload(null, false);
                },
                error: function () {
                    Swal.fire('Gagal!', 'Data Anda gagal dihapus.', 'warning');

                }
            });

        }
    });
}

//Administrator
function tambahAdminSkpd() {
    $('#modalTambahAdministrator').modal('show');
}

$('#formTambahAdm').on('submit', function (e) {
    var postData = new FormData($("#formTambahAdm")[0]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "admin/tambah_adm",
        processData: false,
        contentType: false,
        data: postData,
        dataType: "JSON",
        success: function (data) {
            if (data.success == false) {
                toastr.clear();
                if (data.username_adm_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.username_adm_error + '</p>', 'error');
                }
                if (data.nama_adm_error) {
                    NioApp.Toast('<h5>Gagal Tambah Data</h5><p class="text-danger">' + data.nama_adm_error + '</p>', 'error');
                }
                if (data.id_unit_error) {
                    NioApp.Toast('<h5>Gagal Tambah Data</h5><p class="text-danger">' + data.id_unit_error + '</p>', 'error');
                }
            } else if (data.success == true) {
                Swal.fire('Berhasil Tambah Data!', 'Data telah ditambah.', 'success');

                $('#modalTambahAdministrator').modal('hide');
                $('#tabelAdministrator').DataTable().ajax.reload(null, false);
            }

        },

    })
    return false;
});

function editAdm(elem) {
    var id = $(elem).data("id");
    // console.log(id)
    $('#modalEditAdm').modal('show');
    $('#id_user_adm').val(id)

    $.ajax({
        type: "get",
        "url": BASE_URL + "admin/get_adm/" + id,

        contentType: false,
        dataType: "JSON",
        async: true,

        success: function (data) {
            console.log(data.nm_unit)
            $('#username_adm_edit').val(data.username)
            $('#nama_adm_edit').val(data.nama)
            $('#id_unit_adm_edit').val(data.id_unit)

        },
    })
    return false;


}

$('#formEditAdm').on('submit', function (e) {
    var id = $('#id_user_adm').val()
    var postData = new FormData($("#formEditAdm")[0]);
    $.ajax({
        type: "POST",
        "url": BASE_URL + "admin/update_adm",
        processData: false,
        contentType: false,
        data: postData,
        dataType: "JSON",
        success: function (data) {


            if (data.success == false) {
                toastr.clear();
                if (data.username_adm_error_edit) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.username_adm_error_edit + '</p>', 'error');
                }
                if (data.nama_adm_error_edit) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.nama_adm_error_edit + '</p>', 'error');
                }
                if (data.id_unit_error_edit) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.id_unit_error_edit + '</p>', 'error');
                }

            } else if (data.success == true) {
                Swal.fire('Berhasil Ubah Data!', 'Data telah diubah.', 'success');
                $('#modalEditAdm').modal('hide');
                $('#tabelAdministrator').DataTable().ajax.reload(null, false);
            }

        },

    })
    return false;
});


//Operator QR
function tambahOpQr() {
    $('#modalTambahOpQr').modal('show');
}

$('#formTambahOpQr').on('submit', function (e) {
    var postData = new FormData($("#formTambahOpQr")[0]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "admin/tambah_op_qr",
        processData: false,
        contentType: false,
        data: postData,
        dataType: "JSON",
        success: function (data) {
            if (data.success == false) {
                toastr.clear();
                if (data.username_adm_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.username_adm_error + '</p>', 'error');
                }
                if (data.nama_adm_error) {
                    NioApp.Toast('<h5>Gagal Tambah Data</h5><p class="text-danger">' + data.nama_adm_error + '</p>', 'error');
                }
                if (data.id_unit_error) {
                    NioApp.Toast('<h5>Gagal Tambah Data</h5><p class="text-danger">' + data.id_unit_error + '</p>', 'error');
                }
            } else if (data.success == true) {
                Swal.fire('Berhasil Tambah Data!', 'Data telah ditambah.', 'success');

                $('#modalTambahOpQr').modal('hide');
                $('#tabelOpQr').DataTable().ajax.reload(null, false);
            }

        },

    })
    return false;
});

function editOpQr(elem) {
    var id = $(elem).data("id");
    // console.log(id)
    $('#modalEditOpQq').modal('show');
    $('#id_user_op_qr_edit').val(id)

    $.ajax({
        type: "get",
        "url": BASE_URL + "admin/get_op_qr/" + id,

        contentType: false,
        dataType: "JSON",
        async: true,

        success: function (data) {
            console.log(data.nm_unit)
            $('#username_op_qr_edit').val(data.username)
            $('#nama_op_qr_edit').val(data.nama)
            $('#id_unit_op_qr_edit').val(data.id_unit)

        },
    })
    return false;


}

$('#formEditOpQr').on('submit', function (e) {
    var id = $('#id_user_op_qr_edit').val()
    var postData = new FormData($("#formEditOpQr")[0]);
    $.ajax({
        type: "POST",
        "url": BASE_URL + "admin/update_op_qr",
        processData: false,
        contentType: false,
        data: postData,
        dataType: "JSON",
        success: function (data) {


            if (data.success == false) {
                toastr.clear();
                if (data.username_op_qr_error_edit) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.username_op_qr_error_edit + '</p>', 'error');
                }
                if (data.nama_op_qr_error_edit) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.nama_op_qr_error_edit + '</p>', 'error');
                }
                if (data.id_unit_error_edit) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.id_unit_error_edit + '</p>', 'error');
                }

            } else if (data.success == true) {
                Swal.fire('Berhasil Ubah Data!', 'Data telah diubah.', 'success');
                $('#modalEditOpQq').modal('hide');
                $('#tabelOpQr').DataTable().ajax.reload(null, false);
            }

        },

    })
    return false;
});
