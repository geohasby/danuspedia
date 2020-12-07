<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300;700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danuspedia - Order History</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/history.css') }}">
</head>
<body>
    <div class="background"></div>
    <div class="nav-cont">
        <div class="navbar">
            <div class="kiri">
                <a href="homepage"><img src="{{ asset('img/Logo.svg') }}" alt="" class="logo"></a>
                <div class="garis"></div>
                <a href="profile" class="d-flex align-items-center">
                <img src="{{ asset('img/UserHomepage.svg') }}" alt="">
                <p class="text-dark" >{{ $this_user->name }}</p>
                </a>
            </div>
            <div class="kanan">
                <a href="homepage">Return</a>
            </div>
        </div>
    </div>
    <div class="kotak-1">
        <p class="daftarp">Daftar Penjualan</p>
        <div class="head">
            <div class="namahead">
                <img src="{{ asset('img/UserHomepage.svg') }}" alt="">
                <p>Nama Pembeli</p>
            </div>
            <div class="garis"></div>
            <div class="namahead">
                <img src="{{ asset('img/logo makan.svg') }}" alt="">
                <p>Nama Barang</p>
            </div>
            <div class="garis"></div>
            <div class="namahead">
                <img src="{{ asset('img/logo cod.svg') }}" alt="">
                <p>Tempat COD</p>
            </div>
            <div class="garis"></div>
            <div class="namahead">
                <img src="{{ asset('img/logo status.svg') }}" alt="">
                <p>Status</p>    
            </div>
            <div class="garis"></div>
            <div class="namahead">
                <img src="{{ asset('img/logo harga.svg') }}" alt="">
                <p>Total harga</p>
            </div>
        </div>
        <div class="garishorizontal"></div>
        
        @isset ($order)
            @foreach ($order as $o)
                <div class="isi">
                    <div class="isian">
                        <p>{{ $user->find($o->customer_id)->name }}</p>
                    </div>
                    <div class="garis"></div>
                    <div class="isian">
                        <p>{{ $product->find($o->product_id)->name }}</p>
                    </div>
                    <div class="garis"></div>
                    <div class="isian">
                        <p>{{ $o->place_taken }}</p>
                    </div>
                    <div class="garis"></div>
                    <div class="isian">
                        <p>{{ $o->status }}</p>
                    </div>
                    <div class="garis"></div>
                    <div class="isian">
                        <p>Rp.{{ $o->quantity *  $product->find($o->product_id)->price}}</p>
                    </div>
                </div>
            @endforeach
        @else
            Tidak ada riwayat pesanan
        @endisset
    </div>
</body>
</html>