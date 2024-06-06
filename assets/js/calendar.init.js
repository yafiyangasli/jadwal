!function(g){
	"use strict";function e(){
	}e.prototype.init=function(){
		var l=g("#event-modal"),
		t=g("#modal-title"),
		a=g("#form-event"),
		i=null,
		r=null,
		s=document.getElementsByClassName("needs-validation"),
		i=null,
		r=null, 
		e=new Date,
		n=e.getDate(),
		d=e.getMonth(),
		o=e.getFullYear();
		new FullCalendarInteraction.Draggable(document.getElementById("external-events"),{
			itemSelector:".external-event",eventData:function(e){
				return{
					title:e.innerText,className:g(e).data("class")}
				}
			});
		function printValue(){

		}
		//value dalam kalender
		let url = window.location.href, getLab = url.split("="), getLab2 = getLab[1].split("%20");
		var lab = getLab2[0] + " " + getLab2[1] + " " + getLab2[2];
        console.log(lab);
        var c= 'ajaxLoadJadwal/'+lab;

		//end of value dalam kalender

		//modal
		var v=(
		document.getElementById("external-events"),document.getElementById("calendar"));
		function u(e){
			l.modal("show"),
			a.removeClass("was-validated"),
			a[0].reset(),
			g("#event-title").val(),
			g("#event-category").val(),
			g("#event-date").val(),
			g("#jmulai").val(),
			t.text("Tambah Kegiatan"),r=e}
		//konten kalender
		var m=new FullCalendar.Calendar(v,{
			plugins:["bootstrap","interaction","dayGrid","timeGrid"],
			editable:!0,
			droppable:!0,
			selectable:!0,
			locale : 'id',
			defaultView:"dayGridMonth",
			themeSystem:"bootstrap",
			header:{
				left:"prev,next today",
				center:"title",
				right:"dayGridMonth,timeGridWeek,timeGridDay,listMonth"},
			eventClick:function(e){
				l.modal("show"),
				a[0].reset(),
				i=e.event,
				g("#event-title").val(i.title),
				g("#event-category").val(i.classNames[0]),
				g("#event-date").val(i.start),
				document.getElementById("event-date").value = i.start.getDate()+'-'+i.start.getMonth()+'-'+i.start.getFullYear(),
				console.log(i),
				console.log(i.start.getDate()),
				test(),
				r=null,
				t.text("Ubah Kegiatan"),
				r=null,
				g("event-date").val(e.view.currentStart),
				console.log(e.event.start); //ini buat dapet tanggal di klik nya
			},
			dateClick:function(e){u(e),console.log(e.dateStr)},
			events:c
		});
		m.render(),
		g(a).on("submit",function(e){
			e.preventDefault();
			g("#form-event :input");
			var t,a=g("#event-title").val(),n=g("#event-category").val(),sDate=g("#event-date").val();
			!1===s[0].checkValidity()?(
				event.preventDefault(),event.stopPropagation(),s[0].classList.add("was-validated")):(
					i?(i.setProp("title",a),
					i.setProp("classNames",[n])):(
						t={title:a,start:sDate,allDay:r.allDay,className:n},
						m.addEvent(t)),
						console.log(r.date),
					l.modal("hide"))}),
		g("#btn-delete-event").on("click",function(e){
			i&&(i.remove(),i=null,l.modal("hide"))}),
		g("#btn-new-event").on("click",function(e){
			u({
				date:new Date,allDay:!0})})
		},
	g.CalendarPage=new e,
	g.CalendarPage.Constructor=e
}(window.jQuery),function(){"use strict";window.jQuery.CalendarPage.init()}();

function testAjax(){
	// $.ajax({
 //        url:"ajaxLoadJadwal/Lab Prodi 1",
 //        dataType:"JSON",
 //        success: function(data){
 //        	console.log(data);
 //        }
 //    })
}

function test(){
	
}
function inputJadwal(){

	// $.ajax({
 //        url: "ajaxInputJadwal",
 //        method: 'POST',
 //        data: {
 //           	id: id,
 //            id_tenant: id_tenant,
 //        },
 //        dataType:"JSON",
 //        success: function(data) {
 //            console.log(data.valueSent);
 //            load_persen();
 //        }
 //    });

 // $('#lab').on('change', function(){
	// 		id_lab = document.getElementById('lab').value;
 //        	c= 'ajaxLoadJadwal/'+id_lab;
 //        	console.log(c)
 //        	m.render()
 //        });
}