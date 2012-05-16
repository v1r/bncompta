
<div id="tabs-1">
    <fieldset>
        <legend><h2><?php echo lang('entreprises_add_entreprise_label'); ?></h2></legend>
        <div class="col600">  
            <?php echo form_open($this->uri->uri_string(), 'class="crud"'); ?> <!-- Formulaire -->									


            <p><label for="sf"><?php echo lang('common_entreprise_slug_label'); ?> :</label>
                <input class="mf" name="label" type="text" value="" /></p>

            <p><label for="sf"><?php echo lang('common_name_label'); ?> :  </label>
                <input class="mf" name="name" type="text" value="" /></p>

            <p><label for="sf"><?php echo lang('common.description_label'); ?> :  </label>
                <input class="mf" name="description" type="text" value="" /></p>

            <p><label for="sf"><?php echo lang('common_email_label'); ?> :  </label>
                <input class="mf" name="email" type="text" value="" /></p>

            <p><label for="sf"><?php echo lang('common.modules_permission_label'); ?> :  </label></p>
            <select id="modules_selection" class="multiselect" name="modules[]" multiple="multiple">
                <?php foreach ($modules as $key) : ?>
                    <option value="<?php echo $key->resource_id; ?>"><?php echo lang($key->description)    ; ?></option>
                <?php endforeach; ?>
            </select>  
            <p><input class="button" name="submit" type="submit" value="Submit" />
            </p>
        </div>
    </fieldset>                 
    <?php echo form_close(); ?>  	
</div>                  
<script>                                         
    $(document).ready(function(){
        $(".multiselect").dgMagnetCombo();
        $.localise('ui-multiselect', {/*language: 'en',*/ path: '<?php echo THEME_PATH; ?>' + 'js/locale/'});
        $(".multiselect").multiselect();
    });
</script>