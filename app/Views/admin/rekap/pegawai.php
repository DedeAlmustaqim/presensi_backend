<?= $this->extend('layout/template_admin') ?>
<?= $this->section('content_admin') ?>
<div class="card card-bordered">
    <div class="card-inner">

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-label" for="full-name-1">SKPD</label>
                    <div class="form-control-wrap ">
                        <div class="form-control-select">
                            <select class="form-control" id="id_unit_rekap_adm" name="id_unit_rekap_adm">
                                <option value="">-</option>
                                <?php foreach ($unit as $u) {
                                    echo "<option value='" . $u["id"] . "'>" . $u["nm_unit"] . "</option>";
                                } ?>
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
                            <select class="form-control" id="tahun_tpp_adm" name="tahun_tpp_adm">
                                <option value="">-</option>
                                <option value="2024">2024</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label class="form-label" for="email-address-1">Pilih Bulan</label>
                    <div class="form-control-wrap">
                        <div class="form-control-select">
                            <select class="form-control" id="bulan_tpp_adm" name="bulan_tpp_adm">
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

            <div class="col-lg-4">
                <div id="showCountAdm"></div>
            </div>
            <div class="col-12" id="btnCetak">


            </div>
        </div>



        <hr>

        <div class="table-responsive">
            <table class="table table-bordered " id="tabelTPPAdmin">
                <thead>
                    <tr class="bg-primary text-white text-center">

                        <th>No</th>
                        <th width="30%">Nama</th>
                        <th>NIP</th>
                        <th>Penilaian Disiplin <br> (%)</th>
                        <th>Total Skor <br>Disiplin Kerja (%)</th>
                        <th width="17%">Aksi</th>
                    </tr>
                </thead>

            </table>
        </div>

    </div>

</div>

<!-- Modal Form -->
<div class="modal fade zoom" id="detailRekapAdmin">
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