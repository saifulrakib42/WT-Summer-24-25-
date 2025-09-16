$(document).ready(function(){
    let emailValid = true;
    let phoneValid = true;

    function updateRegisterButton() {
        $('#registerBtn').prop('disabled', !(emailValid && phoneValid));
    }

    $('#email').on('input', function() {
        const email = $(this).val().trim();
        if(email !== '') {
            $.post('../controller/check_email_phone.php', { type: 'email', value: email }, function(response) {
                if(response === 'exists') {
                    $('#email-feedback').text('Email already exists!');
                    $('#email').addClass('is-invalid');
                    emailValid = false;
                } else {
                    $('#email-feedback').text('');
                    $('#email').removeClass('is-invalid');
                    emailValid = true;
                }
                updateRegisterButton();
            });
        } else {
            $('#email-feedback').text('');
            $('#email').removeClass('is-invalid');
            emailValid = true;
            updateRegisterButton();
        }
    });

    $('#phone').on('input', function() {
        const phone = $(this).val().trim();
        if(phone !== '') {
            $.post('../controller/check_email_phone.php', { type: 'phone', value: phone }, function(response) {
                if(response === 'exists') {
                    $('#phone-feedback').text('Phone number already exists!');
                    $('#phone').addClass('is-invalid');
                    phoneValid = false;
                } else {
                    $('#phone-feedback').text('');
                    $('#phone').removeClass('is-invalid');
                    phoneValid = true;
                }
                updateRegisterButton();
            });
        } else {
            $('#phone-feedback').text('');
            $('#phone').removeClass('is-invalid');
            phoneValid = true;
            updateRegisterButton();
        }
    });
});