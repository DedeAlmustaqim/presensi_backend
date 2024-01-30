$(document).ready(function () {

    var id = $('#id_qr_scan').val()






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

            document.getElementById('qrid').innerHTML = 'Masuk'
            makeCodeP(qr_in)
            // makeCodeS(qr_out)
        } else if (formattedTime > endPagi) {
            document.getElementById('qrid').innerHTML = 'Absen ditutup'



            removeCodeIn()
        } else if (formattedTime < startPagi) {
            document.getElementById('qrid').innerHTML = 'Absen ditutup'



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

            document.getElementById('qrid_out').innerHTML = 'Keluar'
            makeCodeS(qr_out)
            // makeCodeS(qr_out)
        } else if (formattedTime > endOut) {
            document.getElementById('qrid_out').innerHTML = 'Absen ditutup'



            removeCodeOut()
        } else if (formattedTime < startOut) {
            document.getElementById('qrid_out').innerHTML = 'Absen ditutup'



            removeCodeOut()
        }




    }

});

