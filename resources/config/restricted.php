<?php
return [

    /*
    |--------------------------------------------------------------------------
    | File path
    |--------------------------------------------------------------------------
    |
    | File name and path to save the indexed words
    | 
    | 
    |
    */
    'file_path' => public_path("reserved.txt"),

    /*
    |--------------------------------------------------------------------------
    | Index level
    |--------------------------------------------------------------------------
    |
    | How deep do u want us to crawl your routes?
    | Ex www.mywebsite.com/segment1/segmen2/segment3
    | setting this value to '2', will allow indexing of segment1 and segment2
    | and exclude segment3
    |
    */
    'index_level' => 2,

    /*
    |--------------------------------------------------------------------------
    | Should merge
    |--------------------------------------------------------------------------
    |
    | Do you want to merge the new result with the old one?
    | It is recommended to set this to "true" if you 
    | manually added some words to the txt file. So as not to loss them.
    |
    */
    'merge' => true,

 ];