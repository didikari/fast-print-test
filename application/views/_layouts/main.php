<!DOCTYPE html>
<html
	lang="en"
	class="light-style layout-menu-fixed"
	dir="ltr"
	data-theme="theme-default"
	data-assets-path="<?= base_url('assets/'); ?>"
	data-template="vertical-menu-template-free">

<head>
	<meta charset="utf-8" />
	<meta
		name="viewport"
		content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
	<title>Programmer Test - <?= $title ?></title>
	<meta name="description" content="" />

	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon/favicon.ico'); ?>" />

	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link
		href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
		rel="stylesheet" />

	<!-- Icons -->
	<link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/boxicons.css'); ?>" />

	<!-- Core CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/vendor/css/core.css'); ?>" class="template-customizer-core-css" />
	<link rel="stylesheet" href="<?= base_url('assets/vendor/css/theme-default.css'); ?>" class="template-customizer-theme-css" />
	<link rel="stylesheet" href="<?= base_url('assets/css/demo.css'); ?>" />

	<!-- Vendors CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css'); ?>" />

	<!-- Helpers -->
	<script src="<?= base_url('assets/vendor/js/helpers.js'); ?>"></script>

	<!-- Template Config -->
	<script src="<?= base_url('assets/js/config.js'); ?>"></script>
	<link href="<?= base_url('assets/vendor/DataTables/datatables.min.css') ?>" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
	<!-- Layout wrapper -->
	<div class="layout-wrapper layout-content-navbar">
		<div class="layout-container">
			<!-- Sidebar -->
			<?php $this->load->view('_layouts/sidebar'); ?>

			<!-- Layout container -->
			<div class="layout-page">
				<?php $this->load->view('_layouts/navbar'); ?>
				<!-- Content wrapper -->
				<div class="content-wrapper">
					<!-- Content -->
					<div class="container-xxl flex-grow-1 container-p-y">
						<!-- Layout Content -->
						<?php $this->load->view($content); ?>
					</div>
					<!-- / Content -->

					<!-- Footer -->
					<?php $this->load->view('_layouts/footer'); ?>

					<div class="content-backdrop fade"></div>
				</div>
				<!-- / Content wrapper -->
			</div>
			<!-- / Layout page -->
		</div>
		<!-- Overlay -->
		<div class="layout-overlay layout-menu-toggle"></div>
	</div>
	<!-- / Layout wrapper -->

	<!-- Core JS -->
	<script src="<?= base_url('assets/vendor/libs/jquery/jquery.js'); ?>"></script>
	<script src="<?= base_url('assets/vendor/libs/popper/popper.js'); ?>"></script>
	<script src="<?= base_url('assets/vendor/js/bootstrap.js'); ?>"></script>
	<script src="<?= base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js'); ?>"></script>
	<script src="<?= base_url('assets/vendor/js/menu.js'); ?>"></script>


	<script src="<?= base_url('assets/vendor/DataTables/datatables.min.js') ?>"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

	<script>
		document.addEventListener('DOMContentLoaded', function() {
			document.querySelectorAll('.delete-btn').forEach(function(button) {
				button.addEventListener('click', function(e) {
					e.preventDefault();
					const id = this.getAttribute('data-id');
					const controller = this.getAttribute('data-controller');

					Swal.fire({
						title: 'Apakah Anda yakin?',
						text: "Data tidak bisa dikembalikan!",
						icon: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Ya, hapus!',
						cancelButtonText: 'Batal'
					}).then((result) => {
						if (result.isConfirmed) {
							window.location.href = '<?= base_url(); ?>' + controller + '/destroy/' + id;
						}
					});
				});
			});
		});
	</script>

	<?php if ($this->session->flashdata('success')): ?>
		<script>
			Swal.fire({
				icon: 'success',
				title: 'Berhasil!',
				text: '<?= $this->session->flashdata('success'); ?>',
				showConfirmButton: false,
				timer: 1500
			});
		</script>
	<?php endif; ?>

	<?php if ($this->session->flashdata('error')): ?>
		<script>
			Swal.fire({
				icon: 'error',
				title: 'Gagal!',
				text: '<?= $this->session->flashdata('error'); ?>',
				showConfirmButton: false,
				timer: 1500
			});
		</script>
	<?php endif; ?>

	<?php if ($this->session->flashdata('warning')): ?>
		<script>
			Swal.fire({
				icon: 'warning',
				title: 'Gagal!',
				text: '<?= $this->session->flashdata('warning'); ?>',
				showConfirmButton: false,
				timer: 1500
			});
		</script>
	<?php endif; ?>

	<script>
		$(document).ready(function() {
			// Cari semua elemen tabel dengan class .dataTable dan inisialisasi DataTables
			$('.dataTable').each(function() {
				$(this).DataTable();
			});
		});
	</script>


	<script src="<?= base_url('assets/js/main.js'); ?>"></script>

	<!-- GitHub Buttons JS -->
	<script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
