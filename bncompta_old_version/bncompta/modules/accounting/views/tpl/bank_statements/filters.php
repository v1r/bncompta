<div class="pad20">
    <div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide"  id="tabs-1">
        <h2><?php echo lang('accounting.bank_statements_label_2'); ?></h2> 
        <hr/>
        <form id="filter"> 
            <p style="margin-left:20px;" >
                <span><strong><?php echo lang('common.by_group_label'); ?> :</strong></span>
                <select  id="filter_by_group" name="filter_by_group">
                    <option selected="selected" value=""><?php echo lang('common.all_label'); ?></option>
                    <option value="2"><?php echo lang('common.managers_label'); ?></option>
                    <option value="3"><?php echo lang('common.users_label'); ?></option>
                </select>
                <span><strong><?php echo lang('common.by_entreprise_label'); ?> : </strong></span>
                <select id="filter_by_entreprise" name="filter_by_entreprise">
                    <option selected="selected" value=""><?php echo lang('common.all_label'); ?></option>
                    <?php foreach ($data_entreprise as $key) : ?>
                        <option value="<?php echo $key->id; ?>"><?php echo $key->name; ?></option>
                    <?php endforeach; ?>
                </select>
        </form>
    </div>
</div>
<script>
    var delay = (function(){
        var timer = 0;
        return function(callback, ms){
            clearTimeout (timer);
            timer = setTimeout(callback, ms);
        };
    })();

    $('select#filter_by_group').live('change', function(){
        var post_url = BASE_URL + 'managers/manage';
        var form_data = $("form#filter").serialize();
        filter(post_url, form_data);
    });
    
    $('select#filter_by_entreprise').live('change', function(){
        var post_url = BASE_URL + 'managers/manage';
        var form_data = $("form#filter").serialize();
        filter(post_url, form_data);
    });
    
    function filter(url, form_data)
    {
        //send the request to the server
        $("#tabs-2").fadeOut('fast', function(){
            $.post(url, form_data, function(data, response, xhr) {
                //success stuff here
                $.uniform.update('select, input');
                $("#tabs-2").html(data).fadeIn('fast');
            });
        });
    }
</script>