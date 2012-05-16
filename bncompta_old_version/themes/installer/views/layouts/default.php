
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!-- Always force latest IE rendering engine & Chrome Frame -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <title>Installation</title>
        <base href="<?php echo base_url(); ?>" />
        <!-- Mobile Viewport Fix -->

        <?php echo $template['partials']['metadata']; ?>
    </head>

    <body>
        <noscript><span class="validate_error">Bncompta ne fonctionne que si le javascript est active..</span></noscript>
        <!-- Container -->
        <div id="container">
            <div id="mask"></div>
            <section id="content-wrapper">
                <?php echo $template['partials']['header']; ?>
                <!-- Background wrapper -->
                <div id="bgwrap">	
                    <div id="content">
                        <div id="main">
                            <?php echo $template['partials']['notices']; ?>
                            <?php if (!empty($template['partials']['navigation'])) : ?>
                                <?php echo $template['partials']['navigation']; ?>
                            <?php endif; ?>
                            <?php if (!empty($template['partials']['filters'])): ?>
                                <?php echo $template['partials']['filters']; ?>
                            <?php endif; ?>
                            <div class="pad20">
                                <?php echo $template['body']; ?>
                            </div>
                            <!-- #customize your modal window here -->
                        </div>
                    </div>

                </div>

            </section>
            <!--Fin du bgwrap -->

        </div>
        <!-- Fin du Container -->
        <?php echo $template['partials']['footer']; ?>
        <script>
           
        </script>
    </body>
</html>