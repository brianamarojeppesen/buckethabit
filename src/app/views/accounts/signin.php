<form id="signin_form" action="<?=site_url('accounts/validate_credentials'); ?>" method="post" accept-charset="utf-8">

  <div class="row">
    <div class="input-field col s12">
       <input type="text" name="signin_form_username" id="signin_form_username">
       <label for="signin_form_username">Username</label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s12">
       <input type="password" name="signin_form_password" id="signin_form_password">
       <label for="signin_form_password">Password</label>
    </div>
  </div>

  <div class="row">
    <div id="signin_form_error" class="form-error col s12">
    </div>
  </div>

  <div class="row">
    <div class="col s12 center">
      <button class="btn-flat waves-effect waves-light-blue" type="submit" name="submit" id="signin_form_submit">Login</button>
    </div>
  </div>

  <div class="row">
    <div class="col s12 center">
      <a class="btn-flat waves-effect waves-light-blue create-account-link" href="<?=site_url('signup'); ?>">Create Account</a>
    </div>
  </div>
</form>
