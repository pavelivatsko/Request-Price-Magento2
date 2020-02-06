require([
    "jquery",
    "mage/mage"
],function($) {
    $(document).ready(function() {
        $('#request-price-form').mage(
            'validation',
            {
                submitHandler: function(form) {
                    $.ajax({
                        url: "/request_price/index/save",
                        data: $('#request-price-form').serialize(),
                        type: 'POST',
                        dataType: 'json',
                        success: function(data, status, xhr) {

                        },
                        error: function (xhr, status, errorThrown) {
                            console.log('Error happens. Try again.');
                            console.log(errorThrown);
                        }
                    });
                }
            }
        );
    });
});
