
//MENU DATATABLE
/*
$('.table-sort').dataTable( {
  "ordering": false
} );
*/

import * as select2 from '../select2';
import * as input from '../input';
import swal from 'sweetalert2';
import * as fullCalendar from 'fullcalendar';
import * as product from '../product';
import * as datePicker from '../datepicker';
import Picker from 'vanilla-picker';

//Smooth Scrolling
// Select all links with hashes
$('a[href*="#"]')
// Remove links that don't actually link to anything
.not('[href="#"]')
.not('[href="#0"]')
.click(function(event) {
// On-page links
if (
  location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
  && 
  location.hostname == this.hostname
) {
  // Figure out element to scroll to
  var target = $(this.hash);
  target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
  // Does a scroll target exist?
  if (target.length) {
    // Only prevent default if animation is actually gonna happen
    event.preventDefault();
    $('html, body').animate({
      scrollTop: target.offset().top
    }, 750, function() {
      // Callback after animation
      // Must change focus!
      var $target = $(target);
      $target.focus();
      if ($target.is(":focus")) { // Checking if the target was focused
        return false;
      } else {
        $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
        $target.focus(); // Set focus again
      };
    });
	event.preventDefault();
  }
}
});

/**
 *
 * TABLE SORT DRAG & DROP
 * 
 */
 
// TABLE SORT CONSTRUCT
function sortConstruct(selector){
	var i = 1;
	var headId;
	$.each($(".table-sort "+selector), function(index){
		var id = $(this).attr('data-id');
		var thisHead = $(this).attr('data-head');
		
		//resets counter if a head isset and it doesn't match with the previous set one
		if(typeof thisHead !== typeof undefined && thisHead !== false){
			if(headId !== thisHead){
				i = 1;
				headId = thisHead;
				console.log("reset");
			}
		}
		
		//counter
		if (typeof id !== typeof undefined && id !== false) {
			$(this).attr("data-position",i);
			i++;
		}
	});
};

sortConstruct(".item");
sortConstruct(".input-option");

// TABLE LEVEL CONSTRUCT
function levelConstruct(startPos, endPos){
	var result;
	
	switch(true) {
		case startPos + 15 >= endPos:
			result = 1;
			break;
		case startPos + 15 < endPos && startPos + 29 >= endPos:
			result = 2;
			break;
		case startPos + 30 < endPos:
			result = 3;
			break;
		default:
			result = 1;
	}
	
	return result;
};

function objectSortAjax(action = null){ //selector,
	var i = 0;
	var list = new Array();
    $('.item').each(function(index){
	    var idVar = $(this).attr('data-id');
		var menuVar = $(this).attr('data-menu');
		var parentVar = $(this).attr('data-parent');
		var positionVar = $(this).attr('data-position');
		
		var listItem =[{
			id:idVar,
			menu:menuVar,
			parent:parentVar,
			position:positionVar,
		}];
			
		list.push(listItem);
		i++;
	});
	
	var dataArray = JSON.stringify(list);
	
	if(action !== null){
		$.ajax({
		   url: action,
		   data: {data: dataArray},
		   type: 'POST',
		   headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		   success: function(response) {
		   		//$(".dz-overlay").addClass("hidden");
		   }
		});
	}
}

