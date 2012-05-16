/*
 * JKB_edit - jQuery inline edit writen by Karim Besbes
 * for BNCompta Project
 * Copyright (c) 2011 
 *  Version 0.1 - First Vesion 
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

(function( $ ){

    var backup = new Array();
    var inputs = new Array(); 
    var inputs_name = new Array();
    var config = {   
        id : '',
        inputs : '',
        url : '',   // Saving url 
        save_icon : '',
        cancel_icon : '',
        div_loader_id : '',
        parent_input_wrapper : '',
        input_wrapper : '',
        id_edit_button : '',
        modal : true,
        validation : 'false',  // Allow jquery validation plugin 1.8.1 to validate fields.
        formToValidate : '',
        validation_success_class : 'kb-validation-checked',
        validation_error_class : 'kb-validation-error',
        validation_status_element : 'span.p'
    };
    
    $.fn.kb_edit = function(options) {
        config.id_edit_button = $(this).attr('id');
        if( options ) {
            $.extend( config, options );
        }  

        $.each(config,function(key,value){
            if(key == 'inputs') {   	 
                inputs = value.split('|');
                    
            }
        });       
        
        if(config.modal == true)
        {
            console.log('modal');
            var maskHeight = $(document).height();
            var maskWidth = $(window).width();
            $('#mask').css({
                'width':maskWidth,
                'height':maskHeight
            });
          
            $('#mask').fadeIn(1000);   
            $('#mask').fadeTo("slow",0.1); 
            $('#mask').click(function(){
                return false;
            })
        }

        
        $.each(inputs,function(key){
            inputs_name.push(inputs[key]);
        });
            
        $(this).parents(config.parent_input_wrapper).find(':input').each(function(i){
            if($(this).attr("name") == "id") {
                config.id = $(this).val();
                return false;
            }
        } );
        
        // <parent>
        //   <edit_wrapper>
        //      <input>
        //         <span>
        $(this).parents(config.parent_input_wrapper)
        .find(config.input_wrapper) 
        .each(function(i) {
            $(this).find(':input').each(function(i) {
                if(jQuery.inArray($(this).attr('name'), inputs_name) != -1)
                {
                    if($(this).attr('type') === 'radio')
                    {
                            
                    }
                    backup[this.name] = this.value;
                    $(this).removeAttr("style");
                    $(this).addClass("kb_inputs");
                    $(this).next().text("");
                }
            });   
        });
        
        $(this).parents(config.parent_input_wrapper)
        .find(config.input_wrapper) 
        .each(function(i) {
            $(this).find('textarea').each(function(i) {
                if(jQuery.inArray($(this).attr('name'), inputs_name) != -1)
                {
                    backup[this.name] = this.value;
                    $(this).removeAttr("style");
                    $(this).next().text("");
                }
            });
                  
        });
        
        $(this).hide(); 
        $(this).after('<img onclick="enabled=true" src="' + config.save_icon +'" style="cursor:pointer;" class="kb-update"  id="update' + config.id + '" /> &nbsp;&nbsp;<img src="' + config.cancel_icon +'" onclick="enabled=true" style="cursor:pointer;" class="kb-cancel"  id="cancel' + config.id + '"  /> ');
         
        $( "#update" + config.id).bind( "click", function( e ) {
            if(config.validation == true)
            {                             

                if(!$('#' + config.formToValidate).valid()){
                    $(config.validation_status_element).removeClass(config.validation_success_class).addClass(config.validation_error_class); 
                    return false;
                }
                else
                {
                    $(config.validation_status_element).removeClass(config.validation_error_class).addClass(config.validation_success_class);    
                    if(config.modal == true) { 
                        $('#mask, .window').hide();
                    }
                    return update();
                }
            }
        
        } );
        $( "#cancel" + config.id).bind( "click", function( e ) {
            if(config.modal == true) { 
                if(config.validation == true)
                {  
                    var validator  =  $('#' + config.formToValidate).validate();
                    validator.resetForm();
                }
                $('#mask, .window').hide();
            }
            return cancel();
        });
        
       
        return true; 
    };

    // Cancel function 
    var cancel = function() {
        var cancel_id = "#cancel" + config.id; 
        $(cancel_id).parents(config.parent_input_wrapper)
        .find(config.input_wrapper)
        .each(function(i) {
            $(this).find(':input').each(function(k) {
                if(typeof backup[this.name] !== 'undefined' && this.name != 'id') 
                {
                    $(this).val(backup[this.name]); 
                }
                $(this).css("display", "none");
            });
            $(this).find('span').each(function(j) {
                $(this).text($(this).prev().val());
            });      
        });
        $("#cancel").unbind();
        return remove(); 
    }; 
  
    // Update function 
    var update = function() {
        $("#" + config.div_loader_id).show();
        var update_id = "#update" + config.id; 
        var post = '';       
        $(update_id).parents(config.parent_input_wrapper)
        .find(config.input_wrapper) 
        .each(function(i) {
            var input_value = '';
            $(this).find(':input').each(function(k) {
                if(jQuery.inArray($(this).attr('name'), inputs_name) != -1)
                {
                    input_value = $(this).val() ; 
                    post += $(this).attr('name') + '=' + input_value + '&' ; 
                    $(this).css("display" , "none");  
                    $(this).after('<span>' + input_value + '</span>');
                }
            });
        });

        if(config.id > 0)
        {
            var data = 'id=' + config.id + '&' + post.substr(0,post.length - 1);
        } else {
            var data =  post.substr(0,post.length - 1);
        }
        $.ajax({  
            
            type: "POST",  
            url: config.url,  
            data: data,  
            success: function() {  
                $("#" + config.div_loader_id).fadeOut("slow");
                $('.notify').html('<div id="notify_tmp" class="notices-message notices-success close"><h4>Mise a jour avec success</h4><p>Mise a jour avec success</p></div>');
                $('#notify_tmp').delay(5000).fadeOut("slow");
                
                  
            }
        });  
        post = '' ;    
        return remove();
    };
    
    var remove = function() 
    {
        $("#"+ config.id_edit_button + config.id).show();
        $("#update" + config.id).remove();
        $("#cancel" + config.id).remove();
    }
})( jQuery );