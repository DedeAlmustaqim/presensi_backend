<?= $this->extend('layout/template_skpd') ?>
<?= $this->section('content_skpd') ?>
<div class="card card-bordered">
    <div class="card-inner">

        <div class="row g-4">
            <input hidden id="unit_absen" name="unit_absen" value="<?php echo session('ses_id_unit') ?>">
            <?php
            if (session('akses') == 1) { ?>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label" for="full-name-1">Pilih OPD</label>
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
            <?php }
            ?>
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

            <div class="col-lg-6">
                <div class="user-activity-group g-4">
                    <div class="user-activity">
                        <em class="icon ni ni-users"></em>
                        <div class="info">
                            <span class="amount">345</span>
                            <span class="title">Total Pegawai</span>
                        </div>
                        <div class="gfx" data-color="#9cabff" style="color: rgb(156, 171, 255);">
                            <svg enable-background="new 0 0 48 17.5" version="1.1" viewBox="0 0 48 17.5" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                <path fill="currentColor" d="m1.2 17.4h-0.3c-0.5-0.1-0.8-0.7-0.7-1.2 2-7.2 5-12.2 8.8-14.7 1.5-1 3-1.5 4.5-1.4 4.9 0.3 7.2 4.9 9 8.5 0.3 0.4 0.5 0.8 0.7 1.2 1 1.8 2.7 3.9 4.5 4.3 0.9 0.2 1.7-0.1 2.6-0.8 1.8-1.4 3-3.7 4.1-5.9 0.5-1 1-1.9 1.5-2.9 1-1.5 2.8-3.5 4.9-3.8 1.1-0.1 2.2 0.3 3.1 1 1.3 1.1 1.9 2.6 2.4 4.1 0.4 1 0.7 1.9 1.2 2.6 0.3 0.4 0.2 1.1-0.2 1.4s-1.1 0.2-1.4-0.2c-0.7-0.9-1.1-2-1.5-3-0.5-1.3-1-2.5-1.9-3.3-0.5-0.4-1-0.6-1.5-0.5-1.3 0.2-2.7 1.6-3.5 2.8-0.5 0.8-1 1.8-1.4 2.7-1.2 2.4-2.4 4.9-4.6 6.5-1.3 1.1-2.8 1.5-4.2 1.2-3.1-0.6-5.1-3.9-5.9-5.3-0.2-0.4-0.4-0.8-0.6-1.3-1.7-3.4-3.5-7.2-7.3-7.4-1.1-0.1-2.1 0.3-3.3 1-3.5 2.4-6.2 7-8 13.7-0.2 0.4-0.6 0.7-1 0.7z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="user-activity">
                        <em class="icon ni ni-users"></em>
                        <div class="info">
                            <span class="amount text-success">49</span>
                            <span class="title">Diterbitkan</span>
                        </div>
                        <div class="gfx" data-color="#ccd4ff" style="color: rgb(204, 212, 255);">
                            <svg enable-background="new 0 0 48 17.5" version="1.1" viewBox="0 0 48 17.5" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                <path fill="currentColor" d="m1.2 17.4h-0.3c-0.5-0.1-0.8-0.7-0.7-1.2 2-7.2 5-12.2 8.8-14.7 1.5-1 3-1.5 4.5-1.4 4.9 0.3 7.2 4.9 9 8.5 0.3 0.4 0.5 0.8 0.7 1.2 1 1.8 2.7 3.9 4.5 4.3 0.9 0.2 1.7-0.1 2.6-0.8 1.8-1.4 3-3.7 4.1-5.9 0.5-1 1-1.9 1.5-2.9 1-1.5 2.8-3.5 4.9-3.8 1.1-0.1 2.2 0.3 3.1 1 1.3 1.1 1.9 2.6 2.4 4.1 0.4 1 0.7 1.9 1.2 2.6 0.3 0.4 0.2 1.1-0.2 1.4s-1.1 0.2-1.4-0.2c-0.7-0.9-1.1-2-1.5-3-0.5-1.3-1-2.5-1.9-3.3-0.5-0.4-1-0.6-1.5-0.5-1.3 0.2-2.7 1.6-3.5 2.8-0.5 0.8-1 1.8-1.4 2.7-1.2 2.4-2.4 4.9-4.6 6.5-1.3 1.1-2.8 1.5-4.2 1.2-3.1-0.6-5.1-3.9-5.9-5.3-0.2-0.4-0.4-0.8-0.6-1.3-1.7-3.4-3.5-7.2-7.3-7.4-1.1-0.1-2.1 0.3-3.3 1-3.5 2.4-6.2 7-8 13.7-0.2 0.4-0.6 0.7-1 0.7z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="user-activity">
                        <em class="icon ni ni-users"></em>
                        <div class="info">
                            <span class="amount text-danger">49</span>
                            <span class="title">Belum Terbit</span>
                        </div>
                        <div class="gfx" data-color="#ccd4ff" style="color: rgb(204, 212, 255);">
                            <svg enable-background="new 0 0 48 17.5" version="1.1" viewBox="0 0 48 17.5" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                <path fill="currentColor" d="m1.2 17.4h-0.3c-0.5-0.1-0.8-0.7-0.7-1.2 2-7.2 5-12.2 8.8-14.7 1.5-1 3-1.5 4.5-1.4 4.9 0.3 7.2 4.9 9 8.5 0.3 0.4 0.5 0.8 0.7 1.2 1 1.8 2.7 3.9 4.5 4.3 0.9 0.2 1.7-0.1 2.6-0.8 1.8-1.4 3-3.7 4.1-5.9 0.5-1 1-1.9 1.5-2.9 1-1.5 2.8-3.5 4.9-3.8 1.1-0.1 2.2 0.3 3.1 1 1.3 1.1 1.9 2.6 2.4 4.1 0.4 1 0.7 1.9 1.2 2.6 0.3 0.4 0.2 1.1-0.2 1.4s-1.1 0.2-1.4-0.2c-0.7-0.9-1.1-2-1.5-3-0.5-1.3-1-2.5-1.9-3.3-0.5-0.4-1-0.6-1.5-0.5-1.3 0.2-2.7 1.6-3.5 2.8-0.5 0.8-1 1.8-1.4 2.7-1.2 2.4-2.4 4.9-4.6 6.5-1.3 1.1-2.8 1.5-4.2 1.2-3.1-0.6-5.1-3.9-5.9-5.3-0.2-0.4-0.4-0.8-0.6-1.3-1.7-3.4-3.5-7.2-7.3-7.4-1.1-0.1-2.1 0.3-3.3 1-3.5 2.4-6.2 7-8 13.7-0.2 0.4-0.6 0.7-1 0.7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12" id="btnCetak">


            </div>
        </div>



        <hr>

        <div class="table-responsive">
            <table class="table table-bordered " id="tabelTPP">
                <thead>
                    <tr class="bg-primary text-white text-center">

                        <th>No</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <!-- <th>TL 1 (%)</th>
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
                        <th>TPTGR (%)</th> -->
                        <th>Penilaian Disiplin <br> (%)</th>
                        <th>Total Skor <br>Disiplin Kerja (%)</th>
                        <!-- <th>Terakhir diupdate</th> -->
                        <!-- <th>diupdate oleh</th> -->
                        <th width="17%">Aksi</th>
                    </tr>
                </thead>

            </table>
        </div>

    </div>

</div>

<!-- Modal Form -->
<div class="modal fade zoom" id="detailRekap">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Detail Rekapitulasi Skor Disiplin Kerja</h6>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div id="showTpp"></div>
            </div>

        </div>
    </div>
</div>


<?= $this->endSection() ?>