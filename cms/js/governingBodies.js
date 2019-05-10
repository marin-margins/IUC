$(document).ready(function () {
    //globalna varijabla za oznaceni redak
    var selectedPerson;
    //resetiranje cijele forme na pocetnu
    $('#reset').on('click', function () {
        $("#personTitle").val("");
        $("#academicStatus").val("");
        $("#fullName").val("");
        $("#instName").val("")
        $("#address").val("");
        $("#instName2").val("");
        $("#address2").val("");
        $("#telephone").val("");
        $("#fax").val("");
        $("#email").val("");
        $("#webAddress").val("");
        $("#memberFrom").val("");
        $("#memberTo").val("");
        $("#other").val("");
        $("#selectStatus").val("").change("");
        //namjestanje buttona
        $('#delete').attr("disabled", true);
        $('#update').attr("disabled", true);
        $('#uploadPic').attr("type", "hidden");
        $('#deletePic').attr("type", "hidden");
        $('#insert').removeAttr('disabled');
        $('#reset').attr("type", "hidden");
        //sakrivena forma se stavlja na prazno
        $("#formPersonID").val("");
    });
    //ako odlucimo box na kraju ode ce bit
    //ako odlucimo box na kraju ode ce bit
    //ako odlucimo box na kraju ode ce bit
    //ako odlucimo box na kraju ode ce bit
    //ako odlucimo box na kraju ode ce bit
    //ako odlucimo box na kraju ode ce bit
    //ako odlucimo box na kraju ode ce bit
    //ako odlucimo box na kraju ode ce bit
    //ako odlucimo box na kraju ode ce bit
    //ako odlucimo box na kraju ode ce bit
    //ajax za dinamične select boxove, grad select box ovisi o tom koja ce se drzava izabrati, inace ce bit prazan
    $('#selectCountry').change(function () {
        var country_id = $(this).val();
        $.ajax({
            url: "./ajax/institutionsAjax.php",
            method: "POST",
            data: {
                post_inst_id: country_id,
                action: "getCities"
            },
            dataType: "text",

            success: function (data) {
                $('#selectCity').html(data);
            }
        });
    });
    //ajax za dohvacanje vise informacija o retku nakon klika na bilo gdje u tom retku
    $('.personRow').on('click', function () {
        var personID = $(this).data("personid");
        //stavljanje hidden ID-a u formi na ID selectanog retka koji se kasnije koristi u POSTU na klikom APPLY CHANGES
        $("#formPersonID").val(personID);
        selectedPerson = personID;
        $.post(
            "./ajax/governingBodiesAjax.php", {
                post_person_id: personID,
                action: "getData"
            },
            function (data, status) {
                var podaci = JSON.parse(data);
                $("#personTitle").val(podaci.title);
                $("#academicStatus").val(podaci.academicStatus);
                var fullname = podaci.firstname + " " + podaci.lastame;
                $("#fullName").val(fullname);
                $("#instName").val(podaci.name);
                $("#address").val(podaci.instAddress);
                $("#selectStatus").val(podaci.isActive).change();
                $("#telephone").val(podaci.phone);
                $("#fax").val(podaci.fax);
                $("#email").val(podaci.email);
                $("#webAddress").val(podaci.url);
                $("#memberFrom").val(podaci.memberFrom);
                $("#memberTo").val(podaci.memberTo);
                $("#other").val(podaci.other);
                //namjestanje buttona
                $('#delete').removeAttr('disabled');
                $('#update').removeAttr('disabled');
                $('#insert').attr("disabled", true);
                $('#reset').attr("type", "show");
                $('#uploadPic').attr("type", "show");
                $('#deletePic').attr("type", "show");
            });
    });
    //ajax za mijenjanje atributa active u 0, tj sakrivanje(lazno brisanje)
    $('#delete').on('click', function () {
        var personID = selectedPerson;
        var confirmation = confirm("Are you sure you want to delete?");
        if (confirmation) {
            $.post("./ajax/governingBodiesAjax.php", {
                post_person_id: personID,
                action: "delete"
            },
                function (data, status) {
                    $("#personTitle").val("");
                    $("#academicStatus").val("");
                    $("#fullName").val("");
                    $("#instName").val("")
                    $("#address").val("");
                    $("#instName2").val("");
                    $("#address2").val("");
                    $("#telephone").val("");
                    $("#fax").val("");
                    $("#email").val("");
                    $("#webAddress").val("");
                    $("#memberFrom").val("");
                    $("#memberTo").val("");
                    $("#other").val("");
                    $("#selectStatus").val("").change("");
                    //namjestanje buttona
                    $('#delete').attr("disabled", true);
                    $('#update').attr("disabled", true);
                    $('#uploadPic').attr("type", "hide");
                    $('#deletePic').attr("type", "hide");
                    //sakrivena formaID se stavlja na prazno
                    $("#formPersonID").val("");
                });
        }
    });
})