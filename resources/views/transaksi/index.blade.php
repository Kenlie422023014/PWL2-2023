
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Data Transaksi Penjualan</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                    <a href="{{ route('transaksi.create') }}" class="btn btn-md btn-success mb-3">Add transaksi penjualan</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Tanggal Transaksi</th>
                                    <th scope="col">Nama Kasir</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Kategori Produk</th>
                                    <th scope="col">Harga</th> 
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Total Harga</th> 
                                    <th scope="col" style="width: 20%">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transaksis as $transaksi)
                                    <tr>
                                        <td>{{ $transaksi->tanggal_transaksi }}</td>
                                        <td>{{ $transaksi->nama_kasir }}</td>
                                        <td>{{ $transaksi->product_name }}</td>
                                        <td>{{ $transaksi->category_name }}</td> 
                                        <td>{{ "Rp " . number_format($transaksi->product_price, 2, ',', '.') }}</td>
                                        <td>{{ $transaksi->jumlah_pembelian }}</td>
                                        <td>{{ "Rp " . number_format($transaksi->product_price * $transaksi->jumlah_pembelian, 2, ',', '.') }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST">
                                                <a href="{{ route('transaksi.show', $transaksi->id) }}" class="btn btn-sm btn-dark">Show</a>
                                                <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Data Transaksi belum Tersedia.
                                </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $transaksis->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "Gagal",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
</body>
</html>
