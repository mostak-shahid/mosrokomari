<?php 

require_once('functions/theme-init/plugin-update-checker.php');
$themeInit = Puc_v4_Factory::buildUpdateChecker(
	'https://raw.githubusercontent.com/mostak-shahid/update/master/mosrokomari.json',
	__FILE__,
	'mosrokomari'
);


require_once('functions/scripts.php');
require_once('functions/setup.php');
require_once('functions/widgets.php');
require_once('functions/post-types.php');
//require_once('functions/taxonomy.php');
require_once('functions/customize.php');
require_once('functions/theme-functions.php');
require_once('functions/custom-comments.php');
require_once('functions/shortcodes.php');
require_once('functions/theme-hooks.php');
require_once('functions/array.php');
require_once('functions/ajax.php');
require_once('functions/woo-functions.php');
require_once('functions/aq_resizer.php');
require_once('functions/breadcrumb.php');
require_once('functions/Mobile_Detect.php');
//require_once('functions/custom-metabox.php');
//require_once('functions/post-like.php');
//require_once('functions/post-view.php');


//Adding theme option redux
require_once('inc/theme-options/ReduxCore/framework.php'); 
//require_once('inc/theme-options/sample/sample-config.php');
require_once('functions/theme-options.php');
require_once('inc/theme-options/loader.php');
require_once('inc/metabox/init.php'); 
require_once('inc/metabox/custom-cmb2-fields.php'); 
require_once('inc/metabox/extensions/cmb-field-sorter/cmb-field-sorter.php');
require_once('inc/metabox/extensions/cmb2-conditionals/cmb2-conditionals.php');
//require_once('inc/cmb2-conditionals/cmb2-conditionals.php'); 
require_once('functions/metaboxes.php'); 
require_once('inc/TGM-Plugin-Activation-develop/plugin-management.php');
require_once('scripts.php');

Redux::init( 'mosrokomari_options' );


