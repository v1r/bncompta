<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide"  id="tabs-1">
    <h2><?php echo lang('managers.add_manager_label'); ?></h2>
    <hr/>
    <?php echo form_open($this->uri->uri_string()); ?> <!-- Form -->									
    <fieldset>
        <div class="col600">  
            <p><label for="sf"><?php echo lang('common_username_label'); ?> :</label>
                <input class="mf" name="username" type="text" value="<?php echo $repopulate->username; ?>" /></p>
            <p><label for="sf"><?php echo lang('common_email_label'); ?> :  </label>
                <input class="mf" name="email" type="text" value="<?php echo $repopulate->email; ?>" /></p>
            <p><label for="sf"><?php echo lang('common_first_name_label'); ?> :  </label>
                <input class="mf" name="first_name" type="text" value="<?php echo $repopulate->first_name; ?>" /></p>
            <p><label for="sf"><?php echo lang('common_last_name_label'); ?> :  </label>
                <input class="mf" name="last_name" type="text" value="<?php echo $repopulate->last_name; ?>" /></p>
            <p><label for="sf"><?php echo lang('common_password_label'); ?> :  </label>
                <input class="mf" name="password" type="password" value="<?php echo $repopulate->password; ?>" /></p>
            <p><label for="sf"><?php echo lang('common_confirm_password_label'); ?> :  </label>
                <input class="mf" name="confirm_password" type="password" value="<?php echo $repopulate->confirm_password; ?>" /></p>

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
    </fieldset>                  <!-- End of fieldset -->
    <?php echo form_close(); ?> <!-- End of Form -->	
</div>                   <!-- End of First tab -->