$(function() {
	
	var xPosSave;
	
	$(".table-sort tbody").sortable({
	  cursor: "move",
	  handle: ".handle",
	  placeholder: "sortable-placeholder",
	  helper: function(e, tr)
	  {
	    var $originals = tr.children();
	    var $helper = tr.clone();
	    $helper.children().each(function(index)
	    {
	    // Set helper cell sizes to match the original sizes
	    $(this).width($originals.eq(index).width());
	    });
	    
	    return $helper;
	  },
		update: function(event, ui) {
		    sortConstruct(".item");
		},
		start:function(event,ui) {
			xPosSave = ui.helper.offset().left; //gets x position from helper to determine lvl
		},
		beforeStop:function(event,ui) {
			var xPos = ui.helper.offset().left; //gets x position from helper to determine lvl
			
			//get new lvl
			var newLvl = levelConstruct(xPosSave,xPos);
			
			//get closest parent
			var parent = ui.item.prev('.item'); // needs to go 2 elementes up bc it counts the placeholder as prev
			var parentId = parseInt(parent.attr("data-id"));
			var parentMenu = parseInt(parent.attr("data-menu"));
			var parentLvl = parseInt(parent.attr("data-level"));
			var parentParent = parent.attr("data-parent");
			var newParent;
			var newMenu;
			
			//decide if new lvl is correct
			switch(true) {
				case newLvl == 1: //less then (item lvl is 1)
					newLvl = newLvl;
					newParent = "";
					newMenu = ui.item.prev().attr("data-menu");					
					break;
				case newLvl == parentLvl: //equal to (item above is same lvl)
					newLvl = newLvl; //new level can exist but only with it's parent his parent
					newParent = parentParent;
					newMenu = parentMenu;					
					break;
				case newLvl > parentLvl+1: //higher then (item above multiple levels lower)
					newLvl = parentLvl+1; //new level can exist but only with it's parent his parent
					newParent = parentId;
					newMenu = parentMenu;										
					break;
				case parentLvl == 1: //less then (item above is lvl 1)
					newLvl = newLvl;
					newParent = parentId;
					newMenu = parentMenu;
					break;
				default:
					newLvl = 1; //newLvl
					newParent = "";
					newMenu = parentId;		
			}
			
			ui.item.attr("data-menu", newMenu);
			ui.item.attr("data-level", newLvl);
			ui.item.attr("data-parent", newParent);
			
			
		},
		stop:function(event,ui) {
			var action = $(this).attr('data-action');
			//ajax call during stop event so the placeholder doesn't get in JSON array
			objectSortAjax(action);
			
		}
	}); //.disableSelection()
});

/**
 *
 * SLUGIFY
 * 
 */

