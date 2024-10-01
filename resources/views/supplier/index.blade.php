<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Manajemen Supplier</h2>

        {{-- Pesan Sukses --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        {{-- Tabel Supplier --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Supplier</th>
                    <th>Alamat Supplier</th>
                    <th>PIC Supplier</th>
                    <th>No HP PIC Supplier</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->nama_supplier }}</td>
                    <td>{{ $supplier->alamat_supplier }}</td>
                    <td>{{ $supplier->pic_supplier }}</td>
                    <td>{{ $supplier->no_hp_pic_supplier }}</td>
                    <td>
                        {{-- Tombol Edit --}}
                        <button class="btn btn-warning" onclick="editSupplier({{ $supplier->id }})">Edit</button>

                        {{-- Tombol Delete --}}
                        <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" style="display:inline;">
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

        {{-- Form Tambah/Edit Supplier --}}
        <h4 id="form-title">Tambah Supplier</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="supplier-form" action="{{ route('suppliers.store') }}" method="POST">
            @csrf
            <input type="hidden" id="supplier-id" name="id">
            
            {{-- Nama Supplier --}}
            <div class="form-group">
                <label for="nama_supplier">Nama Supplier</label>
                <input type="text" id="nama_supplier" name="nama_supplier" class="form-control" required>
            </div>
            
            {{-- Alamat Supplier --}}
            <div class="form-group">
                <label for="alamat_supplier">Alamat Supplier</label>
                <input type="text" id="alamat_supplier" name="alamat_supplier" class="form-control" required>
            </div>
            
            {{-- PIC Supplier --}}
            <div class="form-group">
                <label for="pic_supplier">PIC Supplier</label>
                <input type="text" id="pic_supplier" name="pic_supplier" class="form-control" required>
            </div>
            
            {{-- No HP PIC Supplier --}}
            <div class="form-group">
                <label for="no_hp_pic_supplier">No HP PIC Supplier</label>
                <input type="text" id="no_hp_pic_supplier" name="no_hp_pic_supplier" class="form-control" required>
            </div>

            {{-- Tombol Simpan --}}
            <button type="submit" class="btn btn-success" id="submit-btn">Simpan</button>
        </form>
    </div>

    <script>
        // Fungsi untuk mengedit data supplier
        function editSupplier(id) {
            document.getElementById('form-title').innerHTML = 'Edit Supplier';
            document.getElementById('supplier-form').setAttribute('action', `/suppliers/${id}`);
            document.getElementById('supplier-form').insertAdjacentHTML('beforeend', '{{ method_field('PUT') }}');

            fetch(`/suppliers/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('supplier-id').value = data.id;
                    document.getElementById('nama_supplier').value = data.nama_supplier;
                    document.getElementById('alamat_supplier').value = data.alamat_supplier;
                    document.getElementById('pic_supplier').value = data.pic_supplier;
                    document.getElementById('no_hp_pic_supplier').value = data.no_hp_pic_supplier;
                });
        }
    </script>
</body>
</html>
