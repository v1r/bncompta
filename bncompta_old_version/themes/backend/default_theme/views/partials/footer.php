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
        <?php echo lang('copyleft_label'); ?> 
    </p>
</div>
<!-- Fin of Footer -->
