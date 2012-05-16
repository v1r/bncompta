<?php $this->load->view('tpl/navigation_view'); ?>
<div class="pad20">
    <?php foreach ($bank_accounts as $key) : ?>
        <div id="dashed_list">
            <div class="col1">
                <h2><?php echo $key->name;?></h2>
                <hr/>
               <p> <?php echo $key->description;?></p>
            </div>
            <div class="col2">
                <a  href="bank_accounts/manage/configure/<?php echo $key->id ;?>"><?php echo lang('common_configure_label');?></a>
            </div>

        </div>
    <?php endforeach; ?>
</div>  

<style>
    #dashed_list {
        border: 1px dotted #CCCCCC;
        display: block;
        margin-bottom: 20px;
        overflow: hidden;
        padding: 10px 15px;
        position: relative;
        width: 60%;
    }
    #dashed_list .col1 {
        float: left;
        width: 72%;
    }
    
        #dashed_list .col1 p {
        font-size:12px;
    }

    #dashed_list .col2 {
        float: right;
        padding-top: 10px;
        width: 18%;
    }
</style>
