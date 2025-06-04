<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Daftar Sales</h1>
            <a href="<?= base_url('sales/tambah'); ?>" class="btn btn-primary mb-3">Tambah Sales</a>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <?php if($this->session->flashdata('success')): ?>
                    <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
                <?php endif; ?>

                <?php if($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
                <?php endif; ?>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID Sales</th>
                            <th>Nama Sales</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($sales)): ?>
                            <?php foreach($sales as $s): ?>
                                <tr>
                                    <td><?= htmlspecialchars($s['idsales']); ?></td>
                                    <td><?= htmlspecialchars($s['nama_sales']); ?></td>
                                    <td>
                                        <a href="<?= base_url('sales/edit/' . $s['idsales']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="<?= base_url('sales/hapus/' . $s['idsales']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus sales ini?');">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="3" class="text-center">Data sales kosong</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </section>
</div>