(function (window, $) {
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

    // Jquery mask where <input name="(parametro)">
    $('input[name=begin]').mask('NN/NN/NNNN NN:NN', {
        placeholder: "____/____/________ ____:____",
        translation: {
            'N': {
                pattern: /[0-9]/, optional: false
            }
        }
    });
    $('input[name=finish]').mask('NN/NN/NNNN NN:NN', {
        placeholder: "____/____/________ ____:____",
        translation: {
            'N': {
                pattern: /[0-9]/, optional: false
            }
        }
    });
    $('#updateCourse').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: 'ajaxUpdate.php',
            type: 'post',
            dataType: 'html',
            data: {
                id: $('#id').val(),
                title: $('#title').val(),
                description: $('#description').val(),
                address: $('#address').val(),
                finish: $('#finish').val(),
                about: $('#about').val(),
                published: $('input[name=published]:checked', '#updateCourse').val(),
                begin: $('#begin').val(),
                coordinator_id: $('#coordinator_id').val()
            }
        }).done(function (data) {

            if (data) {
                alert("Ocorreu o seguinte erro: " + data);
            } else {
                alert("Recurso Alterado Com sucesso");
            }
            selectAll();
        });
    });

})(this, this.$ || this.jQuery || false);

function showCourse(course) {
    var id = course.getAttribute("data-course");

    document.getElementById('updateCouseModel').className = "modal active";

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        document.getElementById("updateCourse").innerHTML = this.responseText;
        // Jquery mask where <input name="(parametro)">
        $('input[name=begin]').mask('NN/NN/NNNN NN:NN', {
            placeholder: "____/____/________ ____:____",
            translation: {
                'N': {
                    pattern: /[0-9]/, optional: false
                }
            }
        });
        $('input[name=finish]').mask('NN/NN/NNNN NN:NN', {
            placeholder: "____/____/________ ____:____",
            translation: {
                'N': {
                    pattern: /[0-9]/, optional: false
                }
            }
        });
    };
    xmlhttp.open("GET", "ajax.php?id=" + id, true);
    xmlhttp.send();
}

function selectAll() {
    var query = location.search.slice(1);

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        document.getElementById("application").innerHTML = this.responseText;
    };

    xmlhttp.open("GET", "ajaxSelectAll.php?"+query, true);
    xmlhttp.send();
}