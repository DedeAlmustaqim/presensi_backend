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

    var id_unit_skpd = $('#id_unit_skpd').val()
    var id_unit_jadwal = $('#id_unit_jadwal').val()

    if (id_unit_skpd != null) {
        getSkpd(id_unit_skpd)
    }


    if (id_unit_jadwal != null) {
        getJadwal(id_unit_jadwal)
    }

    $('.timepicker-digitalNative').timepicker({
        use24hours: true,
        timeFormat: 'HH:mm',
        interval: 15,
        dropdown: true

    });

    $('#tabelPegawai').DataTable({
        processing: true,
        serverSide: true,

        destroy: true,
        "bPaginate": true,
        "bLengthChange": false,
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
            "search": "Cari",
            "paginate": {
                "first": "Awal",
                "last": "Akhir",
                "next": "Selanjutnya",
                "previous": "Sebelumnya"
            },
        },
        "displayLength": 25,
        "ajax": {
            "url": BASE_URL + "skpd/json_pegawai",
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
                    return '<div class="text-left">' + data[7] + '</div>'

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
                    return '<div class="text-left">' + data[4] + '</div>'

                }
            },

            {

                "orderable": false,
                "data": function (data,) {
                    return '<div class="text-center">' +
                        '<a title="Edit"  onclick="editPeg(this)" data-id="' + data[6] + '" class="btn btn-outline-primary"><em class="icon ni ni-edit-alt"></em></a>&nbsp;' +
                        '<a title="Reset Password" onclick="resPassPeg(this)" data-id="' + data[6] + '" class="btn btn-outline-primary"><em class="icon ni ni-unlock-fill"></em></a>&nbsp;' +
                        '<a title="Perangkat" onclick="devPeg(this)" data-id="' + data[6] + '" class="btn btn-outline-primary"><em class="icon ni ni-mobile"></em></a>&nbsp;' +
                        '<a  onclick="delPeg(this)" data-id="' + data[6] + '" class="btn btn-dim btn-outline-danger"><em class="icon ni ni-trash"></em></a>&nbsp;' +
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

function getSkpd(id_unit_skpd) {
    $.ajax({
        type: "get",
        "url": BASE_URL + "skpd/get_unit/" + id_unit_skpd,

        contentType: false,
        dataType: "JSON",
        async: true,

        success: function (data) {
            $('#nm_unit_skpd').val(data.nm_unit)
            $('#pimpinan_skpd').val(data.pimpinan)
            $('#lat_skpd').val(data.lat)
            $('#long_skpd').val(data.long)
            $('#gol_skpd').val(data.gol)
            $('#radius_skpd').val(data.radius)
            $('#jabatan_skpd').val(data.jabatan)
        },
    })
}

function getJadwal(id_unit_jadwal) {
    $.ajax({
        type: "get",
        "url": BASE_URL + "skpd/get_jadwal/" + id_unit_jadwal,
        contentType: false,
        dataType: "JSON",
        async: true,
        success: function (data) {

            $('#qr_time_in_start').val(data.qr_time_in_start)
            $('#qr_time_in_end').val(data.qr_time_in_end)
            $('#qr_time_out_start').val(data.qr_time_out_start)
            $('#qr_time_out_end').val(data.qr_time_out_end)
        },
    })
}

$('#formEditUnitSkpd').on('submit', function (e) {
    var id = $('#id_unit_skpd').val()
    var postData = new FormData($("#formEditUnitSkpd")[0]);
    $.ajax({
        type: "POST",
        "url": BASE_URL + "skpd/update_unit",
        processData: false,
        contentType: false,
        data: postData,
        dataType: "JSON",
        success: function (data) {


            if (data.success == false) {
                toastr.clear();
                if (data.nm_unit_skpd_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.nm_unit_skpd_error + '</p>', 'error');
                }
                if (data.pimpinan_skpd_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.pimpinan_skpd_error + '</p>', 'error');
                }
                if (data.gol_skpd_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.gol_skpd_error + '</p>', 'error');
                }
                if (data.jabatan_skpd_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.jabatan_skpd_error + '</p>', 'error');
                }
                if (data.lat_skpd_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.lat_skpd_error + '</p>', 'error');
                }
                if (data.long_skpd_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.long_skpd_error + '</p>', 'error');
                }
                if (data.radius_skpd_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.radius_skpd_error + '</p>', 'error');
                }
            } else if (data.success == true) {
                Swal.fire('Berhasil Ubah Data!', 'Data telah diubah.', 'success');
                getSkpd(id)
            }

        },

    })
    return false;
});

$('#formEditJadwalQr').on('submit', function (e) {
    var id = $('#id_unit_jadwal').val()
    var postData = new FormData($("#formEditJadwalQr")[0]);
    $.ajax({
        type: "POST",
        "url": BASE_URL + "skpd/update_jadwal",
        processData: false,
        contentType: false,
        data: postData,
        dataType: "JSON",
        success: function (data) {


            if (data.success == false) {
                toastr.clear();
                if (data.qr_time_in_start_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.qr_time_in_start_error + '</p>', 'error');
                }
                if (data.qr_time_in_end_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.qr_time_in_end_error + '</p>', 'error');
                }
                if (data.qr_time_out_start_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.qr_time_out_start_error + '</p>', 'error');
                }
                if (data.qr_time_out_end_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.qr_time_out_end_error + '</p>', 'error');
                }

            } else if (data.success == true) {
                Swal.fire('Berhasil Ubah Data!', 'Data telah diubah.', 'success');
                getJadwal(id)
            }

        },

    })
    return false;
});

function tambahPeg() {
    $('#modalTambahPeg').modal('show');
}

