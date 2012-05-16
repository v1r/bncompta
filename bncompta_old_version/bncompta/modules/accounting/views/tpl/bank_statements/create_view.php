
<div class="dynamique_content"><h2><?php echo lang('accounting.add_new_bank_statement_label'); ?></h2>
    <div id="tabs-1">
        <?php echo form_open($this->uri->uri_string(), 'class="crud" id="bank_statements" name="bank_statements"'); ?> 								
        <fieldset>
            <div class="col600">
                <p><label for="bank_statements_label"><?php echo lang('common.label_label'); ?> :</label>
                    <input class="mf" id="label" name="label" type="text" value="<?php echo $repopulate->label; ?>" />
                </p>
                <p><label for="bank_statements_description"><?php echo lang('common.description_label'); ?> :</label>
                    <input class="mf" id="description" name="description" type="text" value="<?php echo $repopulate->description; ?>" />
                </p>
                <p><label for="bank_statements_date"><?php echo lang('common.date_label'); ?> :</label>
                    <input class="mf" id="date" name="date" type="text" value="<?php echo $repopulate->date; ?>" />
                </p>
                <p><label for="bank_statements_ammount"><?php echo lang('accounting.ammount_label'); ?> :</label>
                    <input class="mf" id="ammount" name="ammount" type="text" value="<?php echo $repopulate->date; ?>" />
                </p>
                <p><label for="bank_statements_bank_account"><?php echo lang('accounting.bank_account_label'); ?> :</label>
                    <select  name="bank_account_id">
                        <option value="">#</option>
                        <?php foreach ($entreprise_bank_accounts as $key) : ?>
                            <option value="<?php echo $key->id; ?>"><?php echo $key->label; ?></option>
                        <?php endforeach; ?>
                    </select>
                </p>
                <p><input  type="submit" value="Submit" />
                </p>
            </div>
            <div class="col300">
                <?php if (validation_errors()):// In errors case  ?>
                    <h2><?php echo lang('error_label'); ?></h2>
                    <p><?php echo lang('error_message_label'); ?></p>
                    <div class="error_list">
                        <?php echo validation_errors(); ?>
                    </div>
                <?php endif; ?>
                <div id="messageBox1"> 
                    <ul></ul> 
                </div> 
            </div>
        </fieldset> 
        <?php echo form_close(); ?> 

        <fieldset>
            <div class="col600">
                <?php echo form_open_multipart('modules/upload/upload_process'); ?>
                <label for="mf">Sélectionner un fichier: </label>
                <input type="file" id="fileToUpload" name="userfile" size="20" />

                <input type="button" onclick="return ajaxFileUpload();" class="button" value="upload" />

                </form>
            </div>
            <div class="col300">
                <?php if (validation_errors()):// In errors case  ?>
                    <h2><?php echo lang('error_label'); ?></h2>
                    <p><?php echo lang('error_message_label'); ?></p>
                    <div class="error_list">
                        <?php echo validation_errors(); ?>
                    </div>
                <?php endif; ?>
                <div id="messageBox1"> 
                    <ul></ul> 
                </div> 
            </div>
        </fieldset> 
    </div>
</div>
<script type="text/javascript">
    function ajaxFileUpload()
    {
        $("#loader")
        .ajaxStart(function(){
            $(this).show();
        })
        .ajaxComplete(function(){
            $(this).hide();
        });

        $.ajaxFileUpload
        (
        {
            url: BASE_URL + 'accounting/bank_statements/upload_process',
            secureuri:false,
            fileElementId:'fileToUpload',
            dataType: 'json',
            success: function (data,status)
            {
                var process_upload_url =  BASE_URL + 'accounting/bank_statements/upload' ;
                refresh(process_upload_url);
            },
            error: function (data, status, e)
            {
                var process_upload_url =  BASE_URL + 'accounting/bank_statements/upload' ;
                refresh(process_upload_url);
            }
        }
    )
		
        return false;

    }
    
    function refresh(url)
    {
        //send the request to the server

        $(".dynamique_content").fadeOut('fast', function(){
            $.post(url, function(data, response, xhr) {
                //success stuff here
                $(".dynamique_content").html(data).fadeIn('fast');
            });
        });
    }
    $(document).ready(function(){
 
        $( "#date" ).datepicker( { dateFormat: 'yy-mm-dd',    changeMonth: true });
        $("#bank_statements").validate({
            rules: {
                label: {
                    required : true 
                },
                description : {
                    required : true
                },
                start_date : {
                    required : true
                },
                end_date : {
                    required : true,
                    greaterThan: "#end_date"
                },
                bank_account_id: {
                    required : true
                },
                ammount: {
                    required : true
                }
            },
            messages: {
                label: {
                    required : "Le champ Label est obligatoire"
                },
                description : {
                    required : "Le champ Description est obligatoire"
                },
                start_date: {
                    required : "Le champ  Date de début  est obligatoire"
                },
                end_date : {
                    required : "Le champ Date de fin : est obligatoire"
                },
                bank_account_id : {
                    required : "Le champ compte bancaire est obligatoire"
                },
                ammount : {
                    required : "Le champ somme est obligatoire"
                }
            },
            errorContainer: "#messageBox1",
            errorLabelContainer: "#messageBox1 ul",
            wrapper: "li", debug:true,
            submitHandler: function(form) {
                form.submit();
            }
        });   

        
    });
</script>