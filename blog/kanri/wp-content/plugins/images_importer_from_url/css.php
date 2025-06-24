<?php
header('Content-Type: text/css; charset=UTF-8');
require(dirname(__FILE__).'/properties.php');
?>
.<?php print IIFU_PROPERTIES::CLASS_CAUTION; ?> {
	color: #ff0000;
}

#<?php print IIFU_PROPERTIES::ID_IMAGES_OUTER; ?> {
	width: 90%;
	margin: 0 auto;
}

#<?php print IIFU_PROPERTIES::ID_IMAGES_TABLE; ?> {
	width: 100%;
	margin: 0 auto;
	border-collapse: collapse;
}

#<?php print IIFU_PROPERTIES::ID_IMAGES_TABLE; ?>,
#<?php print IIFU_PROPERTIES::ID_IMAGES_TABLE; ?> tr,
#<?php print IIFU_PROPERTIES::ID_IMAGES_TABLE; ?> td {
	border: 1px solid #dddddd;
}

#<?php print IIFU_PROPERTIES::ID_IMAGES_TABLE; ?> tr {
	background-color: transparent;
}

#<?php print IIFU_PROPERTIES::ID_IMAGES_TABLE; ?> tr.<?php print IIFU_PROPERTIES::CLASS_SUCCEED; ?> {
	background-color: #ffffee;
}

#<?php print IIFU_PROPERTIES::ID_IMAGES_TABLE; ?> tr.<?php print IIFU_PROPERTIES::CLASS_FAILED; ?> {
	background-color: #ffeeee;
}

#<?php print IIFU_PROPERTIES::ID_IMAGES_TABLE; ?> td.<?php print IIFU_PROPERTIES::CLASS_IMAGE_TD; ?> {
	width: 120px;
	text-align: center;
	border-right: none;
}

#<?php print IIFU_PROPERTIES::ID_IMAGES_TABLE; ?> td.<?php print IIFU_PROPERTIES::CLASS_IMAGE_TD; ?> img {
	width: 100px;
	height: 100px;
}

#<?php print IIFU_PROPERTIES::ID_IMAGES_TABLE; ?> td.<?php print IIFU_PROPERTIES::CLASS_URL_TD; ?> {
	vertical-align: middle;
	border-left: none;
}

p.<?php print IIFU_PROPERTIES::CLASS_SUCCEED; ?> {
	color: #0000ff;
	font-weight: bold;
}
