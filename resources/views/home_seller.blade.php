<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/styleHPpenjual.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danuspedia</title>
</head>
<body>
    <div class="content">
        <div class="detail-pesanan bg-main">
            <h1>Detail Pesanan</h1>
            <div class="pencarian-nama">
                <input id="cari-nama" type="text" placeholder="Cari nama pembeli disini">
                <button id="reset"></button>
                <button id="search"></button>
            </div>
            
            <div class="list-pesanan">
                @foreach ($order as $o)
                    <div class="pesanan">
                        <h2>{{ $user->find($o->customer_id)->name }}</h2>
                        <div class="att-produk">
                            <div class="nama-produk">{{ $o->name }}</div>
                        </div>
                        <div class="att-pemesanan">
                            <div class="jumlah-dipesan to-right">x {{ $o->quantity }}</div>
                            <div class="total-dipesan to-right">Rp. {{ $o->price }}</div>
                        </div>
                        <div class="sum-dipesan to-right">
                            <h3>Total : Rp. {{ $o->quantity * $o->price }}</h3>
                        </div>
                        <div class="tempat-cod">
                            <h3>Tempat COD : {{ $o->place_taken }}</h3>
                        </div>
                        <div class="button-collection to-right">
                            <button id="cancel-order" class="cancel-button"></button>
                            <button id="complete-order" class="check-button"></button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="second-section">
            <div class="nav-bar bg-main">
                <a href="#">
                    <div class="logo nav-content"></div>
                </a>
                <div class="mini-profile nav-content">
                    <a href="#">
                        <div class="profile-pic"></div>
                        <div class="profile-name">{{ $user->name }}</div>
                    </a>
                </div>
                <div class="profile-settings nav-content">
                    <form method="POST" action="{{ route('logout') }}">
                    @csrf
                        <a type="submit" href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();"><div class="logout">Logout</div></a>
                    </form>
                    <a href="#"><div class="edit-profile">Edit Profil</div>kalo ini dihapus, edit profilenya ilang oi</a>
                </div>
            </div>
            <div class="main-content bg-main">        
                <a href="#">
                    <div class="tambah-jualan">
                        <div class="logo-tambah"></div>
                        <div class="teks-tambah">Tambah Barang</div>
                    </div>
                </a>

                @foreach ($product as $p)
                    <a href="#">
                        <div class="slot-barang">
                            <img class="foto-barang" src="{{ asset('img/product/' . $p->image) }}" alt="">
                            <div class="data-barang">
                                <div class="nama-barang" >{{ $p->name }}</div>
                            </div>
                        </div>
                    </a>
                @endforeach
                
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div id="pop-up" class="pop-up">
        <div class="confirm bg-main">
            <span>Apakah Anda Yakin?</span>
            <div class="confirm-buttons to-right">
                <button id="yes" class="yes-button"></button>
                <button id="no" class="no-button"></button>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/scriptHPpenjual.js') }}"></script>
</body>
</html>