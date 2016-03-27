<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'MultiDns',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Library
	'MultiDns\Helper'    => 'system/modules/multidns/library/MultiDns/Helper.php',
	'MultiDns\PageModel' => 'system/modules/multidns/library/MultiDns/PageModel.php',
	'MultiDns\PageRoot'  => 'system/modules/multidns/library/MultiDns/PageRoot.php',
));
