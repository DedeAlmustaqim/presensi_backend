$(document).ready(function () {

    $('#skpd_adm').change(function () {
        var id = $(this).val();

        $.ajax({
            type: "get",
            "url": BASE_URL + "admin/get_user_dropdwon/" + id,
            processData: false,
            contentType: false,

            dataType: "JSON",
            success: function (data) {
                $('#user_adm').empty(); // Mengosongkan opsi sebelum menambahkan opsi baru
                $.each(data, function (key, value) {
                    $('#user_adm').append('<option value="' + value.id + '">' + value.name + '</option>'); // Menambahkan opsi baru
                });
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText); // Menampilkan pesan error jika terjadi kesalahan
            }

        })
        showAbsensi()
    });


    $('#tahun_adm').change(function () {
        showAbsensi()
    });
    $('#bulan_adm').change(function () {
        showAbsensi()
    });
    $('#user_adm').change(function () {
        showAbsensi()

    });


    $('#id_unit_rekap_adm').change(function () {


        showRekap()

    });
    $('#tahun_tpp_adm').change(function () {


        showRekap()

    });
    $('#bulan_tpp_adm').change(function () {


        showRekap()

    });


    getConfig()



    $('#id_unit_user').change(function () {
        var id_unit = $(this).val();

        show_tabel_user(id_unit)
    });

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
                    return '<div class="text-left">' + data[8] + '</div>'

                }
            },
            {
                "orderable": false,
                "data": function (data,) {
                    return '<div class="text-left">' + data[9] + '</div>'

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
                        '<a  onclick="resetAdm(this)" data-id="' + data[0] + '" class="btn  btn-secondary">Reset Password</a>&nbsp;' +
                        '<a  onclick="devPorgress(this)" data-id="' + data[0] + '" class="btn btn-dim  btn-outline-danger">Hapus</a>&nbsp;' +
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
                        '<a  onclick="resetOp(this)" data-id="' + data[0] + '" class="btn  btn-outline-secondary" title="Reset Password"><em class="icon ni ni-lock"></em></a>&nbsp;' +
                        '<a  onclick="devProgress(this)" data-id="' + data[0] + '" class="btn btn-dim  btn-outline-danger" title="Hapus"><em class="icon ni ni-trash"></em></a>&nbsp;' +
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

    $('#TabelBanner').DataTable({
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

            "url": BASE_URL + "admin/json_banner",
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
                    return '<div class="text-left"><img height="150" src="' + data[2] + '"></div>'

                }
            },


            {

                "orderable": false,
                "data": function (data,) {
                    return '<div class="text-center">' +
                        '<a  onclick="delBanner(this)" data-id="' + data[0] + '" class="btn btn-dim  btn-outline-danger" title="Hapus"><em class="icon ni ni-trash"></em>Hapus</a>&nbsp;' +
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

    $('#TabelNotif').DataTable({
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

            "url": BASE_URL + "admin/json_notif",
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
                    return '<div class="text-center">' +
                        '<a  onclick="editNotif(this)" data-id="' + data[0] + '" class="btn btn-dim  btn-outline-primary" title="Hapus"><em class="icon ni ni-edit-alt"></em> Edit</a>&nbsp;' +
                        '<a  onclick="delNotif(this)" data-id="' + data[0] + '" class="btn btn-dim  btn-outline-danger" title="Hapus"><em class="icon ni ni-trash"></em> Hapus</a>&nbsp;' +
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

    $('#TabelDatetoSkip').DataTable({
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

            "url": BASE_URL + "admin/json_date_to_skip",
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
                    if (akses == 1) {
                        return '<div class="text-center">' +
                            '<a  onclick="editDatetoSkip(this)" data-id="' + data[0] + '" data-tlg=' + data[1] + ' data-ket=' + data[2] + ' class="btn btn-dim  btn-outline-primary" title="Hapus"><em class="icon ni ni-edit-alt"></em> Edit</a>&nbsp;' +
                            '<a  onclick="delDatetoSkip(this)" data-id="' + data[0] + '" class="btn btn-dim  btn-outline-danger" title="Hapus"><em class="icon ni ni-trash"></em> Hapus</a>&nbsp;' +
                            '</div>'
                    } else {
                        return '<div class="text-center">' +
                            '-'
                        '</div>'
                    }

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

    $('#TabelLogger').DataTable({
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

            "url": BASE_URL + "admin/json_logger",
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
                    return '<div class="text-left">' + data[3] + '</div>'

                }
            },
            {
                "orderable": false,
                "data": function (data,) {
                    return '<div class="text-left">' + data[4] + '</div>'

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

function showAbsensi() {
    var id_unit = $('#skpd_adm').val()
    var id_user_absen = $('#user_adm').val()
    var tahun_absen = $('#tahun_adm').val()
    var bulan_absen = $('#bulan_adm').val()

    toastr.clear();
    if (id_unit == "") {
        NioApp.Toast('<h5>SKPD tidak boleh kosong</h5><p class="text-danger"></p>', 'error');
    }
    if (tahun_absen == "") {
        NioApp.Toast('<h5>Tahun tidak boleh kosong</h5><p class="text-danger"></p>', 'error');
    }
    else if (bulan_absen == "") {
        NioApp.Toast('<h5>Bulan tidak boleh kosong</h5><p class="text-danger"></p>', 'error');
    }
    else if (id_user_absen == "") {
        NioApp.Toast('<h5>Pegawai tidak boleh kosong</h5><p class="text-danger"></p>', 'error');
    } else {

        $.ajax({
            type: "GET",
            "url": BASE_URL + "admin/get_upacara/" + id_user_absen + "/" + bulan_absen + "/" + tahun_absen,
            processData: false,
            contentType: false,

            dataType: "JSON",
            success: function (data) {
                $('#keg_upacara_adm').val(data.keg)


            },

        })
        $.ajax({
            type: "GET",
            "url": BASE_URL + "admin/get_subtraction/" + id_user_absen,
            processData: false,
            contentType: false,

            dataType: "JSON",
            success: function (data) {
                $('#lhkpn_lhasn_adm').val(data.lhkpn_lhasn)
                $('#tptgr_adm').val(data.tptgr)


            },

        })
        document.getElementById('btn_cetak_tpp').innerHTML = '<a target="_blank"  href="' + BASE_URL + 'rekapitulasi/view_absen_tpp/' + id_user_absen + '/' + bulan_absen + '/' + tahun_absen + '" class="btn btn-secondary">Lihat Skor Disiplin</a>'

        $('#tabelAbsenPegawaiAdmin').DataTable({
            processing: true,
            serverSide: true,

            destroy: true,
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
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
            "displayLength": 100,
            "ajax": {
                "url": BASE_URL + "admin/json_absensi/" + id_user_absen + "/" + id_unit + "/" + tahun_absen + "/" + bulan_absen,
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
                        if (data[3] == null) {
                            return '<div class="text-center">-</div>'
                        } else {
                            // Tanggal dan waktu dalam format "YYYY-MM-DD HH:MM:SS"
                            var dateTimeString = data[3];

                            // Parse string tanggal dan waktu
                            var dateTime = new Date(dateTimeString);

                            // Fungsi untuk menambahkan nol di depan angka tunggal
                            function addLeadingZero(number) {
                                return number < 10 ? "0" + number : number;
                            }

                            // Format tanggal dalam format "DD-MM-YYYY HH:MM:SS"
                            var formattedDateTime = addLeadingZero(dateTime.getDate()) + "-" +
                                addLeadingZero(dateTime.getMonth() + 1) + "-" +
                                dateTime.getFullYear();
                            return '<div class="text-center">' + formattedDateTime + '</div>'
                        }

                    }
                },
                {
                    "orderable": false,
                    "data": function (data,) {
                        if (data[4] == null) {
                            return '<div class="text-center">-</div>'
                        } else {
                            return '<div class="text-center">' + data[4] + '</div>'
                        }


                    }
                },
                {
                    "orderable": false,
                    "data": function (data,) {
                        if (data[5] == null) {
                            return '<div class="text-center">-</div>'
                        } else {
                            return '<div class="text-center">' + data[5] + '</div>'
                        }


                    }
                },
                {
                    "orderable": false,
                    "data": function (data,) {
                        if (data[6] == null) {
                            return '<div class="text-center">-</div>'
                        } else {
                            // Tanggal dan waktu dalam format "YYYY-MM-DD HH:MM:SS"
                            var dateTimeString = data[6];
                            // Parse string tanggal dan waktu
                            var dateTime = new Date(dateTimeString);

                            // Fungsi untuk menambahkan nol di depan angka tunggal
                            function addLeadingZero(number) {
                                return number < 10 ? "0" + number : number;
                            }

                            // Format tanggal dalam format "DD-MM-YYYY HH:MM:SS"
                            var formattedDateTime = addLeadingZero(dateTime.getDate()) + "-" +
                                addLeadingZero(dateTime.getMonth() + 1) + "-" +
                                dateTime.getFullYear();
                            return '<div class="text-center">' + formattedDateTime + '</div>'

                        }

                    }
                },
                {
                    "orderable": false,
                    "data": function (data,) {
                        if (data[7] == null) {
                            return '<div class="text-center">-</div>'
                        } else {
                            return '<div class="text-center">' + data[7] + '</div>'
                        }


                    }
                },
                {
                    "orderable": false,
                    "data": function (data,) {
                        if (data[8] == null) {
                            return '<div class="text-center">-</div>'
                        } else {
                            return '<div class="text-center">' + data[8] + '</div>'
                        }


                    }
                },

                {

                    "orderable": false,
                    "data": function (data,) {
                        return '<div class="dropdown">'
                            + '<a href="#" class="btn btn-outline-secondary" data-bs-toggle="dropdown" aria-expanded="false"><span>Aksi</span><em class="icon ni ni-chevron-down"></em></a>'
                            + '<div class="dropdown-menu  mt-1" style="">'
                            + '<ul class="link-list-plain">'
                            + '<li><a style="cursor: pointer;" data-id="' + data[2] + '" data-date="' + data[9] + '" onclick="viewKeterangan(this)">Lihat Keterangan</a></li>'
                            + '</ul>'
                            + '</div>'
                            + '</div>'
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
    }

}

function show_tabel_user(id_unit) {
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
    $('#TabelUser').DataTable({
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
        "displayLength": 100,
        "ajax": {

            "url": BASE_URL + "admin/json_user/" + id_unit,
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
                    return '<div class="text-left">' + data[9] + '</div>'
                    // return '<img src="' + data[12] + '" height="200">'

                }
            },
            {
                "orderable": false,
                "data": function (data,) {
                    return '<div class="text-left">' + data[11] + '</div>'

                }
            },

            {

                "orderable": false,
                "data": function (data,) {
                    if (akses == 1) {
                        return '<div class="text-center">' +
                            '<a  onclick="detailPeg(this)" data-id="' + data[0] + '" class="btn  btn-outline-primary" title="Detail"><em class="icon ni ni-eye"></em></a>&nbsp;' +
                            '<a  onclick="devProgress(this)" data-id="' + data[0] + '" class="btn  btn-outline-primary" title="Edit"><em class="icon ni ni-edit-alt"></em></a>&nbsp;' +
                            '<a  onclick="devProgress(this)" data-id="' + data[0] + '" class="btn btn-dim  btn-outline-danger" title="Hapus"><em class="icon ni ni-trash"></em></a>&nbsp;' +
                            '</div>'
                    } else {
                        return '<div class="text-center">' +
                            '<a  onclick="detailPeg(this)" data-id="' + data[0] + '" class="btn  btn-outline-primary" title="Detail"><em class="icon ni ni-eye"></em></a>&nbsp;' +
                            '</div>'
                    }

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
}

function getConfig() {
    $.ajax({
        type: "get",
        "url": BASE_URL + "admin/get_config/",

        contentType: false,
        dataType: "JSON",
        async: true,

        success: function (data) {
            $('#nm_pemda').val(data.nm_pemda)
            $('#jam_masuk').val(data.jam_masuk)
            $('#jam_pulang').val(data.jam_pulang)
            $('#qr_time_in_start').val(data.qr_time_in_start)
            $('#qr_time_in_end').val(data.qr_time_in_end)
            $('#qr_time_out_start').val(data.qr_time_out_start)
            $('#qr_time_out_end').val(data.qr_time_out_end)
            $('#radius_config').val(data.radius)
            $('#versi_apk').val(data.versi_apk)

        },
    })
}
///UNIT
function tambahUnit() {
    $('#modalTambahUnit').modal('show');
}

function tambahBanner() {
    $('#modalTambahBanner').modal('show');
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
    $('#id_unit_skpd_edit').val(id)

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
            $('#jam_masuk_edit').val(data.jam_masuk)
            $('#jam_pulang_edit').val(data.jam_pulang)
            $('#h_kerja_edit').val(data.hari_kerja)

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
                if (data.lat_edit_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.lat_edit_error + '</p>', 'error');
                }
                if (data.long_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.long_error + '</p>', 'error');
                }
                if (data.jam_masuk_edit_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.jam_masuk_edit_error + '</p>', 'error');
                }
                if (data.jam_pulang_edit_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.jam_pulang_edit_error + '</p>', 'error');
                } if (data.h_kerja_edit_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.h_kerja_edit_error + '</p>', 'error');
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
        text: "Anda tidak akan dapat mengembalikan ini!, Menghapus SKPD juga akan menghapus semua Pegawainya",
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


function resetAdm(elem) {
    var id = $(elem).data("id");
    Swal.fire({
        title: 'Apakah anda yakin??',
        text: "Reset Password Admin SKPD menjadi default 'adminSKPD6213'",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Reset Password!'
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: BASE_URL + 'admin/reset_adm/' + id,
                type: "POST",
                data: {

                    id: id,

                },
                success: function () {
                    Swal.fire('Berhasil!', 'Password di reset "adminSKPD6213".', 'success');
                    $('#TabelUnit').DataTable().ajax.reload(null, false);
                },
                error: function () {
                    Swal.fire('Gagal!', '.', 'warning');

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

function resetOp(elem) {
    var id = $(elem).data("id");
    Swal.fire({
        title: 'Apakah anda yakin??',
        text: "Reset Password Admin SKPD menjadi default 'operatorQR6213'",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Reset Password!'
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: BASE_URL + 'admin/reset_op/' + id,
                type: "POST",
                data: {

                    id: id,

                },
                success: function () {
                    Swal.fire('Berhasil!', 'Password di reset "operatorQR6213".', 'success');
                    $('#TabelUnit').DataTable().ajax.reload(null, false);
                },
                error: function () {
                    Swal.fire('Gagal!', '.', 'warning');

                }
            });

        }
    });
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

function devProgress() {
    Swal.fire('Lagi dalam pengembangan!', '.', 'warning');
}


//add Banner
function addBanner() {
    $('#modalTambahBanner').modal('show');
}
$('#formTambahBanner').on('submit', function (e) {
    var postData = new FormData($("#formTambahBanner")[0]);

    $.ajax({
        type: "post",
        "url": BASE_URL + "admin/add_banner",
        processData: false,
        contentType: false,
        data: postData,
        dataType: "JSON",
        success: function (data) {


            if (data.success == false) {
                if (data.status == 0) {
                    toastr.clear();
                    if (data.banner_title_error) {
                        NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.banner_title_error + '</p>', 'error');
                    }


                }
                if (data.status == 1) {
                    toastr.clear();
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">Judul sudah ada', 'error');


                } if (data.status == 2) {
                    toastr.clear();
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">', 'error');


                } if (data.status == 3) {
                    toastr.clear();
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">Format File Salah', 'error');


                }


            } else if (data.success == true) {

                Swal.fire({
                    icon: "success",
                    title: "Data ditambahkan",
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#modalTambahBanner').modal('hide');
                $('#TabelBanner').DataTable().ajax.reload(null, false);
                $('#formTambahBanner')[0].reset();

            }

        },

    })
    return false;
});
function delBanner(elem) {
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
                url: BASE_URL + 'admin/del_banner/' + id,
                type: "POST",
                data: {

                    id: id,

                },
                success: function () {
                    Swal.fire({
                        icon: "success",
                        title: "Data dihapus",
                        showConfirmButton: false,
                        timer: 1500
                    }); $('#TabelBanner').DataTable().ajax.reload(null, false);
                },
                error: function () {
                    Swal.fire('Gagal!', 'Data Anda gagal dihapus.', 'warning');

                }
            });

        }
    });
}

//notif
function addNotif() {
    $('#modalTambahNotif').modal('show');
}

$('#formTambahNotif').on('submit', function (e) {
    var postData = new FormData($("#formTambahNotif")[0]);

    $.ajax({
        type: "post",
        "url": BASE_URL + "admin/add_notif",
        processData: false,
        contentType: false,
        data: postData,
        dataType: "JSON",
        success: function (data) {


            if (data.success == false) {
                if (data.status == 0) {
                    toastr.clear();
                    if (data.notif_title_error) {
                        NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.notif_title_error + '</p>', 'error');
                    }
                }
                if (data.status == 0) {
                    toastr.clear();
                    if (data.notif_konten_error) {
                        NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.notif_konten_error + '</p>', 'error');
                    }
                }
                if (data.status == 0) {
                    toastr.clear();
                    if (data.notif_tag_error) {
                        NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.notif_tag_error + '</p>', 'error');
                    }
                }




            } else if (data.success == true) {

                Swal.fire({
                    icon: "success",
                    title: "Data ditambahkan",
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#modalTambahNotif').modal('hide');
                $('#TabelNotif').DataTable().ajax.reload(null, false);
                $('#formTambahNotif')[0].reset();

            }

        },

    })
    return false;
});

$('#formEditNotif').on('submit', function (e) {
    var postData = new FormData($("#formEditNotif")[0]);

    $.ajax({
        type: "post",
        "url": BASE_URL + "admin/update_notif",
        processData: false,
        contentType: false,
        data: postData,
        dataType: "JSON",
        success: function (data) {


            if (data.success == false) {
                if (data.status == 0) {
                    toastr.clear();
                    if (data.notif_title_edit_error) {
                        NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.notif_title_error + '</p>', 'error');
                    }
                }
                if (data.status == 0) {
                    toastr.clear();
                    if (data.notif_konten_edit_error) {
                        NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.notif_konten_error + '</p>', 'error');
                    }
                }
                if (data.status == 0) {
                    toastr.clear();
                    if (data.notif_tag_edit_error) {
                        NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.notif_tag_error + '</p>', 'error');
                    }
                }
            } else if (data.success == true) {

                Swal.fire({
                    icon: "success",
                    title: "Data ditambahkan",
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#modalEditNotif').modal('hide');
                $('#TabelNotif').DataTable().ajax.reload(null, false);
            }

        },

    })
    return false;
});


function editNotif(elem) {
    var id = $(elem).data("id");
    // console.log(id)
    $('#modalEditNotif').modal('show');
    $('#id_notif').val(id)

    $.ajax({
        type: "get",
        "url": BASE_URL + "admin/get_notif/" + id,

        contentType: false,
        dataType: "JSON",
        async: true,

        success: function (data) {

            $('#notif_title_edit').val(data.title)
            $('#notif_konten_edit').val(data.informasi)
            $('#notif_tag_edit').val(data.tag)

        },
    })
    return false;


}



function delNotif(elem) {
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
                url: BASE_URL + 'admin/del_notif/' + id,
                type: "POST",
                data: {

                    id: id,

                },
                success: function () {
                    Swal.fire({
                        icon: "success",
                        title: "Data dihapus",
                        showConfirmButton: false,
                        timer: 1500
                    }); $('#TabelNotif').DataTable().ajax.reload(null, false);
                },
                error: function () {
                    Swal.fire('Gagal!', 'Data Anda gagal dihapus.', 'warning');

                }
            });

        }
    });
}

$('#formConfig').on('submit', function (e) {
    var postData = new FormData($("#formConfig")[0]);

    $.ajax({
        type: "post",
        "url": BASE_URL + "admin/update_config",
        processData: false,
        contentType: false,
        data: postData,
        dataType: "JSON",
        success: function (data) {


            if (data.success == false) {
                if (data.status == 0) {
                    toastr.clear();
                    if (data.nm_pemda_error) {
                        NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.nm_pemda_error + '</p>', 'error');
                    }
                }
                if (data.status == 0) {
                    toastr.clear();
                    if (data.jam_masuk_error) {
                        NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.jam_masuk_error + '</p>', 'error');
                    }
                }
                if (data.status == 0) {
                    toastr.clear();
                    if (data.jam_pulang_error) {
                        NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.jam_pulang_error + '</p>', 'error');
                    }
                }
                if (data.status == 0) {
                    toastr.clear();
                    if (data.qr_time_in_start_error) {
                        NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.qr_time_in_start_error + '</p>', 'error');
                    }
                }
                if (data.status == 0) {
                    toastr.clear();
                    if (data.qr_time_in_end_error) {
                        NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.qr_time_in_end_error + '</p>', 'error');
                    }
                }
                if (data.status == 0) {
                    toastr.clear();
                    if (data.qr_time_out_start_error) {
                        NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.qr_time_out_start_error + '</p>', 'error');
                    }
                }
                if (data.status == 0) {
                    toastr.clear();
                    if (data.qr_time_out_end_error) {
                        NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.qr_time_out_end_error + '</p>', 'error');
                    }
                }
                if (data.status == 0) {
                    toastr.clear();
                    if (data.radius_config_error) {
                        NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.radius_config_error + '</p>', 'error');
                    }
                }

                if (data.status == 0) {
                    toastr.clear();
                    if (data.versi_apk_error) {
                        NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.versi_apk_error + '</p>', 'error');
                    }
                }






            } else if (data.success == true) {

                Swal.fire({
                    icon: "success",
                    title: "Data diupdate",
                    showConfirmButton: false,
                    timer: 1500
                });

                getConfig()


            }

        },

    })
    return false;
});

