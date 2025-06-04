<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1><?= isset($pelanggan) ? 'Edit' : 'Tambah' ?> Pelanggan</h1>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Form <?= isset($pelanggan) ? 'Edit' : 'Tambah' ?> Pelanggan</h3></div>
            <div class="card-body">
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                
                <form action="<?= isset($pelanggan) ? base_url('pelanggan/update/'.$pelanggan['idpelanggan']) : base_url('pelanggan/insert'); ?>" method="POST">
                    <div class="form-group">
                        <label for="nama">Nama Pelanggan</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= isset($pelanggan) ? $pelanggan['nama'] : '' ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" required><?= isset($pelanggan) ? $pelanggan['alamat'] : '' ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">No. Telepon</label>
                        <input type="text" name="no_telp" id="no_telp" class="form-control" value="<?= isset($pelanggan) ? $pelanggan['no_telp'] : '' ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </section>
</div>