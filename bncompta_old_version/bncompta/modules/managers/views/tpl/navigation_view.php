<nav id="shortcuts">
    <ul>
        <li>
            <a class="overview" href="managers/manage/" class="tooltip"><?php echo lang('common_users_list_label'); ?></a>
            <a  id="add_manager"class="add" class="tooltip"><?php echo lang('common_add_label'); ?></a>  
        </li>
    </ul>
</nav>

<div id="choose_entreprise">
    <p><?php echo lang('common.select_entreprise_label'); ?></p>
    <select id="select_entreprise" class="select_medium">
        <option value="">-- --</option>
        <?php foreach ($this->entreprise_data as $values) : ?>
            <option value="<?php echo $values->label; ?>"><?php echo $values->label; ?></option>
        <?php endforeach; ?>
    </select>
</div>

<script type="text/javascript">

    $(function() {
                
        $("#choose_entreprise").hide();
        $("#add_manager").click(function(){
               
            $("#choose_entreprise").dialog({
                width: 300,
                modal: true,
                buttons: {
                    "Ok": function() {
                        if($("#select_entreprise").val() == "") {
                            alert("Veuillez selectionnez une entreprise");  
                        }
                        else
                            $(this).dialog("close");
                    },
                    "Cancel": function() {
                        $(this).dialog("destroy");
                    }
                },
                close: function(event, ui) {
     
                    window.location = BASE_URL + 'managers/manage/add/' + $("#select_entreprise").val();
     
                }
                   
            });
        });
    });
</script>