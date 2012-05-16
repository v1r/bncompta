<div class="dynamic_content">   
    <?php if (empty($accounting_year)) : ?>
        <div class="empty-notification id="tabs-1">
             <h2>Oh mon dieu ! vous n'avez pas encore créer un exercice comptable..<a href="accounting/accounting_year/add">Créer un maintenant !</a> </h2>
        </div>
    <?php else: ?>
        <?php foreach ($accounting_year as $key) : ?>
            <div class="ui-tabs-panel <?php echo ($key->id == $this->current_accounting_year_id) ? 'ui-widget-content-active' : 'ui-widget-content'; ?> ui-corner-bottom ui-tabs-hide"  id="tabs-1">
                <div id="accounting">
                    <div class="col1">
                        <h2><?php echo $key->label; ?></h2>
                        <hr/>
                        <p><?php echo $key->description; ?></p>
                        <a class="black large colorbutton" href="#">Consulter</a>
                        <a class="black large colorbutton"  id="open" href="accounting/accounting_year/open/<?php echo $key->id; ?>" ><?php echo lang('common.open_label'); ?></a>
                        <?php if ($key->id == $this->current_accounting_year_id) : ?>
                            <a class="gray large colorbutton" id="edit" href="accounting/accounting_year/edit/<?php echo $key->id; ?>">
                                <?php echo lang('common.edit_label'); ?>   
                            </a>
                        <?php endif; ?>   
                        <?php if ($key->is_default == 0) : ?>
                            <a class="green large colorbutton" id="default" href="accounting/accounting_year/activate_accounting_year/<?php echo $key->id; ?>">
                                <?php echo lang('common.is_default_label'); ?></a>
                        <?php else : ?>
                            <a class="red large colorbutton" id="desactivate" href="accounting/accounting_year/desactivate_accounting_year/<?php echo $key->id; ?>">
                                <?php echo lang('common.desactivate_label'); ?></a>
                        <?php endif; ?>
                    </div>
                    <div class="col2">
                        <div class="box">
                            <p class="box-small"><strong><?php echo lang('common.start_date_label'); ?></strong> : <?php echo date('d-m-Y', $key->start_date); ?></em></p>
                            <p  class="box-small"><strong>  <?php echo lang('common.end_date_label'); ?></strong> : <?php echo date('d-m-Y', $key->end_date); ?></em></p>
                            <p  class="box-small"><strong>  <?php echo lang('common.status_label'); ?></strong>
                                <em <?php echo ($key->closed == 0 ) ? 'style="color:green;"' : 'style="color:red;"'; ?>> : <?php echo ($key->closed == 0 ) ? lang('accounting_year.editable_label') : lang('accounting_year.closed_label'); ?></em>
                            </p>
                            <p  class="box-small"><strong>  <?php echo lang('common.is_default_label'); ?></strong>
                                <em <?php echo ($key->is_default == 1 ) ? 'style="color:green;"' : 'style="color:red;"'; ?>> : <?php echo ($key->is_default == 1 ) ? lang('common.yes_label') : lang('common.no_label'); ?></em>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
            <br/>
        <?php endforeach; ?>
    <?php endif; ?>
</div> 