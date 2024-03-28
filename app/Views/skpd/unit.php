<?= $this->extend('layout/template_skpd') ?>

<?= $this->section('content_skpd') ?>
<div class="nk-block nk-block-lg">

    <div class="card card-bordered">
        <div class="card-inner">
            <form id="formEditUnitSkpd" class="form-validate" novalidate="novalidate">
                <div class="row g-gs">
                    <input type="text" id="id_unit_skpd" hidden name="id_unit_skpd" value="<?php echo session('ses_id_unit') ?>">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="nm_unit_skpd">Nama SKPD</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="nm_unit_skpd" name="nm_unit_skpd" required="">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="fv-email">Nama Pimpinan</label>
                            <div class="form-control-wrap">

                                <input type="text" class="form-control" id="pimpinan_skpd" name="pimpinan_skpd" required="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="fv-phone">Koordinat</label>
                            <div class="form-control-wrap">
                                <ul class="custom-control-group">
                                    <li>
                                        <div class="form-control-wrap">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="fv-phone">Latitude</span>
                                                </div>
                                                <input type="text" disabled class="form-control" name="lat_skpd" id="lat_skpd" required="">
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-control-wrap">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="fv-phone">Longitude</span>
                                                </div>
                                                <input type="text" disabled class="form-control" name="long_skpd" id="long_skpd" required="">
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="fv-phone">Golongan</label>
                            <div class="form-control-wrap">
                                <select class="form-select" name="gol_skpd" id="gol_skpd" required="">
                                    <option value="-">-</option>
                                    <option value="Pembina Utama Madya (IV/d)">Pembina Utama Madya (IV/d)</option>
                                    <option value="Pembina Utama Muda (IV/c)">Pembina Utama Muda (IV/c)</option>
                                    <option value="Pembina Tingkat I (IV/b)">Pembina Tingkat I (IV/b)</option>
                                    <option value="Pembina (IV/a)">Pembina (IV/a)</option>
                                    <option value="Penata Tingkat I (III/d)">Penata Tingkat I (III/d)</option>
                                </select>
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
                                    <input type="text" disabled class="form-control" id="radius_skpd" name="radius_skpd" required="">
                                    <small class="">* Gunakan titik untuk decimal</small>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="fv-email">NIP</label>
                            <div class="form-control-wrap">

                                <input type="text" class="form-control" id="nip_skpd" name="nip_skpd" required="" maxlength="18" minlength="18">
                                <small class="">* jangan gunakan spasi</small>
                            </div>
                        </div>
                    </div>

                    <dvi class="col-md-6">
                        <label class="form-label" for="fv-email">Jam Kerja</label>
                        <div class="row gy-4 align-center">
                            <div class="col-lg-4">
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="fv-phone">Masuk</span>
                                        </div>
                                        <input type="time" class="form-control" readonly disabled name="jam_masuk_skpd" id="jam_masuk_skpd" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="fv-phone">Pulang</span>
                                        </div>
                                        <input type="time" class="form-control" readonly disabled name="jam_pulang_skpd" id="jam_pulang_skpd" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <input type="text" readonly disabled id="h_kerja" name="h_kerja" class="form-control" placeholder="">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Hari Kerja</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </dvi>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="fv-email">Jabatan</label>
                            <div class="form-control-wrap">

                                <input type="text" class="form-control" id="jabatan_skpd" name="jabatan_skpd" required="">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
            <hr>
            <div class="col-md-12">
                <div class="form-group">
                    <a class="btn btn-lg btn-secondary" onclick="changePassSkpd()">Ubah Password Admin SKPD</a>
                    <a class="btn btn-lg btn-warning" onclick="changePassQR()">Ubah Password Operator QR</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalchangePassSkpd">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Password Admin SKPD</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form class="form-validate is-alter" id="formchangePassSkpd" method="post">
                    <input hidden name="id_unit_res_skpd" id="id_unit_res_skpd" value="<?php echo session('ses_id_unit') ?>">
                    <div class="form-group">
                        <label class="form-label" for="full-name">Password Baru</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="pass_reset_skpd" name="pass_reset_skpd" minlength="6" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="full-name">Ulangi Password</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="pass_reset_skpd_repeat" name="pass_reset_skpd_repeat" minlength="6" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-lg btn-danger">Batal</button>&nbsp;
                        <button type="submit" class="btn btn-lg btn-primary">Simpan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modalchangePassQr">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Password Operator QR</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form class="form-validate is-alter" id="formchangePassQr" method="post">
                    <input hidden name="id_unit_res_qr" id="id_unit_res_qr" value="<?php echo session('ses_id_unit') ?>">
                    <div class="form-group">
                        <label class="form-label" for="full-name">Password Baru</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="pass_reset_qr" name="pass_reset_qr" minlength="6" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="full-name">Ulangi Password</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="pass_reset_qr_repeat" name="pass_reset_qr_repeat" minlength="6" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-lg btn-danger">Batal</button>&nbsp;
                        <button type="submit" class="btn btn-lg btn-primary">Simpan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>