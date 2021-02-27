import * as $ from 'jquery';

export function initInputTabs(){
	$(".input-tabs").each(function(index){
		var name = $(this).attr('data-name');
		var inputs = $(this).find('input[name="'+name+'"], select[name="'+name+'"]');
		var val = null;
		
		//determine value
		inputs.each(function(index){
			var type = $(this).attr('type');
			
			if(type == undefined){
				var type = $(this).prop("tagName").toLowerCase();
			}
			
			switch(true) {
			  case type == "radio" || type == "checkbox":
			    if($(this).is(":checked")){
					val = $(this).val();
				}
			    break;
			  default:
			    val = $(this).val();
			}
		});
		
		//using value to display tab-item
		var items = $(this).find('.input-tab-item');
		items.each(function(index){
			var id = $(this).attr("data-id");
			if(id == val){
				$(this).removeClass('d-none');
			}else{
				$(this).addClass('d-none');
			}
		});
		
	});	
}

export default (function () {
	initInputTabs();
	
	$(".input-tabs input, .input-tabs select").change(function(){
		initInputTabs();
	});
	
	$(".input-sync").keyup(function(){
		$(".input-sync").val($(this).val());
	});
	
}());
