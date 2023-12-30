<?= $this->extend('layout/qr_code_template') ?>

<?= $this->section('content') ?>
<div class="nk-block-head nk-block-head-sm">
	<div class="nk-block-between">
		<div class="nk-block-head-content">
			<h3 class="nk-block-title page-title"><?php echo $skpd ?></h3>
		</div><!-- .nk-block-head-content -->
		<div class="nk-block-head-content">
			<div class="toggle-wrap nk-block-tools-toggle">
				<a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
				<div class="toggle-expand-content" data-content="pageMenu">
					<ul class="nk-block-tools g-3">
						<li><a href="<?php echo base_url()?>/auth/logout" class="btn btn-white btn-outline-light"><em class="icon ni ni-power"></em><span>Log Out</span></a></li>
					</ul>
				</div>
			</div><!-- .toggle-wrap -->
		</div><!-- .nk-block-head-content -->
	</div><!-- .nk-block-between -->
</div>
<div class="row justify-content-lg-center ">
	<div class="col-lg-6">
		<div class="card">
			<input type="text" hidden id="id_qr_scan" value="<?php echo session('ses_id_unit') ?>">

			<div class="row h-250px">
				<div class="col-5">
					<div id="qrcode_pagi" class="m-5"></div>
				</div>
				<div class="col-md-7 bg-primary h-250px">
					<div class="card-body">
						<h1 id="rawQr"></h1>
						<h4 class="card-title text-white">ABSENSI MASUK </h4>

						<h6 class="card-text text-white">Scan untuk melakukan absensi masuk</h6>

						<div class="alert alert-light" role="alert">
							<div class="d-flex align-items-center">

								<div class="flex-grow-1 ms-3">
									<h3 class="alert-heading mb-1"><span id="qrid"></span></h3>
									<h6 class="card-title " id="pukul"></h6>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Title -->

		<!-- End Title -->
	</div>
	<div class="col-lg-6">
		<div class="card">

			<div class="row h-250px">
				<div class="col-5">
					<div id="qrcode_out" class="m-5"></div>
				</div>
				<div class="col-md-7 bg-warning h-250px">
					<div class="card-body">
						<h4 class="card-title text-white">ABSENSI KELUAR</h4>

						<h6 class="card-text text-white">Scan untuk melakukan absensi keluar</h6>

						<div class="alert alert-light" role="alert">
							<div class="d-flex align-items-center">

								<div class="flex-grow-1 ms-3">
									<h3 class="alert-heading mb-1"><span id="qrid_out"></span></h3>
									<h6 class="card-title " id="pukulOut"></h6>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Title -->

		<!-- End Title -->
	</div>
</div>
<!-- End Row -->
<?= $this->endSection() ?>