<?php
/**
 * MultiDns extension for Contao Open Source CMS lets you configure multiple dns entries per root page
 *
 * Copyright (c) 2016 Richard Henkenjohann
 *
 * @package MultiDns
 * @author  Richard Henkenjohann <richardhenkenjohann@googlemail.com>
 */

namespace MultiDns;


/**
 * Class Helper
 * @package MultiDns
 */
class Helper
{
	
	/**
	 * Save the MultiDns entries comma delimited in the database
	 *
	 * @param string         $varValue The entries MCW formatted as serialized string
	 * @param \DataContainer $dc
	 *
	 * @return string
	 */
	public function saveMultiDns($varValue, $dc)
	{
		$varValue = deserialize($varValue, true);

		$varValue = implode(',', array_map(function ($entry)
		{
			return $entry['dns'];
		}, $varValue));

		/** @type \Model $objModel */
		$objModel = \PageModel::findByPk($dc->id);
		$objModel->dns = $varValue;
		$objModel->save();

		// Return empty string as we don't want to save native
		return '';
	}


	/**
	 * Convert the comma delimited value to a native MultiColumnWizard value
	 *
	 * @param string         $varValue
	 * @param \DataContainer $dc
	 *
	 * @return array The dns entries MCW adapted
	 */
	public function loadMultiDns($varValue, $dc)
	{
		$varValue = $dc->activeRecord->dns;
		
		$varValue = trimsplit(',', $varValue);
		$varValue = array_map(function ($entry)
		{
			return array('dns' => $entry);
		}, $varValue);

		return $varValue;
	}
}
