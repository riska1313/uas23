<div class="content-wrapper">
    <section class="content-header">
        <h1>Data Pelanggan</h1>
        <a href="<?php echo base_url('pelanggan/tambah'); ?>" class="btn btn-primary mb-3">Tambah Pelanggan</a>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
        <?php elseif ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
        <?php endif; ?>
    </section>

    <section class="content">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pelanggan as $p): ?>
                <tr>
                    <td><?php echo $p['idpelanggan']; ?></td>
                    <td><?php echo $p['nama']; ?></td>
                    <td><?php echo $p['alamat']; ?></td>
                    <td><?php echo $p['no_telp']; ?></td>
                    <td>
                        <a href="<?php echo base_url('pelanggan/edit/'.$p['idpelanggan']); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?php echo base_url('pelanggan/hapus/'.$p['idpelanggan']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?');">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>