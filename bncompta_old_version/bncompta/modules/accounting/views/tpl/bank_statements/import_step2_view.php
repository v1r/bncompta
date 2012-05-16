<h2>Etape 2 </h2>
<p>titre ici...</p>
<form action="accounting/bank_statements/export" method="POST">
    <fieldset>
        <div class="col600">
            <p><label for="bank_statements_label"><?php echo lang('common.label_label'); ?> :</label>
                <input class="mf" id="label" name="label" type="text" value="" />
            </p>
            <p><label for="bank_statements_bank_account"><?php echo lang('accounting.bank_account_label'); ?> :</label>
                <select  name="bank_account_id">
                    <option value="">#</option>
                    <?php foreach ($entreprise_bank_accounts as $key) : ?>
                        <option value="<?php echo $key->id; ?>"><?php echo $key->label; ?></option>
                    <?php endforeach; ?>
                </select>
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
    </fieldset> 
    <table class="fullwidth">
        <tbody>
            <tr>
                <th>date</th>
                <th>description</th>
                <th>montant en euro</th>
            </tr>

            <?php
            foreach ($records_data as $key) :
                $description = str_replace('"', "", $key[1]);
                ?>
                <tr>
                    <td>
                        <input name="date[]" hidden  value="<?php echo $key[0]; ?>"/>
                        <?php echo $key[0]; ?>
                    </td>
                    <td><input name="description[]" hidden value="<?php echo $description; ?>"/><?php echo $description; ?></td>
                    <td><input name="ammount[]" hidden type="text" value="<?php echo $key[2]; ?>"/>
                        <?php echo $key[2]; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</form>
<script type="text/javascript">
    $(function(){
        $(".fullwidth").dragCheck('td:not(.nono)');
    });
</script>