function slugify(Text)
{
    return Text
        .toLowerCase()
        .replace(/[&\/\\#,+()$~%.'":*?<>{}-]/g,'') //removes all special chars
        .replace(/ /g,'-') //replace spaces with dashes
        .replace(/[^\w-]+/g,'')
        .replace(/-{2,}/g, '-') //replace consecutive hyphens with one
        ;
}

$(".slug-input").keyup(function(){
	var val = $(this).val();
	$(this).val(slugify(val));
});

/**
 *
 * LANGUAGE SWITCH
 * 
 */
 
 function langSelectInput(){
 	if($( ".list-group-lang" ).length){
	 	
	 	var activeLang = $(".list-group-lang .list-group-item.active").attr('data-lang');
	 	var items = $( ".list-group-lang .list-group-item" ); //makes sure it only selects language items
	 	
	 	$(".form-group").each(function(index){
	 		var itemLang = $(this).attr('data-lang');
	 		var transCheck = 0;
	 		
	 		if(itemLang == undefined || itemLang.length == 0){
		 		itemLang = 0; //prevents hidden class get put on transparent items
	 		}
	 		
	 		switch (true) {
	 		    case itemLang == 0 && !$(".list-group-lang .list-group-head").hasClass("active"):
	 		        $(this).addClass('transparant');
	 		        
	 		        break;
	 		    case itemLang !== activeLang && itemLang.length > 0:
	 		        $(this).addClass('hidden');
	 		        break;
	 		    default:
	 		    	$(this).removeClass('hidden');
	 		    	$(this).removeClass('transparant');    
	 		}
	 	});
 	}
 };

langSelectInput();

$(".list-group-lang .list-group-item").click(function() {
	$(".list-group-lang .list-group-item").removeClass('active');
	$(this).toggleClass("active");
	langSelectInput();
});

/**
 *
 * STATUS SWITCH
 * 
 */

 function statusInput(){
	 if($( ".list-group-status" ).length){
	 	var value = $(".list-group-status .list-group-item.active").attr("data-status");
	 	$(".status-input").val(value);
	 }
 }

statusInput();

$(".list-group-status .list-group-item").click(function() {
	$(".list-group-status .list-group-item").removeClass('active');
	$(this).toggleClass("active");
	statusInput();
});

/**
 *
 * CUSTOM INPUT
 * 
 */

function optionsInputCheck(elem){
	if($(elem).val() === "select" || $(elem).val() === "checkbox"){
 		$(elem).parents('.row').find(".input-options").removeClass("hidden"); //.eq(2) repeats previous statment another 2 times
	}else{
 		$(elem).parents('.row').find(".input-options").addClass("hidden");
	}
};

$(".select-custom-input").change(function(){
	optionsInputCheck(this);
});

optionsInputCheck(".select-custom-input");

function sortInputOptions(){
	
	sortConstruct(".input-option");
	
	//construct order
	$.each($(".table-sort .input-option"), function(index){
		$(this).find("input[name='option_position\\[\\]']").val($(this).attr('data-position'));
	});
	
	//construct clone id
	$(".input-option").attr('id','');
	$(".input-option:nth-child(1)").attr('id','clone-input-option');
};

$(document).on('click', '.add-input-option', function() {
	$("#clone-input-option").clone().attr('id','').appendTo( "tbody" ).find('input').val('');
	
	sortInputOptions();
});

$(document).on('click', '.remove-input-option', function() {
	if($('.input-option').length > 1){
		
		var id = $(this).attr("data-id");
		
		if(id !== null){
			$.ajax({
			   url: "/admin/items/"+id+"/destroy/inputoption",
			   type: 'DELETE',
			   headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
		}
		
		$(this).parents('.input-option').remove();
		sortInputOptions();
	}
});

$(document).on('mouseleave', '.input-options .input-option', function () {
	sortInputOptions();
});

/**
 *
 * SWITCH INPUT
 * 
 */

$(".input-switch").each(function(index){
	var val = $(this).parent().find("input[type=hidden]:not(.input-translation-id)").val();
	
	if(val == 1){
		$(this).find('input[type=checkbox]').prop('checked', true);
	}else{
		$(this).find('input[type=checkbox]').prop('checked', false);
	}
});

$(".input-switch").click(function() {
	if($(this).find('input[type=checkbox]:checked').length == 0){
		$(this).parent().find("input[type=hidden]").val(0);
	}else{
		$(this).parent().find("input[type=hidden]").val(1);
	}
});

//ACCORDION TABLE (content module)
//$(".table-accordion");

$(".table-accordion b, .table-accordion .arrow").click(function() {
	var head = $(this).closest("tr").attr("data-head");
	var subItem = $(this).closest("tr").attr("data-subitem");
	
	if(head !== undefined && subItem == undefined){
		$(".item[data-head='"+head+"'][data-level='1']").toggleClass("hidden");
		$(".item[data-head='"+head+"'][data-level='2']").addClass('hidden');
		$(this).closest("tr").find(".arrow").toggleClass("active");
	}
	
	if(subItem !== undefined){
		$(".item[data-subitem='"+subItem+"'][data-level='2']").toggleClass("hidden");
		$(this).closest("tr").find(".arrow").toggleClass("active");
	}
});

//SETTINGS
$(document).on('click', '.settings-link', function () {
	var id = $(this).attr('data-id');
	
	$('.settings-inputs[data-id="'+id+'"]').closest('.settings-group').toggleClass('active');
});

$(document).on('click', '.colorpick-input-btn', function () {
	
	var standardValue = $(this).parent().find(".colorpick-input").val();
	var colorDisplay = $(this);
	
	var picker = new Picker({
	    parent: colorDisplay[0],
	    color: standardValue,
	    alpha: false,
	    onChange: function(color) {
			colorDisplay.css({"background-color":color.hex});
			colorDisplay.parent().find(".colorpick-input").val(color.hex);
		},
		onClose: function(color) {			
			picker.destroy();
		}
	});
	
	//remove <style> generated of vanilla picker
	$("style").each(function(index){
		if($(this).html().indexOf('.picker_wrapper') !== -1){
			$(this).remove();
		}
	});
	
	picker.openHandler();
});

//sets the display color for the colorpicker button input
function getInputColor(){
	$(".colorpick-input-btn").each(function(index){
		var standardValue = $(this).parent().find(".colorpick-input").val();
		var colorDisplay = $(this);
		colorDisplay.css({"background-color":standardValue});
	});
};

getInputColor();

//PROJECT MODULE
function animatePercent(elem,finish){
	$(elem).each(function () {
	  var $this = $(this);
	  jQuery({ Counter: $this.text() }).animate({ Counter: finish }, {
	    duration: 650,
	    easing: "swing",
	    step: function () {
	      $this.text(Math.round(this.Counter));
	    }
	  });
	});
};

function getProgress(){
	var iT = $(".list-group-item").length;
	var iD = 0;
	$(".list-group-item.done").each(function(index){
		iD++;
	});
	var percent = (iD/iT)*100;
	var widthBar = $("#progress-bar").width();
	
	if(percent == NaN){
		percent = 0;
	}
	
	var widthProgress = widthBar*(percent/100);
	
	$("#progress").css("width",widthProgress);
	animatePercent(".progress-percentage",percent);
	animatePercent(".progress-percentage-countdown span",(100-percent));

};

getProgress();

function orderTaskGroups(){
	//order all groups
	var data = new Array();
	var i = 1; //position
	$(".task-group-position").each(function(index){
		var item = {
			id: $(this).attr("data-group"),
			position:i
		};
		
		data.push(item);
		i++;
	});
	
	var dataArray = JSON.stringify(data);
	
	$.ajax({
	   url: "/admin/projects/order/taskgroups",
	   data: {data: dataArray},
	   type: 'POST',
	   headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
};

function addTaskGroup(e){
	//add a new group
	var dataArray = {
		project_id: e.closest(".task-container").attr("data-project"),
		name: "Groep naam",
		color: "#ffffff",
	};
	
	$.ajax({
	   url: "/admin/projects/store/taskgroup",
	   data: dataArray,
	   type: 'POST',
	   headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	   success: function(r) {
		   var result = JSON.parse(r);
		   $(".task-group-copy").clone().removeClass("task-group-copy").addClass("task-group-position").attr("data-group",result.id).insertBefore($(".task-group-copy"));
		   orderTaskGroups();
	   }
	});
};

function ajaxTaskGroup(data){
	//edit name, color and order (ajax call happens here)
	$.ajax({
	   url: "/admin/projects/update/taskgroup",
	   data: data,
	   type: 'POST',
	   headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
};

function orderTasks(){
	//order all tasks
	var data = new Array();
	
	$(".list-group").each(function(index){
		var iG = $(this).closest(".task-group").attr('data-group'); // GroupId
		var i = 1; //position
		$(this).find(".list-group-item").each(function(index){
			var item = {
				id: $(this).attr("data-id"),
				group_id: iG,
				position:i
			};
			
			data.push(item);
			i++;
		});
	});
	
	var dataArray = JSON.stringify(data);
	
	$.ajax({
	   url: "/admin/projects/order/task",
	   data: {data: dataArray},
	   type: 'POST',
	   headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
};

function addTask(e){
	//add task
	var value = e.closest(".list-group-input").find("input").val();
	
	if(value !== "" ){ //&& value.length > 5
		var list = e.closest(".list-group");
		var cloneItem = list.find(".list-group-item-clone");

		var dataArray = {
			project_id: e.closest(".task-group").attr("data-project"),
			group_id: e.closest(".task-group").attr("data-group"),
			name: value,
			created_by: $('meta[name="user_id"]').attr('content')
		};
		
		$.ajax({
		   url: "/admin/projects/store/task",
		   data: dataArray,
		   type: 'POST',
		   headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		   success: function(r) {
			   var result = JSON.parse(r);
				cloneItem.clone().removeClass("list-group-item-clone").addClass("list-group-item").insertAfter(cloneItem).attr("data-id",result.id).find(".widget-heading span").html(result.name);
				e.closest(".list-group-input").find("input").val(""); //reset input
				getProgress();
				orderTasks();
		   }
		});
	}
};

function ajaxTask(data,close=false){
	//edit name, color and order (ajax call happens here)
	$.ajax({
	   url: "/admin/projects/update/task",
	   data: data,
	   type: 'POST',
	   headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
	   success: function(r) {
		   if(close === true){
			   $("#task-detail").toggleClass("active");
			   $("#task-detail-overlay").removeClass("active");
		   }
	   }
	});
};

function editTask(){
	//edit name, desciption, priotity, order, user, deadline date (ajax call happens here)
};


$(".task-container-fade > .row").scroll(function(){
	var e = document.querySelector(".task-container-fade > .row");
	var rowWidth = $(this).width();
	
    if($(this).scrollLeft() >= 10){
       	$(".task-container-fade").addClass("task-container-scrolled");
    }else{
	    $(".task-container-fade").removeClass("task-container-scrolled");
    }
    
	if((e.offsetWidth + $(this).scrollLeft()) >= (e.scrollWidth - 10)){
       	$(".task-container-fade").addClass("task-container-scroll-end");
    }else{
	    $(".task-container-fade").removeClass("task-container-scroll-end");
    }
    
});

$(".task-container-editable").find(".row").append('<div class="col-md-3 task-group task-group-placeholder"><div class="placeholder-text"><i class="fa fa-plus"></i><p>Voeg een nieuwe groep toe</p></div></div>');

$(".task-group-placeholder").click(function() {
	addTaskGroup($(this));
});

$(".list-group-dropable").sortable({
	items: ".list-group-item",
	connectWith: ".list-group-dropable",
	placeholder: "marker",
	handle: '.handle',
	update: function( event, ui ) {
		orderTasks();
	}
});

/*
$(document).on('click', '.widget-heading', function () {
	$(".widget-body").removeClass(".widget-body");
	$(this).parent().find(".widget-body").toggleClass("active");
});
*/

$(document).on('click', '.card-left', function () {
	var parent = $(this).closest(".task-group-position");
	parent.insertBefore(parent.prev(".task-group-position"));
	orderTaskGroups();
});

$(document).on('click', '.card-right', function () {
	var parent = $(this).closest(".task-group-position");
	parent.insertAfter(parent.next(".task-group-position"));
	orderTaskGroups();
});

$(document).on('click', '.custom-control', function () {
	var dataArray = {}; //makes an obj so it can be posted (instead of a normal array with [])
	
	dataArray["id"] = $(this).closest(".list-group-item").attr("data-id");
	
	if ($(this).closest(".list-group-item").hasClass("done")) {
		dataArray["status"] = 0; //open
	}else{
		dataArray["status"] = 1; //done
	}
	
	ajaxTask(dataArray);

	$(this).closest(".list-group-item").toggleClass("done");
	getProgress();
});

//updates the group name after focusout
$(document).on('focusout', ".card-header-title b[contenteditable='true']", function () {
	var dataArray = {
		id: $(this).closest(".task-group-position").attr("data-group"),
		name: $(this).html()
	};
	
	ajaxTaskGroup(dataArray);
});

//handles the add task input
$(document).on('click', '.btn-add-task', function () {
	addTask($(this));
});

//register enter press on the add task input
$(document).on('keyup', '.list-group-input input', function (e) {
	if (e.keyCode == 13) {
	    var e = $(this).parent().find('.btn-add-task');
        addTask(e);
    }
});

//handles the colorpicker
$(document).on('click', '.card-change-color-btn', function () {
	var border = $(this).closest(".card-header-title").find(".card-header-border");
	var parent = $(this).closest(".card-change-color")[0];
	var picker = new Picker({
	    parent: parent,
	    color: $(this).closest(".card-header-title").find(".card-header-border").css("background-color"), 
	    onChange: function(color) {
			border.css({"background-color":color.hex});
		},
		onClose: function(color) {			
			var dataArray = {
				id: border.closest(".task-group").attr("data-group"),
				color: color.hex
			};
			
			ajaxTaskGroup(dataArray);
			
			picker.destroy();
		}
	});
	
	//remove <style> generated of vanilla picker
	$("style").each(function(index){
		if($(this).html().indexOf('.picker_wrapper') !== -1){
			$(this).remove();
		}
	});
	
	picker.openHandler();
});

//Highlights the save button in task detail
$(document).on('keyup', '#task-detail *[contenteditable="true"]', function () {
	$("#task-edit-btn").addClass("btn-primary").removeClass("btn-light");
});

//Live updates the task name in the taskgroup list
$(document).on('keyup', '#task-detail *[contenteditable="true"][data-name="name"]', function () {
	var id = $(this).closest("#task-detail-inner").attr("data-id");
	var text = $(this).html();
	$(".list-group-item[data-id="+id+"] .widget-heading span").html(text);
});

//Loads the task detail
$(document).on('click', '.widget-content-main, .open-task-detail', function () {
	var id = $(this).closest(".list-group-item").attr("data-id");
	
	$("#task-detail").load("/admin/projects/"+id+"/task/detail", function(responseText, textStatus, XMLHttpRequest){
		$("#task-detail").toggleClass("active");
		$("#task-detail-overlay").addClass("active");
	});
});

//Saves all the changes made in the detail
$(document).on('click', '.task-detail-close, #task-detail-overlay, #task-edit-btn', function () {
	
	var dataArray = {}; //makes an obj so it can be posted (instead of a normal array with [])
	
	dataArray["id"] = $("#task-detail-inner").attr("data-id");
	
	$("#task-detail-inner *[contenteditable='true']").each(function(index){
		var key = $(this).attr('data-name');
		var value = $(this).html();
		dataArray[key] = value;
	});
	ajaxTask(dataArray,true);
});

function storeComment(){
	var input = $("#task-activity-input input")
	var value = input.val();
	    
    var dataArray = {
		task_id: input.closest("#task-detail-inner").attr("data-id"),
		user_id: $('meta[name="user_id"]').attr('content'),
		text: value
	};
	
	$.ajax({
	   url: "/admin/projects/store/comment",
	   data: dataArray,
	   type: 'POST',
	   headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	   success: function(r) {
		   var result = JSON.parse(r);
		   var cloneItem = $(".message-clone");
		   var comment = cloneItem.clone().removeClass("message-clone").addClass("message").insertAfter(cloneItem).attr("data-id",result.id);
		   
		   comment.find(".message-content p span").html(result.text);
		   comment.find(".message-content p b").html($('meta[name="user_name"]').attr('content'));
		   
		   $(".message-placeholder").remove();
		   
		   input.val(""); //reset input
	   }
	});
};

//register enter press (without shift) on the add comment input
$(document).on('keyup', "#task-activity-input input", function (e) {
	if (e.keyCode == 13 && !e.shiftKey) {
	    storeComment();
	}
});

$(document).on('click', "#task-activity-input .btn", function () {
	storeComment();
});


/* TABLE FORM */

function initTableForm(){
	//adds the table-form-head id if data-head is set on true
	if($('table[data-head="true"]').length){
		$(this).find("tr:not( .table-form-template):first-child, & .table-form-template + tr").attr('id','table-form-head');
	}
	
	//converts name attributes to data-name attributes (necessary to prevent empty hidden inputs)
	$(".table-form-template").find(':input').each(function(index){
		var name = $(this).attr('name');
		$(this).attr('data-name',name);
		$(this).removeAttr('name');
	});
};

initTableForm();

//Add empty row
$(document).on('click', '.table-form-add', function () {
	var tempId = Math.random().toString(36).substring(7);
	var table = $(this).closest('.table-form');
	
	if(! table.length ) {
	    table = $('.table-form');
	}
	
	table.find(".table-form-template").clone().attr('id',tempId).appendTo( table.find("tbody") );

	//converts the data-name to name attribute
	$("#"+tempId).find(':input').each(function(index){
		var name = $(this).attr('data-name');
		$(this).attr('name',name);
		$(this).removeAttr('data-name');
	});
	
	$("#"+tempId).removeClass('table-form-template');
	
	datePicker.pickTime();
	event.preventDefault();
	select2.destroySelect();
	select2.initSelect();
});

//Duplicate row
$(document).on('click', '.table-form-duplicate', function () {
	$(this).closest("tr").clone().removeAttr('id').appendTo(".table-form tbody");
	$('.dropdown-menu').removeClass('show');
	
	datePicker.pickTime();
	event.preventDefault();
});

//Remove row
$(document).on('click', '.table-form-remove', function () {	
	var table = $(this).closest("table");
	var head = $(this).closest("table").attr('data-head');
	if(typeof head !== typeof undefined && head !== false){
		if(table.find("tbody tr:not( .table-form-template)").length == 1){
			//if it is the last item in the table just empty the inputs
			$(this).closest("tr").find("input").val('');
		}else{
			$(this).closest("tr").remove();
			initTableForm();
		}
	}else{
		$(this).closest("tr").remove();
	}

	event.preventDefault();
});

/* 
|	TABLE SORT 
|
|	This is used to sort items within a table.
|	When you set data-head attribute to true, it will give the first tr in tbody a head class.
|	This ensures that the first item will not be deleted only emptied.	
|
|	current use: add/edit invoice items table
|	planned: menu table, item table
|	
*/


//sort invoice items
function sortTable(){
	$(".table-sort tbody tr").each(function(i){
		i++;
		$(this).find('input[name="position[]"]').val(i);
	});
	
	//only if data-head is set on true
	$(".table-sort tbody tr #table-form-head").removeAttr('id');
	$('.table-sort[data-head="true"] tbody tr:nth-child(2)').attr('id','table-form-head');
}

$(".table-sort tbody").sortable({
	items: "tr",
	cursor: "move",
	handle: ".handle",
	placeholder: "sortable-placeholder",
	stop:function(event,ui) {
		sortTable();
	}
}); //.disableSelection()


/* INVOICE */

//calculate invoice
function calcInvoice(){
	var items = new Array;
	var price;
	var quantity;
	var vat;
	var subTotal=0;
	var vatTotal=0;
	var total=0;
	
	$(".invoice-item:not( .table-form-template)").each(function(i){
		var itemSubTotal=0;
		var itemVatTotal=0;
		var itemTotal=0;
/*
		var attr = $(this).find('input[name="price[]"]').attr('data-value'); //true value 00.000 for accurate calculations
		if(typeof attr !== typeof undefined && attr !== false && attr !== ""){
			var value = attr;
		}else{
			var value = $(this).find('input[name="price[]"]').val();
		}
*/
		var value = $(this).find('input[name="price[]"]').val();
		price = parseFloat(value.replace(',', '.').replace(/[^0-9.-]+/g, ''));
		
		if(isNaN(price)){
			price = 0;
		}
		
		quantity = parseFloat($(this).find('input[name="quantity[]"]').val());
		vat = parseFloat($(this).find('input[name="vat[]"]').val());
		if(isNaN(vat)){
			vat = 0;
		}
		
		itemSubTotal = price*quantity;
		
		//item vat percentage (example: 0.21)
		if(vat !== 0){
			itemVatTotal = vat/100;
		}
		
		itemVatTotal = itemVatTotal*itemSubTotal;
		
		//item total
		itemTotal = itemVatTotal+itemSubTotal;
		if(isNaN(itemTotal)){
			itemTotal = 0;
		}
		
		var item = {
			price: price.toFixed(2).toString().replace(/\./g, ','),
			quantity: quantity,
			vat:vat,
			vattotal:itemVatTotal,
			subtotal:itemSubTotal.toFixed(2).toString().replace(/\./g, ','),
			total:itemTotal.toFixed(2).toString().replace(/\./g, ',')
		};
		
		$(this).find('.invoice-item-total').text(item.total);
		
		items.push(item);
		
		//global count
		subTotal = subTotal+itemSubTotal;
		vatTotal = vatTotal+itemVatTotal;
		total = subTotal+vatTotal;
	});
	
	if(isNaN(subTotal)){
		subTotal = 0;
	}
	
	if(isNaN(vatTotal)){
		vatTotal = 0;
	}
	
	if(isNaN(total)){
		total = 0;
	}
	
	//Automatic invoice type change if not a proforma
	if($('.invoice-type-select').val() == "1" || $('.invoice-type-select').val() == "2" && total !== 0){
		if(total < 0){
			$('.invoice-type-select').val('2'); //credit invoice
		}else{
			$('.invoice-type-select').val('1'); //invoice
		}
		$('.invoice-type-select').trigger('change'); //intialize select2
	}
	
	$("#invoice-subtotal").text(subTotal.toFixed(2).toString().replace(/\./g, ','));
	$("#invoice-vattotal").text(vatTotal.toFixed(2).toString().replace(/\./g, ','));
	$("#invoice-total").text(total.toFixed(2).toString().replace(/\./g, ','));
	sortTable();
};
calcInvoice();

//Switch on/off shipping info
$("#other_shipping_info").click(function() {
	//timeout makes sure you get the right value
	setTimeout(function(){
		var val = $("input[name='other_shipping_info']").val();
		
		if(val == 1){
			$("#shipping_info").removeClass("hidden");
		}else{
			$("#shipping_info").addClass("hidden");
		}
		
	}, 1);
});

//invoice presets
//shows modal
$(document).on('click', '.insert-preset', function () {
	$(this).closest('tr').addClass('preset-editable');
	$('#preset-modal').modal('show');
});

$(document).on('click', '.preset-item', function () {
	var name = $(this).attr('data-name');
	var price = $(this).attr('data-price');
	var quantity = $(this).attr('data-quantity');
	var vat = $(this).attr('data-vat');
	
	$(".preset-editable input[name='name[]']").val(name);
	$(".preset-editable input[name='price[]']").val(price);
	$(".preset-editable input[name='quantity[]']").val(quantity);
	$(".preset-editable input[name='vat[]']").val(vat);
	$('#preset-modal').modal('hide');
	
	calcInvoice();
});

//on modal close remove all preset-editable classes for resetting
$('#preset-modal').on('hide.bs.modal', function (e) {
	$('.preset-editable').removeClass('preset-editable');
})

//invoice inputs
//when inputs are manipulated
$(document).on('keyup', '.table-invoice input', function () {
	calcInvoice();
});

$(document).on('click', '.table-invoice input', function () {
	calcInvoice();
});

//On add, duplicate, remove
$(document).on('click', '.invoice-item-add, .invoice-item-duplicate, .invoice-item-remove', function () {
	calcInvoice();
	event.preventDefault();
});

//Invoice details
//change default vat if changed in vat input
$(document).on('keyup', 'input[name="vat[]"]', function () {
	var vat = $(this).val();
	$("#invoice-default-vat").text(vat);
});

$(".card-filter").click(function() {
	$(".card-filter").removeClass('active');
	$(this).addClass('active');
	
	var val = $(this).attr('data-value');
	
	$(".table-card-filter tbody tr").each(function(index){
		var rowVal = $(this).attr("data-value");
		if(val.indexOf(rowVal) >= 0 || val == ""){
			$(this).removeClass("hidden");
		}else{
			$(this).addClass("hidden");
		}
	});
});

/* BOOKING */

function rekeyScheduleInputs(){
	$('.table-datepicker tbody tr:not( .table-form-template)').each(function(iTr){
		
		$(this).find('input[name*="schedule"]').each(function(iIn){
			var name = $(this).attr('name');
			var exp = /(\w+)\[?(\d+?)?\]\[(\w+)\]/;
			var values = name.match(exp); // 1 = schedule, 2 = array key(int), 3 = mon/tue/...
			var newName = values[1]+'['+iTr+']'+'['+values[3]+']';
			
			$(this).not("[type='hidden']").attr('id',newName);
			$(this).attr('name',newName);
			$(this).parent().find('label').attr('for',newName);
			//var replaceName = name.replace(/schedule\[.+\]/g,"schedule["+iTr+"]");
		});
	});
};

rekeyScheduleInputs();

//On add, duplicate, remove
$(document).on('click', '.schedule-item-add, .schedule-item-duplicate, .schedule-item-remove', function () {
	rekeyScheduleInputs();
	event.preventDefault();
});

//slugify input
$("input[data-slugify='true']").keyup(function(){
	$("input[data-slugify='true']").each(function(index){
		var outputName = $(this).attr("data-output");
		var inputName = $(this).attr("name").split(":");
		var val = $(this).val();
		var slug = slugify(val);

		if(inputName.length > 1){
			//if translation isset
			$("input[name='"+inputName[0]+":"+outputName+"']").val(slug);
		}else{
			//if no translation isset
			$("input[name*='"+outputName+"']").val(slug);
		}
	});
});