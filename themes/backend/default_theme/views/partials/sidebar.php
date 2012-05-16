<div class="logo"> 
    <a href="#" title="Administration Home" ><img src="<?php echo THEME_PATH; ?>img/logo.png"/></a> 
</div>
<?php if ($this->session->userdata('ghost_permission')) : ?>
    <p style="margin-left:60px;"><a href="permissions/manage/restore_permission" ><?php echo lang('common.restore_permission_label'); ?> </a></p>
<?php endif; ?>
<div id="sidebar">
    <h2><?php echo lang('navigation_menu_title'); ?></h2>
    <div id="accordion">
        <h3><a href="#"  ><?php echo lang('common_users_label'); ?></a></h3>
        <ul>
        </ul>
        <h3><a href="#"  ><?php echo lang('common_entreprises_label'); ?></a></h3>
        <ul>
        </ul>
        <h3><a href="#"  ><?php echo lang('settings_menu_title'); ?></a></h3>
        <ul>
        </ul>



    </div>   

</div>

<!-- fin  Sidebar -->
