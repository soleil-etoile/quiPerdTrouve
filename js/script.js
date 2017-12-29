

/*
    function getList(type, obj) {
        jQuery("#loading_" + type).show(); // montre le chargement
        jQuery.post("../test2.php", {type: type, id: jQuery("#"+obj).val()}, onAjaxSuccess);
        function onAjaxSuccess(data) {
             out = document.getElementById(type);
             for (var i = out.length - 1; i >= 0; i--) {
                  out.options[i] = null;
             }
             eval(data);
             jQuery("#loading_" + type).hide(); // chargement terminé 
        }
    }
*/

/*jQuery(document).ready(
    function() 
    {
        jQuery('#pays').on('change',function(){
            jQuery(countryName)=jQuery(this).val();
            
            if(countryName){
                jQuery.ajax({
                    type: 'POST';
                    url:
                })
            }
        })
    });*/
   
// pour perdu2.php
/*$(function(){

	$('#country').change(function(){
		var code = $(this).val();
		$('#city').load('perdu2.php', {code: code}, function(){
			$('.city-select').fadeIn('slow');
		});

	});

});*/

// pour perdu3.php
$(document).ready(function(){
    $('#pays').on('change',function(){
        var paysID = $(this).val();
        if(paysID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'id_pays='+paysID,
                //data: $("#pays") + paysID,
                success:function(html){
                    $('#departement').html(html);
                    $('#ville').html('<option value="">Select departement first</option>'); 
                }
            });
        }else{
            alert('else');
            $('#departement').html('<option value="">Select country first</option>');
            $('#ville').html('<option value="">Select state first</option>'); 
        }
    });
    
    $('#departement').on('change',function(){
        var departID = $(this).val();
        if(departID){
            alert("depart");
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'code_departement='+departID,
                success:function(html){
                    $('#ville').html(html);
                }
            }); 
        }else{
            $('#ville').html('<option value="">Select state first</option>'); 
        }
    });
});