<?php

if (function_exists('include_route_files') === false) {
    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function include_route_files($folder)
    {
        $rdi = new RecursiveDirectoryIterator($folder);
        $it = new RecursiveIteratorIterator($rdi);
        while ($it->valid()) {
            if (!$it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                require $it->key();
            }
            $it->next();
        }
    }
}
