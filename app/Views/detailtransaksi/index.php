<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<h2>Rincian Transaksi #<?= $transaksi['id'] ?></h2>
<hr>
<p><strong>Pelanggan:</strong> <?= $transaksi['nama_pelanggan'] ?></p>
<p><strong>Tanggal:</strong> <?= date('d/m/Y', strtotime($transaksi['tanggal'])) ?></p>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($detail as $d): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $d['nama_barang'] ?></td>
            <td><?= number_format($d['harga'], 0, ',', '.') ?></td>
            <td><?= $d['jumlah'] ?></td>
            <td><?= number_format($d['subtotal']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4" class="text-end">Total Bayar</th>
            <th>Rp <?= number_format($transaksi['total']) ?></th>
        </tr>
    </tfoot>
</table>

<a href="/transaksi" class="btn btn-secondary">Kembali</a>

<?= $this->endSection() ?>