import * as $ from 'jquery';
//import * as Bloodhound from '../custom/bloodhound.js';
//import '../custom/typeahead.min.js';
import '../custom/bootstrap-tagsinput.min.js';

export function hashCode(s) {
    for(var i = 0, h = 0; i < s.length; i++){
	    //console.log(s.charCodeAt(i)+':'+h+':'+imul);
	    h = Math.imul(31, h) + s.charCodeAt(i) | 0;
    }
    return Math.abs(h);
}

export function tagsInputInit(){
	//$('.typeahead').typeahead('open');
	//$('.typeahead').typeahead('close');
	
/*
	$('input[data-role=tagsinput]').each(function(index){
		var suggestions = $(this).attr('data-suggestions');
		
		if(typeof suggestions !== typeof undefined && suggestions !== false){

			var json = new Bloodhound({
	            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('text'),
	            queryTokenizer: Bloodhound.tokenizers.whitespace,
	            //remote: suggestions
	            local: JSON.parse(suggestions)
	        });
	 
	        json.initialize();
			console.log(json);
			$(this).tagsinput({
				confirmKeys: [44], //32 space
				trimValue: true,
				typeaheadjs: {
				    name: 'suggestions',
				    displayKey: 'text',
				    valueKey: 'text', //value
				    source: json.ttAdapter()
				}
			});
		}else{
			$(this).tagsinput({
				confirmKeys: [44], //32 space
				trimValue: true
			});
		}
	});
*/
		
	$("input[data-role=tagsinput]").tagsinput({
		confirmKeys: [44], //32 space
		trimValue: true
	});
}

export function combineArrays( array_of_arrays ){

    // First, handle some degenerate cases...

    if( ! array_of_arrays ){
        // Or maybe we should toss an exception...?
        return [];
    }

    if( ! Array.isArray( array_of_arrays ) ){
        // Or maybe we should toss an exception...?
        return [];
    }

    if( array_of_arrays.length == 0 ){
        return [];
    }

    for( let i = 0 ; i < array_of_arrays.length; i++ ){
        if( ! Array.isArray(array_of_arrays[i]) || array_of_arrays[i].length == 0 ){
            // If any of the arrays in array_of_arrays are not arrays or zero-length, return an empty array...
            return [];
        }
    }

    // Done with degenerate cases...

    // Start "odometer" with a 0 for each array in array_of_arrays.
    
    let odometer = new Array( array_of_arrays.length );
    odometer.fill( 0 ); 

    let output = [];

    let newCombination = formCombination( odometer, array_of_arrays );

    output.push( newCombination );

    while ( odometer_increment( odometer, array_of_arrays ) ){
        newCombination = formCombination( odometer, array_of_arrays );
        output.push( newCombination );
    }
    return output;
}/* combineArrays() */


// Translate "odometer" to combinations from array_of_arrays
export function formCombination( odometer, array_of_arrays ){
	
    // In Imperative Programmingese (i.e., English):
    let s_output = [];
    for( let i=0; i < odometer.length; i++ ){
       //s_output += "" + array_of_arrays[i][odometer[i]]; 
       s_output.push( array_of_arrays[i][odometer[i]] ); 
       
    }
    return s_output;

    // In Functional Programmingese (Henny Youngman one-liner):
/*
    return odometer.reduce(
	    
      function(accumulator, odometer_value, odometer_index){
        return "" + accumulator + array_of_arrays[odometer_index][odometer_value];
      },
      ""
    );
*/
}/* formCombination() */

export function odometer_increment( odometer, array_of_arrays ){

    // Basically, work you way from the rightmost digit of the "odometer"...
    // if you're able to increment without cycling that digit back to zero,
    // you're all done, otherwise, cycle that digit to zero and go one digit to the
    // left, and begin again until you're able to increment a digit
    // without cycling it...simple, huh...?

    for( let i_odometer_digit = odometer.length-1; i_odometer_digit >=0; i_odometer_digit-- ){ 

        let maxee = array_of_arrays[i_odometer_digit].length - 1;         

        if( odometer[i_odometer_digit] + 1 <= maxee ){
            // increment, and you're done...
            odometer[i_odometer_digit]++;
            return true;
        }
        else{
            if( i_odometer_digit - 1 < 0 ){
                // No more digits left to increment, end of the line...
                return false;
            }
            else{
                // Can't increment this digit, cycle it to zero and continue
                // the loop to go over to the next digit...
                odometer[i_odometer_digit]=0;
                continue;
            }
        }
    }/* for( let odometer_digit = odometer.length-1; odometer_digit >=0; odometer_digit-- ) */

}/* odometer_increment() */

