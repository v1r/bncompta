<div id="tabs-1">
    <fieldset>
        <h1>Etape 3 - Verification des permissions d'ecritures</h1>
        <p>Avant de procéder à l'installation, veuillez vous assurer  que les fichiers et les répertoires suivantes sont inscriptibles.</p>

        <h2>Repertoires</h2>
        <hr/>

        <?php foreach ($folders_permissions as $dir => $value): ?>
            <?php
            ($value == 1 ) ? $status = '<span style="color:green;">[ Inscriptible ] </span>' : $status = '<span style="color:red;">[ Non inscriptible ]</span>';
            ($value == 0 ) ? $folder_ready = false : $folder_ready = true;
            ?>
            <p><img src="<?php echo THEME_PATH . 'img/folder.png'; ?>" /> <?php echo base_url() . $dir . '  ' . $status; ?></p>
        <?php endforeach; ?>
        <h2>Fichier de configuration</h2>
        <hr/>
        <?php foreach ($files_permissions as $dir => $value): ?>
            <?php
            ($value == 1 ) ? $status = '<span style="color:green;">[ Inscriptible ] </span>' : $status = '<span style="color:red;">[ Non inscriptible ]</span>';
            ($value == 0 ) ? $file_ready = false : $file_ready = true;
            ?>
            <p><img src="<?php echo THEME_PATH . 'img/folder.png'; ?>" /> <?php echo base_url() . $dir . '  ' . $status; ?></p>

        <?php endforeach; ?>
        <?php if($folder_ready AND $file_ready): ?> 
        <?php echo form_open($this->uri->uri_string()); ?> 
        <input hidden name="do_install" />
        <input type="submit" value="Installer" />
        <?php else : ?>
        <p style="color:red;">Veuillez adjuster le chmod des dossiers et des fichiers et rafraichier la page.</p>
        <?php endif; ?>
    </fieldset>