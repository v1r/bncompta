
<h2>Welcome .... </h2>
<p style="float:right;"> Derniere connexion : </p>
      $modules = $this->core->moduleforge->getAllModules();
        foreach ($modules as $key) {

            $this->modules[$key->getModuleName()] = 'test';
            $this->modules[$key->getModuleName()] = 'test';
            $this->modules[$key->getModuleName()] = 'test';
            $this->modules[$key->getModuleName()] = 'test';
            $this->modules[$key->getModuleName()] = 'test';
        }
    <div class="dashboard_menu_icons">
        <!-- Big buttons -->
        <h2><?php echo lang('common_dashboard_heading'); ?></h2>

        <script type="text/javascript">
            $(function() {
                $( ".dash" ).sortable({
                    update: function(event, ui) {
                        var end_pos = $(ui.item).index();
                        var module_name = $(ui.item).attr("id");
                        $.post("dashboard/home/update_position", {
                            module : module_name,
                            position:end_pos
                        });
                        $(ui.item).siblings().each( function() {
                            $.post("dashboard/home/update_position", {
                                module : $(this).attr('id'),
                                position:$(this).index()
                            });
                        });
                                       
                    }

                });
                $( ".dash" ).disableSelection();
            });
        </script>
    </script>
    <ul class="dash">
        <?php
        foreach ($modules as $module_name => $attribute) :
            if ($modules[$module_name]->type === 'mod_admin') :
                if ($modules[$module_name]->name !== 'permissions') :
                    ?>
                    <li id="<?php echo $modules[$module_name]->name ?>">
                        <a href="<?php echo $modules[$module_name]->name . '/manage'; ?>" id="<?php echo $modules[$module_name]->name ?>" title="<?php echo $module_description[$module_name][$user_information->default_lang]; ?>" class="tooltip">
                            <img src="<?php echo base_url() . THEME_PATH; ?><?php echo $modules[$module_name]->icon_path; ?>" alt="" />
                            <span><?php echo $module_title_description[$module_name][$user_information->default_lang]; ?></span>
                        </a>
                    </li>
                <?php endif;
            endif;
        endforeach; ?>
    </ul>
    </div>
<?php endif; ?>
<?php if ($user_information->group_id == 2): ?>
    <div id="columns">
        <div class="notifications column">
            <div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
                <div class="portlet-header">Notifications</div>
                <div id="notifications"class="portlet-content">

                </div>
            </div>
        </div>
        <div class="entreprises_list column">
            <div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
                <div class="portlet-header"><?php echo lang('common_my_entreprises'); ?></div>
                <div class="portlet-content">
                    <?php if (empty($my_entreprises)) : ?>
                        <p><?php echo lang('common.no_entreprises_label'); ?></p>
                    <?php else: ?>
        <?php foreach ($my_entreprises as $key => $value) : ?>
                            <h2><img src="<?php echo base_url() . THEME_PATH; ?>/img/list.png" alt="" />
                                <a href="javascript:void(0);" onclick="browse_entreprise(<?php echo $my_entreprises[$key]->id; ?>)"><?php echo $my_entreprises[$key]->name; ?></h2></a>
                        <?php endforeach; ?>
    <?php endif; ?>
                </div>
            </div>
        </div>
        <h1><?php echo lang('common_my_widgets'); ?></h1>
        <div class="clean-box"><h2>Widgets : Coming soon</h2></div>
    </div>


    <script>
        var notify_icon = '<img src="<?php echo base_url() . THEME_PATH; ?>/img/notify-icon.png"/>'; 
        var delete_icon = '<img src="<?php echo base_url() . THEME_PATH; ?>/img/remove.png"/>';
        var loader = '	<img class="ajax_loader_notify" src="<?php echo base_url() . THEME_PATH; ?>/img/loader.gif"/> ';
        window.onload = loadChirp ; 
        function loadChirp(){                                                                          	
            $.getJSON('dashboard/home/ajax', 
            function(data) { 

                $('#notifications').text("");	
                $('#notifications').append(loader);
                $('.ajax_loader_notify').fadeOut('slow', function(){$.each(data, function(key, val) {
                        $('#notifications').append('<p> -  ' + val + '</p>');});	
                });

            });
        }
        function browse_entreprise(entreprise_id)
        {
            $.post(BASE_URL + 'dashboard/home/update_browsing/' + entreprise_id,
            function(data,response) {
                window.location.href = BASE_URL + 'dashboard/entreprise';
            });
                                    
        }
    </script>
<?php endif; ?>
