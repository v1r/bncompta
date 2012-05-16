<div class="logo"> 
    <a href="#" title="Administration Home" ><img src="<?php echo THEME_PATH; ?>img/logo.png"/></a> 
</div>
<?php if ($this->session->userdata('ghost_permission')) : ?>
    <p style="margin-left:60px;"><a href="permissions/manage/restore_permission" ><?php echo lang('common.restore_permission_label'); ?> </a></p>
<?php endif; ?>
<!-- Sidebar -->
<div id="sidebar">
    <!-- Logo -->

    <!-- Lists -->
    <h2><?php echo lang('navigation_menu_title'); ?></h2>
    <div id="accordion">
        <?php if ($user_information->group_id == 1): ?> 
            <h3><a href="#"  ><?php echo lang('common_users_label'); ?></a></h3>
            <ul>
                <?php
                foreach ($modules as $module_name => $attribute) :
                    if ($modules[$module_name]->menu == 'users' AND $modules[$module_name]->type === 'mod_admin') :
                        ?>
                <?php // @TODO : Get methods dynamicaly, for now add them manually ?>
                        <li>
                            <a href="<?php echo $modules[$module_name]->name . '/manage'; ?>" >
                                <?php echo lang('common_' . $modules[$module_name]->name . '_label'); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            <h3><a href="#"  ><?php echo lang('common_entreprises_label'); ?></a></h3>
            <ul>
                <?php
                foreach ($modules as $module_name => $attribute) :
                    if ($modules[$module_name]->menu == 'entreprises') :
                        ?>
                        <li>
                            <a href="<?php echo $modules[$module_name]->name . '/manage'; ?>" >
                                <?php echo lang('common_' . $modules[$module_name]->name . '_label'); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            <h3><a href="#"  ><?php echo lang('settings_menu_title'); ?></a></h3>
            <ul>
                <?php
                foreach ($modules as $module_name => $attribute) :
                    if ($modules[$module_name]->has_settings == 1) :
                        ?>
                        <li>
                            <?php if ($modules[$module_name]->name === 'settings') : ?>
                                <a href="<?php echo $modules[$module_name]->name . '/manage'; ?>" >
                                    <?php echo lang('common_' . $modules[$module_name]->name . '_label'); ?>
                                </a>
                            <?php else: ?>
                                <a href="<?php echo $modules[$module_name]->name . '/settings'; ?>" >
                                    <?php echo lang('common_' . $modules[$module_name]->name . '_label'); ?>
                                </a>
                            <?php endif; ?>
                        </li>
                    <?php endif;
                endforeach; ?>
            </ul>



        <?php endif; ?>  
        <?php if ($user_information->group_id == 2): ?>  
            <h3><a href="#" class="tooltip"><?php echo lang('common_general_menu'); ?></a></h3>
            <ul>
                <li><a href="index.php"><?php echo lang('dashboard_menu_title'); ?></a></li>
                <li><a href="logout"><?php echo lang('common_logout_label'); ?></a></li>
            </ul>  
            <h3><a href="#" class="tooltip"><?php echo lang('common_my_entreprises'); ?></a></h3>
            <ul>
                <?php if (empty($my_entreprises)) : ?>
                    <p style="font-size:10px;"><?php echo lang('common.no_entreprises_label');?></p>
                <?php else: ?>
                    <?php foreach ($my_entreprises as $key => $value) : ?>
                        <li><a href="javascript:void(0);" onclick="browse_entreprise(<?php echo $my_entreprises[$key]->id; ?>)"><?php echo $my_entreprises[$key]->name; ?></a></li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>  

        <?php endif; ?>        

    </div>   

</div>

<!-- fin  Sidebar -->
