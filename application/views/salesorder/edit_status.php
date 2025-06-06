<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Status Sales Order</h1>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('salesorder/update_status/' . $salesorder['idso']) ?>" method="POST">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="pending" <?= $salesorder['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="proses" <?= $salesorder['status'] == 'proses' ? 'selected' : '' ?>>Proses</option>
                            <option value="selesai" <?= $salesorder['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Update Status</button>
                    <a href="<?= base_url('salesorder') ?>" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </section>
</div>