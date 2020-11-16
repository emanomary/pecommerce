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

function subCatRecursion($categories, $counter, $char){
    foreach($categories as $cat){
        $space = "";
        $style= "";
        $temp=$counter;
        while($temp>0){
            $space.="&nbsp&nbsp&nbsp";
            $style.= $char;
            $temp--;
        }

        if(isset($cat->id)){
            echo '<option value=" ' . $cat->id . '"> ' . $space . $style .
                $cat->name . '</option>';
        }
        if(isset($cat->_childs)){
            subCatRecursion($cat->_childs, $counter+1, $char);
        }
    }
}
