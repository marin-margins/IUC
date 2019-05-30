$(document).ready(function() {
var x ="", i;
$('.InstPersRow').on('click', function(e){
    var instID = $(this).data("instid");
    var table = document.getElementById("mydata");
    console.log(table.rows.length-1)
    var k = table.rows.length-1;
    for( k ; k >= 0; k--)
    {
        table.deleteRow(k);
    }
    $.post(
        "./ajax/ajax_institutions_persons.php", {
            post_person_id: instID,
            action: "getData"
        },
        function (data) {
            var podaci = JSON.parse(data);
            for(i in podaci){
                x = "<tr><td>"+podaci[i].name+"</td><td>"+podaci[i].role+"</td><td>"+podaci[i].type+"</td><td>"+podaci[i].date+"</td><td>"+podaci[i].programme+"</td>";
               // console.log(x)
                //$("#LastName").val(x);
                $("#mydata").append(x);
            }
            $('#myModal').modal('show');
            e.preventDefault();
        });
});
});
