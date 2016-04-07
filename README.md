[![Latest Version on Packagist](http://img.shields.io/packagist/v/richardhj/contao-multidns.svg)](https://packagist.org/packages/richardhj/contao-multidns)
[![Dependency Status](https://www.versioneye.com/php/richardhj:contao-multidns/badge.svg)](https://www.versioneye.com/php/richardhj:contao-multidns)

# MultiDns for Contao Open Source CMS

Per default it is only possible to assign one domain or none per root page.
MultiDns extension for Contao Open Source CMS lets you configure multiple dns entries per root page, e.g. if you need
- ```example.org``` AND
- ```example.com```

routed to one root page.

Routing ```example.org``` AND ```www.example.org``` to one root page is still recommended to do with an ```.htaccess```-Redirect-Rule.

## Duplicate content with this extension?

Adding ```hreflang``` attributes to your website can prohibit duplicate content.
See https://support.google.com/webmasters/answer/189077 and following code for more information:
```html
<link rel="alternate" hreflang="x-default" href="http://example.at/" />
<link rel="alternate" hreflang="de-at" href="http://example.at/" />
<link rel="alternate" hreflang="de-de" href="http://example.de/" />
<link rel="alternate" hreflang="de-ch" href="http://example.ch/" />
<link rel="alternate" hreflang="de" href="http://example.at/" />
```
