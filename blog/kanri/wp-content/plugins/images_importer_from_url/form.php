<form method="POST" name="<?php print IIFU_PROPERTIES::NAME_FORM; ?>" action="http://<?php print $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>">
<p><?php _e('Please enter the URL of the old site:',IIFU_PROPERTIES::TEXT_DOMAIN); ?></p>
<p><input type="text" name="<?php print IIFU_PROPERTIES::NAME_OLD_SITE_URL; ?>" value="<?php print isset($_POST[IIFU_PROPERTIES::NAME_OLD_SITE_URL])?$_POST[IIFU_PROPERTIES::NAME_OLD_SITE_URL]:''; ?>" />&nbsp;&nbsp;<input type="button" name="<?php print IIFU_PROPERTIES::NAME_SUBMIT; ?>" value="<?php _e('Submit',IIFU_PROPERTIES::TEXT_DOMAIN); ?>" /></p>
</form>
<p id="<?php print IIFU_PROPERTIES::ID_MESSAGE; ?>" class="<?php print IIFU_PROPERTIES::CLASS_CAUTION; ?>"></p>