//date to skip
function addDateToSkip() {
    $('#modaladdDateToSkip').modal('show');
}

function editNotif(elem) {
    var id = $(elem).data("id");
    // console.log(id)
    $('#modalEditNotif').modal('show');
    $('#id_notif').val(id)

    $.ajax({
        type: "get",
        "url": BASE_URL + "admin/get_notif/" + id,

        contentType: false,
        dataType: "JSON",
        async: true,

        success: function (data) {

            $('#notif_title_edit').val(data.title)
            $('#notif_konten_edit').val(data.informasi)
            $('#notif_tag_edit').val(data.tag)

        },
    })
    return false;


}


$('#formaddDateToSkip').on('submit', function (e) {
    var postData = new FormData($("#formaddDateToSkip")[0]);

    $.ajax({
        type: "post",
        "url": BASE_URL + "admin/add_date_to_skip",
        processData: false,
        contentType: false,
        data: postData,
        dataType: "JSON",
        success: function (data) {


            if (data.success == false) {
                if (data.status == 0) {
                    toastr.clear();
                    if (data.date_to_skip_error) {
                        NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.date_to_skip_error + '</p>', 'error');
                    }
                }
                if (data.status == 0) {
                    toastr.clear();
                    if (data.ket_date_to_skip_error) {
                        NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.ket_date_to_skip_error + '</p>', 'error');
                    }
                }

            } else if (data.success == true) {

                Swal.fire({
                    icon: "success",
                    title: "Data diupdate",
                    showConfirmButton: false,
                    timer: 1500
                });

                $('#modaladdDateToSkip').modal('hide');
                $('#TabelDatetoSkip').DataTable().ajax.reload(null, false);
                $('#formaddDateToSkip')[0].reset();
            }

        },

    })
    return false;
});

