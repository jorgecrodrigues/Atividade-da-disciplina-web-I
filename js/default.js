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
})(this, this.$ || this.jQuery || false);