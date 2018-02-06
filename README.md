*php* URI
===============
URL Standardized Redirector with Customized Setting for SEO

[![Latest Stable Version](https://poser.pugx.org/yidas/uri/v/stable?format=flat-square)](https://packagist.org/packages/yidas/uri)
[![Latest Unstable Version](https://poser.pugx.org/yidas/uri/v/unstable?format=flat-square)](https://packagist.org/packages/yidas/uri)
[![License](https://poser.pugx.org/yidas/uri/license?format=flat-square)](https://packagist.org/packages/yidas/uri)


---

DEMONSTRATION
-------------

```php
yidas\uri\Seo::trailingSlash(false)->removeIndex();
```


REQUIREMENTS
------------

This library requires the following:

- PHP 5.4.0+

---

INSTALLATION
------------

Run Composer in your project:

    composer require yidas/uri

---

COMPONENTS
----------

### Seo

`yidas\uri\Seo` is a helper to handle URI for SEO, you could customized set rules in your application, then it will redirect to correct URI if the current URI is not match your expectation.

The usage methods are following:

#### `trailingSlash()`

Trailing Slash Handler, by default it always redirect to uri with last slash.

```
https://www.domain.com/about/   (Switch On)
https://www.domain.com/about    (Switch Off)
```

For example:

```php
yidas\uri\Seo::trailingSlash(false);
// https://www.domain.com/about/ => https://www.domain.com/about
```

#### `removeIndex()`

Most framework allows index action could be accessed by root URI of controller, this makes that way only.

For example, `https://www.domain.com/about/index/` to `https://www.domain.com/about/`.
