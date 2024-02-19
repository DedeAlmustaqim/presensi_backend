<?= $this->extend('layout/template_admin') ?>

<?= $this->section('content_admin') ?>
<div class="nk-block nk-block-lg">

    <div class="card card-bordered">
        <div class="card-inner">
            <form id="formConfig" class="form-validate" novalidate="novalidate">
                <div class="row g-gs">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="nm_unit_skpd">Nama Pemda</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="nm_pemda" name="nm_pemda" required="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="fv-phone">Jam Kerja Pemda</label>
                            <div class="form-control-wrap">
                                <ul class="custom-control-group">
                                    <li>
                                        <div class="form-control-wrap">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="fv-phone">Masuk</span>
                                                </div>
                                                <input type="time" class="form-control" name="jam_masuk" id="jam_masuk" required="">
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-control-wrap">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="fv-phone">Pulang</span>
                                                </div>
                                                <input type="time" class="form-control" name="jam_pulang" id="jam_pulang" required="">
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="fv-phone">Jadwal Kode QR Masuk</label>
                            <div class="form-control-wrap">
                                <ul class="custom-control-group">
                                    <li>
                                        <div class="form-control-wrap">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="fv-phone">Mulai</span>
                                                </div>
                                                <input type="time" class="form-control" name="qr_time_in_start" id="qr_time_in_start" required="">
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-control-wrap">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="fv-phone">Berakhir</span>
                                                </div>
                                                <input type="time" class="form-control" name="qr_time_in_end" id="qr_time_in_end" required="">
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="fv-phone">Jadwal Kode QR Pulang</label>
                            <div class="form-control-wrap">
                                <ul class="custom-control-group">
                                    <li>
                                        <div class="form-control-wrap">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="fv-phone">Mulai</span>
                                                </div>
                                                <input type="time" class="form-control" name="qr_time_out_start" id="qr_time_out_start" required="">
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-control-wrap">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="fv-phone">Berakhir</span>
                                                </div>
                                                <input type="time" class="form-control" name="qr_time_out_end" id="qr_time_out_end" required="">
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="radius_skpd">Radius Titik Absensi</label>

                                <div class="form-control-wrap">
                                    <div class="form-text-hint">
                                        <span class="overline-title">Meter</span>
                                    </div>
                                    <input type="text" class="form-control" id="radius_config" name="radius_config" required="">
                                    <small class="">* Gunakan titik untuk decimal</small>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="fv-email">Versi APK ATEI BARTIM</label>
                            <div class="form-control-wrap">

                                <input type="text" class="form-control" id="versi_apk" name="versi_apk" required="" >

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-4">

                        </div>

                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <!-- <button type="button" onclick="devProgress()" class="btn btn-lg btn-primary">Simpan</button> -->
                            <button type="submit" class="btn btn-lg btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>