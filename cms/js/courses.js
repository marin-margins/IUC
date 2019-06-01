$(document).ready(function() {
	var selectedcourse;
    var bojane;
    var i;
	$('.coursesRow').on('click', function () {
		//uzme id spremi ga u globalnu
		var eventt = $(this).data("event");
        selectedcourse = eventt;
		// uzmes id tablice
		var element=document.getElementById("mydata");
		bojane = this.rowIndex -1;//uvijek broj jedan vise zbog footera ili nes tako
		for(i = 0; i < element.rows.length; i++){
            //prolazi kroz for petlju i oznacuje samo onog kojeg si stisnu a ostale stavlja kao basic
            if(i == bojane){
                $(element.rows[i]).css('background-color', 'rgba(50, 115, 220, 0.3)');
            }
            else{
                $(element.rows[i]).css('background-color', '');
            }
        }
        $('#edit').removeAttr("disabled");
    });
	$('#edit').click(function() {
		 //za ici na edit
        window.location='course_details.php?stranica='+ selectedcourse;
    });
});
	
