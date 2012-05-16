<h1>Etape 3 </h1>
<p>Exporter les donnees vers les recettes et depenses</p>
<hr />
<h2>Recettes </h2>

<div id="tabs-2">
    <table id="tab-income" class="scroll" cellpadding="0" cellspacing="0">
    </table>
    <div id="tab-income-pager"></div> <hr />
    <h2>Depenses </h2>
    <table id="tab-expen" class="scroll" cellpadding="0" cellspacing="0">
    </table>
    <div id="tab-expen-pager"></div> 
    <br/>



    <script type="text/JavaScript">
        
        /* var warning = true;
        window.onbeforeunload = function() { 
            if (warning) {
                return 'Vous ne pouvez plus revenir sur cette page';
            }
        }*/


        var mystr = '<?php echo $incomes_xml; ?>' ; 
        var lastSel ;
        var ex_types = "<?php echo $ex_type; ?>"  ; 
        jQuery(document).ready(function(){ 
            jQuery("#tab-income").jqGrid({
                datatype: 'xmlstring',
                datastr : mystr,
                colNames:['Date','Description','Type recette', 'Ht', 'Tva'],
                colModel :[ 
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
                    {name:'description', index:'description', width:150,editable:true}, 
                    {name:'type', index:'type', width:110,editable:true,edittype:"select",editoptions:{value:  ex_types   }},
                    {name:'ht', index:'ht', width:25, align:'right', sorttype:'float',editable:true}, 
                    {name:'tva', index:'tva', width:25,editable:true}
                ],
                pager: '#tab-income-pager',
                width: 1020,
                rowNum:10,
                height: '100%',
                viewrecords: true,
                caption: 'Recettes',
                viewrecords: true,
                gridview: true,
                onSelectRow: function(id){
                    if(id && id!==lastSel){ 
                        jQuery('#tab-income').restoreRow(lastSel); 
                        lastSel=id; 
                    }
                    jQuery('#tab-income').editRow(id, true); 
                    
                },
                editurl: "accounting/bank_statements/update_grid"
            }); 
        }); 
    </script>

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
            var ex_types = "<?php echo $ex_type; ?>"; 
            jQuery(document).ready(function(){ 
                jQuery("#tab-expen").jqGrid({
                    datatype: 'xmlstring',
                    datastr : exstr,
                    colNames:['Actions','Date','Description','Type recette', 'Ht', 'Tva', 'Fichier'],
                    colModel :[ 
                        {name:'act', index:'act', width:140,sortable:false}, 
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
                        {name:'description', index:'description', width:150,editable:true}, 
                        {name:'type', index:'type', width:110,editable:true,edittype:"select",editoptions:{value: ex_types}},
                        {name:'ht', index:'ht', width:20, align:'right', sorttype:'float',editable:true}, 
                        {name:'tva', index:'tva', width:20,editable:true}, 
                        {name:'file_path', index:'file_path', width:90,editable:true}, 
                    ],
                    pager: '#tab-expen-pager',
                    width: 800,
                    rowNum:10,
                    height: '100%',
                    viewrecords: true,
                    caption: 'Recettes',
                    viewrecords: true,
                    gridview: true,
                    loadComplete: function(){ 
                        var ids = jQuery("#tab-expen").getDataIDs(); 
                        var datagrid_count  =  jQuery("#tab-expen").getGridParam("reccount");
                        for(var i=0;i<ids.length;i++){ 
                            var cl = ids[i]; 
                            be = "<input style='margin:1px; '  id='edit_"+cl+"' type='button' value='Modifier' onclick=jQuery('#tab-expen').editRow("+cl+"); ></ids>"; 
                            se = "<input  style='margin:1px;' id='insert_"+cl+"' type='button' value='Inserer' onclick=jQuery('#tab-expen').saveRow("+cl+"); />"; 
                            ce = "<input style='margin:1px;' id='restore_"+cl+"' type='button' value='Restaurer' onclick=jQuery('#tab-expen').restoreRow("+cl+"); />"; 
                            jQuery("#tab-expen").setRowData(ids[i],{act:be+se+ce}) 
                        } 
                    
                        $("input").click(function(){
                            var str = $(this).attr('id');
                            split_str = str.split('_');
                            var action = split_str[0];
                            var id = split_str[1];
                      
                            if(action == 'insert')
                            {
                                $('tr#'+id+' td').hide();
                                datagrid_count--;        
                                if (datagrid_count == 0) {
                                    var nodata = 
                                        [
                                        {id:"no-data" ,act:"No more data", description:"",type:"",label:"",ht:"", tva:""}
                                    ];
                                    jQuery("#tab-expen").jqGrid('addRowData',nodata[0].id,nodata[0]);
                                }
                            }
                        });            
                   
                    }, 
                    editurl: "accounting/bank_statements/update_grid"
                }); 
            }); 
            $("select").uniform(); 
        });
    </script>
</div>
 
