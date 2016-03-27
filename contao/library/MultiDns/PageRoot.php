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
 * Class PageRoot
 * @package MultiDns
 */
class PageRoot extends \Contao\PageRoot
{

	/**
	 * Redirect to the first active regular page
	 *
	 * @param integer $pageId
	 * @param boolean $blnReturn
	 * @param boolean $blnPreferAlias
	 *
	 * @return integer
	 */
	public function generate($pageId, $blnReturn = false, $blnPreferAlias = false)
	{
		// Since the alias is ambiguous globally we have have to prohibit returning the alias instead a page's id
		// We have to do this because the FrontendIndex::run() does not let us hook in
		return parent::generate($pageId, $blnReturn, false);
	}
}
