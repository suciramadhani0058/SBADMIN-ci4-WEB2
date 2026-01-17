<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<h2>Tambah detail transaksi</h2>
<hr>
<form action="/detailtransaksi/create" method="post">
    <?= csrf_field(); ?>

    <div class="mb-3">
        <label class="form-label">Transaksi</label>
        <select name="transaksi_id" class="form-control" required>
            <option value="">-- Pilih Transaksi --</option>
            <?php foreach ($transaksi as $t): ?>
                <option value="<?= $t['id']; ?>">
                    <?= $t['id']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Barang</label>
        <select name="barang_id" class="form-control" required>
            <option value="">-- Pilih Barang --</option>
            <?php foreach ($barang as $b): ?>
                <option value="<?= $b['id']; ?>">
                    <?= $b['id']; ?> - <?= $b['nama_barang'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">jumlah</label>
        <input type="number" name="jumlah" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Subtotal</label>
        <input type="number" name="subtotal" class="form-control" required>
    </div>

    <button class="btn btn-success">Simpan</button>
    <a href="/detailtransaksi" class="btn btn-secondary">Kembali</a>
</form>

<?= $this->endSection() ?>