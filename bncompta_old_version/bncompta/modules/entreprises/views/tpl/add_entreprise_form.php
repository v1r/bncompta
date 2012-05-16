<h1><?php echo lang('entreprises_add_entreprise_label'); ?></h1>
<div id="tabs-1">
    <fieldset>
        <div class="col600">  
            <?php echo form_open($this->uri->uri_string(), 'class="crud"'); ?> <!-- Formulaire -->									

            <legend><?php echo lang('common_add_form_label'); ?></legend>
            <p><label for="sf"><?php echo lang('common_entreprise_slug_label'); ?> :</label>
                <input class="mf" name="label" type="text" value="<?php echo $repopulate->label; ?>" /></p>

            <p><label for="sf"><?php echo lang('common_name_label'); ?> :  </label>
                <input class="mf" name="name" type="text" value="<?php echo $repopulate->name; ?>" /></p>

            <p><label for="sf"><?php echo lang('common.description_label'); ?> :  </label>
                <input class="mf" name="description" type="text" value="<?php echo $repopulate->description; ?>" /></p>

            <p><label for="sf"><?php echo lang('common_email_label'); ?> :  </label>
                <input class="mf" name="email" type="text" value="<?php echo $repopulate->email; ?>" /></p>

            <p><label for="sf"><?php echo lang('common.modules_permission_label'); ?> :  </label></p>
            <select id="modules_selection" class="multiselect" name="modules[]" multiple="multiple">
                <?php foreach ($mod_entreprise as $key) : ?>
                    <option value="<?php echo $key->id; ?>"><?php echo $module_title_description[$key->name]['fr']; ?></option>
                <?php endforeach; ?>
            </select>  
            <p><input class="button" type="submit" value="Submit" />
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
    </fieldset>                  <!-- Fin fieldset -->

    <?php echo form_close(); ?> <!-- Fin Form -->	
</div>                   <!-- Fin tab-1 -->
<script>                                         
    $(document).ready(function(){
        $(".multiselect").dgMagnetCombo();
        $.localise('ui-multiselect', {/*language: 'en',*/ path: '<?php echo THEME_PATH; ?>' + 'js/locale/'});
        $(".multiselect").multiselect();
    });
</script>