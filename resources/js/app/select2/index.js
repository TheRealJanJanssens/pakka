import * as $ from 'jquery';
import 'select2';
import 'select2/dist/css/select2.min.css'; 

export function initSelect(){
	$("select.select2").each(function(index, obj){
/*
		if( $(this).hasClass("select2-hidden-accessible") ){
	        $(this).select2('destroy');
	        console.log('destroyed');
	    }
*/
		
    	var idAttr = $(this).attr("id");
    	var classAttr = $(this).attr("class").replace("form-control ", "").replace("select2 ", "").replace("select2-hidden-accessible", "");
    	var placeholder = $(this).attr("data-placeholder") || null;
    	var search = $(this).attr("data-search") || 0;

    	$(this).select2({
	    	placeholder: placeholder,
	    	minimumResultsForSearch: search,
	    	"language": {
		       "noResults": function(){
		           return "Oeps! Niets gevonden.";
		       }
		   }
    	});
    	
    	$(this).removeAttr("id");
    	if(typeof idAttr !== "undefined"){
	    	if(idAttr.length > 0){
		    	$(this).parent().find("span.select2").attr("id",idAttr);
	    	}
    	}
    	
    	
    	$(this).parent().find("span.select2").wrap( "<div class='"+classAttr+"'></div>" );
    });
}

export function initTextSelect(){
	$("select.select2-text").each(function(index){
		var data = $(this).attr("data-data");
		var placeholder = $(this).attr("data-placeholder");
		
		if(placeholder == undefined){
			placeholder = "";
		}
		
		$(this).select2({
		    //width: '80%',
		    allowClear: true,
		    multiple: true,
		    maximumSelectionSize: 1,
		    placeholder: placeholder,
		    data: JSON.parse(data),
	    	"language": {
		       "noResults": function(){
		           return "Oeps! Niets gevonden.";
		       }
		   }
		});

	});
}

export function destroySelect(){
	$(".select2").each(function(index, obj){
		
		//destroy instance
		if ($(obj).data('select2')){
	        $(obj).select2('destroy');
	    }
		
		//clean up html
		switch(true) {
		  case this.tagName == 'DIV':
		    $(this).remove();
		    break;
		  case this.tagName == 'SELECT':
		    $(this).removeClass("select2-hidden-accessible");
		    break;
		}
	});
}

export default (function () {
	initSelect();
	
    $(".client-select").click(function() {
    	//adds extra attributes when id is present
		$(".select2-search__field").attr("placeholder","Zoek klant");
		if($("#dropdown-footer").length == 0){
			$(".select2-dropdown").append("<span id='dropdown-footer'><a href='#' id='add-client-btn' class='btn btn-icon-b btn-primary-gradient mT-10'><i class='ti-plus'></i>Nieuwe klant</a></span>"); ///admin/clients/create
		}
		
    });
    
    //Select Client
	$('.client-select').on('select2:select', function () {
		var id = $("select[data-select2-id='client-select']").val();

		$.ajax({
		   url: "/admin/clients/"+id+"/get/info",
		   type: 'GET',
		   headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		   success: function(r) {
			   var result = JSON.parse(r);
			   
			   if(result.company_name.length > 0){
				   $("input[name='client_name']").val(result.company_name);
			   }else{
				   $("input[name='client_name']").val(result.name);
			   }
			   
			   $("input[name='client_email']").val(result.email);
			   $("input[name='client_address']").val(result.address);
			   $("input[name='client_zip']").val(result.zip);
			   $("input[name='client_city']").val(result.city);
			   $("input[name='client_country']").val(result.country);
			   $("input[name='client_vat']").val(result.vat);
			   $("input[name='client_id']").val(result.id);
		   }
		});
	});
	
	$(document).on('click', '#add-client-btn', function (event) {
		
		var text = $(this).text();
		
		$("input[name='client_name']").val('');
		$("input[name='client_address']").val('');
		$("input[name='client_zip']").val('');
		$("input[name='client_city']").val('');
		$("input[name='client_country']").val('');
		$("input[name='client_vat']").val('');
		$("input[name='client_id']").val('');
		
		$("input[name='ship_name']").val('');
		$("input[name='ship_address']").val('');
		$("input[name='ship_zip']").val('');
		$("input[name='ship_city']").val('');
		$("input[name='ship_country']").val('');
		
		$("select.select2").select2("close");
		
		$('#select2-client-select-container').text(text);
		
		event.preventDefault();
	});
	
	//invoice type enable disable invoice_no
	$(".invoice-type-select").change(function(){
		var type = $(this).val();
		
		if(type == "3"){
			$('input[name="invoice_no"]').attr('disabled',true);
		}else{
			$('input[name="invoice_no"]').attr('disabled',false);
		}
		
		var val = $('input[name="invoice_no"]').attr('data-doctype-'+type);
		$('input[name="invoice_no"]').val(val);
	});
	
	initTextSelect();
}());


