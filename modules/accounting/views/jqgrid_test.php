<table id="list" class="scroll" cellpadding="0" cellspacing="0">
</table>
<div id="list-pager"></div> <br />
<script type="text/javascript">
    $(function(){ 
        var lastsel;
        $("#list").jqGrid({
            url:'accounting/bank_statements/process_data_grid',
            datatype: 'xml',
            mtype: 'post',
            colNames:['Id','Label','Description', 'Date','Ammount'],
            colModel :[ 
                {name:'id',index:'id', width:10},
                {name:'label', index:'label', width:20,editable:true}, 
                {name:'description', index:'description', width:120 ,editable:true}, 
                {name:'date', index:'date', width:20, align:'right',editable:true}, 
                {name:'ammount', index:'ammount', width:20, align:'right',editable:true}
            ],
            pager: '#list-pager',
            rowNum:10,
            rowList:[10,20,30],
            sortname: 'date',
            sortorder: 'desc',
            viewrecords: true,
            gridview: true,
            caption: 'My first grid',
            width:900,
            onSelectRow: function(id){ if(id && id!==lastsel){ 
                    jQuery('#list').jqGrid('restoreRow',lastsel); 
                    jQuery('#list').jqGrid('editRow',id,true); lastsel=id; } }, 
            editurl: "accounting/bank_statements/update_grid"
        }); 
        $("#list").jqGrid('navGrid',"#list-pager",{edit:false,add:false,del:false});
    }); 
</script>