$('#formTambahPeg').on('submit', function (e) {
    var postData = new FormData($("#formTambahPeg")[0]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "skpd/tambah_peg",
        processData: false,
        contentType: false,
        data: postData,
        dataType: "JSON",
        success: function (data) {


            if (data.success == false) {
                toastr.clear();
                if (data.username_peg_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.username_peg_error + '</p>', 'error');
                }

                if (data.nama_peg_error) {
                    NioApp.Toast('<h5>Gagal Tambah Data</h5><p class="text-danger">' + data.nama_peg_error + '</p>', 'error');
                }
                if (data.nip_peg_error) {
                    NioApp.Toast('<h5>Gagal Tambah Data</h5><p class="text-danger">' + data.nip_peg_error + '</p>', 'error');
                }
                if (data.jabatan_peg_error) {
                    NioApp.Toast('<h5>Gagal Tambah Data</h5><p class="text-danger">' + data.jabatan_peg_error + '</p>', 'error');
                }
            } else if (data.success == true) {

                Swal.fire('Berhasil Tambah Data!', 'Data telah ditambah.', 'success');
                $('#modalTambahPeg').modal('hide');
                $('#tabelPegawai').DataTable().ajax.reload(null, false);
            }

        },

    })
    return false;
});

function delPeg(elem) {
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
                url: BASE_URL + 'skpd/del_peg/' + id,
                type: "POST",
                data: {

                    id: id,

                },
                success: function (data) {
                    Swal.fire('Terhapus!', 'Data Anda telah dihapus.', 'success');
                    $('#tabelPegawai').DataTable().ajax.reload(null, false);
                },
                error: function () {

                    Swal.fire('Gagal!', 'Terjadi kesalahan .', 'error');
                }
            });

        }
    });
}

function editPeg(elem) {
    var id = $(elem).data("id");
    // console.log(id)
    $('#modalEditPeg').modal('show');
    $('#id_user_peg').val(id)

    $.ajax({
        type: "get",
        "url": BASE_URL + "skpd/get_peg/" + id,

        contentType: false,
        dataType: "JSON",
        async: true,

        success: function (data) {

            $('#username_peg_edit').val(data.username)
            $('#nama_peg_edit').val(data.nama)
            $('#nip_peg_edit').val(data.nip)
            $('#jabatan_peg_edit').val(data.jabatan)
        },
    })
    return false;
}

$('#formEditPeg').on('submit', function (e) {
    var id = $('#id_user_peg').val()
    var postData = new FormData($("#formEditPeg")[0]);
    $.ajax({
        type: "POST",
        "url": BASE_URL + "skpd/update_peg",
        processData: false,
        contentType: false,
        data: postData,
        dataType: "JSON",
        success: function (data) {


            if (data.success == false) {
                toastr.clear();
                if (data.username_peg_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.username_peg_error + '</p>', 'error');
                }
                if (data.nama_peg_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.nama_peg_error + '</p>', 'error');
                }
                if (data.nip_peg_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.nip_peg_error + '</p>', 'error');
                }
                if (data.jabatan_peg_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.jabatan_peg_error + '</p>', 'error');
                }

            } else if (data.success == true) {
                Swal.fire('Berhasil Ubah Data!', 'Data telah diubah.', 'success');
                $('#tabelPegawai').DataTable().ajax.reload(null, false);
                $('#modalEditPeg').modal('hide');
            }

        },

    })
    return false;
});

function resPassPeg(elem) {
    var id = $(elem).data("id");
    Swal.fire({
        title: 'Apakah anda yakin??',
        text: "Tanyakan kepada Developer untuk mengetahui Default Password Pegawai ",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Reset!'
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: BASE_URL + 'skpd/ress_pass/' + id,
                type: "POST",
                data: {

                    id: id,

                },
                success: function (data) {
                    Swal.fire('Berhasil!', 'Password telah di reset.', 'success');
                },
                error: function () {

                    Swal.fire('Gagal!', 'Terjadi kesalahan .', 'error');
                }
            });

        }
    });
}

function devPeg(elem) {
    var id = $(elem).data("id");
    // console.log(id)
    $('#modalDevPeg').modal('show');
    $('#id_user_dev_peg').val(id)
    getDevPeg(id)

}
function getDevPeg(id) {
    $.ajax({
        type: "get",
        "url": BASE_URL + "skpd/get_peg/" + id,

        contentType: false,
        dataType: "JSON",
        async: true,

        success: function (data) {
            document.getElementById('nm_peg').innerHTML = data.nama
            document.getElementById('modelName').innerHTML = data.modelName
            document.getElementById('deviceName').innerHTML = data.deviceName
            document.getElementById('manufacturerName').innerHTML = data.manufacturerName
            document.getElementById('productName').innerHTML = data.productName
            document.getElementById('btnResDev').innerHTML = '&nbsp;<a onclick="resDevPeg(this)" data-id="' + data.id_user + '" class="btn btn-primary">Reset Perangkat</a>&nbsp<a data-bs-dismiss="modal" class="btn btn-danger">Tutup</a>'

        },
    })
    return false;
}

function resDevPeg(elem) {
    var id = $(elem).data("id");
    Swal.fire({
        title: 'Apakah anda yakin??',
        text: "Reset Data Perangkat Pegawai",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Reset!'
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: BASE_URL + 'skpd/res_dev/' + id,
                type: "POST",
                data: {

                    id: id,

                },
                success: function (data) {
                    Swal.fire('Berhasil!', 'Perangkat di reset.', 'success');
                    getDevPeg(id)
                },
                error: function () {

                    Swal.fire('Gagal!', 'Terjadi kesalahan .', 'error');
                }
            });

        }
    });
}
