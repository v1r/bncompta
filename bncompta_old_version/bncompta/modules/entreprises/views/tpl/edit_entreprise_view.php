<h1><?php echo lang('entreprises_add_entreprise_label'); ?></h1>
<div id="tabs-1">
    <?php if (validation_errors()):// In errors case  ?>
        <div class="message error close"><h2>Error message : </h2><p><?php echo lang('errors_label'); ?></p></div>
    <?php endif; ?>
    <?php echo form_open($this->uri->uri_string(), 'class="crud"'); ?> <!-- Formulaire -->									
    <fieldset>
        <legend><?php echo lang('common_add_form_label'); ?></legend>
        <p><label for="sf"><?php echo lang('common_entreprise_slug_label'); ?> :</label>
            <input class="mf" name="label" type="text" value="<?php echo $repopulate->label; ?>" /><?php echo form_error('label'); ?></p>

        <p><label for="sf"><?php echo lang('common_name_label'); ?> :  </label>
            <input class="mf" name="name" type="text" value="<?php echo $repopulate->name; ?>" /><?php echo form_error('name'); ?></p>

        <p><label for="sf"><?php echo lang('common.description_label'); ?> :  </label>
            <input class="mf" name="description" type="text" value="<?php echo $repopulate->description; ?>" /><?php echo form_error('description'); ?></p>

        <p><label for="sf"><?php echo lang('common_email_label'); ?> :  </label>
            <input class="mf" name="email" type="text" value="<?php echo $repopulate->email; ?>" /><?php echo form_error('email'); ?></p>

        <p><label for="sf"><?php echo lang('common.modules_permission_label'); ?> :  </label></p>
        <select id="modules_selection" class="multiselect" name="modules[]" multiple="multiple">

            <?php foreach ($mod_entreprise as $key) : ?>
                <option selected="selected" value="<?php echo $key; ?>"><?php echo $module_title_description[$module_name_by_id[$key]]['fr']; ?></option>
            <?php endforeach; ?>
            <?php foreach ($entreprise_mdoules as $key) : ?>
                   <?php if(!in_array($key->id, $mod_entreprise)) :?>
                <option value="<?php echo $key->id; ?>" ><?php echo $module_title_description[$key->name]['fr']; ?></option>
                <?php endif;?>
            <?php endforeach; ?>
        </select>  
        <p><input class="button" type="submit" value="Submit" />
        </p>
    </fieldset>                  <!-- Fin fieldset -->

    <?php echo form_close(); ?> <!-- Fin Form -->	
</div>     <!-- Fin tab-1 -->
<script>                                         
    $(document).ready(function(){

        $(".multiselect").multiselect();
    });
</script>