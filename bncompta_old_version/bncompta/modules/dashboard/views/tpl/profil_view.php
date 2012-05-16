<!-------------------- Information du compte --------------------> 
<h1><?php echo lang('profil.heading_title'); ?></h1>
<div id="kb_slide_wrapper">
    <div id="slides">
        <!-------------------- Information du compte --------------------> 
        <div class="slide"> 
            <form id="account-info-form" action="#">
                <fieldset class="kb-slide" >
                    <legend><?php echo lang('profil.account_detail_label'); ?></legend>
                    <!-- Username --> 
                    <p class="settings_hr">
                        <label for="sf"><?php echo lang('common_username_label'); ?></label>
                        <input class="mf" style="display:none;" name="username"  type="text" value="<?php echo $user_profil->username; ?>" />
                        <span><?php echo $user_profil->username; ?></span>
                    </p>
                    <!-- Email --> 
                    <p class="settings_hr">
                        <label for="sf"><?php echo lang('common_email_label'); ?></label>
                        <input class="mf" style="display:none;" name="email" type="text" value="<?php echo $user_profil->email; ?>" />
                        <span><?php echo $user_profil->email; ?></span>
                    </p>
                    <!-- password --> 
                    <p class="settings_hr">
                        <label for="sf"><?php echo lang('common_password_label'); ?></label>
                        <input class="mf" style="display:none;" id="password" type="password"   name="password"  value="" />
                        <span>**************</span>
                    </p>
                    <!-- Confirm password --> 
                    <p class="settings_hr">
                        <label for="sf"><?php echo lang('common_confirm_password_label'); ?></label>
                        <input class="mf"  style="display:none;" name="confirm_password" type="password" value="" />
                        <span>**************</span>
                    </p>
                    <!-- Language --> 
                    <p class="settings_hr">
                        <label for="sf"><?php echo lang('common_language_label'); ?></label>
                        <input class="mf" style="display:none;" name="default_lang" type="text" value="<?php echo $user_profil->default_lang; ?>" />
                        <span><?php echo $user_profil->default_lang; ?></span>
                    </p>
                    <a class="black large colorbutton" id="edit-account" ><?php echo lang('common_edit_button_label'); ?></a>
                </fieldset>
            </form>
        </div>
        <div class="slide">
            <!--Informations personnelles --> 
            <form id="perso-info-form" action="#">
                <fieldset class="kb-slide"  >
                    <legend><?php echo lang('profil.personal_informations_label'); ?></legend>
                    <!-- Nom --> 
                    <p class="settings_hr">
                        <label for="sf"><?php echo lang('common_first_name_label'); ?></label>
                        <input class="mf" style="display:none;" name="first_name" type="text" value="<?php echo $user_profil->first_name; ?>" />
                        <span><?php echo $user_profil->first_name; ?></span>
                    </p>
                    <!-- Prenom --> 
                    <p class="settings_hr">
                        <label for="sf"><?php echo lang('common_last_name_label'); ?></label>
                        <input class="mf" style="display:none;" name="last_name" type="text" value="<?php echo $user_profil->last_name; ?>" />
                        <span><?php echo $user_profil->last_name; ?></span>
                    </p>
                    <!-- Address --> 
                    <p class="settings_hr">
                        <label for="sf"><?php echo lang('common_address_label'); ?></label>
                        <input class="mf" style="display:none;" name="address" type="text" value="<?php echo $user_profil->address; ?>" />
                        <span><?php echo $user_profil->address; ?></span>
                    </p>
                    <!-- Post Code --> 
                    <p class="settings_hr">
                        <label for="sf"><?php echo lang('common_code_post_label'); ?></label>
                        <input class="mf" style="display:none;" name="post_code" type="text" value="<?php echo $user_profil->post_code; ?>" />
                        <span><?php echo $user_profil->post_code; ?></span>
                    </p>
                    <!--Position a l'entreprise--> 
                    <p class="settings_hr">
                        <label for="sf"><?php echo lang('profil.entreprise_position_label'); ?></label>
                        <input class="mf"  style="display:none;" name="position" type="text" value="<?php echo $user_profil->position; ?>" />
                        <span><?php echo $user_profil->position; ?></span>
                    </p>
                    <a class="black large colorbutton" id="edit-personnel" ><?php echo lang('common_edit_button_label'); ?></a>
                </fieldset>
            </form>


        </div>
        <div class="slide"> 
            <!-------------------- Contact telephones  --------------------> 
            <form id="contact" action="#">
                <fieldset class="kb-slide" >
                    <legend><?php echo lang('profil.contact_me_label'); ?></legend>
                    <!-- Mobile number--> 
                    <p class="settings_hr">
                        <label for="sf"><?php echo lang('profil.phone_number_label'); ?></label>
                        <input class="mf" value="<?php echo $user_profil->mobile_number; ?>" style="display:none;" name="mobile_number" type="text" value="" />
                        <span><?php echo $user_profil->mobile_number; ?></span>
                    </p>
                    <!-- Telephone bureau--> 
                    <p class="settings_hr">
                        <label for="sf"><?php echo lang('profil.office_phone_number_label'); ?></label>
                        <input class="mf" value="<?php echo $user_profil->office_number; ?>"  style="display:none;" name="office_number" type="text" value="" />
                        <span><?php echo $user_profil->office_number; ?></span>
                    </p>
                    <!-- Numero a la maison--> 
                    <p class="settings_hr">
                        <label for="sf"><?php echo lang('profil.home_phone_number_label'); ?></label>
                        <input class="mf"  value="<?php echo $user_profil->home_number; ?>" style="display:none;" name="home_number" type="text" value="" />
                        <span><?php echo $user_profil->home_number; ?></span>
                    </p>
                    <!-- Numero du fax--> 
                    <p class="settings_hr">
                        <label for="sf"><?php echo lang('profil.fax_number_label'); ?></label>
                        <input class="mf" value="<?php echo $user_profil->fax_number; ?>"  style="display:none;" name="fax_number" type="text" value="" />
                        <span><?php echo $user_profil->fax_number; ?></span>
                    </p>
                    <a class="black large colorbutton" id="edit-contact" ><?php echo lang('common_edit_button_label'); ?></a>
                </fieldset>
            </form>
        </div>
        <!-------------------- Messageries et reseaux sociaux--------------------> 

        <div class="slide"> 
            <form id="social" action="#">
                <fieldset class="kb-slide" >
                    <legend><?php echo lang('profil.social_messenger_label'); ?></legend>
                    <!--gavatar--> 
                    <p class="settings_hr">
                        <label for="sf"><?php echo lang('profil.gravatar_label'); ?></label>
                        <input value="<?php echo $user_profil->gravatar; ?>"  style="display:none;" class="mf" name="gravatar" type="text" value="" />
                        <span><?php echo $user_profil->gravatar; ?></span>
                    </p>
                    <!--MSN/Hotmail--> 
                    <p class="settings_hr">
                        <label for="sf"><?php echo lang('profil.msn_label'); ?></label>
                        <input class="mf"  value="<?php echo $user_profil->msn; ?>"  style="display:none;" name="msn" type="text" value="" />
                        <span><?php echo $user_profil->msn; ?></span>
                    </p>
                    <!--Yahoo--> 
                    <p class="settings_hr">
                        <label for="sf"><?php echo lang('profil.yahoo_label'); ?></label>
                        <input class="mf" value="<?php echo $user_profil->yahoo; ?>"  style="display:none;" name="yahoo" type="text" value="" />
                        <span><?php echo $user_profil->yahoo; ?></span>
                    </p>
                    <!--Gmail--> 
                    <p class="settings_hr">
                        <label for="sf"><?php echo lang('profil.gmail_label'); ?></label>
                        <input class="mf" value="<?php echo $user_profil->gmail; ?>"  style="display:none;" name="gmail" type="text" value="" />
                        <span><?php echo $user_profil->gmail; ?></span>
                    </p>
                    <!--Twitter--> 
                    <p class="settings_hr">
                        <label for="sf"><?php echo lang('profil.twitter_label'); ?></label>
                        <input class="mf" value="<?php echo $user_profil->twitter; ?>"  style="display:none;" name="twitter" type="text" value="" />
                        <span><?php echo $user_profil->twitter; ?></span>
                    </p>
                    <!--Facebook--> 
                    <p class="settings_hr">
                        <label for="sf"><?php echo lang('profil.facebook_label'); ?></label>
                        <input class="mf" value="<?php echo $user_profil->facebook; ?>"  style="display:none;" name="facebook" type="text" value="" />
                        <span><?php echo $user_profil->facebook; ?></span>
                    </p>
                    <a class="black large colorbutton" id="edit-social" ><?php echo lang('common_edit_button_label'); ?></a>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $().ready(function() {
        
        $("#edit-account").click(function(){
            $("#edit-account").kb_edit({
                'inputs' : 'username|email|password|confirm_password',
                'url'    :  BASE_URL + 'dashboard/profil/update/1', 
                'save_icon' : BASE_URL + "<?php echo THEME_PATH . 'img/ok.png'; ?>",
                'cancel_icon' : BASE_URL + "<?php echo THEME_PATH . 'img/cancel.png'; ?>",
                'div_loader_id' : 'loader',
                'input_wrapper' : 'p',
                'validation' : true,
                'formToValidate' : 'account-info-form',
                'validation_success_class' : 'kb-validation-checked',
                'validation_error_class' : 'kb-validation-error',
                'validation_status_element' : 'span.pad'
            });   
        });
        
        $("#account-info-form").validate({
            rules: {
                username: {
                    required : true , 
                    minlength: 2,
                    remote: { 
                        url: BASE_URL + 'dashboard/profil/validate_login',
                        async: false  
                    } 
                },
                
                email : {
                    required : true, 
                    email: true,
                    remote: { 
                        url: BASE_URL + 'dashboard/profil/validate_login',
                        async: false}
                },
                password: {
                    required : true , 
                    minlength: 6
                },
                confirm_password : {
                    equalTo: "#password",
                    required : true 
                }
               
            },
            messages: {
                username: {
                    required : "Le champ est obligatoire",
                    minlength : "Le minimum est de deux caracteres",
                    remote : "Username existe deja"
                },
                email : { 
                    required : "Le champ est obligatoire",
                    email : "Veuillez entrer une adresse email valide",
                    remote : "Email existe deja"
                },
                password: {
                    required : "Le champ est obligatoire",
                    minlength : "Le minimum est de deux caracteres"
                },
                confirm_password: {
                    equalTo : "Le mot de passe de confirmation ne correspond pas au mot de passe choisi"
                }
            },
            onkeyup: false 
        });   
        $("#edit-personnel").click(function(){
            $("#edit-personnel").kb_edit({
                'inputs' : 'first_name|last_name|address|post_code|position',
                'url'    :  BASE_URL + 'dashboard/profil/update/2', 
                'save_icon' : BASE_URL + "<?php echo THEME_PATH . 'img/ok.png'; ?>",
                'cancel_icon' : BASE_URL + "<?php echo THEME_PATH . 'img/cancel.png'; ?>",
                'loader_path' : BASE_URL + "<?php echo THEME_PATH . 'img/'; ?>",
                'input_wrapper' : 'p',
                'validation' : true,
                'formToValidate' : 'perso-info-form',
                'validation_success_class' : 'kb-validation-checked',
                'validation_error_class' : 'kb-validation-error',
                'validation_status_element' : 'span.ppi'
            });   
        });
        $("#perso-info-form").validate({
            rules: {
                first_name: {
                    required : true , 
                    minlength: 2
                },
                last_name: {
                    required : true , 
                    minlength: 2
                },
                post_code : {  minlength  : 6 }
            },
            messages: {
                first_name: {
                    required : "Le champ est obligatoire",
                    minlength : "Le minimum est de deux caracteres"
                },
                last_name: {
                    required : "Le champ est obligatoire",
                    minlength : "Le minimum est de deux caracteres"
                },
                post_code :  { 
                    minlength: "Donner un bon numero de code postale",                
                }
            }
        });   
        $("#edit-contact").click(function(){
            $("#edit-contact").kb_edit({
                  	 	 	
                'inputs' : 'mobile_number|office_number|fax_number|home_number',
                'url'    :  BASE_URL + 'dashboard/profil/update/3', 
                'save_icon' : BASE_URL + "<?php echo THEME_PATH . 'img/ok.png'; ?>",
                'cancel_icon' : BASE_URL + "<?php echo THEME_PATH . 'img/cancel.png'; ?>",
                'loader_path' : BASE_URL + "<?php echo THEME_PATH . 'img/'; ?>",
                'input_wrapper' : 'p',
                'id_edit_button' : 'edit-contact',
                'validation' : true,
                'formToValidate' : 'perso-info-form',
                'validation_success_class' : 'kb-validation-checked',
                'validation_error_class' : 'kb-validation-error',
                'validation_status_element' : 'span.pcp'
            });   
        });
        
        $("#edit-social").click(function(){
            $("#edit-social").kb_edit({
                  	 	 	
                'inputs' : 'gravatar|msn|yahoo|gmail|twitter|facebook',
                'url'    :  BASE_URL + 'dashboard/profil/update/4', 
                'save_icon' : BASE_URL + "<?php echo THEME_PATH . 'img/ok.png'; ?>",
                'cancel_icon' : BASE_URL + "<?php echo THEME_PATH . 'img/cancel.png'; ?>",
                'loader_path' : BASE_URL + "<?php echo THEME_PATH . 'img/'; ?>",
                'input_wrapper' : 'p',
                'id_edit_button' : 'edit-social',
                'validation' : true,
                'formToValidate' : 'perso-info-form',
                'validation_success_class' : 'kb-validation-checked',
                'validation_error_class' : 'kb-validation-error',
                'validation_status_element' : 'span.psn'
            });   
        });
    });
</script>
