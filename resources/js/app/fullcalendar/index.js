//import * as $ from 'jquery';
//import 'fullcalendar/main.css';

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import nlLocale from '@fullcalendar/core/locales/nl';

import swal from 'sweetalert2';
import 'select2';
import * as datePicker from '../datepicker';

export default (function () {
  const date = new Date();
  const d    = date.getDate();
  const m    = date.getMonth();
  const y    = date.getFullYear();
  const MySwal = swal.mixin({ /* common params */});
  
  function reloadWidget(){
	$("#calendar-widget").load(window.location+" #calendar-widget > *"); //add ,"" to parameter to only update once
	//https://css-tricks.com/snippets/jquery/partial-page-refresh/
  }
  
  function timeUpdate(event){
  	
  	var start = event.start.format();
  	
  	if(event.end !== null){
	  	var end = event.end.format();
  	}else{
	  	var end = event.start.add(2,'hour').format();
  	}

	var dataArray = {
		id: event.bookingId,
		start_at: start,
		end_at: end,
	};

	$.ajax({
		type: "PUT",
		headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
		url: '/admin/bookings/'+event.bookingId, //$(".booking-form").attr('action') || hardcoded this url bc in test env it tries to execute the action url from local.orca and not from localhost:3000 which gives some problems. When to much spare time try to fix this for cleaner code
		data: dataArray, // serializes the form's elements.
		success: function(data)
		{
			eventSource.refetch();
		   	reloadWidget();
		}
	});
  }
  
  function insertPopUp(){
	  swal.fire({
        title: "Alle data wordt verzameld...",
        text: "Even geduld aub",
        type: "info",
        showLoaderOnConfirm: true,
        onOpen: function(){
            swal.clickConfirm();
        },
        preConfirm: function() {
            return new Promise(function(resolve) {
                $.ajax({
                    type: "GET",
                    url: '/admin/bookings/create',
                    success: function(response){
                        //console.log(response);
						
						datePicker.pickDate();
						
						swal.fire({
						    //type: 'success',
						    html: response,
						    confirmButtonClass: 'btn btn-primary-gradient',
				            cancelButtonClass: 'btn btn-primary',
				            confirmButtonText: 'Opslaan', // Oui, sûr
				            cancelButtonText: 'Sluiten', // Annuler
				            //showCancelButton : true,
						    animation: false,
						    preConfirm: (login) => {
							    //console.log( $(".swal2-content form").attr('action') );
					            $.ajax({
									type: "POST",
									headers: {
								        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								    },
									url: '/admin/bookings', //$(".booking-form").attr('action') || hardcoded this url bc in test env it tries to execute the action url from local.orca and not from localhost:3000 which gives some problems. When to much spare time try to fix this for cleaner code
									data: $(".booking-form").serialize(), // serializes the form's elements.
									success: function(data)
									{
										eventSource.refetch();
									   	reloadWidget();
									}
								});
							  },
						});
						  
						datePicker.pickDate();
						$('select.select2').select2();
                    }
                })
            });
        },allowOutsideClick: false
    });
  }
  
  function updatePopUp(id){
	swal.fire({
        title: "Alle data wordt verzameld...",
        text: "Even geduld aub",
        type: "info",
        showLoaderOnConfirm: true,
        onOpen: function(){
            swal.clickConfirm();
        },
        preConfirm: function() {
            return new Promise(function(resolve) {
                $.ajax({
                    type: "GET",
                    url: '/admin/bookings/'+id+'/edit',
                    success: function(response){
                        //console.log(response);
						
						datePicker.pickDate();
						
						swal.fire({
						    //type: 'success',
						    html: response,
						    confirmButtonClass: 'btn btn-primary-gradient',
				            cancelButtonClass: 'btn btn-primary',
				            confirmButtonText: 'Opslaan', // Oui, sûr
				            cancelButtonText: 'Sluiten', // Annuler
				            //showCancelButton : true,
						    animation: false,
						    preConfirm: (login) => {
							    //console.log( $(".swal2-content form").attr('action') );
					            $.ajax({
									type: "PUT",
									headers: {
								        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								    },
									url: '/admin/bookings/'+id, //$(".booking-form").attr('action') || hardcoded this url bc in test env it tries to execute the action url from local.orca and not from localhost:3000 which gives some problems. When to much spare time try to fix this for cleaner code
									data: $(".booking-form").serialize(), // serializes the form's elements.
									success: function(data)
									{
										eventSource.refetch();
									   reloadWidget();
									}
								});
							  },
						});
						  
						datePicker.pickDate();
						$('select.select2').select2();
                    }
                })
            });
        },allowOutsideClick: false
    });
  }
  
	$(document).on('click', '.event-add', function () {
		insertPopUp();
	});
	
	$(document).on('click', '.event-edit', function () {
		var id = $(this).attr('data-id');
		updatePopUp(id);
	});
	
	
	$(document).on('click', '.event-delete', function () {
		var id = $(this).attr('data-id');
		
		$.ajax({
		   url: "/admin/bookings/"+id,
		   type: 'DELETE',
		   headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		    success: function() {
			    swal.close();
				//refreshes calendar	
				eventSource.refetch();
				reloadWidget();
		   } 
		});	
	});

  //removing booking with the sweetalert2 box
  $(document).on('click', '.event-delete-alert', function () {
	  var id = $(this).attr('data-id');

        swal.fire({
            title: 'Bent u zeker?', // Opération Dangereuse
            text: 'Bent u zeker dat u wilt doorgaan met deze handeling? Deze handeling kan niet ongedaan worden gemaakt.', // Êtes-vous sûr de continuer ?
            type: 'error',
            showCancelButton: true,
            confirmButtonColor: 'null',
            cancelButtonColor: 'null',
            confirmButtonClass: 'btn btn-primary-gradient',
            cancelButtonClass: 'btn btn-primary',
            confirmButtonText: 'Doorgaan!', // Oui, sûr
            cancelButtonText: 'Annuleren', // Annuler
        }).then(res => {
            if (res.value) {
                $.ajax({
				   url: "/admin/bookings/"+id,
				   type: 'DELETE',
				   headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
				    success: function() {
					    swal.close();
						//refreshes calendar
						reloadWidget();	
						eventSource.refetch();
				   } 
				});
            }
        });

  });
  
  let calendar = new Calendar($('#full-calendar') ,{
	events: "/admin/bookings/get/json",
	height   : 800,
	editable : true,
	locale : nlLocale,
	plugins: [dayGridPlugin],
	header: {
		left   : 'month,agendaWeek,agendaDay',
		center : 'title',
		right  : 'today prev,next',
	},
	eventDrop: function(event, delta, revertFunc) {
		timeUpdate(event);
	},
	eventResize: function(event, delta, revertFunc){
		timeUpdate(event);
	},
	eventClick: function(event, jsEvent, view) {
		updatePopUp(event.bookingId);
	}
  });
  //calendar.setOption('locale', $('html').attr('lang'));

}())
