<?php $this->load->view('tpl/analyse/navigation_view'); ?>
<div class="pad20">                
    <h2><?php echo lang('bank_accounts.add_bank_account_label'); ?></h2>
    <div id="tabs-1">

        <?php echo form_open($this->uri->uri_string(), 'class="crud" id="add_bank_account" name="ibanform"'); ?> 								
        <fieldset>
            <div class="col600">
                <p><label for="bank_label"><?php echo lang('bank_accounts.slug_label'); ?> :</label>
                    <input class="mf" name="label" type="text" value="<?php echo $repopulate->label; ?>" />
                </p>
                <p>
                    <label for="bank_name"><?php echo lang('bank_accounts.bank_name_label'); ?> :</label>
                    <input class="mf" id="bank_name" name="name" type="text" value="<?php echo $repopulate->name; ?>" />
                </p>
                <div id="auto-complete" style="width:200px; position:absolute;"></div>
                <p>
                    <label for="bank_address"><?php echo lang('bank_accounts.address_label'); ?> :</label>
                    <input class="mf" id="bank_address" name="address" type="text" value="<?php echo $repopulate->address; ?>" />
                </p>
                <p>
                    <label for="bank_bic"><?php echo lang('bank_accounts.BIC_label'); ?> :</label>
                    <input class="mf" id="bic" name="bic" type="text" value="<?php echo $repopulate->bic; ?>" />
                </p>
                <p>
                <table>
                    <tr>
                        <td width="217" class="tooltip" title="<?php echo lang('bank_accounts.rib_tooltips_label'); ?>">
                            <label for="rib"> <?php echo lang('bank_accounts.rib_label'); ?> :</label></td>
                        <td>
                            <input  id="rib_bank_code" name="rib_bank_code" type="text" value="<?php echo $repopulate->rib_bank_code; ?>" size="5" MAXLENGTH="5" style="width:50px;" />

                        </td>
                        <td><input  id="rib_branch_code" name="rib_branch_code" type="text" value="<?php echo $repopulate->rib_branch_code; ?>" size="5" MAXLENGTH="5" style="width:50px;"/>

                        </td>
                        <td>  <input  id="rib_account_number" name="rib_account_number" type="text" value="<?php echo $repopulate->rib_account_number; ?>" size="11" MAXLENGTH="11" style="width:100px;"/>

                        </td>
                        <td><input   id="rib_key" name="rib_key" type="text" value="<?php echo $repopulate->rib_key; ?>" size="2" MAXLENGTH="2"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1"></td>
                        <td><i><?php echo lang('bank_accounts.rib_bank_code'); ?></i></td>
                        <td><i><?php echo lang('bank_accounts.rib_branch_code'); ?></i></td>
                        <td><i><?php echo lang('bank_accounts.rib_account_number'); ?></i></td>
                        <td><i><?php echo lang('bank_accounts.rib_key'); ?></i></td>
                    </tr>
                </table>
                <p id="calculateIBAN" >
                    <label></label>
                    <select  style="display:none;"name="country" size="1"><option value="FR"></select>
                    <input id="bank"  name="bank" size="11" maxlength="11" type="text" readonly>
                    <input id="account" name="account" size="22" maxlength="22" type="text" readonly>
                    <a  href="javascript:CreateIBAN()"><?php echo lang('bank_accounts.calculate_iban'); ?> </a>
                </p>  
                <script>
                    $('#add_bank_account').submit(function() {
                        $('#rib').val($('#rib_bank_code').val() + $('#rib_branch_code').val() + $('#rib_account_number').val() + $('#rib_key').val()) ; 
                    });
                    var filled = true ; 
                    $("#calculateIBAN").hide();
                    $('#rib_bank_code').keyup(function(element){
                        if ($(this).val()=='') { 
                            $("#calculateIBAN").fadeOut("slow").hide(); 
                            filled = false; 
                        }
                        else
                        {
                            filled = true ; 
                        }
                        
                        if(filled == true) {
                            $("#calculateIBAN").fadeIn("slow").show();  
                                                      
                        }
                    });
                
   
                </script>
                <p class="tooltip" title="<?php echo lang('bank_accounts.iban_tooltips_label'); ?>">
                    <label for="bank_iban" ><?php echo lang('bank_accounts.iban_label'); ?> :</label>
                     <input  id="rib" name="rib"  type="hidden" value="<?php echo $repopulate->rib; ?>" />
                    <input class="mf" id="iban" name="iban" type="text" value="<?php echo $repopulate->iban; ?>" />
                    <a id="CalculateRIB" href="javascript:CalculateRIB()"><?php echo lang('bank_accoutns.calculate_rib'); ?></a>
                </p>
                <script>
                    $("#CalculateRIB").hide();
                    $('#iban').keyup(function(element){
                        if ($('#account').val()==''  && $("#bank").val() == '') { 
                            $("#CalculateRIB").fadeIn("slow").show(); 
                        }
                    });
                </script>
                <p class="tooltip" title="<?php echo lang('bank_accounts.contact_tooltips_label'); ?>">
                    <label for="bank_contact" ><?php echo lang('bank_accounts.contact_label'); ?> :</label>
                    <input class="mf" name="contact" type="text" value="<?php echo $repopulate->contact; ?>" />
                </p>
                <p class="tooltip">
                    <label for="bank_description" ><?php echo lang('bank_accounts.description_label'); ?> :</label>
                    <input class="mf" name="description" type="text" value="<?php echo $repopulate->description; ?>" />
                </p>
                <p><input  type="submit" value="Submit" />
                </p>
            </div>
            <div class="col300">
                <?php if (validation_errors()):// In errors case  ?>
                    <h2><?php echo lang('error_label'); ?></h2>
                    <p><?php echo lang('error_message_label'); ?></p>
                    <div class="error_list">
                        <?php echo validation_errors(); ?>
                    </div>
                <?php endif; ?>
                <div id="messageBox1"> 
                    <ul></ul> 
                </div> 
            </div>
    </div>
