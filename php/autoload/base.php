<?php
class Base {
    /**
     * Provides auto-loading support of classes that follow [class
     * naming conventions](class-names-and-file-location).
     *
     * Class names are converted to file names by making the class name
     * lowercase and converting underscores to slashes:
     *
     *     // Loads classes/my/class/name.php
     *     Base::auto_load('My_Class_Name');
     *
     * You should never have to call this function, as simply calling a class
     * will cause it to be called.
     *
     * This function must be enabled as an autoloader in the bootstrap:
     *
     *     spl_autoload_register(array('Base', 'auto_load'));
     *
     * @param   string   class name
     * @return  boolean
     */
    public static function auto_load($class)
    {
        try
        {
            // Transform the class name into a path
            $file = ROOT_PATH.'/classes/'.str_replace('_', '/', strtolower($class)).".php";

            if ( file_exists($file) )
            {
                // Load the class file
                require $file;

                // Class has been found
                return TRUE;
            }

            // Class is not in the filesystem
            return FALSE;
        }
        catch (Exception $e)
        {
            echo "Exception:".$e.message;
            die;
        }
    }
}