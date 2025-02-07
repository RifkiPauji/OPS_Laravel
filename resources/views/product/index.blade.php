@extends('layouts.app')

@section('title', 'OPS Test | Data Product')

@push('css')
<style>
    .form-control::placeholder {
        color: #4B4B4B !important;
        opacity: 1;
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
                        <h4 class="page-title">Product</h4>
                    </div>
                </div>
            </div>

            <div class="row mt-0 mb-0">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <!-- Filter dan Pencarian -->
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="searchProduct">Cari Produk</label>
                                    <input type="text" id="searchProduct" class="form-control" placeholder="Cari Nama Produk">
                                </div>
                                <div class="col-md-4">
                                    <label for="filterKategori">Filter Kategori</label>
                                    <select id="filterKategori" class="form-control">
                                        <option value="">Semua Kategori</option>
                                        @foreach ($kategori as $dkategori)
                                            <option value="{{ $dkategori->kode_kategori }}">{{ $dkategori->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <a href="{{ route('product_export') }}" class="btn btn-success me-2">
                                        <img src="{{ asset('img/MicrosoftExcelLogo.png') }}" alt="Excel" width="20" class="me-1">
                                        Export Excel
                                    </a>
                                    <a href="{{ route('product_create') }}" class="btn btn-danger">
                                        <img src="{{ asset('img/PlusCircle.png') }}" alt="Tambah" width="20" class="me-1">
                                        Tambah Produk
                                    </a>
                                </div>
                            </div>

                            <!-- Tabel Produk -->
                            <div class="table-responsive p-3">
                                <table id="productTable" class="table table-sm table-bordered table-hover table-striped w-100">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Image</th>
                                            <th>Nama Produk</th>
                                            <th>Kategori Produk</th>
                                            <th>Harga Beli (Rp)</th>
                                            <th>Harga Jual (Rp)</th>
                                            <th>Stok Produk</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productTableBody">
                                        @foreach ($results as $index => $product)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $product->poto_product) }}" alt="Image" width="30">
                                                </td>
                                                <td>{{ $product->nama_product }}</td>
                                                <td>{{ $product->nama_kategori }}</td>
                                                <td>{{ number_format($product->harga_beli, 0, ',', '.') }}</td>
                                                <td>{{ number_format($product->harga_jual, 0, ',', '.') }}</td>
                                                <td>{{ $product->stock }}</td>
                                                <td>
                                                    <a href="{{ route('product_edit', $product->id) }}" class="text-primary me-2">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('product_destroy', $product->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link text-danger" onclick="return confirm('Hapus produk ini?')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- end table -->
                        </div>
                    </div>
                </div>
            </div> <!-- end row -->
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    let table = $('#productTable').DataTable();
});
</script>
<script>
$(document).ready(function() {
    let table = $('#productTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('product_filter') }}",
            data: function (d) {
                d.kategori = $('#filterKategori').val();
                d.search = $('#searchProduct').val();
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'poto_product', name: 'poto_product', render: function(data) {
                return `<img src="{{ asset('storage') }}/${data}" width="30">`;
            }},
            { data: 'nama_product', name: 'nama_product' },
            { data: 'nama_kategori', name: 'nama_kategori' },
            { data: 'harga_beli', name: 'harga_beli', render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ') },
            { data: 'harga_jual', name: 'harga_jual', render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ') },
            { data: 'stock', name: 'stock' },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
        ]
    });

    // Filter Berdasarkan Kategori
    $('#filterKategori').change(function() {
        table.draw();
    });

    let searchDelay;
    $('#searchProduct').on('keyup', function() {
        clearTimeout(searchDelay);
        searchDelay = setTimeout(() => {
            table.draw();
        }, 500);
    });
});
</script>

@endpush
