<?= $this->extend('layout/template_admin') ?>

<?= $this->section('content_admin') ?>
<div class="card card-bordered">
    <div class="card-inner">       
        <div class="table-responsive">
            <table class="table table-bordered" id="TabelLogger" aria-describedby="DataTables_Table_0_info">
                <thead>
                    <tr class="bg-primary text-white text-center">
                        <th width="5%">No</th>
                        <th width="25%">Nama</th>
                        <th >Aksi</th>
                        <th >Additional Info</th>
                        <th >Log Time</th>
                    </tr>
                </thead>

            </table>
        </div>

    </div>
</div>
<?= $this->endSection() ?>