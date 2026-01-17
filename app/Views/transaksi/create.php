<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<h2>Tambah Transaksi</h2>
<hr>

<form action="/transaksi/create" method="post">
    <?= csrf_field(); ?>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Pelanggan</label>
                <select name="pelanggan_id" class="form-control" required>
                    <option value="">-- Pilih Pelanggan --</option>
                    <?php foreach ($pelanggan as $p): ?>
                        <option value="<?= $p['id']; ?>"><?= $p['nama']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d'); ?>" required>
            </div>
        </div>
    </div>

    <h4>Detail Barang</h4>
    <table class="table table-bordered">
        <thead class="bg-dark text-white">
            <tr>
                <th>Produk</th>
                <th style="width: 200px;">Harga Satuan</th>
                <th style="width: 100px;">Jumlah</th>
                <th style="width: 200px;">Subtotal</th>
                <th style="width: 50px;">Aksi</th>
            </tr>
        </thead>
        <tbody id="barisBarang"></tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-end">Total Keseluruhan</th>
                <th>
                    <input type="number" name="total" id="totalKeseluruhan" class="form-control" readonly>
                </th>
                <th></th>
            </tr>
        </tfoot>
    </table>

    <button type="button" class="btn btn-primary mb-3" onclick="tambahBaris()">+ Tambah Barang</button>
    <hr>
    <button type="submit" class="btn btn-success">Simpan Transaksi</button>
    <a href="/transaksi" class="btn btn-secondary">Kembali</a>
</form>

<script>
    const daftarProduk = <?= json_encode($produk); ?>;

    function tambahBaris() {
        const id = Date.now(); 
        let options = '<option value="">-- Pilih Barang --</option>';
        daftarProduk.forEach(p => {
            options += `<option value="${p.id}" data-harga="${p.harga}">${p.nama_barang} (Stok: ${p.stok})</option>`;
        });

        const html = `
            <tr id="row_${id}">
                <td>
                    <select name="produk_id[]" class="form-control" onchange="updateHarga(this, ${id})" required>
                        ${options}
                    </select>
                </td>
                <td><input type="number" name="harga[]" class="form-control harga-satuan" readonly></td>
                <td><input type="number" name="jumlah[]" class="form-control jumlah-beli" min="1" value="1" oninput="hitungSubtotal(${id})" required></td>
                <td><input type="number" name="subtotal[]" class="form-control subtotal" readonly></td>
                <td><button type="button" class="btn btn-danger btn-sm" onclick="hapusBaris(${id})">X</button></td>
            </tr>`;
        document.getElementById('barisBarang').insertAdjacentHTML('beforeend', html);
    }

    function updateHarga(selectElement, id) {
        const row = document.getElementById(`row_${id}`);
        const harga = selectElement.options[selectElement.selectedIndex].getAttribute('data-harga');
        row.querySelector('.harga-satuan').value = harga;
        hitungSubtotal(id);
    }

    function hitungSubtotal(id) {
        const row = document.getElementById(`row_${id}`);
        const harga = parseFloat(row.querySelector('.harga-satuan').value) || 0;
        const jumlah = parseFloat(row.querySelector('.jumlah-beli').value) || 0;
        row.querySelector('.subtotal').value = harga * jumlah;
        hitungTotalKeseluruhan();
    }

    function hitungTotalKeseluruhan() {
        let total = 0;
        document.querySelectorAll('.subtotal').forEach(input => {
            total += parseFloat(input.value) || 0;
        });
        document.getElementById('totalKeseluruhan').value = total;
    }

    function hapusBaris(id) {
        document.getElementById(`row_${id}`).remove();
        hitungTotalKeseluruhan();
    }

    window.onload = tambahBaris;
</script>
<?= $this->endSection() ?>