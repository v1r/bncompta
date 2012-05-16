<?php $this->load->view('tpl/navigation_view'); ?>
<div class="pad20">
    <h2><?php echo lang('managers_list_label'); ?></h2>
    <hr/>
    <?php foreach ($this->entreprise_data as $values) : ?>
        <div id="tabs-2">
            <h2><?php echo lang('common_entreprise_name_label') . '#' . $values->name; ?></h2>
            <table class="fullwidth" cellpadding="0" cellspacing="0" border="0">

                <thead>
                    <tr>
                        <th><?php echo lang('common_first_name_label'); ?></th>
                        <th><?php echo lang('common_email_label'); ?></th>
                        <th><?php echo lang('common_username_label'); ?></th>
                        <th><?php echo lang('common_created_on_label'); ?></th>
                        <th><?php echo lang('common_group_label'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($users_data) > 0) : $i = 0;
                        foreach ($users_data[$values->id] as $key):
                            ?>

                            <tr <?php echo ($i % 2) ? 'class="odd" ' : ' ';
                $i++ ?>>
                            <tr>
                                <td><?php echo $key->first_name . ' ' . $key->last_name; ?> 
                                    <p><a href="permissions/manage/switch_permission_mode/<?php echo $key->user_id; ?>"> <?php echo lang('common.test_user_permission_label'); ?></p></span>
                                </td>
                                <td><?php echo $key->email; ?></td>
                                <td><?php echo $key->username; ?></td>
                                <td><?php echo date('d, M, Y', $key->created_on); ?></td>
                                <td><?php echo $key->group_name; ?></td>
                            </tr>
                            <?php
                        endforeach;
                    else :
                        ?>
                        <tr class="odd">
                            <td colspan="6"><?php echo lang('empty_no_managers_list'); ?></td>
                        </tr>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>
    <?php endforeach; ?> 
</div>


