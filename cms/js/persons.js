$(document).ready(function () {
    var selectedPerson;
    $('personRow').on('click',function () {
        $("#PersonID").val(Persoid);
        selectedPerson = Persoid;
        $("#selectCountry").val(countryId).change();
    })

})