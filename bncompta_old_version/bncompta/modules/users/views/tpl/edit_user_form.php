<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide"  id="tabs-1">
    <h2><?php echo lang('users_add_user_label'); ?></h2>
    <hr/>
    <?php echo form_open($this->uri->uri_string(), 'class="crud"'); ?> <!-- Form -->									
    <fieldset>
        <div class="col600"
        <input type="hidden" value="<?php echo $this->uri->segment(4); ?>" name="entreprise_id" />
        <p><label for="sf"><?php echo lang('common_username_label'); ?> :</label>
            <input class="mf" name="username" type="text" value="<?php echo $repopulate->username; ?>" /></p>
        <p><label for="sf"><?php echo lang('common_email_label'); ?> :  </label>
            <input class="mf" name="email" type="text" value="<?php echo $repopulate->email; ?>" /></p>
        <p><label for="sf"><?php echo lang('common_first_name_label'); ?> :  </label>
            <input class="mf" name="first_name" type="text" value="<?php echo $repopulate->first_name; ?>" /></p>
        <p><label for="sf"><?php echo lang('common_last_name_label'); ?> :  </label>
            <input class="mf" name="last_name" type="text" value="<?php echo $repopulate->last_name; ?>" /></p>
        <p><label for="sf"><?php echo lang('common_password_label'); ?> :  </label>
            <input class="mf" name="password" type="password" value="" /></p>
        <p><label for="sf"><?php echo lang('common_confirm_password_label'); ?> :  </label>
            <input class="mf" name="confirm_password" type="password" value="" /></p>

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
    <fieldset>
        <legend><?php echo lang('common.user_permissions_label'); ?></legend>
            
        <p><select id="methods_selection" class="multiselect" name="methods[]" multiple="multiple"  size="4">     
                <?php foreach ($methods as $k1 => $v1) : ?>
                    <?php foreach ($v1 as $k2 => $v2) :
                        foreach ($v2 as $k3 => $v3) : ?>
                            <?php foreach ($v3 as $k4 => $v4) : ?>
                                <option value="<?php echo $k1 . '|' . $k3 . '|' . $v4; ?>">
                                    <?php echo lang($modules[$k1]->lang_file_name . '.' . $k3 . '_label') . ' - ' .
                                    lang($modules[$k1]->lang_file_name . '.' . $k3 . '_' . $v4 . '_action_label'); ?></option>
                                <?php
                            endforeach;
                        endforeach;
                    endforeach;
                endforeach;
                ?>
            </select></p>

    </fieldset>                  <!-- Fin of fieldset -->
    <p class="normal"><input class="button" type="submit" value="Submit" /></p>
    <?php echo form_close(); ?> <!-- Fin of Form -->
</div>                  <!-- Fin First tab -->




<script>                                         
    $(document).ready(function(){
        $.localise('ui-multiselect', {/*language: 'en',*/ path: '<?php echo THEME_PATH; ?>' + 'js/locale/'});
        $(".multiselect").multiselect();
    });
</script>