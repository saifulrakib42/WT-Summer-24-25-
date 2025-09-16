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
                    $('#email-feedback').text(' already exists!');
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
                    $('#phone-feedback').text(' already exists!');
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


    const sessionPassword = "<?php echo $_SESSION['password']; ?>"; 

    let currentPasswordValid = false;

    function toggleSubmitButton() {
        $("#changePasswordForm button[type='submit']").prop("disabled", !currentPasswordValid);
    }

    // Check when user finishes typing (blur) or on input
    $("input[name='current_password']").on("blur input", function(){
        const currentPassword = $(this).val().trim();

        if(currentPassword === sessionPassword){
            $("#password-feedback").removeClass("text-danger").addClass("text-success")
                .text("Current password matches.");
            currentPasswordValid = true;
        } else {
            $("#password-feedback").removeClass("text-success").addClass("text-danger")
                .text("Current password does not match!");
            currentPasswordValid = false;
        }

        toggleSubmitButton();
    });

    // Initial state
    toggleSubmitButton();

    // Your existing submit handler (unchanged except button state already handled)
    $("#changePasswordForm").on("submit", function(e){
        e.preventDefault();

        if(!currentPasswordValid) return; // just in case

        $.ajax({
            url: "../controller/UserController.php",
            type: "POST",
            data: $(this).serialize(),
            success: function(response){
                if(response === "success"){
                    $("#password-feedback").removeClass("text-danger").addClass("text-success")
                        .text("Password updated successfully!");
                    setTimeout(()=> location.reload(), 1500);
                } else {
                    $("#password-feedback").removeClass("text-success").addClass("text-danger")
                        .text(response);
                }
            }
        });
    });
});