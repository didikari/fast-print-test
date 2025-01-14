<div class="card">
    <div class="card-header">
        <h5 class="card-title">Tambah Kategori</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('status/edit/'.$status['id_status']); ?>" method="POST">
            <div class="row">
                <!-- Harga -->
                <div class="mb-3 col-md-6">
                    <label for="nama_status" class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control" id="nama_status" name="nama_status" placeholder="Nama status" value="<?= $status['nama_status']?>" required>
                </div>
            </div>

            <div class="d-flex">
                <button type="submit" class="btn btn-primary me-3">
                    <i class="bx bx-save"></i> Simpan
                </button>
                <a href="<?= base_url('status') ?>" class="btn btn-secondary">
                    <i class="bx bx-arrow-back"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
