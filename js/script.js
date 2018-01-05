$(document).ready(function(){
    // si on choisi le pays, on charge le liste des départements
    $('#pays').on('change',function(){
       var paysID = $(this).val();
        if(paysID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:{id_pays:paysID},
                //data: $("#pays") + paysID,
                success:function(html){
                    /*alert(html);*/
                    $('#departement').html(html);
                    $('#ville').html('<option value="">Choisissez avant tout le departement</option>'); 
                }/*,
                error: function(a,b,c)
                {
                    alert(a + b + c);
                }*/
            });
        }else{
            alert('else');
            $('#departement').html('<option value="">Choisissez avant tout le pays</option>');
            $('#ville').html('<option value="">Choisissez avant tout le departement</option>'); 
        }
    });
    
    // si on choisi le département, on charge le liste des villes
    $('#departement').on('change',function(){
        var departID = $(this).val();
        if(departID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'code_departement='+departID,
                success:function(html){
                    /*alert(html);*/
                    $('#ville').html(html);
                }/*,
                error: function(a,b,c)
                {
                    alert(a + b + c);
                }*/
            }); 
        }else{
            $('#ville').html('<option value="">Choisissez avant tout le departement</option>'); 
        }
    });
    
    
   /* // datepicker - pour afficher le calendrier
    jQuery("#madate").datepicker();
        });*/
    
});

$(function() {
    $( "#datepicker" ).datepicker({
      showOtherMonths: true,
      selectOtherMonths: true
    });
  } );


            