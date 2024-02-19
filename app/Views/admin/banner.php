<?= $this->extend('layout/template_admin') ?>

<?= $this->section('content_admin') ?>
<div class="card card-bordered">

    <div class="card-inner">
        <a onclick="addBanner()" class="btn btn-primary mb-1">Tambah Banner</a><br>
        <span>Hanya 5 data terakhir yang ditampilkan pada Dashboard Aplikasi ATEI Bartim</span>
        <!-- <span>Jika data tidak tampil di dashboard Aplikasi ATEI mungkin belum dikirim ke Rest API ATEI</span> -->
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered" id="TabelBanner" aria-describedby="DataTables_Table_0_info">
                <thead>
                    <tr class="bg-primary text-white text-center">
                        <th width="5%">No</th>
                        <th width="30%">Deskirpsi</th>
                        <th >Gambar</th>

                        <th width="30%"></th>
                    </tr>
                </thead>

            </table>
        </div>

    </div>
</div>


<!-- Modal Form -->
<div class="modal fade" id="modalTambahBanner">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Banner</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form class="form-validate is-alter" id="formTambahBanner" method="post">
                    
                    <div class="form-group">
                        <label class="form-label" for="full-name">Deskripsi</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="banner_title" name="banner_title" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="default-06">Foto</label>
                        <div class="form-control-wrap">
                            <div class="form-file">
                                <input type="file" multiple="" class="form-file-input" id="banner" name="banner">
                                <label class="form-file-label" for="customFile">Pilih Foto</label>
                                <small class="text-danger">PNG/JPG/JPEG, Gunakan Rasio 16:9 </small>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-lg btn-danger">Batal</button>&nbsp;
                        <!-- <button type="button" onclick="devProgress()" class="btn btn-lg btn-primary">Simpan</button> -->
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
                    <input type="text" hidden id="id_unit" name="id_unit">
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