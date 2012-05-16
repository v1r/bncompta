          
<h2><?php echo lang('accounting_year.edit_accounting_year_label'); ?></h2>
<div id="tabs-1">
    <?php echo form_open($this->uri->uri_string(), 'class="crud" id="new_accounting_year" name="accounting_year"'); ?> 								
    <fieldset>
        <div class="col600">
            <p><label for="accounting_year_label"><?php echo lang('common.label_label'); ?> :</label>
                <input class="mf" id="label" name="label" type="text" value="<?php echo $repopulate->label; ?>" />
            </p>
            <p><label for="accounting_year_description"><?php echo lang('common.description_label'); ?> :</label>
                <input class="mf" id="description" name="description" type="text" value="<?php echo $repopulate->description; ?>" />
            </p>
            <p><label for="accounting_year_start_date"><?php echo lang('common.start_date_label'); ?> :</label>
                <input class="mf" id="start_date" name="start_date" type="text" value="<?php echo date('d-m-Y', $repopulate->start_date); ?>" />
            </p>
            <p><label for="accounting_year_end_date"><?php echo lang('common.end_date_label'); ?> :</label>
                <input class="mf" id="end_date" name="end_date" type="text" value="<?php echo date('d-m-Y', $repopulate->end_date); ?>" />
            </p>
            <p><label for="accounting_year_active"><?php echo lang('common.active_label'); ?> :</label>
                <select  name="active">
                    <option value="0"><?php echo lang('common.no_label'); ?></option>
                    <option value="1"><?php echo lang('common.yes_label'); ?></option>
                </select>
                <a href="" class="tooltip" title="<?php echo lang('accounting_year.activate_tooltip'); ?>">[?]</a>
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
</div>
<?php echo form_close(); ?> 

<script type="text/javascript">
    $(document).ready(function(){
        $( "#start_date" ).datepicker( { dateFormat: 'yy-mm-dd',    changeMonth: true });
        $( "#end_date" ).datepicker( { dateFormat: 'yy-mm-dd',    changeMonth: true});
        $("#new_accounting_year").validate({
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
                active: {
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
                active : {
                    required : "Le champ Active est obligatoire"
                }
            },
            errorContainer: "#messageBox1",
            errorLabelContainer: "#messageBox1 ul",
            wrapper: "li", debug:true,
            submitHandler: function(form) {
                form.submit();
            }
        });   
        jQuery.validator.addMethod("greaterThan", function(value, element, params) {

            if (!/Invalid|NaN/.test(new Date(value))) {
                return new Date(value) > new Date($(params).val());
            }
            return isNaN(value) && isNaN($(params).val()) || (parseFloat(value) > parseFloat($(params).val())); 
        },'La date de debut devrait etre superieur a la date de fin.');
        $("#end_date").rules('add', { greaterThan: "#start_date" });
            
    });
</script>