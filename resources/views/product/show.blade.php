<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danuspedia - {{ $product->name }}</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@200&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet" type ='text/css'>
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/showProduct.css') }}">
</head>
<body>
    <div class="header-container">
      <div class="title-bar">
        <div class="title-bar-left">
          <a href="{{ route('home') }}">
            <img id="Logo" src="{{ asset('img/Logo.svg') }}">
          </a>
        </div>
        <div class = "title-bar-middle">
          <div id="LineLeft"></div>
          <div class = "Menu-bar">
            <div class="dropdown">
              <button onclick="KategoriDrop()" class="dropbtn" >Kategori <img class="segitiga" src="{{ asset('img/SegitigaHomepage.svg') }}"></button>
              <div id="kategoriDropdown" class="dropdown-content">
                <a href="{{ url('category/makanan') }}">Makanan</a>
                <a href="{{ url('category/minuman') }}">Minuman</a>
                <a href="{{ url('category/lain-lain') }}">Others</a>
              </div>
            </div>
            <div class="dropdown"style="margin-left: 30px;">
              <button onclick="HimaDrop()" class="dropbtn" >Himpunan <img class="segitiga" src="{{ asset('img/SegitigaHomepage.svg') }}"></button>
              <div id="himpunanDropdown" class="dropdown-content">
                <a href="{{ url('organisasi/HIMAKOM') }}">HIMAKOM</a>
                <a href="{{ url('organisasi/HMEI') }}">HMEI</a>
                <a href="{{ url('organisasi/HIMATIKA') }}">HIMATIKA</a>
                <a href="{{ url('organisasi/HIMASTA') }}">HIMASTA</a>
                <a href="{{ url('organisasi/HIMARIA') }}">HIMARIA</a>
                <a href="{{ url('organisasi/HIMAFI') }}">HIMAFI</a>
                <a href="{{ url('organisasi/HMGF') }}">HMGF</a>
                <a href="{{ url('organisasi/KMK') }}">KMK</a>
              </div>
            </div>
            <div class="dropdown"style="margin-left: 30px;">
              <button onclick="OrganisasiDrop()" class="dropbtn">Organisasi <img class="segitiga" id="segitigaOrganisasi" src="{{ asset('img/SegitigaHomepage.svg') }}"></button>
              <div id="organisasiDropdown" class="dropdown-content">
                <a href="">ORKOM</a>
                <a href="">OTI</a>
              </div>
            </div>
          </div>
            <form class="wrapper" id="kotakSearch" method="GET" action="{{ url('search') }}">
              <input type="text" name="keyword" class="input" id="searchThis" placeholder="What are you looking for?">
              <button type="submit" class="searchbtn" onclick="searchSomething()">
                <img class="fas" src="{{ asset('img/SearchHomepage.svg') }}">
              </button>
            </form>
        </div>
        <div class="title-bar-right">
          <div id="LineRight"></div>
          <div class="dropdownProfile">
            <button class="dropbtnProfile"><img src="{{ asset('img/UserHomepage.svg') }}" class="UserLogo">
              <img class="segitigaRight" src="{{ asset('img/SegitigaHomepage.svg') }}">
            </button>
            <div id="profileDropdown" class="dropdownProfile-content">
              <a href="#">Profile</a>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a type="submit" href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();">Logout</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


      <div id="deskripsi-produk" class="barang-container">
        <div class="barang">
          <div class="first-section">
            <div id="foto-barang-full" class="foto-barang-full">
              <img src="{{ asset('img/product/' . $product->image) }}" alt="" class="fotoBarang">
            </div>
            <a id="profile-penjual" href="#">
              <div class="mini-profile-penjual">
                <div id="foto-penjual" class="foto-penjual"></div>
                <span id="nama-penjual">{{ $seller->name }}</span>
              </div>
            </a>
          </div> 
          <div class="second-section">
            <div class="profil-barang">
              <div id="nama-barang" class="nama-barang">{{ $product->name }}</div>
              <div class="stok-barang">Stok : <b id="stok-barang">{{ $product->stock }}</b> <b id="critic-state" class="critic-state"> - Stok Ingin Habis!</b></div>
              <div class="harga-barang">
                <div class="label">Harga</div>
                <div class="nominal"> Rp. 
                  <b id="harga-barang">{{ $product->price }}</b>
                </div>
              </div>
              <div class="deskripsi-produk">
                <div class="label">Deskripsi</div>
                <div id="deskripsi-barang" class="deskripsi">
                  {{ $product->description }}
                </div>
              </div>
            </div>
            
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" style="color:red;margin-left:20px;margin-top:30px;" />

            <form method="POST" action="{{ route('order.store') }}">
              @csrf
              <input type="hidden" name="product_id" value="{{$product->id}}">
              <input type="hidden" name="customer_id" value="{{$user->id}}">
              <div class="box-pesanan">
                <div class="spesifikasi-pemesanan">
                  <div class="kuantitas">
                    <span>Jumlah Dibeli</span>
                    <button disabled id="kurang" class="kuantitas"></button>
                    <input id="kuantitas-beli" class="kuantitas-final" name="quantity" value="0">
                    <button id="tambah"></button>
                  </div>
                  <div class="lokasi">
                    <label for="place_taken">Lokasi Pengambilan :</label>
                    <select required name="place_taken" id="lokasi">
                      <option disabled selected value="null">Pilih Lokasi Pengambilan Barang</option>
                      <option value="Selasar Gedung C">Selasar Gedung C</option>
                      <option value="Sekre Hima">Sekre Hima</option>
                      <option value="Lantai 1 Gedung C">Lantai 1 Gedung C</option>
                      <option value="Lantai 2 Gedung C">Lantai 2 Gedung C</option>
                      <option value="Lantai 3 Gedung C">Lantai 3 Gedung C</option>
                    </select>
                  </div>
                  <div class="waktu">
                    <label for="waktu">Waktu Pengambilan</label>
                    <input required name="time_taken" type="datetime-local" id="waktu">
                  </div>
                  <button type="submit" id="checkout">Beli Sekarang! - Rp. <b id="total-harga">0</b></button>
                  <!-- <div id="popup" class="popup-container">
                    <div class="popup">
                      <div class="teks-konfirmasi">Apakah Anda Yakin?</div>
                      <div class="tombol-konfirmasi">
                        <div class="tombol">
                          <button type="submit" id="yakin"></button>
                          <button type="button" id="tidak-yakin"></button>
                        </div>
                      </div>
                    </div>
                  </div> -->
                </div>
              </div>
            </form>
          </div>   
        </div>
      </div>

      

      <div id="success" class="success-popup">
        <span>Checkout Berhasil!</span>
        <p>Segera selesaikan pembayaran!</p>
      </div>
      <script>
        /* When the user clicks on the button,
      toggle between hiding and showing the dropdown content */
      function KategoriDrop() {
        if(document.getElementById("kategoriDropdown").classList.contains('show')){ //buat kalo diklik yang kedua kalinya berarti nutup dropdown
          document.getElementById("kategoriDropdown").classList.remove('show');
          return;
        }
        var dropdowns = document.getElementsByClassName("dropdown-content"); //buat nutup semua dropdown dulu, jadi 1 layar cuma ada 1 dropdown (kecuali profile karena hover)
          var i;
          for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
              openDropdown.classList.remove('show');
            }
          }
        document.getElementById("kategoriDropdown").classList.toggle("show");
      }
  
      function OrganisasiDrop(){
        if(document.getElementById("organisasiDropdown").classList.contains('show')){
          document.getElementById("organisasiDropdown").classList.remove('show');
          return;
        }
        var dropdowns = document.getElementsByClassName("dropdown-content");
          var i;
          for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
              openDropdown.classList.remove('show');
            }
          }
        document.getElementById("organisasiDropdown").classList.toggle("show");
      }
  
  
      // Close the dropdown menu if the user clicks outside of it
      window.onclick = function(event) {
   
        if (!event.target.matches('.dropbtn')) {
          var dropdowns = document.getElementsByClassName("dropdown-content");
          var i;
          for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
              openDropdown.classList.remove('show');
            }
          }
        }
      }
  
      function kategori(){
        var test = document.getElementsByClassName("kategori");
        test[0].classList.toggle("showHasil");   
      }
      function organisasi(){
        var test = document.getElementsByClassName("organisasi");
        test[0].classList.toggle("showHasil");   
      }
    /////yang ini untuk jalanin fungsi di page/////
    let kurang = document.getElementById('kurang');
    let tambah = document.getElementById('tambah');
    let stok = document.getElementById('stok-barang').innerHTML;
    let beli = document.getElementById('checkout');
    let harga = document.getElementById('harga-barang').innerHTML;
    let total = document.getElementById('total-harga');

    /////yang dibawah untuk nilai inputan//////////
    let dibeli = document.getElementById('kuantitas-beli');
    let lokasi = document.getElementById('lokasi');
    let waktu = document.getElementById('waktu');
    

    total.innerHTML = parseInt(dibeli.value)*parseInt(harga); //total harga
    if(dibeli.value == stok) tambah.disabled = true;          //cek stok
    if(stok < 5) document.getElementById('critic-state').style.display = 'inline'; //warning klo stok mau abis
    if(stok == 0) {
      document.getElementById('critic-state').innerHTML = " - Stok Habis!";
      beli.disabled = true;
    }
    //////////tombol kurang////////////
    kurang.addEventListener('click', function() {
      dibeli.value -= 1;
      total.innerHTML = parseInt(dibeli.value)*parseInt(harga);
      if(parseInt(dibeli.value) == 0) kurang.disabled = true;
      if(parseInt(dibeli.value) < parseInt(stok)) tambah.disabled = false;
    });

    ///////////tombol tambah////////////
    tambah.addEventListener('click', function() {
      kurang.disabled = false;
      dibeli.value = parseInt(dibeli.value) + 1;
      total.innerHTML = parseInt(dibeli.value)*parseInt(harga);
      if(parseInt(dibeli.value) >= parseInt(stok)) tambah.disabled = true;
    });

    var normalTimer = setInterval(cekOverlap, 100);
    var normalWindow = true;

    function cekOverlap(){
      var segitigaOrganisasi = document.getElementById("segitigaOrganisasi");
      var rect = segitigaOrganisasi.getBoundingClientRect();
      var y=rect.left;
      if(y<648 && normalWindow){
        document.getElementById("kotakSearch").classList.toggle("kecilinSearch");
        normalWindow = false;
      }
      else if(y>648 && !normalWindow){
        document.getElementById("kotakSearch").classList.toggle("kecilinSearch");
        normalWindow = true;
      }
    }

    // //////////tombol beli////////////
    // beli.addEventListener('click', function() {
    //   let popup = document.getElementById('popup');
    //   let yakin = document.getElementById('yakin');
    //   let notyakin = document.getElementById('tidak-yakin');

    //   //////////cek klo ada yg kosong inputannya/////////
    //   if(dibeli.value == 0 || lokasi.value == null || waktu.value == ""){
    //     alert("Lengkapi Isiannya Dahulu");
    //     return false;
    //   }
    //   else{
    //     popup.style.display = 'block';
    //     //////////kalo confirm///////////////
    //     yakin.addEventListener('click', function() {
    //       popup.style.display = 'none';
    //       let sukses = document.getElementById('success');
    //       sukses.style.display = 'block';
    //       setTimeout(function() {
    //         sukses.style.display = 'none';
    //         return true;
    //       }, 2500);
    //     });
    //     /////////kalo gajadi////////////////
    //     notyakin.addEventListener('click', function() {
    //       popup.style.display = 'none';
    //     });
    //   }
    // });

    //////////////////////////INI BUAT POPUP////////////////////////////
    </script>
</body>
</html>