<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>


<h2> Data Barang</h2>
<hr>

<a href="/barang/new" class="btn btn-success mb-3">
    <i class="fas fa-plus"></i> Tambah Barang
</a>

<table class="table table-bordered table-striped" id="dataTable">
    <thead class="bg-primary text-white">
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($barang)): ?>
            <?php $no = 1; ?>
            <?php foreach ($barang as $b): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($b['nama_barang']) ?></td>
                    <td>Rp <?= number_format($b['harga'], 0, ',', '.') ?></td>
                    <td><?= $b['stok'] ?></td>
                    <td class="text-center">
                        <a href="<?= base_url('barang/edit/' . $b['id']) ?>"
                           class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>

                        <a href="<?= base_url('barang/delete/' . $b['id']) ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin ingin menghapus data ini?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>


<?= $this->endSection() ?>
