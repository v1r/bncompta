<div id="navigation" >
    <ul>
        <li class="navButton selected">
            <a href="#"><?php echo lang('settings.site_configuration_label'); ?></a> 
            <span class="sc"></span>
        </li>
        <li class="navButton">
            <a href="#"><?php echo lang('settings.mail_configuration_label'); ?></a>
            <span class="mc"></span>
        </li>
    </ul>
</div>

<div id="loader"></div>
<div class="pad20">
    <h1><?php echo lang('common_general_settings'); ?></h1>
    <div id="kb_slide_wrapper">
        <div id="slides">
            <div class="slide">
                <form id="site-settings" action="#"> <!-- Formulaire -->									
                <fieldset class="kb-slide" >
                    <legend><?php echo lang('common_site_settings'); ?></legend>
                    <!-- Username --> 
                    <p class="settings_hr">
                        <label for="sf"><?php echo lang('common_site_name'); ?></label>
                        <input class="mf" style="display:none;" name="site_name"  type="text" value="<?php echo $this->setting->site_name; ?>" />
                        <span><?php echo $this->setting->site_name; ?></span>
                    </p>
                    <p class="settings_hr">
                        <label><?php echo lang('common_site_offline'); ?></label>
                        <input name="site_status" style="display:none;" value="0" <?php if ($this->setting->site_status == 0)
                    echo 'checked="checked"'; ?> class="checkbox" type="radio"> 
                        <input style="display:none;" name="site_status"  value="1" <?php if ($this->setting->site_status == 1)
                                   echo 'checked="checked"'; ?> class="checkbox" type="radio"> 
                        <span><?php echo ($this->setting->site_status == 1) ? lang('common_yes_label') : lang('common_no_label'); ?></span>
                    </p>
                    <p class="settings_hr">
                        <label><?php echo lang('common_site_offline_message'); ?></label>
                        <textarea  style="display:none;" rows="10" cols="80" name="site_offline_message"><?php echo $this->setting->site_offline_message; ?></textarea>
                        <span><?php echo $this->setting->site_offline_message; ?></span>
                    </p>
                    <input type="button"  id="edit-site-settings" value="<?php echo lang('common_edit_button_label'); ?>"  />
                </fieldset>                  <!-- Fin fieldset -->
                </form> <!-- Fin Form -->
            </div>
            <div class="slide">
                <?php echo form_open($this->uri->uri_string(), 'class="crud"'); ?> <!-- Formulaire -->									
                <fieldset>

                </fieldset>     <!-- Fin fieldset -->
                <?php echo form_close(); ?> <!-- Fin Form -->
            </div>
        </div>
    </div>
</div>
<script>
    $("#edit-site-settings").click(function(){
        $("#edit-site-settings").kb_edit({
            'inputs' : 'site_name|site_status|site_offline_message',
            'url'    :  BASE_URL + '', 
            'save_icon' : BASE_URL + "<?php echo THEME_PATH . 'img/ok.png'; ?>",
            'cancel_icon' : BASE_URL + "<?php echo THEME_PATH . 'img/cancel.png'; ?>",
            'loader_path' : BASE_URL + "<?php echo THEME_PATH . 'img/'; ?>",
            'input_wrapper' : 'p',
            'validation' : true,
            'formToValidate' : 'site-settings',
            'validation_success_class' : 'kb-validation-checked',
            'validation_error_class' : 'kb-validation-error',
            'validation_status_element' : 'span.sc'
        });   
    });
</script>
