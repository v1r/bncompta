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
    <div class="dynamic-sidebar">
        <div id="accordion"> 
            <?php if ($user_information->group_id == 2): ?>  
                <h3><a href="#" class="tooltip"><?php echo lang('accounting.accounting_year_menu_title'); ?></a></h3>
                <ul id="accounting">
                    <li><a id="accounting-dashboard" href="accounting/accounting_year"><?php echo lang('accounting.account_year_dashboard_label'); ?></a></li>
                    <li><a id="new" href="accounting/accounting_year/add"><?php echo lang('common.new_label'); ?></a></li>
                    <?php if (!empty($accounting_year) AND $this->current_accounting_year_id != FALSE) : ?>
                        <li><a id="edit" href="accounting/accounting_year/edit/<?php echo $this->current_accounting_year_id; ?>"><?php echo lang('common.edit_label'); ?></a></li>
                        <li><a id="close" href="accounting/accounting_year/close/<?php echo $this->current_accounting_year_id; ?>"><?php echo lang('common.close_label'); ?></a></li>
                        <li><a id="delete" href="accounting/accounting_year/delete/<?php echo $this->current_accounting_year_id; ?>"><?php echo lang('common.delete_label'); ?></a></li>
                    <?php endif; ?>
                </ul>  
                <h3><a href="#" class="tooltip"><?php echo lang('accounting.bank_statements_menu_title'); ?></a></h3>
                <ul id="bank_statements">
                    <li><a href="accounting/bank_statements"><?php echo lang('accounting.bank_statements_list_label'); ?></a></li>
                    <li><a href="accounting/bank_statements/add"><?php echo lang('common.new_label'); ?></a></li>
                </ul>  
                <h3><a href="#" class="tooltip"><?php echo lang('accounting.expenditures_menu_title'); ?></a></h3>
                <ul>
                    <?php foreach ($modules as $module_name => $attribute) :
                        if ($modules[$module_name]->menu == 'accounting') : ?>
                            <li><a href=""><?php echo $attribute->title['fr']; ?></a></li>
                        <?php endif;
                    endforeach; ?>
                </ul>  
                <h3><a href="#" class="tooltip"><?php echo lang('accounting.incomes_menu_title'); ?></a></h3>
                <ul>
                    <?php foreach ($modules as $module_name => $attribute) :
                        if ($modules[$module_name]->menu == 'accounting') : ?>
                            <li><a href=""><?php echo $attribute->title['fr']; ?></a></li>
                        <?php endif;
                    endforeach; ?>
                </ul>  

            <?php endif; ?>        
        </div>   
    </div> 
</div>
<?php $this->load->view('tpl/accounting_year/dynamic_script');?>