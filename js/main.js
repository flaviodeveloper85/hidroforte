function check_dep(){

    // requisiçao ajax para verificar se tem novos depoimentos no banco
    $.ajax({  
           url:"<?php echo site_url(); ?>mensagem/refresh_dep",   
           method:"POST",  
           data:new FormData(this),  
           contentType: "html",  
           cache: false,  
           processData:false,  
           success:function(data)  
           {  
              
              $('#box_notify').html(data);
                
           }  
      });
  }
