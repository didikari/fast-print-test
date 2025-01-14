<div class="card">
    <div class="card-header">
        <h5 class="card-title">Tambah Produk</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('product/store') ?>" method="POST">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="nama_produk" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Masukkan Nama Produk" required>
                </div>
				<!-- Harga -->
                <div class="mb-3 col-md-6">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan Harga Produk" required>
                </div>
            </div>
            <div class="row">
                <!-- Kategori -->
                <div class="mb-3 col-md-6">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori" name="kategori_id" required>
                        <option selected disabled>Pilih Kategori</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id_kategori'] ?>"><?= $category['nama_kategori'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

				<div class="mb-3 col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status_id" required>
                        <option selected disabled>Pilih Status</option>
                        <?php foreach ($statuses as $status): ?>
                            <option value="<?= $status['id_status'] ?>"><?= $status['nama_status'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
            </div>
           
            <div class="text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bx bx-save"></i> Simpan
                </button>
                <a href="<?= base_url('product') ?>" class="btn btn-secondary">
                    <i class="bx bx-arrow-back"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
