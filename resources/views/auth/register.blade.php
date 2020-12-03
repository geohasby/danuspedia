<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Sign Up</title>
            <link rel="stylesheet" href="{{ asset('css/register.css') }}">
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet" type ='text/css'>
    </head>
    <body>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <label name="danuspedia" id="danuspedia">
                <img src="{{ asset('img/Logo.svg') }}" class="logo">anuspedia
            </label>
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" style="color:red;margin-left:20px;margin-top:30px;" />
            <fieldset>
                <label for="name">Full Name : </label>
                <input type="text" name="name" required placeholder="Enter your full name">
                <br>
                <label for="email">Email (UGM) : </label>
                <input type="email" name="email" id="email" required placeholder="Enter your UGM Email">
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
            <br>
                <label id="signIn" name="signIn">
                    <a href="{{ route('login') }}">Sign-in here~</a>
                </label>
            <br>
            <label id="more" name="more">More</label>
            <label> about danuspedia</label>    
        </div>
    </body>
</html>    