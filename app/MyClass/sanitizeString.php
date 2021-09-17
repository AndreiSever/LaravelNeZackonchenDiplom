<?php
 
namespace App\MyClass;

class sanitizeMySql
{
    public function sanitizeString($var)
    {
        if (get_magic_quotes_gpc()) $var=stripslashes($var);
        $var=htmlentities($var);
        $var=strip_tags($var);
        return $var;
    }		
    public function sanitizeMySql($var)
    {
        $var=mysqli_real_escape_string($db,$var);
        $var=$this->sanitizeString($var);
        return $var;
    }
}