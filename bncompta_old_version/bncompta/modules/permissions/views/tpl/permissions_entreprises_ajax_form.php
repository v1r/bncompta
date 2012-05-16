<div class="pad20"> 
    <h1><?php echo lang('permissions.entreprise_permissions_heading'); ?></h1>
    <p class="settings_hr">
        <label for="sf"><?php echo lang('common_entreprise_slug_label'); ?></label>
        <span><?php echo $this->entreprise_data[$this->uri->segment(4)]->label; ?></span>
    </p>
    <p class="settings_hr">
        <label for="sf"><?php echo lang('common_name_label'); ?></label>
        <span><?php echo $this->entreprise_data[$this->uri->segment(4)]->name; ?></span>
    </p>
    <p class="settings_hr">
        <label for="sf"><?php echo lang('common_description_label'); ?></label>
        <span><?php echo $this->entreprise_data[$this->uri->segment(4)]->name; ?></span>
    </p>
    <form id="entreprise_modules_permission" method="post" action="permissions/manage/ajax_update_permissions/<?php echo $this->uri->segment(4); ?>">
        <fieldset>
            <legend><?php echo lang('permissions.edit_permissions_label'); ?></legend>
            <p class="settings_hr">
                <label for="sf"><?php echo lang('permisisons.modules_permissions_label'); ?></label>
                <select  class="multiselect" name="modules[]" multiple="multiple">
                    <?php foreach ($mod_entreprise as $k1) : ?>
                        <?php if (array_key_exists($k1->id, $entreprise_permissions)) : ?>
                            <option value="<?php echo $k1->id; ?>" selected="selected"><?php echo $module_title_description[$k1->name]['fr']; ?></option>
                        <?php else: ?>
                            <option value="<?php echo $k1->id; ?>" ><?php echo $module_title_description[$k1->name]['fr']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                            <optgroup label="Listings">
                                <option>test1</option>
                                 <option>test2</option>
                                  <option>test3</option>
                            </optgroup>
                </select>  
            </p>
            <div id="form_loader"></div>
            <input type="submit"   value="<?php echo lang('common_save_button_label'); ?>"  />
        </fieldset>
    </form>
</div>
<script>                                         
    $(document).ready(function(){
        current_uri = '<?php echo base_url() . $this->uri->uri_string(); ?>' ;
  
    $('#entreprise_modules_permission').ajaxForm(function() { 
        $("#loader").show();
        $('#loader').fadeOut("slow", function() {
            $('.form_notify').html('<div id="notify_tmp" class="notices-message notices-success close"><h4>Mise a jour avec success</h4><p>Mise a jour avec success</p></div>');
            $('#notify_tmp').delay(5000).fadeOut("slow");
            $.fancybox.close;
            parent.$.fancybox.close();
        });
           
    }); 
        
        
        $(".multiselect").dgMagnetCombo();
        $(".multiselect").multiselect();
    });
        
</script>