</fieldset> 
<?php echo form_close(); ?> 
</div>         

<script>                                         
    $(document).ready(function(){

        $("#add_bank_account").validate({
            rules: {
                bank_phone_number: {
                    minlength: 5,
                    maxlength: 20
                },
                rib_bank_code : {
                    required : true , 
                    minlength: 5,
                    maxlength: 5
                },
                rib_branch_code : {
                    required : true , 
                    minlength: 5,
                    maxlength: 5
                },
                rib_account_number : {
                    required : true , 
                    minlength: 11,
                    maxlength: 11
                },
                rib_key : {
                    required : true , 
                    minlength: 2,
                    maxlength: 2
                }
            },
            messages: {
                bank_phone_number: {
                    minlength : "Numero de telephone invalide",
                    maxlength : "Numero de telephone invalide"
                },
                rib_bank_code : {
                    required : "Le champ est obligatoire",
                    minlength : "Entrer les 5 chiffres du code bancaire",
                    maxlength : "Le max est de 5 caracteres"
                },
                rib_code_guichet : {
                    required : "Le champ est obligatoire",
                    minlength : "Entrer les 5 chiffres du code de guichet",
                    maxlength : "Le minimum est de 32 caracteres"
                },
                rib_account_number : {
                    required : "Le champ est obligatoire",
                    minlength : "Le numero de compte compote 11 chiffres",
                    maxlength : "Le minimum est de 32 caracteres"
                },
                rib_key : {
                    required : "Le champ est obligatoire",
                    minlength : "La cle du RIB est compose de 2 chiffres",
                    maxlength : "Le minimum est de 32 caracteres"
                }
            },
            errorContainer: "#messageBox1",
            errorLabelContainer: "#messageBox1 ul",
            wrapper: "li", debug:true,
            submitHandler: function(form) {
                form.submit();
            }
        });   
            
    });
    $("#rib_bank_code").keyup(function () {
        var bank_branch = $("#rib_branch_code").val();
        var bank_code = $("#rib_bank_code").val();
        $('#bank').val(bank_code + bank_branch);

    }).keyup();
    $("#rib_branch_code").keyup(function () {
        var bank_branch = $("#rib_branch_code").val();
        var bank_code = $("#rib_bank_code").val();
        $('#bank').val(bank_code + bank_branch);  

    }).keyup();
    
    $("#rib_account_number").keyup(function () {
        var bank_code = $("#rib_account_number").val();
        $('#account').val(bank_code);  

    }).keyup();
    
    function CalculateRIB()
    {
        CheckIBAN();
        populateRIB();
    }
    
    function populateRIB()
    {
        var bank_number = $("#bank").val().substr(0,5).toUpperCase();
        var bank_branch = $("#bank").val().substr(5,10).toUpperCase();
        var bank_account = $("#account").val().toUpperCase();
        var rib_key = Calculate_RIB_Key();
        $("#rib_bank_code").val(bank_number);
        $("#rib_branch_code").val(bank_branch );
        $("#rib_account_number").val(bank_account.substr(-11));
        $("#rib_key").val(rib_key);
    }
    
    function Calculate_RIB_Key()
    {
        var bank_number = format($("#bank").val().substr(0,5).toUpperCase());
        var bank_branch =  format($("#bank").val().substr(5,10).toUpperCase());
        var bank_account =  format($("#account").val().toUpperCase());
        var key = 97 - ( ( 89 * parseInt(bank_number,10) + 15 * parseInt(bank_branch,10) + 3 * parseInt(bank_account,10) ) % 97);
        return key;

    }
    
    function format(data)
    {
        return strtr(data.toString(),"ABCDEFGHIJKLMNOPQRSTUVWXYZ","12345678912345678923456789");
    }
    
    function strtr (str, from, to) {
        var fr = '', i = 0, j = 0, lenStr = 0, lenFrom = 0;
        var tmpFrom = [];
        var tmpTo   = [];
        var ret = '';
        var match = false;
        // Received replace_pairs?
        // Convert to normal from->to chars
        if (typeof from === 'object') {
            for (fr in from) {
                tmpFrom.push(fr);
                tmpTo.push(from[fr]);
            }
            from = tmpFrom;
            to = tmpTo;
        }
        // Walk through subject and replace chars when needed
        lenStr  = str.length;
        lenFrom = from.length;
        for (i = 0; i < lenStr; i++) {
            match = false;
            for (j = 0; j < lenFrom; j++) {
                if (str.substr(i, from[j].length) == from[j]) {
                    match = true;
                    // Fast forward
                    i = (i + from[j].length)-1;
                    break;
                }
            }
            if (false !== match) {
                ret += to[j];
            } else {
                ret += str[i];
            }
        }
        return ret;
    }
    
    $(function() {
        $.ajax({
            url: BASE_URL + 'bnc_data/xml/fr_bank.xml',
            dataType: "xml",
            success: function( xmlResponse ) {
                var data = $( "bank", xmlResponse ).map(function() {
                    return {
                        value: $( "name", this ).text(),
                        
                        code: $( "bank_code", this ).text(),
                        address: $( "address", this ).text(),
                        bic : ($.trim( $( "bic", this ).text() ) || "")
                    };
                }).get();
                $( "#bank_name" ).autocomplete({
                    source: data,
                    appendTo : "#auto-complete",
                    minLength: 0,
                    select: function( event, ui ) {
                        $("#bic").val(ui.item.bic); 
                        $("#rib_bank_code").val(ui.item.code); 
                        $("#bank_address").val(ui.item.address); 
                        
                    }
                });
            }
        });
    });
</script>
