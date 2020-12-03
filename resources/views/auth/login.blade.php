<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Sign In</title>
            <link rel="stylesheet" href="{{ asset('css/login.css') }}">
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet" type ='text/css'>
    </head>
    <body>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label name="danuspedia" id="danuspedia"><img src="{{ asset('img/Logo.svg' )}}" class="logo">anuspedia</label>
            
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" style="color:red;margin-left:20px;margin-top:30px;" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" style="color:red;margin-left:20px;margin-top:30px;" />

            <fieldset>
                <label for="Email">Email: </label>
                <input type="email" name="email" id="email" required>
                <label for="password">Password : </label>
                <input type="password" name="password" id="password" required>
                <p style="font-size: 20px; position:absolute; margin-top:0px;"><input type="checkbox" id="checkbox">  Remember Me &hearts;</p>
            </fieldset>
            <button type="submit">Sign-In</button>
            <div class="registerInfo">
                <label>Doesn't have account?</label>
                <br>
                <label id="register" name="signIn">
                    <a href="{{ route('register') }}">Register here~</a>
                </label>
            </div>
        </form>
        <div class="moreInfo">
            <label id="more" name="more">More</label>
            <label> about danuspedia</label>    
        </div>
    </body>
</html>    
