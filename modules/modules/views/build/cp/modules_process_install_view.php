<div class="container-modal">
    <div class="grid grid_6">
        <div class="tabs-side">
            <ul class="tab-nav" >
                <li  class="current">
                    <a href="#general-tab">
                        <?= getTr("core.common_overview_label"); ?>
                        <span>Module overview</span>	   

                    </a>
                </li>
                <li>
                    <a href="#usage-guide-tab">
                        Usage guide
                        <span>How this module work</span>	                        	
                    </a>
                </li>
                <li>
                    <a href="#developer-guide-tab">
                        Developer guide
                        <span>The developper guide</span>	                        	
                    </a>
                </li>
            </ul>
        </div>
    </div> <!-- .grid -->
    <div id="general-tab">
        <div class="grid grid_16 prepend_1">

            <div class="tab-contents">

                <h2> <?= getTr("core.common_overview_label"); ?></h2>
                <hr />
                <p><?= getTr($overview); ?></p>
                <div class="grid_8 theme_screenshot">
                    <a href="<?= base_url() . 'modules/' . $screenshot_path; ?>" class="screenshot">   
                        <img src="<?= base_url() . 'modules/' . $thumbnail_path; ?>" width="width" height="hight" alt="screenshot" class="screenshot"/>
                        <span>Screenshot</span>						
                    </a>

                </div>
                <div id="usage-guide-tab"></div>
                <div id="developer-guide-tab"></div>
            </div> <!-- .grid -->
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.tab-contents').each (function () {
        var $tabcontent = $(this).find ('.tab-content').hide ();
        $tabcontent.eq (0).show ();
    });
	
    $('.tab-nav a').live ('click', function (e) {
        e.preventDefault ();
		
        var $tab = $(this);
        $tab.parent ().addClass ('current').siblings ('li').removeClass ('current');
        var $content = $($tab.attr ('href'));
        $content.show ().siblings ('.tab-content').hide ();
    });
    $('.screenshot').lightBox ();

</script>