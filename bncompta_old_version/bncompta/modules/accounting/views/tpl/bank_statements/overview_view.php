<?php if (empty($bank_statements)) : ?>
    <div class="empty-notification" id="tabs-1">
         <h2>Hmmm! Vous n'avez pas encore ajouté des relevés bancaires..<a href="accounting/bank_statements/add"> Ajouter maintenant !</a> </h2>
    </div>
<?php else: ?>
    <div id="tabs-2">
        <table id="tab-bs" class="scroll" cellpadding="0" cellspacing="0">
        </table>
        <div id="tab-bs-pager"></div> <hr />
    </div>
    <script type="text/JavaScript">
                                                    
        /* var warning = true;
        window.onbeforeunload = function() { 
            if (warning) {
                return 'Vous ne pouvez plus revenir sur cette page';
            }
        }*/


        var mystr = '<?php echo $bs_xml; ?>' ; 
        var lastSel ;
        var bank_accounts = "<?php echo $bank_account_list; ?>"  ; 
        jQuery(document).ready(function(){ 
            jQuery("#tab-bs").jqGrid({
                datatype: 'xmlstring',
                datastr : mystr,
                colNames:['id','Label','Date','Somme','Description', 'Compte bancaire'],
                colModel :[ 
                    {name:'bs_id', index:'bs_id',hidden:true, width:10,editable:true}, 
                    {name:'label', index:'label', width:70,editable:true}, 
                    {name:'date', index:'date', width:55, sorttype:'date', datefmt:'Y-m-d',editable:true,editoptions:{size:20, 
                            dataInit:function(el){ 
                                $(el).datepicker({dateFormat:'yy-mm-dd'}); 
                            }, 
                            defaultValue: function(){ 
                                var currentTime = new Date(); 
                                var month = parseInt(currentTime.getMonth() + 1); 
                                month = month <= 9 ? "0"+month : month; 
                                var day = currentTime.getDate(); 
                                day = day <= 9 ? "0"+day : day; 
                                var year = currentTime.getFullYear(); 
                                return year+"-"+month + "-"+day; 
                            } 
                        } 
                    },
                    {name:'ammount', index:'ammount', width:50,editable:true}, 
                    {name:'description', index:'description', width:150,editable:true}, 
                    {name:'bank_account_id', index:'bank_account_id', width:110,editable:true,edittype:"select",editoptions:{value:  bank_accounts   }}
                ],
                pager: '#tab-bs-pager',
                width: 1020,
                rowNum:20,
                height: '100%',
                viewrecords: true,
                caption: '<?php echo lang('accounting.bank_statements_label_2'); ?>',
                viewrecords: true,
                gridview: true,
                ondblClickRow: function(id){
                    if(id && id!==lastSel){ 
                        jQuery('#tab-bs').restoreRow(lastSel); 
                        lastSel=id; 
                    }
                    jQuery('#tab-bs').editRow(id, true); 
                    jQuery("#tab-bs").jqGrid('navGrid','#tab-bs-pager',{del:false});
                },
                onSelectRow : function(id) {
                    jQuery("#tab-bs").jqGrid('navGrid','#tab-bs-pager',{add:false,edit:false,del:true,search:false}
                    ,{},{},{mtype:"POST", reloadAfterSubmit:true, serializeDelData: function (postdata) {
                            var rowdata = jQuery('#tab-bs').getRowData(postdata.id);
                            // append postdata with any information 
                            return {id: postdata.id, oper: postdata.oper, bs_id: rowdata.bs_id};
                        }},{} );
                },  
                editurl: "accounting/bank_statements"
            }); 
                   

        }); 
    </script>
<?php endif; ?>



<!-- End of Second tab -->