export function constructVariants(){
	var SKU = "";
	var SKUBase = "PO-"+ hashCode( $('input[name="product_id"]').val() );
	var basePrice = $("input[name='base_price']").val();
	
	//base price fail safe
	if(!basePrice || 0 === basePrice.length){
		basePrice = 0;
	}
		
	//construct tbody if not set
	if( $(".table-variants tbody").length <= 0 ){
		$('.table-variants').append('<tbody></tbody>');
	}
	
	//tags all rows to be removed
	$(".table-variants tbody tr").addClass('remove');
	
	var arrays = [];
	$('.table-tagsinput input[data-role=tagsinput]').each(function(index){
		var val = $(this).val().split(',');
		if(val[0] !== "") {
			arrays.push(val);
			
		}
	});
	
	var combos = combineArrays(arrays);

	if(combos.length > 0){
		$('.variant-tab').removeClass('d-none');
	}else{
		$('.variant-tab').addClass('d-none');
	}
	
	var acronyms = {
		xxs:"xxs",
		xxsmall:"xxs",
		xx_small:"xxs",
		xs:"xs",
		xsmall:"xs",
		x_small:"xs",
		small:"sm",
		medium:"md",
		large:"lg",
		xl:"xl",
		xlarge:"xl",
		x_large:"xl",
		xxl:"xxl",
		xxlarge:"xxl",
		xx_large:"xxl",
		black:"bk",
		gray:"ga",
		grey:"ge"
	};
	
	if(combos.length > 0){
		//Variant stock records
	    var variantSKUArray = [];
		for( let i=0; i < combos.length; i++ ){
			var variant = combos[i];
			var variantName = "";
			var variantOptions = "";
			var seperatorName = "";
			var seperatorOptions = "";
			var variantSKU = "";
			var variantIdentificator = "";
			var acronym = "";
			
			for( let vI=0; vI < variant.length; vI++ ){
				if(vI !== 0){
				   seperatorName = ' + ';
				   seperatorOptions = ',';
				}
				
				var string = variant[vI];
				variantName += seperatorName+'<span>'+string+'</span>';
				variantOptions += seperatorOptions+string;
				
				//replace spaces with underscores for object
				string = string.split(' ').join('_');
				
				//failsafe if acronym already exists within product
				if(acronyms[string]){
					variantSKU += acronyms[string];
				}else{
					acronym = string.slice(0,1) + string.slice(1,2); //last -1
	
					if(variantSKUArray.includes(acronym)){
						acronym = string.slice(0,1) + string.slice(-1);
					}
					
					variantSKU += acronym;
					variantSKUArray.push(variantSKU);
				}
				variantIdentificator += string;
			}
			
			SKU = SKUBase+'-'+variantSKU;
			
			if( $(".table-variants tr[data-sku='"+variantIdentificator+"']").length <= 0 ){
				$('.table-variants tbody').append('<tr data-sku="'+variantIdentificator+'"><td>'+variantName+'</td> <td><input type="hidden" name="stocks[sku][]" class="form-control" value="'+SKU+'"><input type="hidden" name="stocks[option_values][]" class="form-control" value="'+variantOptions+'"><input type="hidden" name="stocks[option_ids][]" class="form-control" value="0"><p>'+SKU+'</p></td> <td><input type="number" name="stocks[price][]" class="form-control variant-price" step="0.01" value="'+basePrice+'"></td> <td><input type="number" name="stocks[quantity][]" class="form-control" value="0"></td><td><input type="number" name="stocks[weight][]" class="form-control" value="0"></td></tr>');
			}else{
				//remove the remove tag to prevent the removal of this existing variant
				$(".table-variants tr[data-sku='"+variantIdentificator+"']").removeClass('remove');
			}
	    }
    }else{
	    //Standard Stock record
	    $('.table-variants tbody').append('<tr data-sku="-"><td>-</td> <td><input type="text" name="stocks[sku][]" class="form-control" value="'+SKUBase+'" disable></td> <td><input type="number" name="stocks[price][]" class="form-control variant-price" step="0.01" value="'+basePrice+'"></td> <td><input type="number" name="stocks[quantity][]" class="form-control" value="0"></td> <td><input type="number" name="stocks[weight][]" class="form-control" value="0"></td></tr>');
    }
	
    
    if($(".table-variants tr.remove").length > 0 ){
	    $('input[name="remove_variants"]').val('1');
	    $(".table-variants tr.remove").remove();
    }
	
	return combos;
}

export default (function () {
	tagsInputInit();
	
	$('.table-tagsinput .table-form-add').click(function() {
		$('input[data-role=tagsinput]').tagsinput('destroy');
		setTimeout(function(){
			tagsInputInit();
		}, 10);
	});
	
	//only fires when table exists and no tbody isset (for example no standard product stock)
	if( $(".table-variants").length > 0 && $(".table-variants tbody tr").length <= 0){
		constructVariants();
	}
	
	// construct variant on change
	$(document).on('change', 'input[data-role=tagsinput]', function () {
		constructVariants();
	});
	
	//delete variant
	$(document).on('click', '.table-tagsinput .table-form-remove', function () {
		setTimeout(function(){
			constructVariants();
		}, 10);
	});
	
	//Base price change and variant price checkup
	var previousPrice;

    $("input[name='base_price']").on('focus', function () {
        // Store the current value on focus and on change
        previousPrice = this.value;
    }).on('keyup change',function() {
        var basePrice = $(this).val();
		$(".variant-price").each(function(index) {
			var variantPrice = $(this).val();
			if(previousPrice == variantPrice){
				$(this).val(basePrice);
			}
		});

        // Previous value is updated
        previousPrice = this.value;
    });
}())
