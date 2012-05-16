<!-- Footer -->
<script>
    $(document).ready(function() { 			
        //tooltip
        $(".tooltip").easyTooltip();		
        // Accordion
    
        var icons = {
            header: "ui-icon-circle-arrow-e",
            headerSelected: "ui-icon-circle-arrow-s"
        };
        $( "#accordion" ).accordion({
            icons: icons,
            autoHeight: false
        });
     
    });

</script>
<div id="footer">
    <p class="mid">
        <a><img src="<?php echo THEME_PATH ;?>img/logo-footer.png"/></a>
    </p>
</div>
<!-- Fin of Footer -->
