<!DOCTYPE html>
<html lang="en">

<head>
  <title>Danuspedia</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@200&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet" type ='text/css'>
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
              <a href="#">Makanan</a>
              <a href="#">Minuman</a>
              <a href="#">Others</a>
            </div>
          </div>
          <div class="dropdown"style="margin-left: 30px;">
            <button onclick="OrganisasiDrop()" class="dropbtn" >Organisasi <img class="segitiga" src="{{ asset('img/SegitigaHomepage.svg') }}"></button>
            <div id="organisasiDropdown" class="dropdown-content">
              <a href="#">Himakom</a>
              <a href="#">Himasta</a>
              <a href="#">HimaGeo</a>
              <a href="#">Himahima</a>
            </div>
          </div>
        </div>
        <div class="wrapper">
          <input type="text" class="input" id="searchThis" 
          placeholder="What are you looking for?">
          <button type="button" class="searchbtn" onclick="searchSomething()">
            <img class="fas" src="{{ asset('img/SearchHomepage.svg') }}">
          </button>
        </div>
      </div>
      <div class="title-bar-right">
        <div id="LineRight"></div>
        <div class="dropdownProfile">
          <button class="dropbtnProfile"><img src="{{ asset('img/UserHomepage.svg') }}" class="UserLogo">
            <img class="segitigaRight" src="{{ asset('img/SegitigaHomepage.svg') }}">
          </button>
          <div id="profileDropdown" class="dropdownProfile-content">
            <a href="#">Profile</a>
            <a href="#">Logout</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
  <div class="products-container">
  @foreach ($product as $p)
    @php
      ++$i;
    @endphp
    
    @if ($i % 4 == 1)
      <div class="photo-column">
    @endif

    <div class="photo-container">
      <div class="overlayContainer">
        <a href="{{ route('product.show',$p->id) }}">
          <img src="{{ asset('img/product/' . $p->image) }}" class="fotoBarang">
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

    function searchSomething(){
      var searchMe = document.getElementById("searchThis").value;
      alert(searchMe);
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
  </script>
</body>
</html>