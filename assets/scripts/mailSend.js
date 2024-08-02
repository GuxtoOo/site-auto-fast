$(document).ready(function() {
    $("#contactForm").on("submit", function(event) {
        event.preventDefault();

        $.ajax({
            url: "../siteAutoFast/mail/mail.php",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {                
                let alertBox = '';
                try {
                    if(response.status === 'success'){
                        alertBox = '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                                    response.message +
                                   '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                     '<span aria-hidden="true">&times;</span>' +
                                   '</button>' +
                                   '</div>';
                    } else {
                        alertBox = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                                    response.message +
                                   '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                     '<span aria-hidden="true">&times;</span>' +
                                   '</button>' +
                                   '</div>';
                    }                    
                } catch (error) {
                    alertBox = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                               'Ocorreu um erro. Por favor, tente novamente.' +
                               '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                 '<span aria-hidden="true">&times;</span>' +
                               '</button>' +
                               '</div>';
                }
                
                $("#responseMessage").html(alertBox);
            },
            error: function() {
                const alertBox = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                                 'Ocorreu um erro. Por favor, tente novamente.' +
                                 '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                   '<span aria-hidden="true">&times;</span>' +
                                 '</button>' +
                                 '</div>';
                $("#responseMessage").html(alertBox);
            }
        });
    });
});