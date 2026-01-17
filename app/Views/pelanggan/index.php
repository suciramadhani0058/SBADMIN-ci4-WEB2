<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<h2> Data Pelanggan</h2>
<hr>
<a href="/pelanggan/new" class="btn btn-success">Tambah pelanggan</a>
<hr>
<table class="table table-bordered table-striped" id="dataTable">
    <thead class="bg-primary text-white">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama pelanggan</th>
            <th scope="col">Alamat</th>
            <th scope="col">Nomor Hp</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($pelanggan)): ?>
            <?php $no = 1; ?>
            <?php foreach ($pelanggan as $p): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $p['nama'] ?></td>
                    <td><?= $p['alamat'] ?></td>
                    <td><?= $p['telepon'] ?></td>
                    <td class="text-center">
                        <a href="<?= base_url('pelanggan/edit/' . $p['id']) ?>"
                            class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>

                        <a href="<?= base_url('pelanggan/delete/' . $p['id']) ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">Belum ada data</td>
            </tr>
        <?php endif; ?>
    </tbody>

</table>

<?= $this->endSection() ?>