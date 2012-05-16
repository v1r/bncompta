<div class="dynamique_content">
    <h2><?php echo lang('mods_list_modules_label'); ?></h2>
    <hr />
    <?php if (!empty($not_installed_modules)) : ?> 
        <h4><?php echo lang('mods_modules_not_installed'); ?></h4>
        <div id="tabs-2">
            <table class="fullwidth" cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th><?php echo lang('common_name_label'); ?></th>
                        <th><?php echo lang('common.description_label'); ?></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0;
                    foreach ($not_installed_modules as $module => $key): ?>
                        <tr <?php echo ($i % 2) ? 'class="odd" ' : ' ';
                $i++ ?>>
                            <td><?php echo $key[$module]['title']->fr; ?></td>
                            <td><?php echo $key[$module]['description']->fr; ?></td>
                            <td>
                               <a class="black large colorbutton" href="<?php echo 'modules/manage/install/' . $module; ?>">Installer</a>
                            </td>   
                        </tr>              
                    <?php endforeach; ?> 
                </tbody>
            </table>
        </div>
        <hr />
    <?php endif; ?>
    <h4><?php echo lang('mods_addon_modules'); ?></h4>
    <div id="tabs-2">
        <table class="fullwidth" cellpadding="0" cellspacing="0" border="0">
            <thead>
                <tr>
                    <th><?php echo lang('common_name_label'); ?></th>
                    <th><?php echo lang('common.description_label'); ?></th>
                    <th><?php echo lang('common.active_label'); ?></th>
                    <th><?php echo lang('common_type_label'); ?></th>
                    <th><?php echo lang('common_actions_label'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($this->module_data as $module):
                    if (!$module->is_core):
                        ?> 
                        <tr <?php echo ($i % 2) ? 'class="odd" ' : ' ';
                $i++ ?>>
                            <td><?php echo $module_title_description[$module->name]['fr']; ?></td>
                            <td><?php echo $module_description[$module->name]['fr']; ?></td>
                            <td><?php
                    echo(($module->enabled) ?
                            '<a id="active-inactive' . $module->id . '" href="javascript:update_module_status(' . $module->id . ',0)"><img id="active_status' . $module->id . '" src="' . base_url() . THEME_PATH . 'img/ok.png" /></a>' :
                            '<a id="active-inactive' . $module->id . '" href="javascript:update_module_status(' . $module->id . ',1)"><img id="active_status' . $module->id . '" src="' . base_url() . THEME_PATH . 'img/cancel.png" /></a>');
                        ?> </td>
                            <td><?php echo $module->type; ?></td>
                            <td>
                               <a class="black large colorbutton" onclick="refresh_module('<?php echo $module->name; ?>')"><?php echo lang('common_refresh_label'); ?></a>
                               <a class="black large colorbutton"><?php echo lang('common_uninstall_label'); ?></a>
                            </td>   
                        </tr>                 
                    <?php endif;
                endforeach; ?> 
                <?php if ($i == 0) : ?> 
                    <tr><td><?php echo lang('mods_no_addon_modules'); ?></td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <hr />
        <h4><?php echo lang('mods_core_modules'); ?></h4>
        <table class="fullwidth" cellpadding="0" cellspacing="0" border="0">
            <thead>
                <tr>
                    <th><?php echo lang('common_name_label'); ?></th>
                    <th><?php echo lang('common.description_label'); ?></th>
                    <th><?php echo lang('common_type_label'); ?></th>
                    <th><?php echo lang('common_version_label'); ?></th>
                    <th><?php echo lang('common_actions_label'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($this->module_data as $module):
                    if ($module->is_core):
                        ?>  

                        <tr <?php echo ($i % 2) ? 'class="odd" ' : ' ';
                $i++ ?>>
                            <td><?php echo $module_title_description[$module->name]['fr']; ?></td>
                            <td><?php echo $module_description[$module->name]['fr']; ?></td>
                            <td><?php echo $module->type; ?></td>
                            <td><?php echo $module->version; ?></td>
                            <td>
                               <a class="black large colorbutton"  onclick="refresh_module('<?php echo $module->name; ?>')"><?php echo lang('common_refresh_label'); ?></a>
                            </td>  
                        </tr>                 
                    <?php endif;
                endforeach; ?> 
            </tbody>
        </table>
    </div>        <hr />         
</div>

<script>
    /**
         @author Karim Besbes
         @description update module status via ajax
     */
    
    function refresh(url)
    {
        //send the request to the server
       
        $(".dynamique_content").fadeOut('fast', function(){
            $.post(url, function(data, response, xhr) {
                $(".dynamique_content").html(data).fadeIn('fast');
                if (response == "error") {
                    $('.js_notify').html('<div id="notify_tmp" class="notices-message notices-error close"><p>Oups! Une erreur est survenue.</p></div>');
                    $('#notify_tmp').delay(5000).fadeOut("slow");
                }
                else
                {
                    $('.js_notify').html('<div id="notify_tmp" class="notices-message notices-success close"><p>Le module a été actualisé</p></div>');
                    $('#notify_tmp').delay(5000).fadeOut("slow");
                }
            });
            $("#loader").delay(1000).fadeOut("slow");
        });
    }
    function update_module_status($module_id, $status)
    { 
        var url = '' ;
        var icon = '' ;
        var title = '' ;
        var href = '';

 
        if($status == 0) { 
            url =  BASE_URL +'modules/manage/desactivate/'  + $module_id;
            icon = BASE_URL + "<?php echo THEME_PATH . 'img/cancel.png'; ?>" ; 
            title = 'activer'; 
            href = 'javascript:update_module_status(' + $module_id + ',1)'; 
        } 
 
        else if($status == 1) { 
  
            url = BASE_URL + 'modules/manage/activate/' + $module_id;
            icon = BASE_URL + "<?php echo THEME_PATH . 'img/ok.png'; ?>" ; 
            title = 'desactiver';
            href = 'javascript:update_module_status(' + $module_id + ',0)'; 

  
        }

        $.ajax({
            url: url,
            context: document.body,
            success: function(){
                $('#active-inactive' + $module_id ).attr({href:href});
                $('#active_status' + $module_id).attr({ 
                    src: icon,
                    title: title
                });	
  
            }
        });
    }
    
    function refresh_module(module_name)
    { 
        var loader = '	<img class="ajax_loader_notify" src="<?php echo base_url() . THEME_PATH; ?>/img/loader.gif"/> ';
        var  url =  BASE_URL +'modules/manage/update/' + module_name ;  
        var request_url =  BASE_URL +'modules/manage'; 
        modules_url =  BASE_URL +'modules/manage/';  
        $("#loader").show();
        $.ajax({
            url: url,
            context: document.body,
            success: function(){
                refresh(request_url);
            }
            
        });
    }
</script>
