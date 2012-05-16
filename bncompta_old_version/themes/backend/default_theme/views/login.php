<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
        <title>Identification page </title>
        <link type="text/css" href="<?php echo base_url() . THEME_PATH; ?>css/login.css" rel="stylesheet" />  
        <link type="text/css" href="<?php echo base_url() . THEME_PATH; ?>css/uniform.default.css" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo base_url() . THEME_PATH; ?>js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . THEME_PATH; ?>js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . THEME_PATH; ?>js/jquery.uniform.min.js"></script>
        
    </head>
    <body>
        <?php if ($this->setting->site_status == 1) : ?>
            <div class="top_warning">
                <?php echo $this->setting->site_offline_message; ?>
            </div>
        <?php endif; ?>
        <div id="container">

            <div class="logo_big">
                <a href="auth"><img src="<?php echo base_url() . THEME_PATH; ?>img/logo_big.png" alt="" /></a>
            </div>

            <div id="box">

                <?php echo form_open('auth/login'); ?>
                <p class="main">

                    <label class="login"><?php echo lang('login_label'); ?> </label>
                    <input type="text" name="username" value="" /> 
                    <label class="login"><?php echo lang('password_label'); ?> </label>
                    <input type="password" name="password" value=""/>  
                    <span class="space">
                        <input type="submit" value="<?php
                echo lang('connection_label');
                ?>" class="login" />
                    </span>
                </p>


                <?php
                echo form_close();
                ?>
                <br/>
                <div class="notices">
                    <?php
                    if (validation_errors())
                        :
                        ?>
                        <div class="message_small error_small close">
                            <h2><?php echo lang('login_error_label'); ?></h2>
                            <p><?php echo lang('login_error_message'); ?></p></div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('success_message')): ?>
                        <div class="message_small success_small close"><h2><?php
                    echo lang('logout_label');
                        ?></h2><p><?php
                            echo lang('logout_message');
                        ?></p></div>
                        <?php endif; ?>
                        <?php if ($this->session->flashdata('warning')): ?>
                        <div class="message_small success_small close"><h2>
                                <?php echo $this->session->flashdata('warning'); ?></h2>

                        </div>
                    <?php endif; ?>
                </div>
            </div>


        </div>

        <script type="text/javascript" src="<?php echo base_url() . THEME_PATH; ?>js/cufon.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . THEME_PATH; ?>js/qk.font.js"></script>
        <script type="text/javascript">
            $(document).ready(function() { 	
                $("select, input.mf,input, input:radio, input:file").uniform(); });
            Cufon.replace('h1,h2,h4');
        </script> 
        <?php if (validation_errors()): ?>
            <script>$(".main").effect("shake", { times: 3}, 100);  </script>
        <?php endif; ?>   

    </body>
</html>