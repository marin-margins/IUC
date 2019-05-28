
$(document).ready(function() {
	$('#FORM1').hide();
	$('#bla').show();
    $('#edit1').hide();
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
            function (data,status) {
                var podaci = JSON.parse(data);
                $("#newsTitle").val(podaci.title);
                $("#date").val(podaci.date);
                $("#summary").val(podaci.summary);
                $("#body").val(podaci.body);
             

                //namjestanje buttona


                $('#insert').prop('disabled', true);
                $('.uploadForm').show();
            });
    });
	$('#edit').on('click', function () {
    document.getElementById("bla").style.display = "none";
	$('#TABLE,#FORM1').toggle(200);
        $('#edit1').show();


} );
    $('#delete').on('click', function () {
        var newsID = selectedNews;
        var confirmation = confirm("Are you sure you want to delete?");
        if (confirmation) {
            $.post("./ajax/newsAjax.php", {
                post_news_id: newsID,

                action: "delete",
                function(data){
                    location.reload();
                }
            }) };

    } );
    $('#edit1').on('click', function () {
    var    newsTitle=$("#newsTitle").val();
    var     newsDate=$("#date").val();
    var     newsSummary=$("#summary").val();
    var    newsBody= $("#body").val();
        var newsID = selectedNews;
        var confirmation = confirm("Are you sure you want to edit?");
        if (confirmation) {
            $.post("./ajax/newsAjax.php", {
                post_news_id: newsID,
                post_news_title:newsTitle,
                post_news_date:newsDate,
                post_news_summary:newsSummary,
                post_news_body:newsBody,
                action: "editNews ",
                function(data){
                   // location.reload();
                }
            }) };

    } );


  } );