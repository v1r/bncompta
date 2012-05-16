<div id="tabs-2">
    <?php if ($manager_data->count() > 0) : $i = 0; ?>
        <table class="fullwidth" cellpadding="0" cellspacing="0" border="0">
            <thead>
                <tr>
                    <th><?php echo lang('common_first_name_label'); ?></th>
                    <th><?php echo lang('common_email_label'); ?></th>
                    <th><?php echo lang('common_username_label'); ?></th>
                    <th><?php echo lang('common_created_on_label'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($manager_data as $key): ?>
                    <tr <?php echo ($i % 2) ? 'class="odd" ' : ' ';
            $i++ ?>>
                    <tr>
                        <td><?php echo $key->first_name . ' ' . $key->last_name; ?> 
                            <p><a href="permissions/manage/switch_permission_mode/<?php echo $key->user_id; ?>"> <?php echo lang('common.test_user_permission_label'); ?></p></span>
                        </td>
                        <td><?php echo $key->email; ?></td>
                        <td><?php echo $key->username; ?></td>
                        <td><?php echo date('d, M, Y', $key->created_on); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table
        <hr/>
    <?php else : ?>
        <div class="empty-notification" id="tabs-1">
             <h2><?php echo lang('empty_no_managers_list'); ?></h2>
        </div>
    <?php endif; ?>
</div>


<!-- End of Second tab -->