function editDatetoSkip(elem) {
    var id = $(elem).data("id");
    var tgl = $(elem).data("tgl");
    var ket = $(elem).data("ket");
    $('#modalEditDate').modal('show');
    $('#id_date').val(id)
    $('#date_to_skip_edit').val(tgl)
    $('#ket_date_to_skip_edit').val(ket)

}

$('#formEditNotif').on('submit', function (e) {
    var postData = new FormData($("#formEditNotif")[0]);

    $.ajax({
        type: "post",
        "url": BASE_URL + "admin/update_notif",
        processData: false,
        contentType: false,
        data: postData,
        dataType: "JSON",
        success: function (data) {


            if (data.success == false) {
                if (data.status == 0) {
                    toastr.clear();
                    if (data.notif_title_edit_error) {
                        NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.notif_title_error + '</p>', 'error');
                    }
                }
                if (data.status == 0) {
                    toastr.clear();
                    if (data.notif_konten_edit_error) {
                        NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.notif_konten_error + '</p>', 'error');
                    }
                }
                if (data.status == 0) {
                    toastr.clear();
                    if (data.notif_tag_edit_error) {
                        NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.notif_tag_error + '</p>', 'error');
                    }
                }
            } else if (data.success == true) {

                Swal.fire({
                    icon: "success",
                    title: "Data ditambahkan",
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#modalEditNotif').modal('hide');
                $('#TabelNotif').DataTable().ajax.reload(null, false);
            }

        },

    })
    return false;
});

