
$(document).ready(function() {
	$('#FORM1').hide();
    $('.newsRow').on('click', function () {
		$(this).css('background', 'red');
        var newsID = $(this).data("newsid");
        //stavljanje hidden ID-a u formi na ID selectanog retka koji se kasnije koristi u POSTU na klikom APPLY CHANGES
        $("#formNewsID").val(newsID);
        selectedNews = newsID;
        $.post(
            "./ajax/newsAjax.php", {
                post_news_id: newsID,
                action: "getData"
            },
            function (data, status) {
                var podaci = JSON.parse(data);
                $("#newsTitle").val(podaci.title);
                $("#date").val(podaci.date);
                $("#summary").val(podaci.summary);
                $("#body").val(podaci.body);
             
          
                //namjestanje buttona
                $('#delete').removeAttr('disabled');
                $('#update').removeAttr('disabled');
                $('.uploadForm').show();
                $('#insert').attr("disabled", true);
                $('#reset').attr("type", "show");
                $('#deletePic').attr("type", "show");
            });
    });
	$('#edit').on('click', function () {

	$('#TABLE,#FORM1').toggle(200);
		


} );		
} );