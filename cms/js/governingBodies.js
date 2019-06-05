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
        $("#imgDiv").remove();
        //namjestanje buttona
        $('#delete').attr("disabled", true);
        $('#update').attr("disabled", true);
        $('#deletePic').attr("type", "hidden");
        $('#insert').removeAttr('disabled');
        $('#reset').attr("type", "hidden");
        //sakrivena forma se stavlja na prazno
        $("#formPersonID").val("");
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
                var fullname = podaci.firstname + " " + podaci.lastname;
                $("#fullName").val(fullname);
                $("#instName").val(podaci.instituteName);
                $("#address").val(podaci.address);
                $("#selectStatus").val(podaci.isActive).change();
                $("#telephone").val(podaci.phone);
                $("#fax").val(podaci.fax);
                $("#email").val(podaci.email);
                $("#webAddress").val(podaci.url);
                $("#memberFrom").val(podaci.memberFrom);
                $("#memberTo").val(podaci.memberTo);
                $("#other").val(podaci.other);
                //ako slika postoji dodaje se img u div i omogucuje se brisanje slike, ako ne slika nije dodana u div i ne moze se izbrisat
                if (podaci.path != undefined) {
                    $('#imgDiv').prepend('<img id="image" name="image" src=' + podaci.path + ' height="300" width="300" />');
                    $('#deletePic').removeAttr("disabled");
                }
                else
                    $('#deletePic').attr("disabled", true);
                //namjestanje buttona
                $('#delete').removeAttr('disabled');
                $('#update').removeAttr('disabled');
                $('#insert').attr("disabled", true);
                $('#reset').attr("type", "show");
                $('#deletePic').attr("type", "show");
            });
    });
    //BRISANJE COVJEKA
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
                    $('#deletePic').attr("type", "hide");
                    //sakrivena formaID se stavlja na prazno
                    $("#formPersonID").val("");
                });
        }
    });
    //BRISANJE SLIKE
    //ajax za mijenjanje atributa active u 0, tj sakrivanje(lazno brisanje)
    $('#deletePic').on('click', function () {
        var personID = selectedPerson;
        var confirmation = confirm("Are you sure you want to delete?");
        if (confirmation) {
            $.post("./ajax/governingBodiesAjax.php", {
                post_person_id: personID,
                action: "deletePic"
            },
                function (data, status) {
                    alert("Picture deleted");
                    $('#deletePic').attr("disabled", true);
                    $('#imgDiv').remove();
                });
        }
    });
})