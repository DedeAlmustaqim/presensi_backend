<?= $this->extend('layout/template_skpd') ?>

<?= $this->section('content_skpd') ?>
<div class="card card-bordered">

    <div class="card-inner">
        <a onclick="tambahPeg()" class="btn btn-primary mb-1">Tambah Pegawai</a>
        <hr>

        <div class="table-responsive">
            <table class="table table-bordered" id="tabelPegawai" aria-describedby="DataTables_Table_0_info">
                <thead>
                    <tr class="bg-primary text-white text-center">
                        <th width="5%">No</th>
                        <th width="15%">Username</th>
                        <th width="25%">Nama</th>
                        <th width="20%">Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

            </table>
        </div>

    </div>
</div>


<!-- Modal Form -->
<div class="modal fade" id="modalTambahPeg">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pegawai</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form class="form-validate is-alter" id="formTambahPeg" method="post">
                    <div class="form-group">
                        <label class="form-label" for="full-name">Username</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="username_peg" name="username_peg" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="full-name">Nama</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="nama_peg" name="nama_peg" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="full-name">NIP</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="nip_peg" name="nip_peg" required maxlength="18" minlength="18">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="full-name">Jabatan</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="jabatan_peg" name="jabatan_peg" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="full-name">SKPD</label>
                        <div class="form-control-wrap">
                            <input type="text" disabled class="form-control" value="<?php echo $unit ?>">
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

<!-- Modal Form -->
<div class="modal fade" id="modalEditPeg">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Pegawai</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form class="form-validate is-alter" id="formEditPeg" method="post">
                    <input type="text" hidden name="id_user_peg" id="id_user_peg">
                    <div class="form-group">
                        <label class="form-label" for="full-name">Username</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="username_peg_edit" name="username_peg_edit" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="full-name">Nama</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="nama_peg_edit" name="nama_peg_edit" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="full-name">NIP</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="nip_peg_edit" name="nip_peg_edit" required maxlength="18" minlength="18">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="full-name">Jabatan</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="jabatan_peg_edit" name="jabatan_peg_edit" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="full-name">SKPD</label>
                        <div class="form-control-wrap">
                            <input type="text" disabled class="form-control" value="<?php echo $unit ?>">
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

<div class="modal fade" id="modalDevPeg">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perangkat</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <input type="text" hidden name="id_user_dev_peg" id="id_user_dev_peg">
                <table class="table table-bordered">

                    <tbody>
                        <tr>
                            <td width="30%">Nama Pegawai</td>
                            <td>
                                <p id="nm_peg"></p>
                            </td>
                        </tr>
                       
                        <tr>
                            <td width="30%">Model</td>

                            <td>
                                <p id="modelName"></p>
                            </td>
                        </tr>
                        <tr>
                            <td>Perangkat</td>
                            <td>
                                <p id="deviceName"></p>
                            </td>
                        </tr>
                        <tr>
                            <td>Produksi</td>
                            <td>
                                <p id="manufacturerName"></p>
                            </td>
                        </tr>
                        <tr>
                            <td>Produk</td>
                            <td>
                                <p id="productName"></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <div class="text-center" id="btnResDev"></div>

            </div>

        </div>
    </div>
</div>
<?= $this->endSection() ?>