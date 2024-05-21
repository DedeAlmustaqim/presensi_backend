<!DOCTYPE html>
<html>

<head>
    <title><?= $unit . '_' . $bulan . '_' . $tahun ?></title>
    <style>
        /** Define the margins of your page **/
        @page {
            margin-top: 30;
            margin-left: 30px;
            margin-right: 30px;
            margin-bottom: 30px;
        }

        header {
            position: fixed;
            top: -60px;
            left: 20px;
            right: 20px;
            height: 30px;

            /** Extra personal styles **/
            color: #000000;
            text-align: center;
            line-height: 30px;
        }

        table {
            border-collapse: collapse;
            font-size: 14px;
        }



        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 40px;

            /** Extra personal styles **/
            color: #000000;
            text-align: left;
            line-height: 35px;
        }

        h1 {
            display: block;
            font-size: 24px;
            margin-top: 0.2em;
            margin-bottom: 0.02em;
            margin-left: 0;
            margin-right: 0;
            font-weight: bold;
        }

        h2 {
            display: block;
            font-size: 12;
            margin-top: 0.02em;
            margin-bottom: 0.02em;
            margin-left: 0;
            margin-right: 0;
            font-weight: bold;
        }

        h3 {
            display: block;
            font-size: 1.0em;
            margin-top: 0.02em;
            margin-bottom: 0.02em;
            margin-left: 0;
            margin-right: 0;
            font-weight: bold;
        }

        h4 {
            display: block;
            font-size: 0.8em;
            margin-top: 0.02em;
            margin-bottom: 0.02em;
            margin-left: 0;
            margin-right: 0;
            font-weight: bold;
        }

        .text_td {
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 8px;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            padding: 2;
        }

        .text_utama {
            font-family: "Times New Roman", Times, serif;
            font-size: 12px;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            /* padding: 2; */
        }


        .text-center {

            text-align: center;
        }

        .text-right {

            text-align: right;
        }

        .text-left {

            text-align: left;
        }

        .text-danger {
            color: red;
        }
    </style>
</head>


<body>


    <h3 class="text-center">REKAP KEHADIRAN PEGAWAI <br> <?= $unit ?> </h3>
    <h4 class="text-center">UB. <?= $bulan ?> Tahun <?= $tahun ?></h4>
    <br>
    <table border="1" cellpadding="2" width="100%" class="text_utama">
        <tr class="text-center">
            <td rowspan="2" width="3%">No.</td>
            <td rowspan="2" width="16%">Nama</td>
            <td rowspan="2" width="10%">NIP</td>
            <td colspan="4">Keterlambatan (%)</td>
            <td colspan="4">Pulang Sebelum Waktu (%)</td>
            <td colspan="3">Cuti (%)</td>
            <td rowspan="2">Izin pada <br> Jam Masuk<br> (%)</td>
            <td rowspan="2">Izin pada <br> Jam Pulang<br> (%)</td>
            <td rowspan="2">TK (Tanpa <br> Keterangan)<br> (%)</td>
            <td rowspan="2">Tidak <br> Upacara<br> (%)</td>
            <td rowspan="2">LHKPN/ <br> LHKASN<br> (%)</td>
            <td rowspan="2">TPTGR<br> (%)</td>
            <td rowspan="2">PD<br>(Penilaian Disiplin )<br> (%)</td>
            <td rowspan="2">Total Skor DK<br>(Disiplin Kerja)<br> (%)</td>
        </tr>
        <tr class="text-center">
            <td>TL 1</td>
            <td>TL 2</td>
            <td>TL 3</td>
            <td>TL 4</td>
            <td>PSW 1</td>
            <td>PSW 2</td>
            <td>PSW 3</td>
            <td>PSW 4</td>
            <td>THKC 1</td>
            <td>THKC 2</td>
            <td>THKC 3</td>
        </tr>
        <tr class="text-center">
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
            <td>6</td>
            <td>7</td>
            <td>8</td>
            <td>9</td>
            <td>10</td>
            <td>11</td>
            <td>12</td>
            <td>13</td>
            <td>14</td>
            <td>15</td>
            <td>16</td>
            <td>17</td>
            <td>18</td>
            <td>19</td>
            <td>20</td>
            <td>21</td>
            <td>22</td>
        </tr>
        <?php
        $no = 1;
        foreach ($data as $d) {
        ?>
            <tr>
                <td class="text-center"><?php echo $no++; ?></td>
                <td><?php echo $d->name; ?></td>
                <td class="text-right"><?php echo $d->nip; ?></td>
                <td class="text-right"><?php echo $d->tl1; ?></td>
                <td class="text-right"><?php echo $d->tl2; ?></td>
                <td class="text-right"><?php echo $d->tl3; ?></td>
                <td class="text-right"><?php echo $d->tl4; ?></td>
                <td class="text-right"><?php echo $d->psw1; ?></td>
                <td class="text-right"><?php echo $d->psw2; ?></td>
                <td class="text-right"><?php echo $d->psw3; ?></td>
                <td class="text-right"><?php echo $d->psw4; ?></td>
                <td class="text-right"><?php echo $d->thck1; ?></td>
                <td class="text-right"><?php echo $d->thck2; ?></td>
                <td class="text-right"><?php echo $d->thck3; ?></td>
                <td class="text-right"><?php echo $d->ijm; ?></td>
                <td class="text-right"><?php echo $d->ijp; ?></td>
                <td class="text-right"><?php echo $d->tk; ?></td>
                <td class="text-right"><?php echo $d->tu; ?></td>
                <td class="text-right"><?php echo $d->lhkpn; ?></td>
                <td class="text-right"><?php echo $d->tptgr; ?></td>
                <td class="text-right"><?php echo $d->subtraction; ?></td>
                <td class="text-right"><?php echo $d->dk; ?></td>
            </tr>
        <?php
        } ?>
    </table>
    <br>
    <i class="text_utama">* Penilaian Disiplin (PD) pada kolom 22 adalah penjumlahan hasil dari kolom 4 s/d 20 (dihitung berdasarkan jumlah hari kerja dalam bulan berjalan)</i><br>
    <i class="text_utama">* Total Skor Dk (Disiplin Kerja) pada kolom 22 = (100% - PD)</i><br>
    <i class="text_utama">* Rekapitulasi Kehadiran pada bulan berjalan ditandatangani oleh Kasubbag Kepegawaian / yang membidangi</i>
    
    <table width="100%">
        <tr>
            <td width="75%" class="text_utama"></td>
            <td>Kasubbag Kepegawaian / yang <br>membidangi, <br><br><br><br><br><br><b><?= $kasubbag ?></b><br>NIP. <?= $nip_kasubbag ?></td>
        </tr>
    </table>
    <footer>
        <table width="100%">
            <tr>
                <td width="85%">
                    <i><u>
                            <font size="10px">Printed by ATEI WEB <?php echo date("d-m-Y") ?> <?php echo date("H:i:s") ?> WIB</font>
                        </u></i>
                </td>
                <td>
                    <i><u>
                            <font size="10px"><?php echo base_url() ?></font>
                        </u></i>
                </td>
            </tr>
    </footer>
</body>

</html>