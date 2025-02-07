@extends('layouts.app')

@section('title', 'OPS Test | Edit Produk')

@push('css')
<style>
    .upload-area {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 200px;
        border: 2px solid #007bff;
        border-radius: 10px;
        cursor: pointer;
        position: relative;
        background-color: #f9f9f9;
        text-align: center;
        transition: border 0.3s ease-in-out;
    }

    .upload-area:hover, .upload-area.dragover {
        border: 2px dashed #0056b3;
    }

    .upload-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .upload-placeholder {
        width: 50px;
        height: 50px;
        opacity: 0.5;
    }

    .upload-text {
        color: #666;
        font-size: 14px;
        margin-top: 10px;
    }

    .preview-container img {
        max-width: 100%;
        max-height: 150px;
        margin-top: 10px;
        border-radius: 5px;
    }
</style>
@endpush

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Edit Produk - {{ $product->nama_product }}</h4>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="edit-product-form" method="POST" action="{{ route('product_update', $product->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="kategori">Kategori</label>
                                        <select name="kategori" id="kategori" class="form-control select2" required>
                                            <option value="" disabled>Pilih Kategori</option>
                                            @foreach ($kategori as $dkategori)
                                                <option value="{{ $dkategori->kode_kategori }}" {{ $product->kategori == $dkategori->kode_kategori ? 'selected' : '' }}>
                                                    {{ $dkategori->nama_kategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kategori')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="nama_product">Nama Barang</label>
                                        <input type="text" class="form-control" id="nama_product" name="nama_product"
                                            value="{{ $product->nama_product }}" required>
                                        @error('nama_product')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <label for="harga_beli">Harga Beli</label>
                                        <input type="number" class="form-control" id="harga_beli" name="harga_beli"
                                            value="{{ $product->harga_beli }}" required>
                                        @error('harga_beli')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label for="harga_jual">Harga Jual</label>
                                        <input type="number" class="form-control" id="harga_jual" name="harga_jual"
                                            value="{{ $product->harga_jual }}" required>
                                        @error('harga_jual')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label for="stock">Stok Barang</label>
                                        <input type="number" class="form-control" id="stock" name="stock"
                                            value="{{ $product->stock }}" required>
                                        @error('stock')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Upload Gambar -->
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="poto_product">Upload Gambar</label>
                                        <div class="upload-area" id="upload-area">
                                            <input type="file" class="form-control d-none" id="poto_product" name="poto_product" accept="image/*" onchange="previewImage(event)">
                                            <div class="upload-box text-center" onclick="triggerUpload()">
                                                <img id="preview-image" src="{{ asset('storage/' . $product->poto_product) }}" class="upload-placeholder">
                                                <p class="upload-text">Klik untuk mengubah gambar</p>
                                            </div>
                                        </div>
                                        <div class="preview-container" id="preview-container"></div>
                                        @error('poto_product')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Tombol Simpan & Batalkan -->
                                <div class="col-md-9">
                                    <div class="row mt-4">
                                        <div class="col text-end">
                                            <a href="{{ route('product') }}" class="btn btn-outline-primary">Batalkan</a>
                                            <button type="submit" class="btn btn-primary">Update Produk</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function triggerUpload() {
        document.getElementById('poto_product').click();
    }

    function previewImage(event) {
        var file = event.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-image').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }

    // Drag & Drop
    var dropArea = document.getElementById('upload-area');

    dropArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        dropArea.classList.add('dragover');
    });

    dropArea.addEventListener('dragleave', function() {
        dropArea.classList.remove('dragover');
    });

    dropArea.addEventListener('drop', function(e) {
        e.preventDefault();
        dropArea.classList.remove('dragover');
        var files = e.dataTransfer.files;
        if (files.length > 0) {
            document.getElementById('poto_product').files = files;
            previewImage({ target: document.getElementById('poto_product') });
        }
    });
</script>
@endpush
