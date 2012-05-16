
<?php
$folder = './installation';
if (is_dir($folder)) :
    ?>
    <div class="WarningWrapper WarningMessageWrapperRight BNC">
        <div class="dockWarning">
            Veuillez supprimer le dossier d'installation!
        </div>
    </div>
<?php endif; ?>
<div id="header">
    <div id="top">
        <div class="meta">
            <ul>
                <li><a href="logout" title="<?php echo $this->lang->line('logout_alt_title'); ?>" ><span class="ui-icon ui-icon-power"></span><?php echo $this->lang->line('logout_label'); ?></a></li>
                <li><a href="dashboard/settings" title="<?php echo $this->lang->line('settings_alt_title'); ?>" ><span class="ui-icon ui-icon-wrench"></span><?php echo $this->lang->line('settings_label'); ?></a></li>
                <li><a href="dashboard/profil" title="<?php echo $this->lang->line('profile_alt_title'); ?>" ><span class="ui-icon ui-icon-person"></span><?php echo $this->lang->line('profile_label'); ?></a></li>
            </ul>
        </div>				
    </div>

    <div id="navbar">
        <ul class="nav">
            <li><a href="#"><img class="dash" src="<?php echo base_url() . THEME_PATH; ?>img/icons/home.png" alt=" <?php echo lang('dashboard_menu_title'); ?>" title=" <?php echo lang('dashboard_menu_title'); ?>"/></a></li>
            <li><a href="entreprises/manage">Site</a>
                <ul>
                    <li><a>Tableau de bord</a></li>
                    <li><a>Gestion des utilisateurs</a></li>
                    <li><a>Configuration Generale</a></li>
                    <li><a>Deconnexion</a></li>
                </ul>
            </li>

            <li><a href="#">
                    <?php echo lang('modules_menu_title'); ?>
                </a>
            </li>

            <li><a href="entreprises/manage">Outils</a></li>
            <li><a href="entreprises/manage">Aide</a></li>
        </ul>
    </div>
</div>
