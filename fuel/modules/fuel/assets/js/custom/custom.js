function selectParty(selectedItem) {
	$("#party").val(selectedItem);
	//Call the controller to get coil details as json object.
	// Then convert json to a html table.
	//then to display uncomment below. 
	//reffer to http://www.zachhunter.com/2010/04/json-objects-to-html-table/
	 //$("#coil_details").append("<Here type converted json to HTML>");
}
 
 function suggest(inputString,url){
 alert(url);
        if(inputString.length == 0) {
            $('#suggestions').fadeOut();
        } else {
        $('#nPartyId').addClass('load');
            $.post(url, {queryString: ""+inputString+""}, function(data){
                if(data.length >0) {
                    $('#suggestions').fadeIn();
                    $('#suggestionsList').html(data);
                    $('#nPartyId').removeClass('load');
                }
            });
        }
    }
 
    function fill(thisValue) {
        $('#nPartyId').val(thisValue);
        setTimeout("$('#suggestions').fadeOut();", 600);
    }


$(document).ready(function()//When the dom is ready 
 {
	$("#fWidth").keyup(function() {
        if(parseInt($(this).val()) > 2000) { 
            alert("Error in width.");
        }
    });	
 
 $("#fThickness").keyup(function() {
        if(parseInt($(this).val()) > 100) { 
            alert("Error in thickness.");
        }
    });
	
$("#fQuantity").change(function() {
        if(parseInt($(this).val()) < 100) { 
            alert("Error in weight.");
        }
    });	
 
  $("#nPartyId").keyup(function() {
  inputString = $(this).val();
  //alert (inputString);
         if($(this).val().length == 0) {
            $('#suggestions').fadeOut();
        } else {
			/* var module = $(this).attr('id').replace('inward_entry', '').split('-').join('/');
				var page = (module == 'inward_entry') ? 'inward_entry/autosuggest' : 'inward_entry'; // need so back button will not show ajax
					$(this).load(jqx.config.basePath + module + '/' + page,function(data){*/
			 $.post('autosuggest', {nPartyId : ""+inputString+""}, 
			 function(data){
                if(data.length >0) {
                    $('#suggestions').fadeIn();
                    $('#suggestionsList').html(data);
                    $('#nPartyId').removeClass('load');
                }
            });
		}
		});	
    });

 