<?php
     $form_action = 'accounts/create_account';
     $form_name = 'signup_form';
     $csrf = array(
          'name' => $this->security->get_csrf_token_name(),
          'hash' => $this->security->get_csrf_hash()
     );
?>
<form id="<?=$form_name; ?>" action="<?=site_url($form_action); ?>" method="post" accept-charset="utf-8">
<?//= form_open ( $form_action , [ 'id' => $form_name ] ); ?>
<input type="hidden" id="<?=$form_name.'_'.$csrf['name'];?>" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />

<?=form_fieldset('Personal Information'); ?>

<?php
     $field_name = 'First Name';
     $field_id = 'first_name';
     $field_id_full = $form_name.'_'.$field_id;
?>
<?= form_label ( $field_name , $field_id_full ); ?>
<?= form_input (
          [
                    'name' => $field_id_full ,
                    'id' => $field_id_full ,
                    'placeholder' => $field_name ,
                    'value' => $signup_form_first_name,
          ]
); ?>
<span id="<?=$field_id_full; ?>_error" class="error"><?= form_error ( $field_id_full ); ?></span>

<?php
     $field_name = 'Last Name';
     $field_id = 'last_name';
     $field_id_full = $form_name.'_'.$field_id;
?>
<?= form_label ( $field_name , $field_id_full ); ?>
<?= form_input (
          [
                    'name' => $field_id_full ,
                    'id' => $field_id_full ,
                    'placeholder' => $field_name ,
                    'value' => $signup_form_last_name,
          ]
); ?>
<span id="<?=$field_id_full; ?>_error" class="error"><?= form_error ( $field_id_full ); ?></span>

<?php
     $field_name = 'Email';
     $field_id = 'email';
     $field_id_full = $form_name.'_'.$field_id;
?>
<?= form_label ( $field_name , $field_id_full ); ?>
<?= form_input (
          [
                    'name' => $field_id_full ,
                    'id' => $field_id_full ,
                    'placeholder' => $field_name ,
                    'value' => $signup_form_email,
          ]
); ?>
<span id="<?=$field_id_full; ?>_error" class="error"><?= form_error ( $field_id_full ); ?></span>

<?=form_fieldset_close(); ?>

<?=form_fieldset('Login Info'); ?>

<?php
     $field_name = 'Username';
     $field_id = 'username';
     $field_id_full = $form_name.'_'.$field_id;
?>
<?= form_label ( $field_name , $field_id_full ); ?>
<?= form_input (
          [
                    'name' => $field_id_full ,
                    'id' => $field_id_full ,
                    'placeholder' => $field_name ,
                    'value' => $signup_form_username,
          ]
); ?>
<span id="<?=$field_id_full; ?>_error" class="error"><?= form_error ( $field_id_full ); ?></span>

<?php
     $field_name = 'Password';
     $field_id = 'password';
     $field_id_full = $form_name.'_'.$field_id;
?>
<?= form_label ( $field_name , $field_id_full ); ?>
<?= form_password (
          [
                    'name' => $field_id_full ,
                    'id' => $field_id_full ,
                    'placeholder' => $field_name ,
          ]
); ?>
<span id="<?=$field_id_full; ?>_error" class="error"><?= form_error ( $field_id_full ); ?></span>

<?php
     $field_name = 'Confirm Password';
     $field_id = 'password2';
     $field_id_full = $form_name.'_'.$field_id;
?>
<?= form_label ( $field_name , $field_id_full ); ?>
<?= form_password (
          [
                    'name' => $field_id_full ,
                    'id' => $field_id_full ,
                    'placeholder' => $field_name ,
          ]
); ?>
<span id="<?=$field_id_full; ?>_error" class="error"><?= form_error ( $field_id_full ); ?></span>

     <?=form_fieldset_close(); ?>

     <?=form_fieldset('Password Recovery'); ?>

     <?php
          $field_name = 'Question 1';
          $field_id = 'lost_password_question_1';
          $field_id_full = $form_name.'_'.$field_id;
     ?>
     <?= form_label ( $field_name , $field_id_full ); ?>
     <?= form_textarea (
               [
                         'name' => $field_id_full ,
                         'id' => $field_id_full ,
                         'placeholder' => $field_name ,
                         'rows' => 2,
                         'value' => $signup_form_lost_password_question_1,
               ]
     ); ?>
     <span id="<?=$field_id_full; ?>_error" class="error"><?= form_error ( $field_id_full ); ?></span>

     <?php
          $field_name = 'Answer 1';
          $field_id = 'lost_password_answer_1';
          $field_id_full = $form_name.'_'.$field_id;
     ?>
     <?= form_label ( $field_name , $field_id_full ); ?>
     <?= form_textarea (
               [
                         'name' => $field_id_full ,
                         'id' => $field_id_full ,
                         'placeholder' => $field_name ,
                         'rows' => 2,
               ]
     ); ?>
     <span id="<?=$field_id_full; ?>_error" class="error"><?= form_error ( $field_id_full ); ?></span>

     <?php
          $field_name = 'Question 2';
          $field_id = 'lost_password_question_2';
          $field_id_full = $form_name.'_'.$field_id;
     ?>
     <?= form_label ( $field_name , $field_id_full ); ?>
     <?= form_textarea (
               [
                         'name' => $field_id_full ,
                         'id' => $field_id_full ,
                         'placeholder' => $field_name ,
                         'rows' => 2,
                         'value' => $signup_form_lost_password_question_2,
               ]
     ); ?>
     <span id="<?=$field_id_full; ?>_error" class="error"><?= form_error ( $field_id_full ); ?></span>

     <?php
          $field_name = 'Answer 2';
          $field_id = 'lost_password_answer_2';
          $field_id_full = $form_name.'_'.$field_id;
     ?>
     <?= form_label ( $field_name , $field_id_full ); ?>
     <?= form_textarea (
               [
                         'name' => $field_id_full ,
                         'id' => $field_id_full ,
                         'placeholder' => $field_name ,
                         'rows' => 2,
               ]
     ); ?>
     <span id="<?=$field_id_full; ?>_error" class="error"><?= form_error ( $field_id_full ); ?></span>

     <?php
          $field_name = 'Question 3';
          $field_id = 'lost_password_question_3';
          $field_id_full = $form_name.'_'.$field_id;
     ?>
     <?= form_label ( $field_name , $field_id_full ); ?>
     <?= form_textarea (
               [
                         'name' => $field_id_full ,
                         'id' => $field_id_full ,
                         'placeholder' => $field_name ,
                         'rows' => 2,
                         'value' => $signup_form_lost_password_question_3,
               ]
     ); ?>
     <span id="<?=$field_id_full; ?>_error" class="error"><?= form_error ( $field_id_full ); ?></span>

     <?php
          $field_name = 'Answer 3';
          $field_id = 'lost_password_answer_3';
          $field_id_full = $form_name.'_'.$field_id;
     ?>
     <?= form_label ( $field_name , $field_id_full ); ?>
     <?= form_textarea (
               [
                         'name' => $field_id_full ,
                         'id' => $field_id_full ,
                         'placeholder' => $field_name ,
                         'rows' => 2,
               ]
     ); ?>
     <span id="<?=$field_id_full; ?>_error" class="error"><?= form_error ( $field_id_full ); ?></span>

     <?php
     $field_name = 'Create Account';
     $field_id = 'submit';
     $field_id_full = $form_name.'_'.$field_id;
?>
<?=form_submit(
     [
          'name' => $field_id_full,
          'id' => $field_id_full,
          'value' => $field_name
     ]
); ?>

<?=form_fieldset_close(); ?>

<?=form_close(); ?>