function detailPeg(elem) {
    var id = $(elem).data("id");


    $.ajax({
        type: "get",
        "url": BASE_URL + "admin/get_peg/" + id,
        contentType: false,
        dataType: "JSON",
        async: true,
        success: function (data) {
            $('#ModalPegDetail').modal('show');
            document.getElementById('showDetailPegAdmin').innerHTML = ' <div class="row">' +
                '<div class="row">' +
                '<div class="col-6">' +
                '<div class="card-inner-group">' +
                '<div class="card-inner">' +
                '<div class="user-card user-card-s2">' +
                '<img src="' + data.img + '" alt="" height="300">' +
                '<div class="user-info">' +
                '<h5>' + data.name + '</h5>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="col-6  bg-blue-dim">' +
                '<div class="card-inner">' +
                '<h6 class="overline-title mb-2">Detail</h6>' +
                '<div class="row g-3">' +
                '<div class="col-sm-6 col-md-4 col-lg-12">' +
                '<span class="sub-text">NIP :</span>' +
                '<span>' + data.nip + '</span>' +
                '</div>' +
                '<div class="col-sm-6 col-md-4 col-lg-12">' +
                '<span class="sub-text">Status Pegawai :</span>' +
                '<span>' + data.status_peg + '</span>' +
                '</div>' +
                '<div class="col-sm-6 col-md-4 col-lg-12">' +
                '<span class="sub-text">Jabatan :</span>' +
                '<span>' + data.jabatan + '</span>' +
                '</div>' +
                '<div class="col-sm-6 col-md-4 col-lg-12">' +
                '<span class="sub-text">Email:</span>' +
                '<span>' + data.email + '</span>' +
                '</div>' +

                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>'
        },
    })
}

