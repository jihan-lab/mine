@extends('layouts.admin')

@section('title')
    Admin Product Page
@endsection
@section('content')
    <div
        class="section-content section-dashboard-home"
        data-aos="fade-up"
        >
        <div class="container-fluid">
            <div class="dashboard-heading">
            <h2 class="dashboard-title">Dashboard Admin</h2>
            <p class="dashboard-subtitle">
                Edit Product
            </p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('product.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nama Produk</label>
                                            <input type="text" class="form-control" value="{{ $item->name }}" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Pemilik Produk</label>
                                            <select class="form-control" name="users_id" required>
                                                <option value="{{ $item->users_id }}">{{ $item->users->name }}</option>
                                                @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Kategori Produk</label>
                                            <select class="form-control" name="categories_id" required>
                                                <option value="{{ $item->categories_id }}">{{ $item->categories->name }}</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Harga Produk</label>
                                            <input type="number" class="form-control" value="{{ $item->price }}" name="price" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Deskirpsi Produk</label>
                                            <textarea class="form-control" name="description" id="editor" required>{!! $item->description !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-success px-5 ml-3">Save</button>
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
    </div>
    <!-- /#page-content-wrapper -->
@endsection

@push('addon-script')
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace( 'editor' );
</script>
@endpush
