<?php if (empty($expenditures)) : ?>
    <div class="empty-notification" id="tabs-1">
        <h2>Hmmm! Vous n'avez pas encore ajouté des dépenses..<a href="accounting/expenditures/add"> Ajouter maintenant !</a> </h2>
    </div>
<?php else: ?>
    <div id="tabs-2">
        <table id="tab-expen" class="scroll" cellpadding="0" cellspacing="0">
        </table>
        <div id="tab-expen-pager"></div> 
    </div>

    <script type="text/JavaScript">
                                            
        /* var warning = true;
          window.onbeforeunload = function() { 
              if (warning) {
                  return 'Vous ne pouvez plus revenir sur cette page';
              }
          }*/

        $(function(){
            var exstr = '<?php echo $expenditures_xml; ?>' ; 
            var lastsel ;
                        
            var bank_statements = "<?php echo $bank_statements_select; ?>";
            var ex_types = "<?php echo $ex_type; ?>"; 
            var accounting_year = "<?php echo $accounting_year_select; ?>"; 
            jQuery(document).ready(function(){ 
                jQuery("#tab-expen").jqGrid({
                    datatype: 'xmlstring',
                    datastr : exstr,
                    colNames:['Exercice Label','Date','Description','Type depenses','Releve bancaire', 'Ht', 'Tva', 'Fichier'],
                    colModel :[ 
                        {name:'accounting_year_id', index:'accounting_year_id', align:'center',width:30,editable:true,edittype:"select",editoptions:{value: accounting_year}},
                        {name:'date', align:'center', index:'date', width:25, sorttype:'date', datefmt:'Y-m-d',editable:true,editoptions:{size:20, 
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
                        {name:'description',  align:'left',index:'description', width:100,editable:true}, 
                        {name:'expenditure_type_id', index:'expenditure_type_id', align:'center',width:30,editable:true,edittype:"select",editoptions:{value: ex_types}},
                        {name:'bank_statement_id', index:'bank_statement_id', align:'center',width:30,editable:true,edittype:"select",editoptions:{value: bank_statements}},
                        {name:'ht', index:'ht', width:20, align:'center', sorttype:'float',editable:true}, 
                        {name:'tva', index:'tva', width:20,editable:true}, 
                        {name:'file_path', index:'file_path', width:20}, 
                    ],
                    pager: '#tab-expen-pager',
                    rowNum:10,
                    height: '100%',
                    viewrecords: true,
                    caption: '<?php echo lang('accounting.expenditures_label'); ?>',
                    viewrecords: true,
                    gridview: true,
                    ondblClickRow: function(id){
                                                
                        if(id && id!==lastsel){ 
                            jQuery('#tab-expen').restoreRow(lastsel); 
                            lastsel=id; 
                        }
                        jQuery('#tab-expen').editRow(id, true); 
                    },
                    onSelectRow : function(id) {
                        jQuery("#tab-expen").jqGrid('navGrid','#tab-expen-pager',{add:false,edit:false,del:true,search:false}
                        ,{},{},{mtype:"POST", reloadAfterSubmit:true, serializeDelData: function (postdata) {
                                var rowdata = jQuery('#tab-expen').getRowData(postdata.id);
                                // append postdata with any information 
                                return {id: postdata.id, oper: postdata.oper, bs_id: rowdata.bs_id};
                            }},{} );
                    },  
                    editurl: "accounting/expenditures"
                }); 
            }); 
                

            jQuery(window).bind('resize', function() {
            console.log('reszing');
                var targetGrid = '#tab-expen' ;
                var targetContainer =  '#tabs-2';
                // Get width of parent container
                var width = jQuery(targetContainer).attr('clientWidth');
             
                if (width == null || width < 1){
                    // For IE, revert to offsetWidth if necessary
                    width = jQuery(targetContainer).attr('offsetWidth');
                }
                width = width - 2; // Fudge factor to prevent horizontal scrollbars
                if (width > 0 &&
                    // Only resize if new width exceeds a minimal threshold
                // Fixes IE issue with in-place resizing when mousing-over frame bars
                Math.abs(width - jQuery(targetGrid).width()) > 5)
                {
                    jQuery(targetGrid).setGridWidth(width);
                }

            }).trigger('resize');


            $("select").uniform(); 
        });
                    
    </script>
<?php endif; ?>



<!-- End of Second tab -->