function viewKeterangan(elem) {
    var id = $(elem).data("id");
    var date = $(elem).data("date");



    console.log(id)
    console.log(date)
    $('#modalKet').modal('show');
    $.ajax({
        type: "POST",
        "url": BASE_URL + "skpd/get_ket",

        data: {
            id: id,
            date: date
        },
        dataType: "JSON",
        success: function (data) {
            document.getElementById('tgl_in_off').innerHTML = data.tgl_in_off
            document.getElementById('no_surat_in').innerHTML = data.no_surat_in
            document.getElementById('ket_in').innerHTML = data.ket_in
            document.getElementById('tgl_out_off').innerHTML = data.tgl_out_off
            document.getElementById('no_surat_out').innerHTML = data.no_surat_out
            document.getElementById('ket_out').innerHTML = data.ket_out

            console.log(data)
        },

    })

}
$("#modalKet").on('hide.bs.modal', function (e) {
    document.getElementById('tgl_in_off').innerHTML = '';
    document.getElementById('no_surat_in').innerHTML = '';
    document.getElementById('ket_in').innerHTML = '';
    document.getElementById('tgl_out_off').innerHTML = '';
    document.getElementById('no_surat_out').innerHTML = '';
    document.getElementById('ket_out').innerHTML = '';
});

$('#tahun_absen').change(function () {


    showAbsensi()

});



