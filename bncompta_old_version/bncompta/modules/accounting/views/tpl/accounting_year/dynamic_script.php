<script type="text/javascript">
    $(document).ready(function() { 	                                                                                                                     
        $("#accounting a").click(function(){
                                                                                                    

            var url = BASE_URL + $(this).attr('href') ; 
            var get_url = <?php echo '"' . current_url() . '"'; ?> ;
            $("#loader").show();
            if($(this).attr('id') === 'default') 
            {        
                $.post(url, function(data) {
                    refresh(get_url)
                    refresh_sidebar() ; 
                });
                                    
                return false;
            }
                                                                                                                            
            if($(this).attr('id') === 'desactivate') 
            {
                $.post(url, function(data) {
                    refresh(get_url)
                    refresh_sidebar() ; 
                });
                                        
                return false;
            }
            if($(this).attr('id') === 'edit') 
            {
                refresh(url)                                                        
                return false;
            }
                                                                                                                            
            if($(this).attr('id') === 'new') 
            {
                refresh(url)                        
                return false;
            }
            if($(this).attr('id') === 'open') 
            {                        
                $.post(url, function(data) {
                    refresh(get_url)
                    refresh_sidebar() ; 
                });                          
                return false;
            }
                                                                                                                            
            if($(this).attr('id') === 'accounting-dashboard') 
            {
                refresh(get_url)                                                                     
                return false;
            }
                                                                        
            if($(this).attr('id') === 'close') 
            {
                $("#loader").show();
                refresh(url)                           
                return false;
            }
            if($(this).attr('id') === 'delete') 
            {
                $("#loader").show();
                refresh(url)                           
                return false;
            }
                                                                                                                            
        });    
        function refresh(url)
        {
            console.log('refresh call started');
            setTimeout(function(){
                $(".dynamic_content").fadeOut('fast', function(){
                    $.post(url, function(data, response, xhr) {
                        //success stuff here
                        $(".dynamic_content").html(data).fadeIn('slow');
                        $("#loader").hide();    
                    });
                });},1000);
                                                                                                        
        }
        function refresh_sidebar()
        {
            //send the request to the server
                        
            console.log('sidebar call started');
            var url = BASE_URL + 'accounting/accounting_year/refresh_sidebar' ; 
            $(".dynamic-sidebar").fadeOut(function(){
                $.post(url, function(data, response, xhr) {
                    //success stuff here
                    $(".dynamic-sidebar").html(data).fadeIn('fast');
                });
            });
        }
    });
                                                                                                                
</script>