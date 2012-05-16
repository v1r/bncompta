<script type="text/javascript">		
    
    $(document).ready(function() {
        /*
         *   Examples - images
         */

        $("a#example1").fancybox({
            'width'		        : '800',
            'height'			: '700',
            'autoDimensions'            : false,
            'overlayOpacity'            : 0.9
        }
    );
    });</script>


<div id="loader"></div>
<div class="pad20">

    <h1><?php echo lang('permissions.manage_permissions_label');?></h1>
    <div id="tabs-2">
        <table class="fullwidth" cellpadding="0" cellspacing="0" border="0">
            <thead>
                <tr>
                    <td><?php echo lang('common_name_label');?></td>
                    <td><?php echo lang('common_manager_name_label');?></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>

                <?php if ($entreprises_data->count() > 0) :
                    foreach ($entreprises_data as $key): ?> 
                        <tr class="odd_class">
                            <td><?php echo $key->name; ?></td>
                            <td><?php echo(isset($manager_name[$key->id]->first_name)) ? '<span>' . $manager_name[$key->id]->first_name . ' ' . $manager_name[$key->id]->last_name . '</span>' : lang('entpreprises_no_manager_assigned'); ?></td>
                            <td><a class="button_actions action-button" id="example1" href="permissions/manage/entreprises/<?php echo $key->id; ?>"><?php echo lang('common_edit_label'); ?></td>
                        </tr>                     
                    <?php endforeach;
                endif; ?> 

            </tbody>
        </table>
    </div>
</div>


