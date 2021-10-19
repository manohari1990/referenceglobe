$(function(){
    $( "#dob" ).datepicker({
        changeMonth: true,
        changeYear: true,
        format: "yyyy-mm-dd",
        minDate: new Date ('1990-01-01'),
        maxDate: new Date('2015-12-31'),
        //setDate: new Date(2014, 10, 30),
        autoclose: true
    });
    $("#userForm").validate({
        rules: {
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            dob: {
                required: true
            },
            user_roll: {
                required: true
            },
            gender: {
                required: true
            },
            user_signature: {
                required: true
            },
            address: {
                required: true
            },
            phone_number: {
                required: false,
                phoneValidation: true
            },        
            username: {
                required: true
            },
            user_password: {
                required: true,
                pwcheck: true,
                minlength: 8
            },
            email_id: {
                required: true,
                emailcheck: true
            },
        },
        messages: {
            first_name: {
                required: "First Name is required."
            },
            last_name: {
                required: "Last Name is required."
            },
            dob: {
                required: "DOB is required."
            },
            gender: {
                required: "Gender is required."
            },
            user_roll: {
                required: "User Role is required."
            },
            user_signature: {
                required: "Signature is required."
            },
            username: {
                required: "Username is required."
            },
            user_password: {
                required: "Password is required",
                pwcheck: "Password must contain atleast one uppercase, one lowercase, one digit and special characters from @#$%&",
                minlength: "Password must be between 8 and 20 characters long"
            },
            email_id: {
                required: "Email Adresse is required.",
                emailcheck: "Invalid email address."
            },
            phone_number: {
                required: "",
                phoneValidation: "Invalid Phone number."
            }
        }
    });
    $.validator.addMethod("pwcheck", function(value, element) {
        return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
                && /[a-z]/.test(value) // has a lowercase letter
                && /\d/.test(value) // has a digit
    });

    $.validator.addMethod("emailcheck", function(value, element) {
        return /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i.test(value)
    });

    $.validator.addMethod('phoneValidation', function(value, element){
        if(value.match(/^\d{10}$/)) {
            return true;
        }
        return false;
    });
});
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
function onlyAlphabets(e, t) {
    return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32);
}
