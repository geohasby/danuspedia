<!DOCTYPE html>
<html lang="en">

<head>
  <title>Danuspedia</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="shortcut icon" href="{{ asset('img/iconWeb.svg' )}}" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@200&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
</head>
<body>
  <div class="header-container">
    <div class="title-bar">
      <div class="title-bar-left">
        <a href="{{ route('login') }}">
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
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>    

  <!-- @if ($message = Session::get('success')) -->
    <div id="successBuy">
        <p id="hasilOrder">{{ $message }}</p>
    </div>
  <!-- @elseif ($message = Session::get('error')) -->
    <div id="failBuy" >
      <p id="hasilOrder">{{ $message }}</p>
    </div>
  <!-- @endif -->

  @isset($keyword)
    <div class="hasilPencarian">
        <li class="cari">
          <span class="refCari">
          @if ($mode == 'search')
            Hasil Pencarian : 
          @elseif ($mode == 'category')
            Kategori : 
          @elseif ($mode == 'organisasi')
            Organisasi : 
          @endif  
          "{{$keyword}}"</span>
        </li>
    </div>
  @endisset

  <div class="products-container">
  @isset($product)  
    @foreach ($product as $p)
      @php
        ++$i;
      @endphp
      
      @if ($i % 4 == 1)
        <div class="photo-column">
      @endif

      <div class="photo-container">
        <div class="overlayContainer">
<<<<<<< HEAD
          <a>
=======
          <a> <!--href="{{ route('product.show',$p->id) }}"  ini link nya barangkali butuh-->
>>>>>>> parent of a4fa678... sabar
            <img id="barang" src="{{ asset('img/product/' . $p->image) }}" class="fotoBarang">
          </a>
          <div class="overlay">
            <div class="beliBarangIni">Beli barang ini</div>
          </div>
        </div>
        <div class="LineBelowImage"></div>
        <img class="iconDeskripsi" src="{{ asset('img/' . $p->category . 'Homepage.svg') }}">
        <p class="deskripsiBarang" id="namaBarang">{{$p->name}}</p>
        <img class="iconDeskripsi"src="{{ asset('img/MoneyHomepage.svg') }}">
        <p class="deskripsiBarang" id="hargaBarang">{{$p->price}}</p>
        <img class="iconDeskripsi" src="{{ asset('img/UserHomepage.svg') }}" style="margin-bottom:-12px;">
        <p class="deskripsiBarang" id="penjualBarang">{{$seller->find($p->seller_id)->name}}</p>
      </div>
      
      @if ($i % 4 == 0)
        </div>     
      @endif
    @endforeach
  @else
    <h1 class="tidakDitemukan">tidak ditemukan</h1>
  @endisset
  </div>

    <!------------------------------------INI BUAT POPUP--------------------------------->
    <div id="popup" class="popup-container">
    <div class="popup">
      <div class="first-section">
        <div id="foto-barang-full" class="foto-barang-full"></div>
        <a id="profile-penjual" href="#">
          <div class="mini-profile-penjual">
            <div id="foto-penjual" class="foto-penjual"></div>
            <span id="nama-penjual">Nama_Organisasi</span>
          </div>
        </a>
      </div> 
      <div class="second-section">
        <div class="profil-barang">
          <div id="nama-barang" class="nama-barang">Kapak Kingmaker Kecil</div>
          <div class="stok-barang">Stok : <b id="stok-barang">2</b></div>
          <div class="harga-barang">
            <div class="label">Harga</div>
            <div id="harga-barang" class="nominal">Rp. 2,500</div>
          </div>
          <div class="deskripsi-produk">
            <div class="label">Deskripsi</div>
            <div id="deskripsi-barang" class="deskripsi">
              Kapak Kepik Kepak Kipik Kupuk-Kupuk Watdepuk
            </div>
          </div>
        </div>
        <form action onsubmit="">
          <div class="box-pesanan">
            <div class="spesifikasi-pemesanan">
              <div class="kuantitas">
                <span>Jumlah Dibeli</span>
                <button disabled id="kurang"></button>
                <div id="kuantitas-beli" class="kuantitas-final">1</div>
                <button id="tambah"></button>
              </div>
              <div class="lokasi">
                <label for="lokasi">Lokasi Pengambilan :</label>
                <select required name="Lokasi" id="lokasi">
                  <option disabled selected value="null">Pilih Lokasi Pengambilan Barang</option>
                  <option value="selasar-c">Selasar Gedung C</option>
                  <option value="sekrehima">Sekre Hima</option>
                </select>
              </div>
              <div class="waktu">
                <label for="waktu">Waktu Pengambilan</label>
                <input type="datetime-local" id="waktu">
              </div>
              
              <button id="checkout" type="submit">Beli Sekarang!</button>
            </div>
          </div>
        </form>
        
      </div>   
      <div class="exit">
        <button id="exit"></button>
      </div>
    </div>
  </div>
  <!------------------------------------INI BUAT POPUP--------------------------------->


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

    function HimaDrop(){
      if(document.getElementById("himpunanDropdown").classList.contains('show')){
        document.getElementById("himapunanDropdown").classList.remove('show');
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
      document.getElementById("himpunanDropdown").classList.toggle("show");
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
    var normalTimer = setInterval(cekOverlap, 100);
    var normalWindow = true;
    function cekOverlap(){
      var segitigaOrganisasi = document.getElementById("segitigaOrganisasi");
      var rect = segitigaOrganisasi.getBoundingClientRect();
      var y=rect.left;
      if(y<450 && normalWindow){
        document.getElementById("kotakSearch").classList.toggle("kecilinSearch");
        normalWindow = false;
      }
      else if(y>450 && !normalWindow){
        document.getElementById("kotakSearch").classList.toggle("kecilinSearch");
        normalWindow = true;
      }
    }

    if(document.getElementById("successBuy") != null){
      var kelas = "successBuy";
      setTimeout(fading,3000);
    }
    else if(document.getElementById("failBuy") != null){
      var kelas = "failBuy"
      setTimeout(fading,3000);
    }
    
    function fading(){
      document.getElementById(kelas).classList.toggle("gone");
    }
    //////////////////////////////////////////////////////////////////////
    ///////////////////////////INI BUAT POPUP/////////////////////////////
    let kurang = document.getElementById('kurang');
    let tambah = document.getElementById('tambah');
    let dibeli = document.getElementById('kuantitas-beli');
    let stok = document.getElementById('stok-barang').innerHTML;
    let keluar = document.getElementById('exit');
    let popup = document.getElementById('popup');
    let benda = document.getElementById('barang')
    if(dibeli.innerHTML == stok) tambah.disabled = true;

    kurang.addEventListener('click', function() {
      dibeli.innerHTML -= 1;
      if(dibeli.innerHTML == 1) kurang.disabled = true;
      if(dibeli.innerHTML < stok) tambah.disabled = false;
    });

    tambah.addEventListener('click', function() {
      kurang.disabled = false;
      dibeli.innerHTML = parseInt(dibeli.innerHTML) + 1;
      if(dibeli.innerHTML >= stok) tambah.disabled = true;
    });

    keluar.addEventListener('click', function() {
      popup.style.display = 'none';
    });

    benda.addEventListener('click', function() {
      popup.style.display = 'block';
    });

    //////////////////////////INI BUAT POPUP////////////////////////////
    ////////////////////////////////////////////////////////////////////
  </script>
</body>
</html>