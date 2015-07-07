<div class="row">
  <div class="col s12">
    <?php
         $form_action = 'accounts/create_account';
         $form_name = 'signup_form';
         $csrf = array(
              'name' => $this->security->get_csrf_token_name(),
              'hash' => $this->security->get_csrf_hash()
         );
    ?>
    <form id="<?=$form_name; ?>" action="<?=site_url($form_action); ?>" method="post" accept-charset="utf-8">
      <input type="hidden" id="<?=$form_name.'_'.$csrf['name'];?>" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />

    <div class="section">
<h3 class="header">Personal Information</h3>

<div class="row">
  <div class="input-field col s12 m6">
    <?php
         $field_name = 'First Name';
         $field_id = 'first_name';
         $field_id_full = $form_name.'_'.$field_id;
    ?>
    <?= form_input (
              [
                        'name' => $field_id_full ,
                        'id' => $field_id_full ,
                        'value' => $signup_form_first_name,
                        'class' => 'validate'
              ]
    ); ?>
     <label for="<?=$field_id_full; ?>" id="<?=$field_id_full; ?>_label" data-error="<?=form_error ( $field_id_full, false, false ); ?>"><?=$field_name; ?></label>
  </div>

  <div class="input-field col s12 m6">
    <?php
         $field_name = 'Last Name';
         $field_id = 'last_name';
         $field_id_full = $form_name.'_'.$field_id;
    ?>
    <?= form_input (
              [
                        'name' => $field_id_full ,
                        'id' => $field_id_full ,
                        'value' => $signup_form_last_name,
                        'class' => 'validate'
              ]
    ); ?>
     <label for="<?=$field_id_full; ?>" id="<?=$field_id_full; ?>_label" data-error="<?=form_error ( $field_id_full, false, false ); ?>"><?=$field_name; ?></label>
  </div>
</div>

<?php
     $field_name = 'Email';
     $field_id = 'email';
     $field_id_full = $form_name.'_'.$field_id;
?>
<div class="row">
  <div class="input-field col s12">
    <i class="material-icons prefix mdi-communication-email"></i>
    <?= form_input (
              [
                        'name' => $field_id_full ,
                        'id' => $field_id_full ,
                        'value' => $signup_form_email,
                        'class' => 'validate'
              ]
    ); ?>
     <label for="<?=$field_id_full; ?>" id="<?=$field_id_full; ?>_label" data-error="<?=form_error ( $field_id_full, false, false ); ?>"><?=$field_name; ?></label>
  </div>
</div>
</div>

<div class="section">
<h3 class="header">Login Information</h3>

<?php
     $field_name = 'Username';
     $field_id = 'username';
     $field_id_full = $form_name.'_'.$field_id;
?>
<div class="row">
  <div class="input-field col s12">
    <i class="material-icons prefix mdi-action-account-circle"></i>
    <?= form_input (
              [
                        'name' => $field_id_full ,
                        'id' => $field_id_full ,
                        'value' => $signup_form_username,
                        'class' => 'validate'
              ]
    ); ?>
     <label for="<?=$field_id_full; ?>" id="<?=$field_id_full; ?>_label" data-error="<?=form_error ( $field_id_full, false, false ); ?>"><?=$field_name; ?></label>
  </div>
</div>

<div class="row">
  <div class="input-field col s12 m6">
    <i class="material-icons prefix mdi-action-lock"></i>
    <?php
         $field_name = 'Password';
         $field_id = 'password';
         $field_id_full = $form_name.'_'.$field_id;
    ?>
    <?= form_password (
              [
                        'name' => $field_id_full ,
                        'id' => $field_id_full ,
                        'class' => 'validate'
              ]
    ); ?>
     <label for="<?=$field_id_full; ?>" id="<?=$field_id_full; ?>_label" data-error="<?=form_error ( $field_id_full, false, false ); ?>"><?=$field_name; ?></label>
  </div>

  <div class="input-field col s12 m6">
    <?php
         $field_name = 'Confirm Password';
         $field_id = 'password2';
         $field_id_full = $form_name.'_'.$field_id;
    ?>
    <?= form_password (
              [
                        'name' => $field_id_full ,
                        'id' => $field_id_full ,
                        'class' => 'validate'
              ]
    ); ?>
     <label for="<?=$field_id_full; ?>" id="<?=$field_id_full; ?>_label" data-error="<?=form_error ( $field_id_full, false, false ); ?>"><?=$field_name; ?></label>
  </div>
</div>
</div>

<div class="section">
<h3 class="header"><i class="material-icons prefix mdi-action-question-answer"></i> Account Recovery</h3>