function showRekap() {
    var id = $('#id_unit_rekap_adm').val()
    var tahun_tpp = $('#tahun_tpp_adm').val()
    var bulan_tpp = $('#bulan_tpp_adm').val()

    console.log(id)

    toastr.clear();
    if (id == "") {
        NioApp.Toast('<h5>SKPD tidak boleh Kosong</h5><p class="text-danger"></p>', 'error');
    }
    if (tahun_tpp == "") {
        NioApp.Toast('<h5>Tahun tidak boleh kosong</h5><p class="text-danger"></p>', 'error');
    }
    else if (bulan_tpp == "") {
        NioApp.Toast('<h5>Bulan tidak boleh kosong</h5><p class="text-danger"></p>', 'error');

    } else {

        $.ajax({
            type: "get",
            "url": BASE_URL + "rekapitulasi/get_count_peg/" + id + "/" + bulan_tpp + "/" + tahun_tpp,

            contentType: false,
            dataType: "JSON",
            async: true,
            processData: false,
            contentType: false,
            data: {
                month: bulan_tpp,
                year: tahun_tpp,
            },

            success: function (data) {
                document.getElementById('showCountAdm').innerHTML = '<div class="user-activity-group g-4">' +
                    '<div class="user-activity">' +
                    '<em class="icon ni ni-users"></em>' +
                    '<div class="info">' +
                    '<span class="amount">' + data.user_skpd + '</span>' +
                    '<span class="title">Total Pegawai</span>' +
                    '</div>' +

                    '</div>' +
                    '<div class="user-activity">' +
                    '<em class="icon ni ni-users"></em>' +
                    '<div class="info">' +
                    '<span class="amount text-success">' + data.user_tpp + '</span>' +
                    '<span class="title">Diterbitkan</span>' +
                    '</div>' +

                    '</div>' +
                    '<div class="user-activity">' +
                    '<em class="icon ni ni-users"></em>' +
                    '<div class="info">' +
                    '<span class="amount text-danger">' + data.user_tpp_unpublish + '</span>' +
                    '<span class="title">Belum Terbit</span>' +
                    '</div>' +

                    '</div>' +
                    '</div>'
            },
        })

        document.getElementById('btnCetak').innerHTML = ' <a target="_blank" href="' + BASE_URL + 'rekapitulasi/view_rekap_tpp_asn_pdf/' + bulan_tpp + '/' + tahun_tpp + '/' + id + '" class="btn btn-outline-primary ">Cetak Rekap ASN</a>&nbsp;'
            + '<a target="_blank" href="' + BASE_URL + 'rekapitulasi/view_rekap_absen_non_asn_tpp/' + bulan_tpp + '/' + tahun_tpp + '/' + id + '" class="btn btn-outline-primary ">Cetak Rekap NON ASN</a>&nbsp;'
            + '<a target="_blank" href="' + BASE_URL + 'rekapitulasi/view_rekap_tpp_pdf/' + bulan_tpp + '/' + tahun_tpp + '/' + id + '" class="btn btn-outline-primary ">Cetak Rekap ASN & NON-ASN</a>&nbsp;'
            + '<a onclick="refreshRekap()" class="btn btn-primary float-end">Refresh Data</a>&nbsp;'
        $('#tabelTPPAdmin').DataTable({
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
                "search": "Cari",
                "paginate": {
                    "first": "Awal",
                    "last": "Akhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                },
            },
            "displayLength": 100,
            "ajax": {
                "url": BASE_URL + "rekapitulasi/json_rekap/" + bulan_tpp + "/" + tahun_tpp + "/" + id,
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
                        return '<div class="text-left">' + data[21] + '</div>'

                    }
                },
                {
                    "orderable": false,
                    "data": function (data,) {
                        return '<div class="text-left">' + data[22] + '</div>'

                    }
                },

                {
                    "orderable": false,
                    "data": function (data,) {
                        return '<div ><h5 class="text-danger text-center">' + data[18] + '</h5></div>'

                    }
                },
                {
                    "orderable": false,
                    "data": function (data,) {
                        return '<div ><h5 class="text-success text-center">' + data[17] + '</h5></div>'


                    }
                },



                {

                    "orderable": false,
                    "data": function (data,) {
                        return '<div class="dropdown center">'
                            + '<a href="#" class="btn btn-outline-secondary" data-bs-toggle="dropdown" aria-expanded="false"><span>Aksi</span><em class="icon ni ni-chevron-down"></em></a>'
                            + '<div class="dropdown-menu  mt-1" style="">'
                            + '<ul class="link-list-plain">'
                            + '<li><a style="cursor: pointer;" data-id="' + data[0] + '"  onclick="detailRekap(this)">Detail</a></li>'
                            + '<li><a style="cursor: pointer;" target="_blank" href="' + BASE_URL + 'rekapitulasi/view_absen_tpp_pdf/' + data[1] + '/' + data[19] + '/' + data[20] + '">Cetak Rincian Absensi</a></li>'
                            + '<li><a style="cursor: pointer;" target="_blank" href="' + BASE_URL + 'rekapitulasi/view_absen_tpp/' + data[1] + '/' + data[19] + '/' + data[20] + '">Cek Kesesuaian Rekap</a></li>'
                            + '</ul>'
                            + '</div>'
                            + '</div>'
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
    }

}

function refreshAbsensi() {
    showAbsensi()
}

function konversiFormatTanggal(tanggal) {
    var tanggalObj = new Date(tanggal);

    // Mendapatkan tanggal, bulan, dan tahun
    var tanggalStr = ("0" + tanggalObj.getDate()).slice(-2);
    var bulanStr = ("0" + (tanggalObj.getMonth() + 1)).slice(-2);
    var tahunStr = tanggalObj.getFullYear();

    // Mendapatkan jam, menit, dan detik
    var jamStr = ("0" + tanggalObj.getHours()).slice(-2);
    var menitStr = ("0" + tanggalObj.getMinutes()).slice(-2);
    var detikStr = ("0" + tanggalObj.getSeconds()).slice(-2);

    // Menggabungkan dalam format yang diinginkan
    var formatTanggal = tanggalStr + "-" + bulanStr + "-" + tahunStr + " " + jamStr + ":" + menitStr + ":" + detikStr;

    return formatTanggal;
}

function detailRekap(elem) {
    var id = $(elem).data("id");
    $.ajax({
        type: "get",
        "url": BASE_URL + "admin/get_tpp_by_id/" + id,
        contentType: false,
        dataType: "JSON",
        async: true,
        success: function (data) {
            $('#detailRekapAdmin').modal('show');
            document.getElementById('showTpp').innerHTML = ' <div class="row">' +
                '<div class="col-6">' +
                '<h4>' + data.name + '</h4>' +
                '</div>' +
                '<div class="col-6">' +
                '<h4 class="float-end">' + konversiBulan(data.month) + ' ' + data.year + '</h4>' +
                '</div>' +
                '</div>' +
                '<hr>' +
                '<table class="table table-bordered table-striped">' +
                '<tr>' +
                '<td>' +
                '<h6>TL 1 (' + data.tl1 + '%)</h6>' +
                '</td>' +
                '<td>' +
                '<h6>TL 2 (' + data.tl2 + '%)</h6>' +
                '</td>' +
                '<td>' +
                '<h6>TL 3 (' + data.tl3 + '%)</h6>' +
                '</td>' +
                '<td>' +
                '<h6>TL 4 (' + data.tl4 + '%)</h6>' +
                '</td>' +
                '</tr>' +

                '<tr>' +
                '<td>' +
                '<h6>PSW 1 (' + data.psw1 + '%)</h6>' +
                '</td>' +
                '<td>' +
                '<h6>PSW 2 (' + data.psw2 + '%)</h6>' +
                '</td>' +
                '<td>' +
                '<h6>PSW 3 (' + data.psw3 + '%)</h6>' +
                '</td>' +
                '<td>' +
                '<h6>PSW 4 (' + data.psw4 + '%)</h6>' +
                '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>' +
                '<h6>THKC 1 (' + data.thck1 + '%)</h6>' +
                '</td>' +
                '<td>' +
                '<h6>THKC 2 (' + data.thck2 + '%)</h6>' +
                '</td>' +
                '<td>' +
                '<h6>THKC 3 (' + data.thck3 + '%)</h6>' +
                '</td>' +
                '<td>' +
                '<h6>TK 4 (' + data.tk + '%)</h6>' +
                '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>' +
                '<h6>Tidak Upacara (' + data.tu + '%)</h6>' +
                '</td>' +
                '<td>' +
                '<h6>LHKPN/ LHKASN (' + data.lhkpn + '%)</h6>' +
                '</td>' +
                '<td>' +
                '<h6>TPTGR (' + data.tptgr + '%)</h6>' +
                '</td>' +
                '<td>' +
                '<h6 class="text-danger">PD (' + data.subtraction + '%)</h6>' +
                '</td>' +
                '</tr>' +
                '<tr>' +
                '<td colspan="2" class="bg-dark">' +
                '<h4 class="text-white">Total Skor DK (' + data.dk + '%)</h4>' +
                '</td>' +
                '<td>' +
                '<h6>Terakhir update</h6> ' + konversiFormatTanggal(data.updated_at) + ' ' +
                '</td>' +
                '<td>' +
                '<h6>Diupdate oleh<br></h6>' + data.updated_by + ' ' +
                '</td>' +

                '</tr>' +


                '</table>'
        },
    })
}