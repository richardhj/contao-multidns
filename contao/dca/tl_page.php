<?php
/**
 * MultiDns extension for Contao Open Source CMS lets you configure multiple dns entries per root page
 *
 * Copyright (c) 2016 Richard Henkenjohann
 *
 * @package MultiDns
 * @author  Richard Henkenjohann <richardhenkenjohann@googlemail.com>
 */


/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_page']['palettes']['root'] = str_replace
(
	',dns',
	',multidns',
	$GLOBALS['TL_DCA']['tl_page']['palettes']['root']
);


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_page']['fields']['multidns'] = array
(
	'label'         => &$GLOBALS['TL_LANG']['tl_page']['dns'],
	'exclude'       => true,
	'inputType'     => 'multiColumnWizard',
	'eval'          => array
	(
		'columnFields' => array
		(
			'dns' => array
			(
				'label'          => &$GLOBALS['TL_LANG']['tl_page']['dns'],
				'exclude'        => true,
				'inputType'      => 'text',
				'decodeEntities' => true,
				'rgxp'           => 'url',
				'save_callback'  => array
				(
					array('tl_page', 'checkDns')
				)
			),
		),
		'tl_class'     => 'clr long',
		'doNotSaveEmpty' => true
	),
	'load_callback' => array(array('MultiDns\Helper', 'loadMultiDns')),
	'save_callback' => array(array('MultiDns\Helper', 'saveMultiDns')),
);
