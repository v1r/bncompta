<h2><?php echo $this->lang->line('welcome_message', '<span>' . $full_name . '</span>'); ?></h2>
<hr />
<div class="dashboard_menu_icons">
    <!-- Big buttons -->
    <h2><?php echo lang('common_dashboard_heading'); ?></h2>
    <ul class="dash">
        <?php
        if ($user_information->group_id == 2):
            foreach ($modules as $module_name => $attribute) :
                if ($modules[$module_name]->type === 'mod_manager') :
                    ?>
                    <li>
                        <a href="<?php echo $modules[$module_name]->name . '/manage/'; ?>" id="menu1" title="<?php echo $module_description[$module_name][$user_information->default_lang]; ?>" class="tooltip">
                            <img src="<?php echo base_url() . THEME_PATH; ?><?php echo $modules[$module_name]->icon_path; ?>" alt="" />
                            <span><?php echo $module_title_description[$module_name][$user_information->default_lang]; ?></span>
                        </a>
                    </li>
                <?php
                endif;
            endforeach;
        endif;
        ?>
<?php foreach ($entreprise_modules as $module_name => $value) : ?>
            <li>
                <a href="<?php echo $entreprise_modules[$module_name]->name . '/manage/'; ?>" id="menu1" title="<?php echo $module_description[$value->name][$user_information->default_lang]; ?>" class="tooltip">
                    <img src="<?php echo base_url() . THEME_PATH; ?><?php echo $entreprise_modules[$module_name]->icon_path; ?>" alt="" />
                    <span><?php echo $module_title_description[$value->name][$user_information->default_lang]; ?></span>
                </a>
            </li>
<?php endforeach; ?>

    </ul>
</div>
