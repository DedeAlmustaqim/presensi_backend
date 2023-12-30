<?= $this->extend('layout/template_skpd') ?>

<?= $this->section('content_skpd') ?>
<div class="nk-block nk-block-lg">

    <div class="card card-bordered">
        <div class="card-inner">
            <form id="formEditJadwalQr" class="form-validate" novalidate="novalidate">
                <div class="row g-gs">
                    <input type="text" id="id_unit_jadwal" hidden  name="id_unit_jadwal" value="<?php echo session('ses_id_unit') ?>">

                    <div class="col-md-6">
                        <label class="form-label" for="fv-phone">Jadwal QR Code (Masuk)</label>

                        <div class="row gy-4">
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="fv-phone">Mulai</span>
                                            </div>
                                            <input type="text" class="form-control timepicker-digitalNative" name="qr_time_in_start" id="qr_time_in_start" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="fv-phone">Berakhir</span>
                                            </div>
                                            <input type="text" class="form-control timepicker-digitalNative" name="qr_time_in_end" id="qr_time_in_end" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="fv-phone">Jadwal QR Code (Keluar)</label>

                        <div class="row gy-4">
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="fv-phone">Mulai</span>
                                            </div>
                                            <input type="text" class="form-control timepicker-digitalNative" name="qr_time_out_start" id="qr_time_out_start" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="fv-phone">Berakhir</span>
                                            </div>
                                            <input type="text" class="form-control timepicker-digitalNative" name="qr_time_out_end" id="qr_time_out_end" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <hr>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="text-center">
                        <button type="submit" class="btn btn-lg btn-primary text-center">Simpan</button>
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>
</div>
</div>
<?= $this->endSection() ?>