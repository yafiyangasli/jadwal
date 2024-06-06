$(document).ready(function(){
	var calendar = new FullCalendar.Calendar({
		plugins:["bootstrap","interaction","dayGrid","timeGrid"],
		editable:!0,
		droppable:!0,
		selectable:!0,
		defaultView:"dayGridMonth",
		themeSystem:"bootstrap",
		header : {
			left : 'prev, next today',
			center : 'title',
			right:"dayGridMonth,timeGridWeek,timeGridDay,listMonth",
		}
	})
})