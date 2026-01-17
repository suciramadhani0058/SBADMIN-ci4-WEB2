<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<h2>Edit Transaksi</h2>
<hr>

<form action="/transaksi/update/<?= $transaksi['id'] ?>" method="post">
    <?= csrf_field(); ?>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Pelanggan</label>
                <select name="pelanggan_id" class="form-control" required>
                    <option value="">-- Pilih Pelanggan --</option>
                    <?php foreach ($pelanggan as $p): ?>
                        <option value="<?= $p['id']; ?>" <?= $p['id'] == $transaksi['pelanggan_id'] ? 'selected' : ''; ?>>
                            <?= $p['nama']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="<?= $transaksi['tanggal']; ?>" required>
            </div>
        </div>
    </div>

    <h4>Detail Barang</h4>
    <table class="table table-bordered" id="tabelBarang">
        <thead>
            <tr>
                <th>Produk</th>
                <th style="width: 200px;">Harga Satuan</th>
                <th style="width: 100px;">Jumlah</th>
                <th style="width: 200px;">Subtotal</th>
                <th style="width: 50px;">Aksi</th>
            </tr>
        </thead>
        <tbody id="barisBarang">
            </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-end">Total Keseluruhan</th>
                <th>
                    <input type="number" name="total" id="totalKeseluruhan" class="form-control" value="<?= $transaksi['total']; ?>" readonly>
                </th>
                <th></th>
            </tr>
        </tfoot>
    </table>

    <button type="button" class="btn btn-primary mb-3" onclick="tambahBaris()">+ Tambah Barang</button>
    <hr>
    <button type="submit" class="btn btn-success">Update Transaksi</button>
    <a href="/transaksi" class="btn btn-secondary">Kembali</a>
</form>

<script>
    // Data master barang dari controller
    const daftarProduk = <?= json_encode($produk); ?>;
    // Data rincian transaksi lama dari controller
    const detailLama = <?= json_encode($detail); ?>;

    function tambahBaris(data = null) {
        const id = Date.now() + Math.random(); 
        let options = '<option value="">-- Pilih Barang --</option>';
        
        daftarProduk.forEach(p => {
            let selected = (data && data.barang_id == p.id) ? 'selected' : '';
            options += `<option value="${p.id}" data-harga="${p.harga}" ${selected}>${p.nama_barang} (Stok: ${p.stok})</option>`;
        });

        // Jika data ada (saat loading data lama), gunakan nilai tersebut. Jika baru, gunakan default.
        const hargaVal = data ? (data.harga || 0) : '';
        const jumlahVal = data ? data.jumlah : 1;
        const subtotalVal = data ? data.subtotal : '';

        const html = `
            <tr id="row_${id}">
                <td>
                    <select name="produk_id[]" class="form-control" onchange="updateHarga(this, '${id}')" required>
                        ${options}
                    </select>
                </td>
                <td>
                    <input type="number" name="harga[]" class="form-control harga-satuan" value="${hargaVal}" readonly>
                </td>
                <td>
                    <input type="number" name="jumlah[]" class="form-control jumlah-beli" min="1" value="${jumlahVal}" oninput="hitungSubtotal('${id}')" required>
                </td>
                <td>
                    <input type="number" name="subtotal[]" class="form-control subtotal" value="${subtotalVal}" readonly>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="hapusBaris('${id}')">X</button>
                </td>
            </tr>
        `;
        document.getElementById('barisBarang').insertAdjacentHTML('beforeend', html);
        
        // Jika sedang memuat data lama yang tidak punya kolom 'harga' di tabel detail, 
        // kita perlu mentrigger hitungSubtotal agar angka muncul
        if(data && !data.harga) {
           const selectElement = document.querySelector(`#row_${id} select`);
           updateHarga(selectElement, id);
        }
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
        
        const subtotal = harga * jumlah;
        row.querySelector('.subtotal').value = subtotal;
        
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
        const rowCount = document.querySelectorAll('#barisBarang tr').length;
        if (rowCount > 1) {
            document.getElementById(`row_${id}`).remove();
            hitungTotalKeseluruhan();
        } else {
            alert("Minimal harus ada satu barang dalam transaksi.");
        }
    }

    // Fungsi otomatis saat halaman dimuat untuk menampilkan barang yang sudah dibeli
    window.onload = function() {
        if (detailLama.length > 0) {
            detailLama.forEach(item => {
                tambahBaris(item);
            });
        } else {
            tambahBaris();
        }
    };
</script>

<?= $this->endSection() ?>