<div id="accordion"> 
            <?php if ($user_information->group_id == 2): ?>  
                <h3><a href="#" class="tooltip"><?php echo lang('accounting.accounting_year_menu_title'); ?></a></h3>
                <ul id="accounting">
                    <li><a id="accounting-dashboard" href="accounting/accounting_year"><?php echo lang('accounting.account_year_dashboard_label'); ?></a></li>
                    <li><a id="new" href="accounting/accounting_year/add"><?php echo lang('common.new_label'); ?></a></li>
                    <?php if (!empty($accounting_year) AND $this->current_accounting_year_id != FALSE) : ?>
                        <li><a id="edit" href="accounting/accounting_year/edit/<?php echo $this->current_accounting_year_id; ?>"><?php echo lang('common.edit_label'); ?></a></li>
                        <li><a id="close" href="accounting/accounting_year/close/<?php echo $this->current_accounting_year_id; ?>"><?php echo lang('common.close_label'); ?></a></li>
                        <li><a href="accounting/accounting_year"><?php echo lang('common.delete_label'); ?></a></li>
                    <?php endif; ?>
                </ul>  
                <h3><a href="#" class="tooltip"><?php echo lang('accounting.bank_statements_menu_title'); ?></a></h3>
                <ul>
                    <?php foreach ($modules as $module_name => $attribute) :
                        if ($modules[$module_name]->menu == 'accounting') : ?>
                            <li><a href=""><?php echo $attribute->title['fr']; ?></a></li>
                        <?php endif;
                    endforeach; ?>
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

<?php if (is_ajax()) : ?>
    <script type="text/javascript" src="<?php echo THEME_PATH; ?>js/custom.js"></script>
<?php endif; ?>