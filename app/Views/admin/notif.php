<?= $this->extend('layout/template_admin') ?>

<?= $this->section('content_admin') ?>
<div class="card card-bordered">

    <div class="card-inner">
        <a onclick="addNotif()" class="btn btn-primary mb-1">Tambah Pemberitahuan</a><br>
        <span>Hanya 5 data terakhir yang ditampilkan pada Dashboard Aplikasi ATEI Bartim</span>
        <!-- <span>Jika data tidak tampil di dashboard Aplikasi ATEI mungkin belum dikirim ke Rest API ATEI</span> -->
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered" id="TabelNotif" aria-describedby="DataTables_Table_0_info">
                <thead>
                    <tr class="bg-primary text-white text-center">
                        <th width="5%">No</th>
                        <th width="30%">Judul</th>
                        <th>Konten</th>

                        <th width="30%"></th>
                    </tr>
                </thead>

            </table>
        </div>

    </div>
</div>


<!-- Modal Form -->
<div class="modal fade" id="modalTambahNotif">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Notif</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form class="form-validate is-alter" id="formTambahNotif" method="post">

                    <div class="form-group">
                        <label class="form-label" for="full-name">Judul</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="notif_title" name="notif_title" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="default-textarea">Konten</label>
                        <div class="form-control-wrap">
                            <textarea required class="form-control no-resize" id="notif_konten" name="notif_konten"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="full-name">Tag</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="notif_tag" name="notif_tag" required>
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
<div class="modal fade" id="modalEditNotif">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Notif</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form class="form-validate is-alter" id="formEditNotif" method="post">
                    <input type="text" hidden id="id_notif" name="id_notif">
                    <div class="form-group">
                        <label class="form-label" for="full-name">Judul</label>
                        <div class="form-control-wrap">
                            <input type="text"  class="form-control" id="notif_title_edit" name="notif_title_edit" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="default-textarea">Konten</label>
                        <div class="form-control-wrap">
                            <textarea required class="form-control no-resize" id="notif_konten_edit" name="notif_konten_edit"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="full-name">Tag</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="notif_tag_edit" name="notif_tag_edit" required>
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