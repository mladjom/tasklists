<?php $this->load->view("includes/header"); ?>

<?php $this->load->view($content); ?>
<script type='text/javascript' language='javascript'>
$(document).ready(function() {

  $("#form-login").validate({

    errorElement: "span",
		errorClass:"alert-danger",

    rules: {

      username: {
        required: true,
        minlength: 5,
        maxlength:25
      },
      password: {
        required: true,
        minlength: 6,
        maxlength:12
      }
    },
    messages: {

      username: {
        required: "Username is required."
      },

      password: {
        required: "Please provide a password.",
        minlength: "Your password must be at least 5 characters long",
        maxlength: "Password can not be more than 25 characters"
      }
      

    },

    errorPlacement: function(error, element, errorClass) {
      error.appendTo(element.parent());
    }

  });
$("#form-signup").validate({

errorElement: "span",
errorClass:"alert-danger",

rules: {

    username: {
        required: true,
        minlength: 5,
        maxlength: 25,
        remote: {
            url: "<?php echo base_url().'site/register_username_exists';?>",
            type: "post",
            data: {
                username: function () {
                    return $("#username").val();
                }
            }
        }
    },
    email: {
        required: true,
        email: true,
        remote: {
            url: "<?php echo base_url().'site/register_email_exists';?>",
            type: "post",
            data: {
                email: function () {
                    return $("#email").val();
                }
            }
        }
    },

    password: {
        required: true,
        minlength: 6,
        maxlength: 12
    },
    cpassword: {
        equalTo: "#password"
    }
},

messages: {

    username: {
        required: "Username is required.",
        minlength: 'min lenght',
        maxlength: 'max lenght',
        lettersonly: 'and even this',
        remote: 'Username already exist. Log in to your existing account.'

    },

    password: {
        required: "Please provide a password.",
        minlength: "Your password must be at least 6 characters long",
        maxlength: "Password can not be more than 12 characters"
    },

    cpassword: {
        equalTo: "Password is not matching!"
    },

    email: {
        required: 'Email address is required',
        email: 'Please enter a valid email address',
        remote: 'Email already used. Log in to your existing account.'
    }
},

errorPlacement: function (error, element, errorClass) {
    error.appendTo(element.parent());
}

});


}); // Closing $(document).ready()
</script>
<?php $this->load->view("includes/footer"); ?>