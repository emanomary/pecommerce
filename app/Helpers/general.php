<?php
define('PAGINATION_COUNT',10);
/**
 * return the folder of  direction of site ltr or rtl
 * @return string
 */
function getFolder()
{
    $directionFolder = app()->getLocale() == 'ar'? 'css-rtl' : 'css';
    return $directionFolder;
}
