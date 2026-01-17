<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<h2>Tambah Barang</h2>
<hr>
<form action="/barang/create" method="post">
    <div class="mb-3">
        <label for="">Nama Barang</label>
        <input type="text" name="nama_barang" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="">Harga</label>
        <input type="text" name="harga" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="">Stok</label>
        <input type="text" name="stok" class="form-control" required>
    </div>
    <button class="btn btn-success">Simpan</button>
    <a href="/barang" class="btn btn-secondary">Kembali</a>
</form>

<?= $this->endSection() ?>