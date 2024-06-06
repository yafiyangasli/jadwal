document.addEventListener('DOMContentLoaded', function() {
    let url = window.location.href, getLab = url.split("="), getLab2 = getLab[1].split("%20");
    var lab = getLab2[0] + " " + getLab2[1] + " " + getLab2[2];

    console.log()
    
    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendar.Draggable;

    var containerEl = document.getElementById('external-events');
    var calendarEl = document.getElementById('calendar');

    //inisialisasi draggable event
    new Draggable(containerEl,{
    	itemSelector: '.fc-event',
    	eventData: function(eventEl){
    		return {
    			title: eventEl.innerText, className: eventEl.getAttribute('data-class')
    		};
    	}
    });
    //_____

    //kalender

    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale : 'id',
        editable:!0,
		droppable:!0,
		selectable:!0,
        initialView: 'dayGridMonth',
        themeSystem: 'bootstrap',
        headerToolbar: {
        	left: 'prev,next today',
        	center: 'title',
        	right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        eventClick:function(a){
            console.log(a.event.start)
            klikJadwal(a.event)
        },
        dateClick:function(b){
            console.log('kontol2')
        },
        events: 'ajaxLoadJadwal/'+lab,
    });
    calendar.render();
});

function inputJadwal(){
	console.log('a');
	$.ajax({
        url: "<?= base_url(); ?>user/check_selesaiInkubasi",
        method: 'POST',
        data: {
           	id: id,
            id_tenant: id_tenant,
        },
        dataType:"JSON",
        success: function(data) {
            console.log(data.valueSent);
            load_persen();
        }
    });
}

function klikJadwal(a){
    console.log(a)
    var start = a.start;
    var end = a.end;
    var date = start.toDateString();
    console.log(date);

}