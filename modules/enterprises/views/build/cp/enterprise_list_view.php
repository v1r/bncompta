<div id="assign_manager">
    <p><?php echo lang('entreprises.select_manager_label'); ?></p>
    <select id="select_manager" class="select_medium">
        <option value="none">#Pas de gérant</option>
        <?php foreach ($available_managers as $values) : ?>

            <option value="<?php echo $values->user_id; ?>"><?php echo $values->first_name . ' ' . $values->last_name; ?></option>
        <?php endforeach; ?>
    </select>
</div>
<?php if ($entreprises_data->count() > 0) : ?>
    <h2><?php echo lang('entreprise_list_label'); ?></h2>
    <hr/>
    <div id="tabs-2">
        <table class="fullwidth" cellpadding="0" cellspacing="0" border="0">
            <thead>
                <tr>
                    <td><?php echo lang('common_name_label'); ?></td>
                    <td><?php echo lang('common_email_label'); ?></td>
                    <td><?php echo lang('common.description_label'); ?></td>
                    <td><?php echo lang('common_created_on_label'); ?></td>
                    <td><?php echo lang('common_manager_name_label'); ?></td>
                    <td><?php echo lang('common_actions_label'); ?></td>
                    <td><?php echo lang('common_assign_label'); ?></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($entreprises_data as $key): ?>
                    <tr class="odd_class_<?php echo $key->id; ?>">
                <input type="hidden" name="id" value="<?php echo $key->id; ?>"/>
                <td><input  style="display:none; " name="name"  value="<?php echo $key->name; ?>"  /><span><?php echo $key->name; ?></span></td>
                <td><input   style="display:none;" name="email" value="<?php echo $key->email; ?>"  /><span><?php echo $key->email; ?></span></td>
                <td><input   style="display:none;" name="description" value="<?php echo $key->description; ?>"  /><span><?php echo $key->description; ?></span></td>
                <td><input   style="display:none;" name="created_on" value="<?php echo date('d, M, Y', $key->created_on); ?>"  /><span><?php echo date('d, M, Y', $key->created_on); ?></span></td>
                <td>
                    <?php echo(isset($manager_name[$key->id]->first_name)) ? '<span>' . $manager_name[$key->id]->first_name . ' ' . $manager_name[$key->id]->last_name . '</span>' : lang('entpreprises_no_manager_assigned'); ?>
                </td>
                <td>
                    <a class="black large colorbutton" href="entreprises/manage/edit/<?php echo $key->id; ?>"><?php echo lang('common.edit_label'); ?></a>
                    <a class="black large colorbutton" href="entreprises/manage/delete/<?php echo $key->id; ?>"><?php echo lang('common.delete_label'); ?></a>
                </td>
                <td><img id="assign_manager_<?php echo $key->id; ?>"
                         src="<?php echo base_url() . THEME_PATH . 'img/assign.png'; ?>"  onclick="assign(<?php echo $key->id; ?>);"/></td>     
                </tr>
            <?php endforeach; ?>
            <tr class="odd">
                <td colspan="6"><?php echo lang('empty_no_managers_list');
            ?></td>
            </tr>
            </tbody>
        </table>
    </div>
    <?php else : ?>
    <div class="empty-notification id="tabs-1">
         <h2><?php echo lang('empty_entreprises_list'); ?></h2>
    </div>
<?php endif; ?>
<script type="text/javascript">
    var enabled = true;
    function edit(id)
    {
        if(enabled) {
            enabled = false;
            $("#edit" + id).kb_edit({
                'inputs' : 'id|name|email|description',
                'url'    :  BASE_URL + 'entreprises/manage/ajax_update', 
                'save_icon' : BASE_URL + "<?php echo THEME_PATH . 'img/ok.png'; ?>",
                'cancel_icon' : BASE_URL + "<?php echo THEME_PATH . 'img/cancel.png'; ?>",
                'loader_path' : BASE_URL + "<?php echo THEME_PATH . 'img/'; ?>",
                'modal' : true,
                'parent_input_wrapper' : 'tr',
                'input_wrapper' : 'td',
                'id_edit_button' : 'edit'
            });   
        }
    }
        
    $("#assign_manager").hide();
    function assign(entreprise_id) { 
            
        $("#assign_manager").dialog({
            modal: true,
            buttons: {
                "Ok": function() {
                     
                    $(this).dialog("close");
                },
                "Cancel": function() {
                    $(this).dialog("destroy");
                }
            },
            close: function(event, ui) {
     
                window.location = BASE_URL + 'entreprises/manage/assign/'+ entreprise_id +'/' + $("#select_manager").val();
     
            }
                   
        });
    }
</script>

