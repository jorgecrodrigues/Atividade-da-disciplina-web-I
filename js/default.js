;(function (window, $) {
    "use string";
    $(window.document).ready(function () {
        //
        $('.btn.btn-clear.float-right').on('click', function () {
            $(this.parentElement.parentElement.parentElement).removeClass('active');
        });
        //
        $('#new').on('click', function () {
            $('.new').addClass('active');
        });
    });

    // Jquery mask
    $('#begin').mask('NN/NN/NNNN NN:NN', {
        placeholder: "____/____/________ ____:____",
        translation: {
            'N': {
                pattern: /[0-9]/, optional: false
            }
        }
    });
    $('#finish').mask('NN/NN/NNNN NN:NN', {
        placeholder: "____/____/________ ____:____",
        translation: {
            'N': {
                pattern: /[0-9]/, optional: false
            }
        }
    });
})(this, this.$ || this.jQuery || false);