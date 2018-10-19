;(function (window, $) {
    "use string";
    $(window.document).ready(function () {
        //
        $('.btn.btn-clear.float-right').on('click', function () {
            $(this.parentElement.parentElement.parentElement).removeClass('active');
        });
        //
        $('#new').on('click', function () {
            // Faker
            faker.locale = "pt_BR";
            $("#title").val(faker.lorem.words());
            $("#description").val(faker.lorem.sentence());
            $("#address").val(faker.address.streetAddress());
            // Datas
            var $a = new Date(faker.date.between('2015', '2019'));
            $("#begin").val($a.getDate() + '/' + ($a.getMonth() + 1) + '/' + $a.getFullYear() + ' ' + $a.getHours() + ':' + $a.getMinutes());
            $("#finish").val($a.getDate() + '/' + ($a.getMonth() + 1) + '/' + $a.getFullYear() + ' ' + $a.getHours() + ':' + $a.getMinutes());

            $("#about").val(faker.lorem.paragraphs());
            // Mostra o modal
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

function showCourse(course) {
    var id = course.getAttribute("data-course");

    document.getElementById('updateCouseModel').className = "modal active";

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        document.getElementById("updateCourse").innerHTML = this.responseText;
    };
    xmlhttp.open("GET", "../ajax.php?id="+id, true);
    xmlhttp.send();
}