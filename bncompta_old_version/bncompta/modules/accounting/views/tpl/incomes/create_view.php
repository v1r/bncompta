
<div class="dynamique_content"><h2><?php echo lang('accounting.add_new_bank_statement_label'); ?></h2>
    <div id="tabs-1">
        <?php echo form_open($this->uri->uri_string(), 'class="crud" id="expenditures" name="expenditures"'); ?> 								
        <fieldset>
            <div class="col600">
                <p><label for="incomes_description"><?php echo lang('common.description_label'); ?> :</label>
                    <input class="mf" id="description" name="description" type="text" value="<?php echo $repopulate->description; ?>" />
                </p>
                <p><label for="incomes_date"><?php echo lang('common.date_label'); ?> :</label>
                    <input class="mf" id="date" name="date" type="text" value="<?php echo $repopulate->date; ?>" />
                </p>
                <p><label for="incomes_ht"><?php echo lang('accounting.ht_label'); ?> :</label>
                    <input class="mf" id="ammount" name="ht" type="text" value="<?php echo $repopulate->ht; ?>" />
                </p>
                <p><label for="incomes_tva"><?php echo lang('accounting.tva_label'); ?> :</label>
                    <input class="mf" id="ammount" name="tva" type="text" value="<?php echo $repopulate->tva; ?>" />
                </p>
                <p><label for="incomes_type"><?php echo lang('common.type_label'); ?> :</label>
                    <select  name="income_type_id">
                        <option value="">#</option>
                        <?php foreach ($expenditure_type as $key) : ?>
                            <option value="<?php echo $key->id; ?>"><?php echo $key->label; ?></option>
                        <?php endforeach; ?>
                    </select>
                </p>
                <p><label for="client"><?php echo lang('accounting.client_label'); ?> :</label>
                    <select  name="client_id">
                        <option value="">#</option>
                        <option value="0">Vide</option>
                        <?php foreach ($income_type as $key) : ?>
                            <option value="<?php echo $key->id; ?>"><?php echo $key->label; ?></option>
                        <?php endforeach; ?>
                    </select>
                </p>
                <?php echo form_open_multipart(''); ?>
                <label for="mf">Sélectionner un fichier: </label>
                <input type="file" id="fileToUpload" name="userfile" size="20" />

                <input type="button" onclick="return ajaxFileUpload();" class="button" value="upload" />

                </form>
                <input type="hidden" id="file_path" name="file_path" size="20" value="" />
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
            <legend>Importation a partir d'un releve bancaire</legend>
            <?php echo form_open('accounting/incomes/import', 'class="crud" id="import_incomes" name="import_incomes"'); ?> 
            <p><label for="incomes_bank_statements"><?php echo lang('accounting.bank_statements_label_2'); ?> :</label>
                <select  name="bank_statement_id">
                    <option value="">#</option>
                    <?php foreach ($bank_statements as $key) : ?>
                        <option value="<?php echo $key->id; ?>"><?php echo $key->label; ?></option>
                    <?php endforeach; ?>
                </select>
            </p>

            <input type="button" onclick="return ajaxFileUpload();" class="button" value="<?php echo lang('common.import_button_label'); ?>" />

            </form>
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

        $.ajaxFileUpload(
        {
            url: BASE_URL + 'accounting/incomes/upload_attachment',
            secureuri:false,
            fileElementId:'fileToUpload',
            dataType: 'json',
            success: function (data,status)
            {
                $("#file_path").val(data.filePath);
            },
            error: function (data, status, e)
            {
                alert(data.error);
            }
        }
    )
		
        return false;

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