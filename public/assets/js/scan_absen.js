
$(document).ready(function () {
    var table;
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
    var id = $('#id_qr_scan').val()
    table = initDatatable();
    scrollDataTable();
    function initDatatable() {
        return $('#tableUserView').DataTable({
            processing: true,
            serverSide: true,

            destroy: true,

            "bPaginate": true,

            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,

            "scrollCollapse": true,
            "columnDefs": [{
                "visible": false,

            }],
            "order": [
                [0, 'asc']
            ],



            "displayLength": 5,
            "ajax": {
                "url": BASE_URL + "/get_user/" + id,
            },
            "columns": [

                {
                    "orderable": false,
                    "data": function (data) {
                        // Get current date
                        var currentDate = new Date();
                
                        // Format the date as needed (you can customize this part)
                        var formattedDate = currentDate.toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit',
                        });
                
                        // Return the formatted date
                        return '<div class="text-left">' + formattedDate + '</div>';
                    }
                },
               
                {
                    "orderable": false,
                    "data": function (data,) {
                        return '<div class="user-card user-card-s1">'+
                        '<div class="user-avatar md bg-primary">'+
                            '<img height="55" width="55" src="'+data[5]+'" alt="">'+
                            
                        '</div>'+
                        '<div class="user-info">'+
                            '<h6>'+data[1]+'</h6>'+
                           
                        '</div>'+
                    '</div>'

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
                    "className":'bg-success',
                    "data": function (data) {
                        if (data[3] == null) {
                            return '<div class="text-left">Belum Check IN</div>';
                        } else {
                            return '<div class="text-left">' + data[3] + '</div>';
                        }
                    }
                },

                {
                    "orderable": false,
                   "className":'bg-orange',
                    "data": function (data) {
                        if (data[4] == null) {
                            return '<div class="text-left ">Belum Check Out</div>';
                        } else {
                            return '<div class="text-left">' + data[4] + '</div>';
                        }
                    }
                },

            ],




        });
    }


    function scrollDataTable() {
        var table = $('#tableUserView').DataTable();
        var currentPage = 0;

        var scrollInterval = setInterval(function () {
            table.page(currentPage).draw('page');
            currentPage++;

            // Optional: Reset to the first page after reaching the last page
            if (currentPage === table.page.info().pages) {
                currentPage = 0;
            }
        }, 2500); // Adjust the interval as needed

        // Optional: Stop scrolling after a certain time or condition
       
    }


    setInterval(() => {
        $.ajax({
            type: "get",
            "url": "https://api-absen.baritotimurkab.go.id/public/api/scan/" + id,
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                document.getElementById('pukul').innerHTML = data.qr_time_in_start + ' s/d ' + data.qr_time_in_end
                document.getElementById('pukulOut').innerHTML = data.qr_time_out_start + ' s/d ' + data.qr_time_out_end



                displayMaintenance(data.qr_time_in_start, data.qr_time_in_end, data.qr_in);
                displayMaintenanceOut(data.qr_time_out_start, data.qr_time_out_end, data.qr_out);


            },

        })

    }, 2000);
    var qrcode = new QRCode(document.getElementById("qrcode_pagi"), {
        width: 200,
        height: 200
    });
    var qrcodeOut = new QRCode(document.getElementById("qrcode_out"), {
        width: 180,
        height: 180
    });

    function makeCodeP(qr_in) {

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        // document.getElementById('rawQr').innerHTML = today + qr_in
        // $('#rawQr').innerHTML = today + qr_in
        $('#qrcode_pagi').show();
        qrcode.makeCode(today + qr_in);
    }

    function removeCodeIn() {
        $('#qrcode_pagi').hide();

    }
    function removeCodeOut() {
        $('#qrcode_out').hide();

    }
    function makeCodeS(qr_out) {

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;

        $('#qrcode_out').show();
        qrcodeOut.makeCode(today + qr_out);

    }



    function displayMaintenance(startPagi, endPagi, qr_in) {
        let currentDateTime = new Date();


        let hours = currentDateTime.getHours();
        hours = hours <= 9 ? '0' + hours : hours;

        let formattedTime = hours + ":" + String(currentDateTime.getMinutes()).padStart(2, "0");
        console.log(formattedTime)







        if (formattedTime > startPagi && formattedTime <= endPagi) {

            document.getElementById('qrid').innerHTML = '<h6 class="text-success">Kode QR Check In dibuka</h6>'
            makeCodeP(qr_in)
            // makeCodeS(qr_out)
        } else if (formattedTime > endPagi) {
            document.getElementById('qrid').innerHTML = '<h6 class="text-warning">Kode QR Check In ditutup</h6>'



            removeCodeIn()
        } else if (formattedTime < startPagi) {
            document.getElementById('qrid').innerHTML = '<h6 class="text-warning">Kode QR Check In ditutup</h6>'



            removeCodeIn()
        }




    }

    function displayMaintenanceOut(startOut, endOut, qr_out) {
        let currentDateTime = new Date();


        let hours = currentDateTime.getHours();
        hours = hours <= 9 ? '0' + hours : hours;

        let formattedTime = hours + ":" + String(currentDateTime.getMinutes()).padStart(2, "0");
        console.log(formattedTime)







        if (formattedTime > startOut && formattedTime <= endOut) {

            document.getElementById('qrid_out').innerHTML = '<h6 class="text-success">Kode QR Check Out dibuka</h6>'
            makeCodeS(qr_out)
            // makeCodeS(qr_out)
        } else if (formattedTime > endOut) {
            document.getElementById('qrid_out').innerHTML = '<h6 class="text-warning">Kode QR Check Out ditutup</h6>'



            removeCodeOut()
        } else if (formattedTime < startOut) {
            document.getElementById('qrid_out').innerHTML = '<h6 class="text-warning">Kode QR Check Out ditutup</h6>'



            removeCodeOut()
        }




    }

});

