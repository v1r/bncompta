<h2>Etape 1 </h2>
<p>titre ici...</p>
<form action="accounting/bank_statements/import" method="POST" id="step1">
    <fieldset>
        <legend>Options d'importaitons</legend>
        <div class="col600">
            <p>
                <span>
                    Separateur :
                </span>
                <select name="seperator">
                    <option value=";">;</option>
                    <option value=",">\t</option>
                    <option value="\t">,</option>
                </select>

            </p>
        </div>
        <div class="col300">
            <input type="submit" value="Continuer" />
        </div>

    </fieldset>
    <table class="fullwidth">
        <tbody>
            <tr>
                <th>Ligne</th>
                <th>Donnees</th>
            </tr>
            <?php $i = 1;
            foreach ($lines as $key => $value) : ?>
                <?php if ($value != '') : ?>
                    <tr>
                        <td style="text-align:center; "><em style="font-size:10px;"><?php echo $i++; ?></em> </td>
                        <td >
                            <input hidden type="checkbox" checked value='<?php echo $value; ?>' name="bank_statements_records[]"/>

                            <?php echo $value; ?>

                        </td>     
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
                    <input hidden value="<?php echo $count ;?>" name="count"/>
        </tbody>
    </table>

</form>
<script type="text/javascript">
    $(function(){
        $(".fullwidth").dragCheck('td:not(.nono)');
    });

</script>
