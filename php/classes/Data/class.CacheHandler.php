<?php

/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 28-12-2014
 * Time: 01:00
 */

class CacheHandler extends Singleton
{

    public function getCachedXMLFile($cacheName, $cacheDuration, $url, $parameters = null)
    {
        $this->$cacheDuration = $cacheDuration;
        $cacheFile = "cache/" . $cacheName . '.cache';
        if (!file_exists($cacheFile) || filemtime($cacheFile) + $cacheDuration < time()) {
            /*
             * Cache bestand maken
             */
            $contents = APIHandler::getInstance()->getXMLContent($url, $parameters);
            file_put_contents($cacheFile, $contents);

        } else {
            /*
             * Cache bestand laden
             */
        }

        return $cacheFile;
    }

    public function deleteCache()
    {
        /** define the directory **/
        $dir = "cache/";
        $except = array("stations.cache");

        /*** cycle through all files in the directory ***/
        foreach (glob($dir . "*") as $file) {

            /*** if file is 1 hours (3600 seconds) old then delete it ***/
            if (filemtime($file) < time() - 3600 && !in_array($file, $except)) {
                unlink($file);
            }
        }
    }

} 