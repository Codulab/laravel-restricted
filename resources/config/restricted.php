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
    'file_path' => public_path("restricted-usernames.txt"),

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
    | 
    |
    */
    'merge' => true,

 ];