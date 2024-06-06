document.addEventListener('DOMContentLoaded', function() {

	$.ajax({
        url:"home/ajaxLoadLab",
        method: 'POST',
        dataType:"JSON",
        success: function(data){
        	loadCalendar(data[0].nama_lab);
        }
    });
	
	document.getElementsByClassName('tentang')[0].setAttribute("class","tentang nav-link active");
	document.getElementsByClassName('tentangTab')[0].setAttribute("class","tentangTab active tab-pane p-3");

});
	


function loadCalendar(lab){
	document.getElementById('calendar').innerHTML = ``;

	var defaultEvents = 'home/ajaxLoadJadwalHome/'+lab;

	var calendarEl = document.getElementById('calendar');

	var calendar = new FullCalendar.Calendar(calendarEl, {
		plugins: [ 'bootstrap', 'dayGrid', 'timeGrid'],
		locale : 'id',
		defaultView: 'dayGridMonth',
		themeSystem: 'bootstrap',
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
		},
		events : defaultEvents
	});
	calendar.render();
}