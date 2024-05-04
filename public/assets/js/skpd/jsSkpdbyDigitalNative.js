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

    $('#tahun_absen').change(function () {


        showAbsensi()

    });
    $('#bulan_absen').change(function () {


        showAbsensi()

    });
    $('#user_absen').change(function () {


        showAbsensi()

    });
    $('#bulan_tpp').change(function () {


        showRekap()

    });
    $('#tahun_tpp').change(function () {


        showRekap()

    });



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
                    return '<div class="text-center">' +
                        '<a title="Detail"  onclick="detailPeg(this)" data-id="' + data[6] + '" class="btn btn-outline-primary"><em class="icon ni ni-eye"></em></a>&nbsp;' +
                        '<a title="Edit"  onclick="editPeg(this)" data-id="' + data[6] + '" class="btn btn-outline-primary"><em class="icon ni ni-edit-alt"></em></a>&nbsp;' +
                        '<a title="Reset Password" onclick="resetPeg(this)" data-id="' + data[6] + '" class="btn btn-outline-primary"><em class="icon ni ni-unlock-fill"></em></a>&nbsp;' +
                        '<a title="Urutkan" onclick="sortPeg(this)" data-id="' + data[6] + '"  data-sort="' + data[8] + '" class="btn btn-outline-primary"><em class="icon ni ni-sort-line"></em></a>&nbsp;' +
                        // '<a title="Laporan" onclick="lapPeg(this)" data-id="' + data[6] + '" class="btn btn-outline-primary"><em class="icon ni ni-file-pdf"></em></a>&nbsp;' +
                        // '<a  onclick="delPeg(this)" data-id="' + data[6] + '" class="btn btn-dim btn-outline-danger"><em class="icon ni ni-trash"></em></a>&nbsp;' +
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

    //Tabel Rekap Pegawai
    $('#tabelRekapPegawai').DataTable({
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
                        '<a title="Laporan" onclick="lapRekapPeg(this)" data-id="' + data[6] + '" class="btn btn-outline-primary"><em class="icon ni ni-eye"></em>&nbsp;Jam Kerja</a>&nbsp;' +
                        '<a title="Laporan" onclick="lapPegTPP(this)" data-id="' + data[6] + '" class="btn btn-outline-primary"><em class="icon ni ni-eye"></em>&nbsp;TPP</a>&nbsp;' +
                        // '<a  onclick="delPeg(this)" data-id="' + data[6] + '" class="btn btn-dim btn-outline-danger"><em class="icon ni ni-trash"></em></a>&nbsp;' +
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

function refreshAbsensi() {
    showAbsensi()
}
function refreshRekap() {
    showRekap()
}
function showAbsensi() {
    var id_user_absen = $('#user_absen').val()
    var id_unit = $('#unit_absen').val()
    var tahun_absen = $('#tahun_absen').val()
    var bulan_absen = $('#bulan_absen').val()

    toastr.clear();
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
            "url": BASE_URL + "skpd/get_upacara/" + id_user_absen + "/" + bulan_absen + "/" + tahun_absen,
            processData: false,
            contentType: false,

            dataType: "JSON",
            success: function (data) {
                $('#keg_upacara').val(data.keg)


            },

        })
        $.ajax({
            type: "GET",
            "url": BASE_URL + "skpd/get_subtraction/" + id_user_absen,
            processData: false,
            contentType: false,

            dataType: "JSON",
            success: function (data) {
                $('#lhkpn_lhasn').val(data.lhkpn_lhasn)
                $('#tptgr').val(data.tptgr)


            },

        })
        document.getElementById('btn_cetak_tpp').innerHTML = '<a  target="_blank" href="' + BASE_URL + 'skpd/rekap/view_absen_tpp/' + id_user_absen + '/' + bulan_absen + '/' + tahun_absen + '" class="btn btn-secondary">Lihat Skor Disiplin</a>'

        $('#tabelAbsenPegawai').DataTable({
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
                "url": BASE_URL + "skpd/json_absensi/" + id_user_absen + "/" + id_unit + "/" + tahun_absen + "/" + bulan_absen,
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
                            + '<li><a style="cursor: pointer;" data-id="' + data[0] + '" onclick="delCheckIn(this)">Hapus Data Check In</a></li>'
                            + '<li><a style="cursor: pointer;" data-id="' + data[0] + '" onclick="delCheckOut(this)">Hapus Data Check Out</a></li>'
                            + '<li><a style="cursor: pointer;" data-id="' + data[0] + '" onclick="delDataAbsen(this)">Hapus Data Absen</a></li>'
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

function showRekap() {
    var tahun_tpp = $('#tahun_tpp').val()
    var bulan_tpp = $('#bulan_tpp').val()



    toastr.clear();
    if (tahun_tpp == "") {
        NioApp.Toast('<h5>Tahun tidak boleh kosong</h5><p class="text-danger"></p>', 'error');
    }
    else if (bulan_tpp == "") {
        NioApp.Toast('<h5>Bulan tidak boleh kosong</h5><p class="text-danger"></p>', 'error');

    } else {

        document.getElementById('btnCetak').innerHTML = ' <a target="_blank" href="' + BASE_URL + 'skpd/rekap/view_rekap_tpp_asn_pdf/' + bulan_tpp + '/' + tahun_tpp + '" class="btn btn-outline-primary ">Cetak Rekap ASN</a>&nbsp;'
            + '<a target="_blank" href="' + BASE_URL + 'skpd/rekap/view_rekap_absen_non_asn_tpp/' + bulan_tpp + '/' + tahun_tpp + '" class="btn btn-outline-primary ">Cetak Rekap NON ASN</a>&nbsp;'
            + '<a target="_blank" href="' + BASE_URL + 'skpd/rekap/view_rekap_tpp_pdf/' + bulan_tpp + '/' + tahun_tpp + '" class="btn btn-outline-primary ">Cetak Rekap ASN & NON-ASN</a>&nbsp;'
            + '<a onclick="refreshRekap()" class="btn btn-primary float-end">Refresh Data</a>&nbsp;'
        $('#tabelTPP').DataTable({
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
                "url": BASE_URL + "skpd/rekap/json_rekap/" + bulan_tpp + "/" + tahun_tpp,
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
                // {
                //     "orderable": false,
                //     "data": function (data,) {
                //         return '<div class="text-left">' + data[2] + '</div>'

                //     }
                // },
                // {
                //     "orderable": false,
                //     "data": function (data,) {
                //         return '<div class="text-left">' + data[3] + '</div>'

                //     }
                // },
                // {
                //     "orderable": false,
                //     "data": function (data,) {
                //         return '<div class="text-left">' + data[4] + '</div>'

                //     }
                // },
                // {
                //     "orderable": false,
                //     "data": function (data,) {
                //         return '<div class="text-left">' + data[5] + '</div>'

                //     }
                // },
                // {
                //     "orderable": false,
                //     "data": function (data,) {
                //         return '<div class="text-left">' + data[6] + '</div>'

                //     }
                // },
                // {
                //     "orderable": false,
                //     "data": function (data,) {
                //         return '<div class="text-left">' + data[7] + '</div>'

                //     }
                // },
                // {
                //     "orderable": false,
                //     "data": function (data,) {
                //         return '<div class="text-left">' + data[8] + '</div>'

                //     }
                // },
                // {
                //     "orderable": false,
                //     "data": function (data,) {
                //         return '<div class="text-left">' + data[9] + '</div>'

                //     }
                // },
                // {
                //     "orderable": false,
                //     "data": function (data,) {
                //         return '<div class="text-left">' + data[10] + '</div>'

                //     }
                // },
                // {
                //     "orderable": false,
                //     "data": function (data,) {
                //         return '<div class="text-left">' + data[11] + '</div>'

                //     }
                // },

                // {
                //     "orderable": false,
                //     "data": function (data,) {
                //         return '<div class="text-left">' + data[12] + '</div>'

                //     }
                // }, {
                //     "orderable": false,
                //     "data": function (data,) {
                //         return '<div class="text-left">' + data[13] + '</div>'

                //     }
                // },

                // {
                //     "orderable": false,
                //     "data": function (data,) {
                //         return '<div class="text-left">' + data[14] + '</div>'

                //     }
                // }, {
                //     "orderable": false,
                //     "data": function (data,) {
                //         return '<div class="text-left">' + data[15] + '</div>'

                //     }
                // },
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

                // {
                //     "orderable": false,
                //     "data": function (data,) {
                //         var date = data[23];
                //         var dateTime = new Date(date);
                //         var formattedDateTime = addLeadingZero(dateTime.getDate()) + "-" +
                //             addLeadingZero(dateTime.getMonth() + 1) + "-" +
                //             dateTime.getFullYear() + " " +
                //             addLeadingZero(dateTime.getHours()) + ":" +
                //             addLeadingZero(dateTime.getMinutes()) + ":" +
                //             addLeadingZero(dateTime.getSeconds());
                //         return '<div class="text-left">' + formattedDateTime + '</div>'

                //     }
                // },
                // {
                //     "orderable": false,
                //     "data": function (data,) {
                //         return '<div class="text-left">' + data[24] + '</div>'

                //     }
                // },
                // {

                //     "orderable": false,
                //     "data": function (data,) {
                //         return '<div class="text-center">' +
                //             '<a target="_blank" href="' + BASE_URL + 'skpd/rekap/view_absen_tpp_pdf/' + data[1] + '/' + data[19] + '/' + data[20] + '" class="btn btn-sm btn-secondary mb-1">Detail </a>'
                //             +'<a target="_blank" href="' + BASE_URL + 'skpd/rekap/view_absen_tpp_pdf/' + data[1] + '/' + data[19] + '/' + data[20] + '" class="btn btn-sm btn-secondary mb-1">Cetak Rincian Absensi </a>'
                //             +'<a target="_blank" href="' + BASE_URL + 'skpd/rekap/view_absen_tpp/' + data[1] + '/' + data[19] + '/' + data[20] + '" class="btn btn-sm btn-primary mb-1">Cek Kesesuaian Rekap </a>'
                //     }
                // },

                {

                    "orderable": false,
                    "data": function (data,) {
                        return '<div class="dropdown center">'
                            + '<a href="#" class="btn btn-outline-secondary" data-bs-toggle="dropdown" aria-expanded="false"><span>Aksi</span><em class="icon ni ni-chevron-down"></em></a>'
                            + '<div class="dropdown-menu  mt-1" style="">'
                            + '<ul class="link-list-plain">'
                            + '<li><a style="cursor: pointer;" data-id="' + data[0] + '"  onclick="detailRekap(this)">Detail</a></li>'
                            + '<li><a style="cursor: pointer;" target="_blank" href="' + BASE_URL + 'skpd/rekap/view_absen_tpp_pdf/' + data[1] + '/' + data[19] + '/' + data[20] + '">Cetak Rincian Absensi</a></li>'
                            + '<li><a style="cursor: pointer;" target="_blank" href="' + BASE_URL + 'skpd/rekap/view_absen_tpp/' + data[1] + '/' + data[19] + '/' + data[20] + '">Cek Kesesuaian Rekap</a></li>'
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
            $('#nip_pimpinan').val(data.nip_pimpinan)
            $('#kasubbag').val(data.kasubbag)
            $('#nip_kasubbag').val(data.nip_kasubbag)
            $('#jam_masuk_skpd').val(data.jam_masuk)
            $('#jam_pulang_skpd').val(data.jam_pulang)
            $('#h_kerja').val(data.hari_kerja)
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
                if (data.nip_skpd_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.nip_skpd_error + '</p>', 'error');
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

function detailRekap(elem) {
    var id = $(elem).data("id");
    $.ajax({
        type: "get",
        "url": BASE_URL + "skpd/get_tpp_by_id/" + id,
        contentType: false,
        dataType: "JSON",
        async: true,
        success: function (data) {
            $('#detailRekap').modal('show');
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

function detailPeg(elem) {
    var id = $(elem).data("id");


    $.ajax({
        type: "get",
        "url": BASE_URL + "skpd/get_peg/" + id,
        contentType: false,
        dataType: "JSON",
        async: true,
        success: function (data) {
            $('#pegDetail').modal('show');
            document.getElementById('showDetailPeg').innerHTML = ' <div class="row">' +
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
                if (data.nik_unik_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.nik_unik_error + '</p>', 'error');
                }
                if (data.nik_peg_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.username_peg_error + '</p>', 'error');
                }

                if (data.nama_peg_error) {
                    NioApp.Toast('<h5>Gagal Tambah Data</h5><p class="text-danger">' + data.nama_peg_error + '</p>', 'error');
                }
                if (data.status_peg_error) {
                    NioApp.Toast('<h5>Gagal Tambah Data</h5><p class="text-danger">' + data.status_peg_error + '</p>', 'error');
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
                $("#formTambahPeg")[0].reset();
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
            $('#nama_peg_edit').val(data.name)
            $('#nip_peg_edit').val(data.nip)
            $('#email_peg_edit').val(data.email)
            $('#jabatan_peg_edit').val(data.jabatan)
            $('#status_peg_edit').val(data.status_peg)
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
                if (data.status_peg_edit_error) {
                    NioApp.Toast('<h5>Gagal Tambah Data</h5><p class="text-danger">' + data.status_peg_edit_error + '</p>', 'error');
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



function sortPeg(elem) {
    var id = $(elem).data("id");
    var sort = $(elem).data("sort");
    // console.log(id)
    $('#modalSort').modal('show');
    $('#id_user_sort_peg').val(id)
    $('#sort_peg').val(sort)


}

function resetPeg(elem) {
    var id = $(elem).data("id");
    Swal.fire({
        title: 'Apakah anda yakin??',
        text: "Reset Password Pegawai menjadi default 'baritotimurkab'",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Reset Password!'
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: BASE_URL + 'skpd/ress_pass/' + id,
                type: "POST",
                data: {

                    id: id,

                },
                success: function () {
                    Swal.fire('Berhasil!', 'Password di reset "baritotimurkab".', 'success');
                    $('#TabelUnit').DataTable().ajax.reload(null, false);
                },
                error: function () {
                    Swal.fire('Gagal!', '.', 'warning');

                }
            });

        }
    });
}

$('#formSortPeg').on('submit', function (e) {

    var postData = new FormData($("#formSortPeg")[0]);
    $.ajax({
        type: "POST",
        "url": BASE_URL + "skpd/sort_peg",
        processData: false,
        contentType: false,
        data: postData,
        dataType: "JSON",
        success: function (data) {


            if (data.success == false) {
                toastr.clear();
                if (data.sort_peg_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.username_peg_error + '</p>', 'error');
                }


            } else if (data.success == true) {
                Swal.fire('Berhasil Ubah Data!', 'Data telah diubah.', 'success');
                $('#tabelPegawai').DataTable().ajax.reload(null, false);
                $('#modalSort').modal('hide');
            }

        },

    })
    return false;
});


function lapRekapPeg(elem) {
    var id = $(elem).data("id");

    $('#id_user_lap_jam_kerja').val(id)
    $('#modalRekapJamKerja').modal('show');

}

function lapPegTPP(elem) {
    var id = $(elem).data("id");

    $('#id_user_lap_tpp').val(id)
    $('#modalRekapTPP').modal('show');

}

function cetakRekapPerPeg() {
    // Mendapatkan nilai dari input tahun_lap dan bulan_lap
    var tahun = document.getElementById("tahun_lap").value;
    var bulan = document.getElementById("bulan_lap").value;
    // Mendapatkan nilai dari input id_user_sort_peg
    var id = document.getElementById("id_user_lap_jam_kerja").value;
    // Membuka tautan baru dengan URL yang sesuai
    window.open(BASE_URL + 'skpd/rekap/view_absen/' + id + "/" + bulan + "/" + tahun);
}

function cetakRekapTPP() {
    // Mendapatkan nilai dari input tahun_lap dan bulan_lap
    var tahun = document.getElementById("tahun_tpp").value;
    var bulan = document.getElementById("bulan_tpp").value;
    // Mendapatkan nilai dari input id_user_sort_peg
    var id = document.getElementById("id_user_lap_tpp").value;
    // Membuka tautan baru dengan URL yang sesuai
    window.open(BASE_URL + 'skpd/rekap/view_absen_tpp/' + id + "/" + bulan + "/" + tahun);
}

function devPorgress() {
    Swal.fire('Lagi dalam pengembangan!', '.', 'warning');
}

function changePassSkpd() {
    $('#modalchangePassSkpd').modal('show');
}

$('#formchangePassSkpd').on('submit', function (e) {

    var postData = new FormData($("#formchangePassSkpd")[0]);
    $.ajax({
        type: "POST",
        "url": BASE_URL + "skpd/reset_pass_skpd",
        processData: false,
        contentType: false,
        data: postData,
        dataType: "JSON",
        success: function (data) {


            if (data.success == false) {
                toastr.clear();
                if (data.pass_reset_skpd_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.pass_reset_skpd_error + '</p>', 'error');
                }
                if (data.pass_reset_skpd_repeat_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.pass_reset_skpd_repeat_error + '</p>', 'error');
                }

            } else if (data.success == true) {
                Swal.fire('Berhasil Ubah Password!', 'Password telah diubah.', 'success');
                $('#modalchangePassSkpd').modal('hide');
            }

        },

    })
    return false;
});

function changePassQR() {
    $('#modalchangePassQr').modal('show');
}

$('#formchangePassQr').on('submit', function (e) {

    var postData = new FormData($("#formchangePassQr")[0]);
    $.ajax({
        type: "POST",
        "url": BASE_URL + "skpd/reset_pass_qr",
        processData: false,
        contentType: false,
        data: postData,
        dataType: "JSON",
        success: function (data) {


            if (data.success == false) {
                toastr.clear();
                if (data.pass_reset_qr_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.pass_reset_qr_error + '</p>', 'error');
                }
                if (data.pass_reset_qr_repeat_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.pass_reset_qr_repeat_error + '</p>', 'error');
                }

            } else if (data.success == true) {
                Swal.fire('Berhasil Ubah Password!', 'Password telah diubah.', 'success');
                $('#modalchangePassQr').modal('hide');
            }

        },

    })
    return false;
});

function delCheckIn(elem) {
    var id = $(elem).data("id");
    Swal.fire({
        title: 'Hapus data Check In??',
        text: "Anda tidak akan dapat mengembalikan ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!'
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: BASE_URL + 'skpd/del_check_in/' + id,
                type: "POST",
                data: {
                    id: id,
                },
                success: function (data) {
                    Swal.fire('Terhapus!', 'Data Anda telah dihapus.', 'success');
                    showAbsensi();
                },
                error: function () {

                    Swal.fire('Gagal!', 'Terjadi kesalahan .', 'error');
                }
            });

        }
    });
}

function delCheckOut(elem) {
    var id = $(elem).data("id");
    Swal.fire({
        title: 'Hapus data Check Out??',
        text: "Anda tidak akan dapat mengembalikan ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!'
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: BASE_URL + 'skpd/del_check_out/' + id,
                type: "POST",
                data: {
                    id: id,
                },
                success: function (data) {
                    Swal.fire('Terhapus!', 'Data Anda telah dihapus.', 'success');
                    showAbsensi();
                },
                error: function () {

                    Swal.fire('Gagal!', 'Terjadi kesalahan .', 'error');
                }
            });

        }
    });
}
function delDataAbsen(elem) {
    var id = $(elem).data("id");
    Swal.fire({
        title: 'Hapus data Check In dan Check Out??',
        text: "Anda tidak akan dapat mengembalikan ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!'
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: BASE_URL + 'skpd/del_absen/' + id,
                type: "POST",
                data: {
                    id: id,
                },
                success: function (data) {
                    Swal.fire('Terhapus!', 'Data Anda telah dihapus.', 'success');
                    showAbsensi();
                },
                error: function () {

                    Swal.fire('Gagal!', 'Terjadi kesalahan .', 'error');
                }
            });

        }
    });
}

