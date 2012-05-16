<h1>installation du logiciel</h1>
<div id="tabs-1">
    <fieldset>
        <div class="col600">
            <?php echo form_open($this->uri->uri_string()); ?> 								
            <h2>Etape 2 : Configuration de la base de donnee</h2>
            <p> Veuillez indiquer le nom de la base de donnees. </p>
            <hr>
            <p><label>Nom de la base :</label>
                <input name="database" id="database" value="<?php echo $repopulate->database; ?>"/>
            </p>
            <hr/>
            <h2>Administrateur du systeme</h2>
            <p>Veuillez remplir les champs avec les information necessaires pour se connecter a l'application.</p>
            <hr/>
            <p><label>Pseudonyme  :</label>
                <input name="username" id="username" value="<?php echo $repopulate->username; ?>"/>
            </p>
            <p>
                <label>Nom</label>
                <input name="firstname" id="firstname" value="<?php echo $repopulate->firstname; ?>"/>
            </p>
            <p>
                <label>Prenom</label>
                <input name="lastname" id="lastname" value="<?php echo $repopulate->lastname; ?>"/>
            </p>
            <p><label>Email  :</label>
                <input name="email" id="email" value="<?php echo $repopulate->email; ?>"/>
            </p>
            <p>
                <label>Mot de passe :</label>
                <input name="password" type="password" id="password" value="<?php echo $repopulate->password; ?>"/>
            </p>
            <p>
                <label>Confirmation du mot de passe :</label>
                <input name="confirm_password"  type="password" id="confirm_password" value="<?php echo $repopulate->confirm_password; ?>"/>
            </p>

            <input type="submit" value="Etape 3" />
        </div>
        <div class="col300">
            <?php if (validation_errors()):// In errors case  ?>
                <h2><?php echo lang('error_label'); ?></h2>
                <p><?php echo lang('error_message_label'); ?></p>
                <div class="error_list">
                    <?php echo validation_errors(); ?>
                    <?php echo form_error('test_connection'); ?>
                </div>
            <?php endif; ?>
            <div id="messageBox1"> 
                <ul></ul> 
            </div> 
        </div>
</div>
</fieldset>