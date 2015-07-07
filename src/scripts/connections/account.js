(function(window,undefined){

  // Localise Globals
  var $ = window.jQuery;

  $BS.connect('signup_form', '#signup_form', function() {

            $('input', this ).blur(function() {
              if($(this).val()) {
                 $url = $(this ).closest('form' ).attr('action')

                 var data = {
                      test_field: this.id,
                      test: '1'
                 }

                 data[this.id] = $(this).val()

                 if (this.id === 'signup_form_password') data['signup_form_password2'] = $('#signup_form_password2' ).val()

                 if (this.id === 'signup_form_password2') data['signup_form_password'] = $('#signup_form_password' ).val()

                 $BS.query($url ).with_data(data ).post()
               } else {
                 $(this).removeClass('valid');
                 $(this).removeClass('invalid');
                 $(this.id+'_label').attr('data-error', '');
                 $(this.id+'_label').attr('data-success', '');
               }
            })

            $('#signup_form_submit').click(function () {

                 $url = $(this ).closest('form' ).attr('action')

                 console.log('Posting to '+$url);
                 $BS.query($url).with_data({
                      signup_form_first_name: $('#signup_form_first_name' ).val(),
                      signup_form_last_name: $('#signup_form_last_name' ).val(),
                      signup_form_email: $('#signup_form_email' ).val(),
                      signup_form_username: $('#signup_form_username' ).val(),
                      signup_form_password: $('#signup_form_password' ).val(),
                      signup_form_password2: $('#signup_form_password2' ).val(),
                      signup_form_lost_password_question_1: $('#signup_form_lost_password_question_1' ).val(),
                      signup_form_lost_password_answer_1: $('#signup_form_lost_password_answer_1' ).val(),
                      signup_form_lost_password_question_2: $('#signup_form_lost_password_question_2' ).val(),
                      signup_form_lost_password_answer_2: $('#signup_form_lost_password_answer_2' ).val(),
                      signup_form_lost_password_question_3: $('#signup_form_lost_password_question_3' ).val(),
                      signup_form_lost_password_answer_3: $('#signup_form_lost_password_answer_3' ).val(),
                 }).post()

                //  History.pushState({url: $url}, null, $url)

                 return false
            })
  })

  $BS.connect('signin_form', '#signin_form', function() {

       $('#signin_form_submit').click(function () {
         console.log('Attempting login.');

            $url = $(this ).closest('form' ).attr('action')

            console.log('posting to ' + $url);
            console.log('with username ' + $('#signin_form_username' ).val());
            console.log('and password ' + $('#signin_form_password' ).val());
            $BS.query($url).with_data({
                 signin_form_username: $('#signin_form_username' ).val(),
                 signin_form_password: $('#signin_form_password' ).val(),
                 error_target: 'signin_form_error',
            }).post()

            // History.pushState({url: $url}, null, $url)

            return false
       })
  })

})(window);
