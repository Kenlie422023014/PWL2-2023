<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible"  content="ie=edge">
    <title>New products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstarp.min.css" rel="stylesheet">
</head>
<body style="background: lightgray;">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <h3>add new product</h3>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                    <form id="productForm" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="font-weight-bold"> IMAGE</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                        </div>

                        <div class="form-group mb-3">
                            <label for="product_category_id"> PRODUCT CATEGORY</label>
                            <select class="form-control" id="product_category_id" name="product_category_id">
                                <option value=""> --select category product --</option>
                                @foreach ($data['categories'] as $category)
                                    <option value="{{ $category->id }}">{{ $category->product_category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="id_supplier"> Supplier </label>
                            <select class="form-control" id="id_supplier" name="id_supplier">
                                <option value=""> --select supplier --</option>
                                @foreach ($data['suppliers_'] as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="masukan judul product">
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5"
                            placeholder="masukan deskripsi product">
                            </textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold"> price</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="masukan harga produk">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">stock</label>
                                    <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" placeholder="masukan stok produk">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-md btn-primary me-3"> Save</button>
                        <button type="button" id="resetBtn" onclick="resetForm()" class="btn btn-md btn-warning">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');

        function resetForm() {
            document.getElementById("productForm").reset();
            for (var instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].setData('')
            }
        }
    </script>
</body>
</html>