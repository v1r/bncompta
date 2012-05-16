<h1>Bienvenue dans le guide d'installation du logiciel BNCOMPTA</h1>
<div id="tabs-1">
        <fieldset>
            <div class="col600">
                <?php echo form_open($this->uri->uri_string()); ?> 								
                <h2>Etape 1 : Configuration du serveur de la base de donnees</h2>
                <p> Afin de verifier la base de donnee, il faudrait que l'installeur sache dans quel serveur elle se trouve et details de connexion. </p>
                <hr>
                <p><label>Nom de l'hôte :</label>
                    <input name="host" id="host" value="<?php echo $repopulate->host; ?>"/>
                </p>
                <p><label>Utilisateur :</label>
                    <input name="username" id="username" value="<?php echo $repopulate->username; ?>"/>
                </p>
                <p>
                    <label>Mot de passe :</label>
                    <input name="password" id="password" value="<?php echo $repopulate->password; ?>"/>
                </p>
                <p>
                    <label>Port</label>
                    <input name="port" id="port" value="3306"/>
                </p>
                <input type="submit" value="Etape 2" />
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

        </fieldset>
</div>