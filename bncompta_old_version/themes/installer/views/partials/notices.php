<?php if ($this->session->flashdata('error')) : ?>
    <div class="notices-message notices-error close">
        <p>[!] <?php echo $this->session->flashdata('error'); ?></p>
    </div>
<?php endif; ?>
<?php if ($this->session->flashdata('success')): ?>
    <div class="notices-message notices-success close">
        <?php echo $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>