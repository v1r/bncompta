<div class="dynamique_content">
    <h2><?php echo lang('core.modules_list_modules_label'); ?></h2>
    <hr />
 
        <h4><?php echo lang('core.modules_installed_modules_label'); ?></h4>
        <div id="tabs-2">
            <table class="fullwidth" cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th><?php echo lang('core.common_name_label'); ?></th>
                        <th><?php echo lang('core.common_description_label'); ?></th>
                        <th><?php echo lang('core.common_actions_label'); ?></th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $i = 0;
                    foreach ($installedModules as $module => $key):
                        foreach ($key as $k) :
                            ?>
                            <tr <?php
                echo ($i % 2) ? 'class="odd" ' : ' ';
                $i++
                            ?>>
                                <td><?php echo lang((string)$k['title']) ; ?></td>
                                <td><?php echo  lang((string)$k['description']) ; ?></td>
                                <td>
                                    <a class="black large colorbutton" href="#">Action#1 Action#2</a>
                                </td>   
                            </tr>      
                            <?php
                        endforeach;
                    endforeach;
                    ?>

                </tbody>
            </table>
        </div>       
</div>

