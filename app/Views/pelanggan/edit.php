<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">Edit pelanggan</h2>

    <form action="/pelanggan/update/<?= $pelanggan['id'] ?>" method="post">
        <?= csrf_field(); ?>

        <div class="mb-3">
            <label>Nama pelanggan</label>
            <input type="text" name="nama" class="form-control" value="<?= $pelanggan['nama'] ?>" required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" value="<?= $pelanggan['alamat'] ?>" required>
        </div>

        <div class="mb-3">
            <label>telepon</label>
            <input type="number" name="telepon" class="form-control" value="<?= $pelanggan['telepon'] ?>" required>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="/pelanggan" class="btn btn-secondary">Kembali</a>
    </form>

<?= $this->endSection() ?>
