
<h2><?php echo lang("core.dashboard_welcome_label") . $this->user->first_name  . ' ' .  $this->user->last_name ; ?></h2>
<p> <?php echo lang("core.dashboard_last_connection_label"); ?>
   <?php echo date('d, M, Y, g:i a', $this->user->last_login); ?> </p>
<div class="dashboard_menu_icons">
    <h2><?php echo lang('common_dashboard_heading'); ?></h2>
    <ul class="dash">
        <?php foreach ($this->userACL["byGA"] as $module => $dontcare) : ?>
            <li id="">
                <a href="<?php echo get_route((string) $this->modules[$module]['name']); ?>" 
                   id="<?php echo $this->modules[$module]['name']; ?>"
                   title="<?php echo lang($this->modules[$module]['description']) ?>" class="tooltip">
                    <img src="<?php echo base_url() . $this->modules[$module]['iconPath'] ?>"  />
                    <span><?php echo lang($this->modules[$module]['title']); ?></span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

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