<p class="flow-text">In case you lose access to your account for any reason, these questions and answers will help us get you set back up. Make them something unique. Something only you would know.</p>

<div class="row">
  <div class="input-field col s12 m6">
    <?php
         $field_name = 'Question 1';
         $field_id = 'lost_password_question_1';
         $field_id_full = $form_name.'_'.$field_id;
    ?>
    <?= form_textarea (
              [
                        'name' => $field_id_full ,
                        'id' => $field_id_full ,
                        'rows' => 2,
                        'value' => $signup_form_lost_password_question_1 ,
                        'class' => 'validate materialize-textarea'
              ]
    ); ?>
     <label for="<?=$field_id_full; ?>" id="<?=$field_id_full; ?>_label" data-error="<?=form_error ( $field_id_full, false, false ); ?>"><?=$field_name; ?></label>
  </div>

  <div class="input-field col s12 m6">
    <?php
      $field_name = 'Answer 1';
      $field_id = 'lost_password_answer_1';
      $field_id_full = $form_name.'_'.$field_id;
    ?>
    <?= form_textarea (
              [
                        'name' => $field_id_full ,
                        'id' => $field_id_full ,
                        'rows' => 2,
                        'class' => 'validate materialize-textarea'
              ]
    ); ?>
     <label for="<?=$field_id_full; ?>" id="<?=$field_id_full; ?>_label" data-error="<?=form_error ( $field_id_full, false, false ); ?>"><?=$field_name; ?></label>
  </div>
</div>

<div class="row">
  <div class="input-field col s12 m6">
    <?php
         $field_name = 'Question 2';
         $field_id = 'lost_password_question_2';
         $field_id_full = $form_name.'_'.$field_id;
    ?>
    <?= form_textarea (
              [
                        'name' => $field_id_full ,
                        'id' => $field_id_full ,
                        'rows' => 2,
                        'value' => $signup_form_lost_password_question_2 ,
                        'class' => 'validate materialize-textarea'
              ]
    ); ?>
     <label for="<?=$field_id_full; ?>" id="<?=$field_id_full; ?>_label" data-error="<?=form_error ( $field_id_full, false, false ); ?>"><?=$field_name; ?></label>
  </div>

  <div class="input-field col s12 m6">
    <?php
      $field_name = 'Answer 2';
      $field_id = 'lost_password_answer_2';
      $field_id_full = $form_name.'_'.$field_id;
    ?>
    <?= form_textarea (
              [
                        'name' => $field_id_full ,
                        'id' => $field_id_full ,
                        'rows' => 2,
                        'class' => 'validate materialize-textarea'
              ]
    ); ?>
     <label for="<?=$field_id_full; ?>" id="<?=$field_id_full; ?>_label" data-error="<?=form_error ( $field_id_full, false, false ); ?>"><?=$field_name; ?></label>
  </div>
</div>

<div class="row">
  <div class="input-field col s12 m6">
    <?php
         $field_name = 'Question 3';
         $field_id = 'lost_password_question_3';
         $field_id_full = $form_name.'_'.$field_id;
    ?>
    <?= form_textarea (
              [
                        'name' => $field_id_full ,
                        'id' => $field_id_full ,
                        'rows' => 2,
                        'value' => $signup_form_lost_password_question_3 ,
                        'class' => 'validate materialize-textarea'
              ]
    ); ?>
     <label for="<?=$field_id_full; ?>" id="<?=$field_id_full; ?>_label" data-error="<?=form_error ( $field_id_full, false, false ); ?>"><?=$field_name; ?></label>
  </div>

  <div class="input-field col s12 m6">
    <?php
      $field_name = 'Answer 3';
      $field_id = 'lost_password_answer_3';
      $field_id_full = $form_name.'_'.$field_id;
    ?>
    <?= form_textarea (
              [
                        'name' => $field_id_full ,
                        'id' => $field_id_full ,
                        'rows' => 2,
                        'class' => 'validate materialize-textarea'
              ]
    ); ?>
     <label for="<?=$field_id_full; ?>" id="<?=$field_id_full; ?>_label" data-error="<?=form_error ( $field_id_full, false, false ); ?>"><?=$field_name; ?></label>
  </div>
</div>
</div>

<div class="section">
     <?php
     $field_name = 'Sign Up';
     $field_id = 'submit';
     $field_id_full = $form_name.'_'.$field_id;
?>
<div class="row">
  <div class="col s12 center">
    <button class="btn-large waves-effect waves-teal" type="submit" name="<?=$field_name; ?>" id="signup_form_submit"><i class="material-icons mdi-content-create right"></i><?=$field_name; ?></button>
  </div>
</div>
</div>

<?=form_close(); ?>

</div>
</div>
