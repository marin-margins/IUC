$(document).ready(function() {
    //globalna varijabla za oznaceni redak
    var selectedInst;
    //resetiranje cijele forme na pocetnu
    $('#reset').on('click', function() {
        $("#institutionName").val("");
        $("#selectCountry").val("").change();
        $("#selectCity").val("").change();
        $("#address").val("")
        $("#webAddress").val("");
        $("#president").val("");
        $("#iucRepresentative").val("");
        $("#financialContact").val("");
        $("#internationalContact").val("");
        $("#memberFrom").val("");
        $("#memberTo").val("");
        $("#other").val("");
        //namjestanje buttona
        $('#delete').attr("disabled", true);
        $('#update').attr("disabled", true);
        $('#reset').attr("type", "hidden");
        $('#insert').removeAttr('disabled');
        //sakrivena forma se stavlja na prazno
        $("#formInstitutionID").val("");
    });
    //ajax za dinamične select boxove, grad select box ovisi o tom koja ce se drzava izabrati, inace ce bit prazan
    $('#selectCountry').change(function() {
        var country_id = $(this).val();
        $.ajax({
            url: "./ajax/institutionsAjax.php",
            method: "POST",
            data: {
                post_inst_id: country_id,
                action: "getCities"
            },
            dataType: "text",

            success: function(data) {
                console.log(data);
                $('#selectCity').html(data);
            }
        });
    });
    //ajax za dohvacanje vise informacija o retku nakon klika na bilo gdje u tom retku
    $('.institutionRow').on('click', function() {
        var cityId = $(this).data("cityid");
        var countryId = $(this).data("countryid");
        var instID = $(this).data("instid");
        //stavljanje hidden ID-a u formi na ID selectanog retka koji se kasnije koristi u POSTU na klikom CREATE NEW
        $("#formInstitutionID").val(instID);
        selectedInst = instID;
        $.post(
            "./ajax/institutionsAjax.php", {
                post_inst_id: instID,
                action: "getData"
            },
            function(data, status) {
                var podaci = JSON.parse(data);
                $("#institutionName").val(podaci.name);
                $("#selectCountry").val(countryId).change();
                $("#selectCity").val(cityId).change();
                $("#address").val(podaci.address);
                $("#webAddress").val(podaci.webAddress);
                //ponovno sam napisao jer ne dohvaca funkciju od gore checkMemberStatus()
                if (podaci.isMember == 'Y')
                    $("#selectStatus").val("Member").change();
                else
                    $("#selectStatus").val("Associate Member").change();
                $("#president").val(podaci.president);
                $("#iucRepresentative").val(podaci.iucRepresentative);
                $("#financialContact").val(podaci.financeContact);
                $("#internationalContact").val(podaci.internationalContact);
                $("#memberFrom").val(podaci.memberFrom);
                $("#memberTo").val(podaci.memberTo);
                $("#other").val(podaci.comment);
                //namjestanje buttona
                $('#delete').removeAttr('disabled');
                $('#update').removeAttr('disabled');
                $('#insert').attr("disabled", true);
                $('#reset').attr("type", "show");
            });
    });
    //ajax za mijenjanje atributa active u 0, tj sakrivanje(lazno brisanje)
    $('#delete').on('click', function() {
        var instID = selectedInst;
        var confirmation = confirm("Are you sure you want to delete?");
        if (confirmation) {
            $.post("./ajax/institutionsAjax.php", {
                    post_inst_id: instID,
                    action: "delete"
                },
                function(data, status) {
                    alert("Institution deleted");
                    $("#institutionName").val("");
                    $("#selectCountry").val("").change();
                    $("#selectCity").val("").change();
                    $("#address").val("")
                    $("#webAddress").val("");
                    $("#president").val("");
                    $("#iucRepresentative").val("");
                    $("#financialContact").val("");
                    $("#internationalContact").val("");
                    $("#memberFrom").val("");
                    $("#memberTo").val("");
                    $("#other").val("");
                    $('#delete').attr("disabled", true);
                    $('#update').attr("disabled", true);
                    //sakrivena forma se stavlja na prazno
                    $("#formInstitutionID").val("");
                });
        }
    });
})