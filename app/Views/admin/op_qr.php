<?= $this->extend('layout/template_admin') ?>

<?= $this->section('content_admin') ?>
<div class="card card-bordered">

    <div class="card-inner">
        <a onclick="tambahOpQr()" class="btn btn-primary mb-1">Tambah Operator Kode QR</a>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered" id="tabelOpQr">
                <thead>
                    <tr class="bg-primary text-white text-center">
                        <th width="5%">No</th>
                        <th width="20%">Username</th>
                        <th width="20%">Nama</th>
                        <th width="20%">SKPD</th>

                        <th></th>
                    </tr>
                </thead>

            </table>
        </div>

    </div>
</div>


<!-- Modal Form -->
<div class="modal fade" id="modalTambahOpQr">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Operator Kode QR</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form class="form-validate is-alter" id="formTambahOpQr" method="post">
                    <div class="form-group">
                        <label class="form-label" for="full-name">Username</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="username_op_qr" name="username_op_qr" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="phone-no">Nama </label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="nama_op_qr" name="nama_op_qr" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="fv-topics">SKPD</label>
                        <div class="form-control-wrap ">
                            <select class="form-select js-select2" id="id_unit_op_qr" name="id_unit_op_qr" data-placeholder="Pilih SKPD" required>
                                <option label="empty" value=""></option>
                                <?php
                                foreach ($skpd as $row) { ?>
                                    <option  value="<?php echo $row['id_unit']?>"><?php echo $row['nm_unit']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <hr>
                    <div class="form-group">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-lg btn-danger">Batal</button>&nbsp;
                        <button type="submit" class="btn btn-lg btn-primary">Simpan</button>
                    </div>
                </form>
                <hr>
                <div class="modal-footer bg-light text-left">
                    <span class="sub-text">Password dibuat secara otomatis<br>Password Default : <b> PresensibyDN </b></span>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal Form -->
<div class="modal fade" id="modalEditOpQq">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Operator Kode QR</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form class="form-validate is-alter" id="formEditOpQr" method="post">
                    <input type="text" hidden  id="id_user_op_qr_edit" name="id_user_op_qr_edit">
                    <div class="form-group">
                        <label class="form-label" for="full-name">Username</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="username_op_qr_edit" name="username_op_qr_edit" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="phone-no">Nama </label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="nama_op_qr_edit" name="nama_op_qr_edit" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="fv-topics">SKPD</label>
                        <div class="form-control-wrap ">
                            <select class="form-select js-select2" id="id_unit_op_qr_edit" name="id_unit_op_qr_edit" data-placeholder="Pilih SKPD" required>
                             
                                <?php
                                foreach ($skpd as $row) { ?>
                                    <option  value="<?php echo $row['id_unit']?>"><?php echo $row['nm_unit']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <hr>
                    <div class="form-group">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-lg btn-danger">Batal</button>&nbsp;
                        <button type="submit" class="btn btn-lg btn-primary">Simpan</button>
                    </div>
                </form>
                <hr>
                <div class="modal-footer bg-light text-left">
                    <span class="sub-text">Password dibuat secara otomatis<br>Hubungi Developer untuk mengetahui Default Password untuk Administrator</span>
                </div>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection() ?>