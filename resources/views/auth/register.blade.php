<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Sign Up</title>
        <link rel="stylesheet" href="{{ asset('css/register.css') }}">
        <link rel="shortcut icon" href="{{ asset('img/iconWeb.svg' )}}" type="image/x-icon">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet" type ='text/css'>
    </head>
    <body>
        <div class="moreAbout"><label id="more" onclick="mores()">More</label> about danuspedia</div>
        <div class="popUpDanuspedia">Danuspedia adalah e-commerce yang akan mempermudah proses jual beli di lingkungan perkuliahan<br>
            <label id="founded">Founded by Gamabrok </label>
            <button id="popUpOke" onClick="naik()">Cool!</button>
        </div>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <label name="danuspedia" id="danuspedia">
                <img class="D" src="{{ asset('img/Logo.svg') }}" class="logo">anuspedia
            </label>
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" style="color:red;margin-left:20px;margin-top:30px;" />
            <fieldset>
                <label for="name">Full Name : </label>
                <input type="text" name="name" required placeholder="Enter your full name">
                <br>
                <label for="email">Email : </label>
                <input type="email" name="email" id="email" required placeholder="Enter your Email">
                <br>
                <label for="phone_number">Phone number :</label>
                <input type="tel" name="phone_number" id="phone_number" required placeholder="Enter your mobile phone number">
                <br>
                <label for="password">Password : </label>
                <input type="password" name="password" id="password" required placeholder="Enter your password">
                <br>
                <label for="password_confirmation">Confirm Password : </label>
                <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Confirm your password">
            </fieldset>
            <button type="submit">Sign-up</button>
        </form>
        <div class="signInInfo">
            <label>Already have account?</label>
                <label name="signIn">
                    <a id="signIn" href="{{ route('login') }}">Sign-in here~</a>
                </label>    
        </div>
        <script>
            var popUp = document.getElementsByClassName("popUpDanuspedia")[0];
            function mores(){
                popUp.style.top = "50%";
                popUp.style.opacity = 100;
            }
            function naik(){
                popUp.style.top = "-50%";
                popUp.style.opacity = 0;
            }
        </script>

    </body>


</html>    