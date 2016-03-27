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
 * Class PageModel
 * @package MultiDns
 */
class PageModel extends \Contao\PageModel
{

	/**
	 * Alter the "domain" key
	 *
	 * @return static The page model
	 */
	public function loadDetails()
	{
		parent::loadDetails();

		// Return the current host if in dns list or the full dns list to have a domain restriction at all
		$this->domain = in_array(\Environment::get('host'), trimsplit(',', $this->domain))
			? \Environment::get('host')
			: $this->domain;

		return $this;
	}


	/**
	 * Find the first published root page by its host name and language
	 *
	 * @param string $strHost     The host name
	 * @param mixed  $varLanguage An ISO language code or an array of ISO language codes
	 * @param array  $arrOptions  An optional options array
	 *
	 * @return static The model or null if there is no matching root page
	 */
	public static function findFirstPublishedRootByHostAndLanguage($strHost, $varLanguage, array $arrOptions = array())
	{
		$t = static::$strTable;
		$objDatabase = \Database::getInstance();

		$strWhereFindHostInDns = $objDatabase->findInSet('\'' . $strHost . '\'', "$t.dns", true);

		if (is_array($varLanguage))
		{
			$arrColumns = array("$t.type='root' AND ($strWhereFindHostInDns OR $t.dns='')");

			if (!empty($varLanguage))
			{
				$arrColumns[] = "($t.language IN('" . implode("','", $varLanguage) . "') OR $t.fallback='1')";
			}
			else
			{
				$arrColumns[] = "$t.fallback='1'";
			}

			//@todo this needs a rework as it is equal with the parent's code
			if (!isset($arrOptions['order']))
			{
				$arrOptions['order'] = "$t.dns DESC" . (!empty($varLanguage) ? ", " . $objDatabase->findInSet("$t.language", array_reverse($varLanguage)) . " DESC" : "") . ", $t.sorting";
			}

			if (!BE_USER_LOGGED_IN)
			{
				$time = \Date::floorToMinute();
				$arrColumns[] = "($t.start='' OR $t.start<='$time') AND ($t.stop='' OR $t.stop>'" . ($time + 60) . "') AND $t.published='1'";
			}

			return static::findOneBy($arrColumns, array(), $arrOptions);
		}
		else
		{
			$arrColumns = array("$t.type='root' AND ($strWhereFindHostInDns OR $t.dns='') AND ($t.language=? OR $t.fallback='1')");
			$arrValues = array($varLanguage);

			//@todo this needs a rework as it is equal with the parent's code
			if (!isset($arrOptions['order']))
			{
				$arrOptions['order'] = "$t.dns DESC, $t.fallback";
			}

			if (!BE_USER_LOGGED_IN)
			{
				$time = \Date::floorToMinute();
				$arrColumns[] = "($t.start='' OR $t.start<='$time') AND ($t.stop='' OR $t.stop>'" . ($time + 60) . "') AND $t.published='1'";
			}

			return static::findOneBy($arrColumns, $arrValues, $arrOptions);
		}
	}
}
