<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<h2>Tambah pelanggan</h2>
<hr>
<form action="/pelanggan/create" method="post">
    <div class="mb-3">
        <label for="">Nama pelanggan</label>
        <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="">Alamat</label>
        <input type="text" name="alamat" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="">telepon</label>
        <input type="text" name="telepon" class="form-control" required>
    </div>
    <button class="btn btn-success">Simpan</button>
    <a href="/pelanggan" class="btn btn-secondary">Kembali</a>
</form>

<?= $this->endSection() ?>