
@push('head')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="./login-style.css"/>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<meta name="google-signin-client_id" content="590170900338-4dbm5mkui534lu2ldapjmf1u487vru1u.apps.googleusercontent.com.apps.googleusercontent.com">

@endpush
<!------ Include the above in your HEAD tag ---------->

<!--
    you can substitue the span of reauth email for a input with the email and
    include the remember me checkbox
    -->
    @include("header")

    <div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" class="form-signin" method="POST" action="/">
                @csrf
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>

                <div id="my-signin2">

                </div>  
            </form><!-- /form -->
            <a href="#" class="forgot-password">
                Forgot the password?
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->
    @include("footer")
<script>
  function onSuccess(googleUser) {
console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
}
function onFailure(error) {
console.log(error);
}
function renderButton() {
gapi.signin2.render('my-signin2', {
  'scope': 'profile email',
  'width': 240,
  'height': 50,
  'longtitle': true,
  'theme': 'dark',
  'onsuccess': onSuccess,
  'onfailure': onFailure
});
}
</script>
<script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>