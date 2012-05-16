 
        <?php if ($this->session->flashdata('error')) : ?>
            <div class="message error close">
                <h2><?php echo lang('error_label'); ?></h2>
                <p><?php echo $this->session->flashdata('error'); ?></p>
            </div>
        <?php endif; ?>
        <table class="fullwidth" cellpadding="0" cellspacing="0" border="0">
            <thead>
                <tr>
                    <td><?php echo lang('common_first_name_label'); ?></td>
                    <td><?php echo lang('common_email_label'); ?></td>
                    <td><?php echo lang('common_username_label'); ?></td>
                    <td><?php echo lang('common_created_on_label'); ?></td>
                    <td><?php echo lang('common_actions_label'); ?></td>
                </tr>
            </thead>
            <tbody>
                <?php if (count($users_data) > 0) : $i = 0;
                    foreach ($users_data as $key): ?>
                        <tr <?php echo ($i % 2) ? 'class="odd" ' : ' ';
                $i++ ?>>
                            <td><?php echo $key->first_name . ' ' . $key->last_name; ?> </td>
                            <td><?php echo $key->email; ?></td>
                            <td><?php echo $key->username; ?></td>
                            <td><?php echo date('d, M, Y', $key->created_on); ?></td>
                            <td><a class="black large colorbutton" href="users/manage/edit/<?php echo $key->user_id; ?>"><?php echo lang('common.edit_label'); ?></a></td>
                        </tr>
                        
                    <?php endforeach;
                else : ?>
                    <tr class="odd">
                        <td colspan="6"><?php echo lang('empty_no_managers_list'); ?></td>
                    </tr>
                <?php endif; ?>

            </tbody>
        </table>
 
<!-- End of Second tab -->
