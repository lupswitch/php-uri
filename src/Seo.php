<?php

namespace yidas\uri;

/**
 * SEO URI Redirector
 * 
 * A helper to handle URI for SEO, you could customized set rules in your 
 * application, then it will redirect to correct URI if the current URI is not 
 * match your expectation.
 * 
 * @author 	Nick Tsai <myintaer@gmail.com>
 * @since   1.1.0
 */
class Seo
{
    /**
     * Trailing Slash Handler
     * 
     * @param bool Switch to keep trailing slash or not
     * @return object self
     * @example
     *  https://www.domain.com/about/   (Switch On)
     *  https://www.domain.com/about    (Switch Off)
     */
	public static function trailingSlash($switch=true)
	{
        // AJAX skip
        if (self::isAjax()) {
            return new self;
        }
        
        $uri = self::getRequestUri();
        
        if ($switch) {
            // Add trailing slash
            if ($uri && strpos($uri, '?')===false 
                && strpos($uri, '/')!==false //Except root
                && substr($uri, -1)!=='/') {
    
                self::redirect($uri. '/', true);
            }

        } else {
            // Remove trailing slash
            if ($uri && substr($uri, -1)==='/') {
                
                $uri = substr($uri, 0, -1);
    
                self::redirect($uri, true);
            }
        }
        
        return new self;
    }

    /**
     * Remove Index Action Name from URI
     * 
     * Most framework allows index action could be accessed by root URI of 
     * controller, this makes that way only.
     * 
     * @param string index action string with slash prefix
     * @return object self
     * @example
     *  https://www.domain.com/about/index/ to
     *  https://www.domain.com/about/
     */
    public static function removeIndex($caseSensitive=false, $index='/index')
    {
        // AJAX skip
        if (self::isAjax()) {
            return new self;
        }
        
        $uri = self::getRequestUri();
        // Find matched position
        $pos = $caseSensitive 
            ? strpos($uri, $index)
            : strpos(strtolower($uri), strtolower($index));

        if ($pos && strpos($uri, '?')===false) {
            // Get index action URI segment
            $indexLen = strlen($index);
            $index = substr($uri, $pos, $indexLen);
            // Check index string is in the end of URI with trailing slash concern
            if (strpos(substr($uri, -1-$indexLen), $index) !== false) {
                // Replace
                $uri = str_replace($index, '', $uri);
                self::redirect($uri, true);
            } 
        }

        return new self;
    }

    /**
     * Get Server REQUEST_URI
     * 
     * @return string $_SERVER['REQUEST_URI']
     */
    public static function getRequestUri()
    {
        return isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : NULL;
    }

    /**
     * Is Reuest comes from AJAX
     * 
     * @return bool Result
     */
    public static function isAjax()
    {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) 
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    }
    
    /**
     * Redirect URI
     * 
     * @param string URL
     * @param bool 301 Moved Permanently
     */
    public static function redirect($uri='/', $code301=false)
    {
        if ($code301) {

            header("HTTP/1.1 301 Moved Permanently");
        }

        header("Location: {$uri}");
        exit;
    }
}
