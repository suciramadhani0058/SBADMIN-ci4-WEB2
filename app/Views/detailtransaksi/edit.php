<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">Edit detail transaksi</h2>

<form action="/detailtransaksi/update/<?= $detailtransaksi['id'] ?>" method="post">
    <?= csrf_field(); ?>

    <div class="mb-3">
        <label class="form-label">ID Transaksi</label>
        <select name="transaksi_id" class="form-control" required>
            <?php foreach ($transaksi as $t): ?>
                <option value="<?= $t['id']; ?>"
                    <?= $t['id'] == $detailtransaksi['transaksi_id'] ? 'selected' : ''; ?>>
                    <?= $t['id']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">ID Barang</label>
        <select name="barang_id" class="form-control" required>
            <?php foreach ($barang as $b): ?>
                <option value="<?= $b['id']; ?>"
                    <?= $b['id'] == $detailtransaksi['barang_id'] ? 'selected' : ''; ?>>
                    <?= $b['id']; ?> - <?= $b['nama_barang'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Jumlah</label>
        <input type="number" name="jumlah" class="form-control" value="<?= $detailtransaksi['jumlah'] ?>" required>
    </div>

    <div class="mb-3">
        <label>subtotal</label>
        <input type="number" name="subtotal" class="form-control" value="<?= $detailtransaksi['subtotal'] ?>" required>
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="/detailtransaksi" class="btn btn-secondary">Kembali</a>
</form>

<?= $this->endSection() ?>