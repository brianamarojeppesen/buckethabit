<form id="signin_form" action="<?=site_url('accounts/validate_credentials'); ?>" method="post" accept-charset="utf-8">

     <label for="username">Username</label>
     <input type="text" name="signin_form_username" id="signin_form_username" placeholder="Username" />

     <label for="password">Password</label>
     <input type="password" name="signin_form_password" id="signin_form_password" placeholder="Password" />

     <span id="signin_form_error" class="error"></span>

     <input type="submit" name="submit" id="signin_form_submit" value="Login" />
     <a href="<?=site_url('signup'); ?>">Create Account</a>

</form>
