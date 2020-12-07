<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('img/iconWeb.svg' )}}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300;700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danuspedia - Create Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/createProduct.css') }}">
</head>
<body>
    <div class="background"></div>
    <div class="nav-cont">
        <div class="navbar">
            <div class="kiri">
                <a href="{{ route('seller.home') }}"><img src="{{ asset('img/Logo.svg') }}" alt="" class="logo"></a>
                <div class="garis"></div>
                <a href="" class="d-flex align-items-center">
                    <img src="{{ asset('img/user 1.svg') }}" alt="">
                    <p class="text-dark">{{ $user->name }}</p>
                </a>
            </div>
            <div class="kanan">
                <a href="{{ route('seller.home') }}">Return</a>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        @if ($errors->any())
            <div class="alert alert-danger warning">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="form d-flex justify-content-center flex-column align-items-center">
            <form method="POST" action="{{ route('product.store') }}" class="form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="seller_id" value="{{$user->id}}">
                <div class="input nama">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="name" class="inputnama" required>
                </div>
                <div class="input kategori">
                    <label for="kategori">Kategori</label>
                    <select name="category" id="kategori" class="select-kategori" required>
                        <option disabled selected value="">Pilih Kategori Barang</option>
                        <option value="makanan">Makanan</option>
                        <option value="minuman">Minuman</option>
                        <option value="lain">Lainnya</option>
                    </select>
                </div>
                <div class="input stok">
                    <label for="stok">Jumlah</label>
                    <input type="text" name="stock" id="stok" class="inputstok" required>
                </div>
                <div class="input harga">
                    <label for="harga">Harga</label>
                    <input type="text" name="price" id="harga" class="inputharga" required>
                </div>
                <div class="input deskripsi">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="description" id="deskripsi" cols="35" rows="5" required></textarea>
                </div>
                <div class="input foto">
                    <label for="foto">Foto</label>
                    <input type="file" name="img" id="foto" class="inputfoto" required>
                </div>
                <div class="submitButton">
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>

            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>