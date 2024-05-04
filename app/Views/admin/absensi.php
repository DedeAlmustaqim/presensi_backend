<?= $this->extend('layout/template_admin') ?>
<?= $this->section('content_admin') ?>
<div class="card card-bordered">
    <div class="card-inner">
        <form id="updateSubtraction" method="post">


            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label" for="full-name-1">SKPD</label>
                        <div class="form-control-wrap ">
                            <div class="form-control-select">
                                <select class="form-control" id="skpd_adm" name="skpd_adm">
                                    <option value="">-</option>
                                    <?php foreach ($unit as $u) {
                                        echo "<option value='" . $u["id"] . "'>" . $u["nm_unit"] . "</option>";
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label" for="phone-no-1">Pegawai</label>
                        <div class="form-control-wrap ">
                            <div class="form-control-select">
                                <select class="form-control" id="user_adm" name="user_adm">
                                    <option value="">-</option>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label class="form-label" for="full-name-1">Pilih Tahun</label>
                        <div class="form-control-wrap ">
                            <div class="form-control-select">
                                <select class="form-control" id="tahun_adm" name="tahun_adm">
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
                                <select class="form-control" id="bulan_adm" name="bulan_adm">
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
                
            </div>
            <hr>
            <div class="row">
                <div class="col-8">
                    <div class="row g-3 align-center">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-label" for="site-name">Tidak Upacara</label>
                                <span class="form-note">Pengurangan sebesar 3% per Kegiatan</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="form-text-hint">
                                        <span class="overline-title">Kegiatan</span>
                                    </div>
                                    <input disabled type="text" class="form-control" id="keg_upacara_adm" name="keg_upacara_adm" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 align-center">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-label" for="site-name">LHKPN/ LHKASN </label>
                                <span class="form-note">Pengurangan sebesar 5% dari total TPP PNS/CPNS per bulan</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="form-control-wrap ">
                                    <div class="form-control-select">
                                        <select disabled class="form-control" id="lhkpn_lhasn_adm" name="lhkpn_lhasn_adm">
                                            <option value="">-Pilih-</option>
                                            <option value="true">Sudah</option>
                                            <option value="false">Belum</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 align-center">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-label" for="site-name">TPTGR </label>
                                <span class="form-note">Pengurangan sebesar 5% dari total TPP PNS/CPNS per bulan</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="form-control-wrap ">
                                    <div class="form-control-select">
                                        <select disabled class="form-control" id="tptgr_adm" name="tptgr_adm">
                                            <option value="">-Pilih-</option>
                                            <option value="true">Sudah</option>
                                            <option value="false">Belum</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <a onclick="refreshAbsensi()" class="btn btn-dark mb-1">Refresh Data</a><br>
                    <div id="btn_cetak_tpp"></div>
                </div>
            </div>
        </form>
        <hr>

        <div class="table-responsive">
            <table class="table table-bordered nowrap table-striped" id="tabelAbsenPegawaiAdmin">
                <thead>
                    <tr class="bg-primary text-white text-center">
                        <th>No</th>

                        <th>Tanggal Check In</th>
                        <th>Jam Check In</th>
                        <th>Keterangan</th>
                        <th>Tanggal Check Out</th>
                        <th>Jam Check Out</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

            </table>
        </div>

    </div>
</div>

<!-- Modal Form -->
<div class="modal fade" id="modalKet">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Keterangan Absensi</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <table class="table table-bordered nowrap">
                    <thead>
                        <th>Keterangan Check IN</th>
                        <th><span id="tgl_in_off"></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="30%">No Surat</td>
                            <td><span id="no_surat_in"></span></td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td><span id="ket_in"></td>
                        </tr>
                    </tbody>

                </table>
                <hr>
                <table class="table table-bordered nowrap">
                    <thead>
                        <th>Keterangan Check OUT</th>
                        <th><span id="tgl_out_off"></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="30%">No Surat</td>
                            <td><span id="no_surat_out"></td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td><span id="ket_out"></td>
                        </tr>
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>


<?= $this->endSection() ?>