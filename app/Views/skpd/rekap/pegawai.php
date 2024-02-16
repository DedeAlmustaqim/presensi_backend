<?= $this->extend('layout/template_skpd') ?>

<?= $this->section('content_skpd') ?>
<div class="card card-bordered">

    <div class="card-inner">

        <div class="table-responsive">
            <table class="table table-bordered" id="tabelRekapPegawai" aria-describedby="DataTables_Table_0_info">
                <thead>
                    <tr class="bg-primary text-white text-center">
                        <th width="5%">No</th>
                        <th width="35%">Nama</th>
                        <th width="30%">Rekapitulasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

            </table>
        </div>

    </div>
</div>





<div class="modal fade" id="modalRekapJamKerja">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Absensi Pegawai Sesuai Jam Kerja</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form id="" class="form-validate" novalidate="novalidate">
                    <input type="text" hidden name="id_user_lap_jam_kerja" id="id_user_lap_jam_kerja">
                    <div class="row g-gs">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pilih Tahun</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" name="tahun_lap" id="tahun_lap" required="">
                                        <option value="">-</option>
                                        <option value="2024">2024</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-control-wrap">
                                <label>Pilih Bulan</label>
                                <select class="form-select" name="bulan_lap" id="bulan_lap" required="">
                                    <option value="">-</option>
                                    <?php
                                    helper('tanggal_indo_helper');
                                   
                                    for ($i = 1; $i <= 12; $i++) {

                                        echo "<option value=\"$i\">" . bulan($i) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" data-bs-dismiss="modal" class="btn btn-lg btn-danger">Batal</button>&nbsp;
                            <button type="button" onclick="cetakRekapPerPeg()" class="btn btn-lg btn-primary">Cetak Laporan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalRekapTPP">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Absensi Pegawai Sesuai TPP</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form id="" class="form-validate" novalidate="novalidate">
                    <input type="text" hidden name="id_user_lap_tpp" id="id_user_lap_tpp">
                    <div class="row g-gs">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pilih Tahun</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" name="tahun_tpp" id="tahun_tpp" required="">
                                        <option value="">-</option>
                                        <option value="2024">2024</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-control-wrap">
                                <label>Pilih Bulan</label>
                                <select class="form-select" name="bulan_tpp" id="bulan_tpp" required="">
                                    <option value="">-</option>
                                    <?php
                                    helper('tanggal_indo_helper');
                                   
                                    for ($i = 1; $i <= 12; $i++) {

                                        echo "<option value=\"$i\">" . bulan($i) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" data-bs-dismiss="modal" class="btn btn-lg btn-danger">Batal</button>&nbsp;
                            <button type="button" onclick="cetakRekapTPP()" class="btn btn-lg btn-primary">Cetak Laporan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>