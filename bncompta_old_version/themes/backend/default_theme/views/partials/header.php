<?php if ($this->setting->site_status == 1) : ?>
    <div class="WarningWrapper WarningMessageWrapperRight BNC">
        <div class="dockWarning">
            <?php echo lang('common_offline_site_warning'); ?>
        </div>
    </div>
<?php endif; ?>
<?php $folder = './installation';
if (is_dir($folder)) : ?>
    <div class="WarningWrapper WarningMessageWrapperRight BNC">
        <div class="dockWarning">
            Veuillez supprimer le dossier d'installation!
        </div>
    </div>
<?php endif; ?>
<!-- Header -->
<div id="header">
    <!-- Top -->
    <div id="top">
        <!-- Fin Logo -->
        <!-- Meta informations -->
        <div class="meta">
            <ul>
                <li><a href="logout" title="<?php echo $this->lang->line('logout_alt_title'); ?>" ><span class="ui-icon ui-icon-power"></span><?php echo $this->lang->line('logout_label'); ?></a></li>
                <li><a href="dashboard/settings" title="<?php echo $this->lang->line('settings_alt_title'); ?>" ><span class="ui-icon ui-icon-wrench"></span><?php echo $this->lang->line('settings_label'); ?></a></li>
                <li><a href="dashboard/profil" title="<?php echo $this->lang->line('profile_alt_title'); ?>" ><span class="ui-icon ui-icon-person"></span><?php echo $this->lang->line('profile_label'); ?></a></li>
            </ul>
        </div>
        <!-- Fin Meta information -->					
    </div>
    <!-- Fin Top-->
    <!-- The navigation bar -->
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
            <?php if ($this->logged_in_user->group_id == 1) : ?>
                <li><a href="#">
                        <?php echo lang('modules_menu_title'); ?>
                    </a>
                    <ul>
                        <?php foreach ($modules as $module_name => $attribute) : ?>
                            <?php if ($modules[$module_name]->name !== 'settings') : ?>
                                <?php if ($modules[$module_name]->type == 'mod_admin') : ?>
                                    <?php if (count($controller_data[$attribute->name]) == 1) : ?>
                                        <li>
                                            <a href="<?php echo $modules[$module_name]->name . '/' . $modules[$module_name]->home_controller; ?>" >
                                                <?php echo $module_title_description[$module_name][$user_information->default_lang]; ?>
                                            </a>
                                        </li>
                                    <?php else : ?>
                                        <li>
                                            <a href="#" >
                                                <?php echo $module_title_description[$module_name][$user_information->default_lang]; ?>
                                            </a>

                                            <ul class="sub">
                                                <?php foreach ($controller_data[$attribute->name] as $key => $value) : ?>
                                                    <?php foreach ($value as $k => $v) : ?>
                                                        <li><a href="<?php echo $attribute->name . '/' . $k; ?>"><?php echo lang($attribute->lang_file_name . '.' . $k . '_action_label'); ?></a></li>
                                                    <?php endforeach; ?>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>

                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li><a href="entreprises/manage">Outils</a></li>
            <?php endif; ?>

            <?php if ($this->logged_in_user->group_id == 2 AND $this->current_segment !== 'dashboard/home') : ?> 
                <li><a href="#">
                        <?php echo lang('modules_menu_title'); ?>
                    </a>
                    <ul>
                        <?php foreach ($modules as $module_name => $attribute) : ?>
                            <?php if ($modules[$module_name]->name !== 'settings') : ?>
                                <?php if ($modules[$module_name]->type == 'mod_manager' OR $modules[$module_name]->type == 'mod_entreprise') : ?>
                                    <?php if (count($controller_data[$attribute->name]) == 1) : ?>
                                        <li>
                                            <a href="<?php echo $modules[$module_name]->name . '/' . $modules[$module_name]->home_controller; ?>" >
                                                <?php echo $module_title_description[$module_name][$user_information->default_lang]; ?>
                                            </a>
                                        </li>
                                    <?php else : ?>
                                        <li>
                                            <a href="#" >
                                                <?php echo $module_title_description[$module_name][$user_information->default_lang]; ?>
                                            </a>

                                            <ul class="sub">
                                                <?php foreach ($controller_data[$attribute->name] as $key => $value) : ?>
                                                    <?php foreach ($value as $k => $v) : ?>
                                                        <li><a href="<?php echo $attribute->name . '/' . $k; ?>"><?php echo lang($attribute->lang_file_name . '.' . $k . '_action_label'); ?></a></li>
                                                    <?php endforeach; ?>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>

                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <li><a href="entreprises/manage">Aide</a></li>
        </ul>
    </div>
    <!-- Fin navigation bar" -->


</div>
<!-- Fin Header -->