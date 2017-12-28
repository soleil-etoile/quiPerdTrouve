/*jQuery(document).ready(function(){
    chargement();
    setInterval(chargement, 3000);
    
    jQuery("#btnSub").click(function(e) {
        e.preventDefault();
        ajout();
    });

    
});

function chargement(){

    jQuery.ajax({
        url: "test.php",
        dataType: "html",
        success()  {
            
        },
        error() {
            
        },
        complete(xhr) {
           jQuery("#commentaire").html(xhr.responseText);
        }
    });
};

function ajout() {
  
    jQuery.ajax({
        url: "ajout.php",
        type: "POST",
        data: jQuery("#formulaire").serialize() + "&ajax=1",
        dataType: "html",
        success()  {
            
        },
        error() {
            
        },
        complete(xhr) {
         
            chargement();
            jQuery("#message").val("");
        }
    });
    
}
    
    */



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

jQuery(document).ready(
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
    });
   
                    