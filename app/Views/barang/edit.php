<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">Edit Barang</h2>

    <form action="/barang/update/<?= $barang['id'] ?>" method="post">
        <?= csrf_field(); ?>

        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" value="<?= $barang['nama_barang'] ?>" required>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="<?= $barang['harga'] ?>" required>
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" value="<?= $barang['stok'] ?>" required>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="/barang" class="btn btn-secondary">Kembali</a>
    </form>

<?= $this->endSection() ?>
