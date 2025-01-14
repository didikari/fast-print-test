<div class="card">
	<div class="card-header d-flex justify-content-between align-items-center">
		<h5 class="card-title">Category List</h5>
		<div class="btn-group">
			<button class="btn btn-primary btn-sm me-2">
				<a href="<?= base_url('categories/add') ?>" class="text-white">
					<i class="bx bx-plus"></i> Add Category
				</a>
			</button>
		</div>
	</div>
	<div class="card-datatable text-nowrap table-responsive">
		<table id="kategoriTable" class="table table-hover table-bordered dataTable">
			<thead class="table-dark">
				<tr>
					<th>ID</th>
					<th>Nama Kategori</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($categories as $category): ?>
					<tr>
						<td><?= $category['id_kategori'] ?></td>
						<td><?= $category['nama_kategori'] ?></td>
						<td>
							<a href="<?= base_url('categories/edit/' . $category['id_kategori']) ?>" class="btn btn-sm btn-warning btn-delete">
								<i class="bx bx-edit-alt"></i> Edit
							</a>
							<a href="#" data-id="<?= $category['id_kategori']; ?>"
								class="btn btn-sm btn-danger delete-btn" data-controller="categories">
								<i class="bx bx-trash"></i> Delete
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="card-footer text-center">
		<small class="text-muted">Last updated: <?= date('Y-m-d H:i:s') ?></small>
	</div>
</div>
