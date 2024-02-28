<?= $this->extend('layout/template_admin') ?>

<?= $this->section('content_admin') ?>
<div class="card card-bordered">

    <div class="card-inner">
        <a onclick="tambahUnit()" class="btn btn-primary mb-1">Tambah SKPD</a>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered" id="TabelUnit" aria-describedby="DataTables_Table_0_info">
                <thead>
                    <tr class="bg-primary text-white text-center">
                        <th width="5%">No</th>
                        <th>SKPD</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Hari Kerja</th>
                        <th width="20%"></th>
                    </tr>
                </thead>

            </table>
        </div>

    </div>
</div>


<!-- Modal Form -->
<div class="modal fade" id="modalTambahUnit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Unit</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
            <form class="form-validate is-alter" id="formTambahUnit" method="post">
                   
                    <div class="form-group">
                        <label class="form-label" for="full-name">Nama Unit</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="nm_unit" name="nm_unit" required>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Latitude</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="lat" name="lat" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Longitude</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="long" name="long" required>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Jam Masuk</label>
                                <div class="form-control-wrap">
                                    <input type="time" class="form-control" id="jam_masuk" name="jam_masuk" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Jam Pulang</label>
                                <div class="form-control-wrap">
                                    <input type="time" class="form-control" id="jam_pulang" name="jam_pulang" required>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Hari Kerja</label>
                                <div class="form-control-wrap">
                                    <select class="form-select " id="h_kerja" name="h_kerja" data-placeholder="Pilih SKPD" required>
                                        <option selected value="">Pilih</option>
                                        <option selected value="5">5 Hari</option>
                                        <option selected value="6">6 Hari</option>

                                    </select>
                                </div>
                            </div>
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
<div class="modal fade" id="modalEditUnit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Unit</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <form class="form-validate is-alter" id="formEditUnit" method="post">
                    <input type="text" hidden id="id_unit_skpd_edit" name="id_unit_skpd_edit">
                    <div class="form-group">
                        <label class="form-label" for="full-name">Nama Unit</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="nm_unit_edit" name="nm_unit_edit" required>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Latitude</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="lat_edit" name="lat_edit" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Longitude</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="long_edit" name="long_edit" required>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Jam Masuk</label>
                                <div class="form-control-wrap">
                                    <input type="time" class="form-control" id="jam_masuk_edit" name="jam_masuk_edit" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Jam Pulang</label>
                                <div class="form-control-wrap">
                                    <input type="time" class="form-control" id="jam_pulang_edit" name="jam_pulang_edit" required>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Hari Kerja</label>
                                <div class="form-control-wrap">
                                    <select class="form-select " id="h_kerja_edit" name="h_kerja_edit" data-placeholder="Pilih SKPD" required>
                                        <option selected value="">Pilih</option>
                                        <option selected value="5">5 Hari</option>
                                        <option selected value="6">6 Hari</option>

                                    </select>
                                </div>
                            </div>
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