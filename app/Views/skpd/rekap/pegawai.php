<?= $this->extend('layout/template_skpd') ?>
<?= $this->section('content_skpd') ?>
<div class="card card-bordered">
    <div class="card-inner">

        <div class="row g-4">
            <input hidden id="unit_absen" name="unit_absen" value="<?php echo session('ses_id_unit') ?>">
            <div class="col-lg-3">
                <div class="form-group">
                    <label class="form-label" for="full-name-1">Pilih Tahun</label>
                    <div class="form-control-wrap ">
                        <div class="form-control-select">
                            <select class="form-control" id="tahun_tpp" name="tahun_tpp">
                                <option value="">-</option>
                                <option value="2024">2024</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label class="form-label" for="email-address-1">Pilih Bulan</label>
                    <div class="form-control-wrap">
                        <div class="form-control-select">
                            <select class="form-control" id="bulan_tpp" name="bulan_tpp">
                                <option value="">-</option>
                                <?php
                                $bulan = array(
                                    1 => 'Januari',
                                    2 => 'Februari',
                                    3 => 'Maret',
                                    4 => 'April',
                                    5 => 'Mei',
                                    6 => 'Juni',
                                    7 => 'Juli',
                                    8 => 'Agustus',
                                    9 => 'September',
                                    10 => 'Oktober',
                                    11 => 'November',
                                    12 => 'Desember'
                                );
                                foreach ($bulan as $key => $nama_bulan) {
                                    echo "<option value='$key'>$nama_bulan</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12" id="btnCetak">
               

            </div>
        </div>



        <hr>

        <div class="table-responsive">
            <table class="table table-bordered nowrap" id="tabelTPP">
                <thead>
                    <tr class="bg-primary text-white text-center">

                        <th>No</th>
                        <th width="60%">Nama</th>
                        <th>NIP</th>
                        <th>TL 1 (%)</th>
                        <th>TL 2 (%)</th>
                        <th>TL 3 (%)</th>
                        <th>TL 4 (%)</th>
                        <th>PSW 1 (%)</th>
                        <th>PSW 2 (%)</th>
                        <th>PSW 3 (%)</th>
                        <th>PSW 4 (%)</th>
                        <th>THCK 1 (%)</th>
                        <th>THCK 2 (%)</th>
                        <th>THCK 3 (%)</th>
                        <th>TK (%)</th>
                        <th>Tidak Upacara (%)</th>
                        <th>LHKPN/LHKASN (%)</th>
                        <th>TPTGR (%)</th>
                        <th>Total Skor DK (%)</th>
                        <th>Terakhir diupdate</th>
                        <th>diupdate oleh</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

            </table>
        </div>

    </div>

</div>




<?= $this->endSection() ?>