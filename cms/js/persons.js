$(document).ready(function () {
    var selectedPerson;
    $('.personRow').on('click',function () {
        var persid = $(this).data("persid");
        var countryId = $(this).data("countryid");
        var instID = $(this).data("instid");
        $("#PersonID").val(persid);
        selectedPerson = persid;
        $.post(
            "./ajax/Ajaxpersons.php", {
                post_person_id: persid,
                action: "getData"
            },
            function (data) {
                var podaci = JSON.parse(data);
                $("#LastName").val(podaci.lastname);
                $("#FirstName").val(podaci.firstname);
                $("#selectCountry").val(countryId).change();
                $("#selectInstituion").val(instID).change();
                $("#Address").val(podaci.address);
                $("#Phone").val(podaci.phone);
                $("#Mobile").val(podaci.mobile);
                $("#Fax").val(podaci.fax);
                $("#Email").val(podaci.email);
                $("#WebPage").val(podaci.url);
                $("#AcaStatus").val(podaci.academicStatus);
                $("#Department").val(podaci.department);

                $("#update").removeAttr("disabled");
                $("#insert").attr("disabled",true);
                $("#reset").attr("type","show");

            });
    });

    $('#reset').on('click', function () {
        $("#LastName").val("");
        $("#FirstName").val("");
        $("#selectCountry").val("").change();
        $("#selectInstituion").val("").change();
        $("#Address").val("");
        $("#Phone").val("");
        $("#Mobile").val("");
        $("#Fax").val("");
        $("#Email").val("");
        $("#WebPage").val("");
        $("#AcaStatus").val("");
        $("#Department").val("");

        $('#update').attr("disabled", true);
        $('#reset').attr("type", "hidden");
        $('#insert').removeAttr('disabled');

        $("#PersonID").val("");
    });
    $('#dataTable_length').on('click', function () {
        var numb1 =document.getElementById("prvi").value;
        console.log(numb1)
    });

})