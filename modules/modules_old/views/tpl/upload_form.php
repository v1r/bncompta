<fieldset>
    <?php echo form_open_multipart('modules/upload/upload_process'); ?>
    <label for="mf"><?php echo lang('modules.select_module_to_upload_label'); ?>: </label>
    <input type="file" name="userfile" size="20" />

    <input type="submit" class="button" value="upload" />

</form>

</fieldset>