<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi Penjualan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

    <div class="container mt-4">
        <h2>Daftar Transaksi Penjualan</h2>

        <!-- Pesan Sukses -->
        <div id="success-message" class="alert alert-success" style="display: none;">
            Transaksi berhasil ditambahkan.
        </div>

        <!-- Tabel Transaksi -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal Transaksi</th>
                    <th>Nama Kasir</th>
                    <th>Nama Produk</th>
                    <th>Jumlah Pembelian</th>
                    <th>Total Harga</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="transaksi-table-body">
                <!-- Data Transaksi Dinamis (Contoh Data) -->
                @foreach ($transaksi as $t)
                <tr>
                    <td>{{ $t->tanggal_transaksi }}</td>
                    <td>{{ $t->nama_kasir }}</td>
                    <td>{{ $t->product->nama }}</td>
                    <td>{{ $t->jumlah_pembelian }}</td>
                    <td>{{ $t->jumlah_pembelian * $t->product->price }}</td>
                    <td>
                        <button class="btn btn-warning" onclick="editTransaksi({{ $t->id }}, '{{ $t->id_products }}', {{ $t->jumlah_pembelian }}, '{{ $t->nama_kasir }}', '{{ $t->tanggal_transaksi }}')">Edit</button>
                        <form action="{{ route('transaksi.destroy', $t->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <hr>

        <!-- Form Tambah/Edit Transaksi -->
        <h4 id="form-title">Tambah Transaksi</h4>

        <form id="transaksi-form" action="{{ route('transaksi.store') }}" method="POST">
            @csrf
            <input type="hidden" id="transaksi-id" name="id">

            <!-- Produk -->
            <div class="form-group">
                <label for="id_products">Produk</label>
                <select name="id_products" id="id_products" class="form-control">
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Jumlah Pembelian -->
            <div class="form-group">
                <label for="jumlah_pembelian">Jumlah Pembelian</label>
                <input type="number" id="jumlah_pembelian" name="jumlah_pembelian" class="form-control" required>
            </div>

            <!-- Nama Kasir -->
            <div class="form-group">
                <label for="nama_kasir">Nama Kasir</label>
                <input type="text" id="nama_kasir" name="nama_kasir" class="form-control" required>
            </div>

            <!-- Tanggal Transaksi -->
            <div class="form-group">
                <label for="tanggal_transaksi">Tanggal Transaksi</label>
                <input type="datetime-local" id="tanggal_transaksi" name="tanggal_transaksi" class="form-control" required>
            </div>

            <!-- Tombol Simpan -->
            <button type="button" class="btn btn-success" id="submit-btn" onclick="simpanTransaksi()">Simpan</button>
        </form>
    </div>

    <script>
        function simpanTransaksi() {
            const formTitle = document.getElementById('form-title').innerText;
            const productId = document.getElementById('id_products').value;
            const jumlahPembelian = document.getElementById('jumlah_pembelian').value;
            const namaKasir = document.getElementById('nama_kasir').value;
            const tanggalTransaksi = document.getElementById('tanggal_transaksi').value;

            // Jika form sedang dalam mode tambah
            if (formTitle === "Tambah Transaksi") {
                // Tambah data ke dalam tabel
                const tableBody = document.getElementById('transaksi-table-body');
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>${tanggalTransaksi}</td>
                    <td>${namaKasir}</td>
                    <td>Produk ${productId}</td>
                    <td>${jumlahPembelian}</td>
                    <td>${jumlahPembelian * 10000}</td>
                    <td>
                        <button class="btn btn-warning" onclick="editTransaksi(1, 'Produk ${productId}', ${jumlahPembelian}, '${namaKasir}', '${tanggalTransaksi}')">Edit</button>
                        <button class="btn btn-danger" onclick="deleteTransaksi(1)">Delete</button>
                    </td>
                `;
                tableBody.appendChild(newRow);

                // Tampilkan pesan sukses
                document.getElementById('success-message').style.display = 'block';

                // Reset form
                resetForm();
            }
        }

        function editTransaksi(id, productName, jumlahPembelian, namaKasir, tanggalTransaksi) {
            // Ganti judul form menjadi Edit Transaksi
            document.getElementById('form-title').innerHTML = 'Edit Transaksi';

            // Isi form dengan data transaksi yang akan diedit
            document.getElementById('id_products').value = productName.split(' ')[1];
            document.getElementById('jumlah_pembelian').value = jumlahPembelian;
            document.getElementById('nama_kasir').value = namaKasir;
            document.getElementById('tanggal_transaksi').value = tanggalTransaksi;
        }

        function deleteTransaksi(id) {
            // Contoh aksi hapus, Anda bisa menyesuaikannya dengan request ke server
            alert('Transaksi dengan ID ' + id + ' dihapus!');
        }

        function resetForm() {
            document.getElementById('form-title').innerHTML = 'Tambah Transaksi';
            document.getElementById('transaksi-form').reset();
        }
    </script>
</body>
</html>
