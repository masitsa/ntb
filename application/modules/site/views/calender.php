
  <!-- jQuery UI -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/themes/bluish/"?>style/jquery-ui.css"> 
  <!-- Calendar -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/themes/bluish/"?>style/fullcalendar.css">
  
 <div class="container-fluid">
 	
 	<div class="col-md-12 col-lg-12">
     	<h4 class="page-section-heading">Meetings</h4>
     	<div class="col-md-12 col-lg-12" style="margin-bottom:5px;">
	 		
	 	</div>
	 	<div class="col-md-12 col-lg-12">
		 	<div class="panel panel-default">
            	<div id="meetings"></div>
		    </div>
		</div>
	</div>
 </div>
 
<script src="<?php echo base_url()."assets/themes/bluish/"?>js/jquery-ui-1.10.2.custom.min.js"></script> <!-- jQuery UI -->
<script src="<?php echo base_url()."assets/themes/bluish/"?>js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
 
<script type="text/javascript">
$(document).ready(function() {
	var config_url = '<?php echo site_url();?>';
	var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
  $.ajax({
	type:'POST',
	url: config_url+"site/get_meetings_schedule",
	cache:false,
	contentType: false,
	processData: false,
	dataType: "json",
	success:function(data){
		
		var meetings = [];
		var total_events = parseInt(data.total_events, 10);

		for(i = 0; i < total_events; i++)
		{
			var data_array = [];
			
			data_title = data.title[i];
			data_start = data.start[i];
			data_end = data.end[i];
			data_backgroundColor = data.backgroundColor[i];
			data_borderColor = data.borderColor[i];
			data_allDay = data.allDay[i];
			data_url = data.url[i];
			
			//add the items to an array
			data_array.title = data_title;
			data_array.start = data_start;
			data_array.end = data_end;
			data_array.backgroundColor = data_backgroundColor;
			data_array.borderColor = data_borderColor;
			data_array.allDay = data_allDay;
			data_array.url = data_url;
			//console.log(data_array);
			meetings.push(data_array);
		}
		console.log(meetings);
		/*for(var i in data){
			meetings.push([i, data [i]]);alert(data[i]);
		}*/
		
		$('#meetings').fullCalendar({
			  header: {
				left: 'prev',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,next'
			  },
			  editable: true,
			  events: meetings
			});
	},
	error: function(xhr, status, error) {
		alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
	}
});

});
</script>