<?= $this->extend('layout/template_admin') ?>

<?= $this->section('content_admin') ?>
<div class="card card-bordered">

    <div class="card-inner">
        <?php if (session('akses') == 1) {

        ?>
            <a onclick="addDateToSkip()" class="btn btn-primary mb-1">Tambah hari Libur</a><br>
            <span>Memambahkan hari libur akan mengecualikan tanggal libur pada Rekap Laporan</span>
        <?php
        } ?>

        
        <!-- <span>Jika data tidak tampil di dashboard Aplikasi ATEI mungkin belum dikirim ke Rest API ATEI</span> -->
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered" id="TabelDatetoSkip" aria-describedby="DataTables_Table_0_info">
                <thead>
                    <tr class="bg-primary text-white text-center">
                        <th width="5%">No</th>
                        <th width="30%">Tanggal</th>
                        <th>Keterangan</th>

                        
                        <th width="30%"></th>
                    </tr>
                </thead>

            </table>
        </div>

    </div>
</div>


<!-- Modal Form -->
<div class="modal fade" id="modaladdDateToSkip">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Hari Libur</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form class="form-validate is-alter" id="formaddDateToSkip" method="post">

                    <div class="form-group">
                        <label class="form-label" for="full-name">Tanggal</label>
                        <div class="form-control-wrap">
                            <input type="date" class="form-control" id="date_to_skip" name="date_to_skip" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="default-textarea">Keterangan</label>
                        <div class="form-control-wrap">
                            <textarea required class="form-control no-resize" id="ket_date_to_skip" name="ket_date_to_skip"></textarea>
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
<div class="modal fade" id="modalEditDate">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Hari Libur</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form class="form-validate is-alter" id="formaddDateToSkip" method="post">
                    <input type="text" id="id_date" hidden name="id_date">
                    <div class="form-group">
                        <label class="form-label" for="full-name">Tanggal</label>
                        <div class="form-control-wrap">
                            <input type="date" class="form-control" id="date_to_skip_edit" name="date_to_skip_edit" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="default-textarea">Keterangan</label>
                        <div class="form-control-wrap">
                            <textarea required class="form-control no-resize" id="ket_date_to_skip_edit" name="ket_date_to_skip_edit"></textarea>
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