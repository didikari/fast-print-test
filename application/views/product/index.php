<div class="card">
	<div class="card-header d-flex justify-content-between align-items-center">
		<h5 class="card-title">Product List</h5>
		<div class="btn-group">
			<button class="btn btn-primary btn-sm me-2">
				<a href="<?= base_url('product/add') ?>" class="text-white">
					<i class="bx bx-plus"></i> Add Product
				</a>
			</button>
			<!-- Sync Button -->
			<button type="button" class="btn btn-info btn-sm">
				<a href="<?= base_url('api/product') ?>" class="text-white">
					<i class="bx bx-refresh"></i> Sync
				</a>
			</button>
		</div>
	</div>
	<div class="card-datatable text-nowrap table-responsive">
		<table id="productTable" class="table table-hover table-bordered dataTable">
			<thead class="table-dark">
				<tr>
					<td>No</td>
					<th>ID</th>
					<th>Nama</th>
					<th>Kategori</th>
					<th>Harga</th>
					<th>Status</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($products as $index => $product): ?>
					<tr>
						<td><?= $index+1?></td>
						<td><?= $product['id_produk'] ?></td>
						<td><?= $product['nama_produk'] ?></td>
						<td><?= $product['nama_kategori'] ?></td>
						<td><?= 'Rp ' . number_format($product['harga'], 0, ',', '.') ?></td>
						<td>
							<?php if ($product['status_id'] == 1): ?>
								<span class="badge bg-success">Active</span>
							<?php else: ?>
								<span class="badge bg-danger">Inactive</span>
							<?php endif; ?>
						</td>
						<td>
							<a href="<?= base_url('product/edit/' . $product['id_produk']) ?>" class="btn btn-sm btn-warning btn-delete">
								<i class="bx bx-edit-alt"></i> Edit
							</a>
							<a href="#" data-id="<?= $product['id_produk']; ?>"
								class="btn btn-sm btn-danger delete-btn" data-controller="product">
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
