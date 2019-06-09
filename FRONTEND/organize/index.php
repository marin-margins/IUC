<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Organize IUC Programme</title>
	<link rel="stylesheet" href="../style.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,600,700i,800,800i,900,900i|Playfair+Display:400,400i,700,700i,900,900i" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

</head>
<body>
	    <!-- NAVBAR -->
    <div class="org-navbar">
        <div class="nav-left">
        <img src="../to_include/logo-header.png" alt="IUC International University Centre Dubrovnik Logo" class="org-logo">
        <span id="divider"></span>
		<p>Inter-University Centre<span> Dubrovnik</span></p>
        </div>

        <div class="nav-right">
            
            <input type="search" placeholder="search" name="" id="search">
            <svg class="search-icon sicon" xmlns="http://www.w3.org/2000/svg" width="15.207" height="15.207" viewBox="0 0 15.207 15.207"><defs><style>.asrt,.csrt{fill:none;}.asrt{stroke:#8b8b8b;stroke-width:2px;}.bsrt{stroke:none;}</style></defs><g class="asrt"><circle class="bsrt" cx="6.5" cy="6.5" r="6.5"/><circle class="csrt" cx="6.5" cy="6.5" r="5.5"/></g><line class="asrt" x2="4" y2="4" transform="translate(10.5 10.5)"/></svg>
            
            <a onclick="openHamb()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 16 18"><defs><style>.as{fill:none;stroke:#010727;stroke-width:2px;}</style></defs><g transform="translate(0 1)"><line class="as" x2="16"/><line class="as" x2="16" transform="translate(0 8)"/><line class="as" x2="16" transform="translate(0 16)"/></g></svg></a>
        </div>
    </div>
    

    <!-- HEADER -->
    <div class="org-header">
        <div class="org-overlay"></div>
        <h1>Organize IUC Programme</h1>
    </div>
    
    <!--TABS-->
    <div class="tabs-area">
		<div class="tabs">
			<ul id="tabs">
				<li class="tablink active">
					<svg class="img-idea" xmlns="http://www.w3.org/2000/svg" width="20.834" height="25" viewBox="0 0 20.834 25"><defs><style>.img-idea{fill:#3891cc;}</style></defs><path class="img-idea" d="M14.5,19.792H10.333a.521.521,0,1,0,0,1.042H14.5a.521.521,0,1,0,0-1.042Zm0,2.083H10.333a.521.521,0,1,0,0,1.042H14.5a.521.521,0,1,0,0-1.042Zm.26,2.083H10.073l1.237.815a.97.97,0,0,0,.641.227h.932a.972.972,0,0,0,.641-.227ZM18.667,9.584c0,3.718-3.348,6.232-3.348,9.166H13.247a10.111,10.111,0,0,1,1.793-5.07,8.61,8.61,0,0,0,1.544-4.1,3.9,3.9,0,0,0-4.17-3.929A3.891,3.891,0,0,0,8.25,9.584a8.61,8.61,0,0,0,1.544,4.1,10.09,10.09,0,0,1,1.792,5.07H9.515c0-2.933-3.348-5.448-3.348-9.166a5.977,5.977,0,0,1,6.247-6.013A5.982,5.982,0,0,1,18.667,9.584Zm4.167-.72v1.429H20.19c.021-.232.04-.467.04-.709s-.018-.483-.036-.719h2.641ZM11.742,2.039V0H13.17V2.046c-.252-.023-.5-.036-.756-.036-.224,0-.448.01-.672.029Zm-3.9,1.348L6.759,1.366,8.018.691,9.1,2.7A8.094,8.094,0,0,0,7.843,3.386ZM18.87,5.194l2.023-1.452L21.725,4.9l-2.14,1.534a6.976,6.976,0,0,0-.716-1.244ZM15.734,2.705,16.816.691l1.258.675L16.99,3.388A8.086,8.086,0,0,0,15.734,2.705ZM5.247,6.438,3.107,4.9,3.94,3.743,5.962,5.194A6.966,6.966,0,0,0,5.247,6.438ZM19.525,12.92l2.452.994-.535,1.324-2.526-1.023C19.134,13.8,19.341,13.369,19.525,12.92Zm-13.654,1.2-2.454,1.1-.585-1.3,2.437-1.1C5.449,13.279,5.655,13.708,5.871,14.123ZM4.644,10.294H2V8.865H4.641c-.019.235-.036.473-.036.72S4.623,10.061,4.644,10.294Z" transform="translate(-2)"/></svg>
					<a href="#" id="defaultOpen" onclick="MyFunction(event,'tab1');return false;">FROM IDEA TO COURSE</a>
					<hr>
				</li>
				<li class="tablink">
					<svg class="img-guidelines" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25"><defs><style>.img-guidelines{fill:none;stroke:#bebebe;stroke-width:2px;}</style></defs><g transform="translate(-465 -290)"><line y2="25" transform="translate(471.5 290)"/><line y2="25" transform="translate(477.5 290)"/><line y2="25" transform="translate(483.5 290)"/><line y2="25" transform="translate(490 295.5) rotate(90)"/><line y2="25" transform="translate(490 302.5) rotate(90)"/><line y2="25" transform="translate(490 309.5) rotate(90)"/></g></svg>
					<a href="#" onclick="MyFunction(event,'tab2');return false;">GUIDELINES</a>
					<hr>
				</li>
			</ul>
			<div id="tab1" class="tab-content">
				<h2>How to practically go about organizing a graduate course or a conference at the Inter-University Centre</h2>
				<hr>
				<h3>Before the Course </h3><br><br>
				<p>The outset of your IUC course will be either an idea of how to internationalize an existing research theme in your own university or national context - or it will be about meeting (parts of) your existing European or overseas research networks. You will want to explore the potential of your research themes or your already existing courses at graduate and Ph.D. level internationally. Within the tradition and framework of the Inter University Centre any discipline is welcomed, along with inter-disciplinary or cross-disciplinary courses. <br><br> The IUC will provide you with an application form. You have to present a team of two or three researchers as course directors and their home universities - representing a minimum two countries. Attention to Croatian universities is welcome, but it is not a demand. One of the course directors must be the ‘organizing’ one, with whom the IUC will communicate. <br><br> You will set the date of your programme, design the title and a brief description of the course, a list of professors and other staff, teaching, instructing or supervising during the course. The general staffing of your course is announced as ‘resource persons’, and it is generally expected that resource persons take part in the course. <br><br> You will submit your plan to the IUC Secretariat with a view to its approval by the Executive Committee by March 31st every year. Your course will be reviewed and approved by the IUC Executive committee, announced on the on the IUC web pages, other media and IUC annual poster, sent to all member universities. The Director General has the authority to accept courses offered all year round - within the organizational scope left by the general planning. Those courses are also announced on the web pages. <br><br> In case of queuing up for space, the Director General will suggest and negotiate a solution. You are of course encouraged to announce the course yourself to all relevant potential partners all over the world. You will of course secure the best possible networking and diversity of approaches within your field, and attempt to recruit participants from as many countries as are relevant in your field. Course participation should not fall below ten or exceed 60. This rule does not apply for conferences. <br><br> The competence of accepting participants rests with you as the organizing course director. <br><br> You will keep the IUC Secretariat informed of the process of recruitment for your course, and you will receive current information from the Secretariat about potential participants approaching the IUC through web pages. You will in due course inform the IUC of your needs of technical equipment and of any extra demands for classrooms; exceeding the lecture room you are allotted. <br><br> The overall space consists of a large conference hall, which can accommodate 110 participants, 10 classrooms of different sizes, two cabinets and a library. The conference hall and classrooms are equipped with power point and overhead projectors. Simultaneous translation equipment is also available in the conference hall. <br><br> Participants of IUC courses and conferences have a computer room with internet connection and a printer at their disposal every work day from 8 a.m. to 7 p.m. <br><br> The standard General course fee for courses for organisers coming from IUC member institutions is 600 Euro. If organisers are coming from non-members the General course fee is 1000 Euro per course. Furthermore, students (excluding organisers or lecturers) pay an individual course fee of 50 Euro. <br><br> All participants in conferences pay a conference fee of 50 Euro. Organisers coming from IUC members pay General conference fee of 100 Euro. Organisers coming from non-members pay General conference fee of 500 Euro. <br><br> Participants’ travel and accommodation costs are not the responsibility of the IUC. However, the IUC Secretariat will help organisers or individuals to find the most convenient accommodation and assist in any other practical issues such as social programme, organisation of coffee breaks, meals or possible transfers.</p>
				<h3>The Daily Work at the IUC </h3><br><br>
				<p>The IUC building is open every work day from 8 a.m. to 7 p.m. Other working rhythms, especially through weekends, are possible with previous arrangement with the IUC Secretariat. <br><br> The copying of course material is available at no extra cost. <br><br> The IUC encourages course directors to complete the course with a course evaluation. The theoretical and methodological innovations acquired in each course will often form the basis of new courses in a continuous and yet renewing tradition within each research field. <br><br> All students who have paid and participated actively are entitled to a Certificate of Attendance, comprising an assessment in European Credit Transfer Points regarding their general post-graduate and Ph.D. education, if course directors have secured them at home universities. Special Certificates are issued to participants who had presented a paper.</p>
				<h3>General Organization </h3><br><br>
				<p>From many countries, package tours to Dubrovnik are available, and this will often turn out to be the most economical solution. There is a University of Zagreb Dormitory at the top floor of the building, which offers discount prices to participants of IUC courses. Please book well in advance at dormitorij@caas.unizg.hr. For information on hotel rates please visit the IUC homepage.</p>
			</div>

			<div id="tab2" class="tab-content">
				<h2>Lorem ipsum</h2>
				<hr>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
			</div>

		</div>
		
		<a href class="btn apply-btn">APPLY ></a>
		
	</div>
    
    
    <script>$(document).ready(function(){document.getElementById("defaultOpen").click()})</script>
    
    <script>
		function MyFunction(evnt, tabNum) {
		  
		  var i, tabcontent, tablinks;

		  tabcontent = document.getElementsByClassName("tab-content");
		  for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		  }

		  tablinks = document.getElementsByClassName("tablink");
		  for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" active", "");
		  }

		  document.getElementById(tabNum).style.display = "block";
		  if (tabNum = 'tab2') {
			  $(".apply-btn").css("top", "50%");
		  } else if (tabNum = 'tab1') {
			  $(".apply-btn").css("top", "20%");
		  }
		  evnt.currentTarget.parentElement.className += " active";
		  boje();
		}
	</script>
   
   <script>
		function boje() {
		  if ( $(".img-guidelines").parent().hasClass("active") ) {
			$(".img-guidelines").css("stroke", "var(--light-blue)");
			$(".img-idea").css("fill", "#bebebe");
		  }
		  else {
			$('.img-guidelines').css("stroke", "#bebebe");
			$(".img-idea").css("fill", "var(--light-blue)");
			}
		  };
	</script>
    
    

    <?php
        include("../to_include/hamburger.php");
    ?>


    <?php
    include('../to_include/footer.php')
    ?>
</body>
</html>