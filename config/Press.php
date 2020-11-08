<?php

return [
    /*
     * Driver that used to fetch files of 'files_path' directiory
     * Supported drivers
     * ------------------
     * [ 'files' ]
     * */
    'driver'    =>  'file',

    /*
     * Path of .md files that contains posts
     * Custom path to your posts files directory
     * which related to the selected dirver
     * */
    'file'  =>  [

        'files_path' => 'blogs',
    ],

    'path'  =>  'admin'
];