$('#updateSubtraction').on('submit', function (e) {

    var postData = new FormData($("#updateSubtraction")[0]);
    $.ajax({
        type: "POST",
        "url": BASE_URL + "skpd/subtraction",
        processData: false,
        contentType: false,
        data: postData,
        dataType: "JSON",
        success: function (data) {


            if (data.success == false) {
                toastr.clear();
                if (data.user_absen_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.user_absen_error + '</p>', 'error');
                }

                if (data.bulan_absen_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.bulan_absen_error + '</p>', 'error');
                }
                if (data.tahun_absen_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.tahun_absen_error + '</p>', 'error');
                }
                if (data.keg_upacara_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.keg_upacara_error + '</p>', 'error');
                }
                if (data.lhkpn_lhasn_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.lhkpn_lhasn_error + '</p>', 'error');
                }
                if (data.tptgr_error) {
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data.tptgr_error + '</p>', 'error');
                }



            } else if (data.success == true) {
                Swal.fire('Berhasil !', 'Data telah diupdate.', 'success');
                showAbsensi();
            }

        },

    })
    return false;
});

$('#postTpp').on('submit', function (e) {

    var postData = new FormData($("#postTpp")[0]);
    $.ajax({
        type: "POST",
        "url": BASE_URL + "skpd/posted_tpp",
        processData: false,
        contentType: false,
        data: postData,
        dataType: "JSON",
        success: function (data) {


            if (data.success == false) {
                toastr.clear();
                NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger"></p>', 'error');



            } else if (data.success == true) {
                Swal.fire('Berhasil !', 'Berhasil Simpan Data Perhitungan Skor Disiplin.', 'success');
                location.reload();
            }

        },

    })
    return false;
});

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


function addLeadingZero(number) {
    return number < 10 ? "0" + number : number;
}

var namaBulan = [
    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
];

// Fungsi untuk mengonversi angka menjadi nama bulan
function konversiBulan(angkaBulan) {
    return namaBulan[angkaBulan - 1];
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