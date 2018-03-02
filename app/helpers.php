<?php

if (!function_exists('ddd')) {

    /**
     * workaround for the laravel helper function dd
     * @param array $args
     */
    function ddd(...$args)
    {
        http_response_code(500);
        call_user_func_array('dd', $args);
    }
}

if (!function_exists('random_color')) {

    /**
     * generates a random color
     */
    function random_color()
    {
        return '#' . dechex(rand(0x000000, 0xDDDDDD));
    }
}

if (!function_exists('attachement_folder')) {

    function attachement_folder($media)
    {

        $mimes = collect([

            'documents' => [
                'txt' => 'text/plain',
                'json' => 'application/json',
                'zip' => 'application/zip',
                'rar' => 'application/x-rar-compressed',
                'exe' => 'application/x-msdownload',
                'msi' => 'application/x-msdownload',
                'pdf' => 'application/pdf',
                'psd' => 'image/vnd.adobe.photoshop',
                'ai' => 'application/postscript',
                'eps' => 'application/postscript',
                'ps' => 'application/postscript',
                'doc' => 'application/msword',
                'xls' => 'application/vnd.ms-excel',
                'ppt' => 'application/vnd.ms-powerpoint',
                'odt' => 'application/vnd.oasis.opendocument.text',
                'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
            ],
            'images' => [
                'png' => 'image/png',
                'jpe' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'jpg' => 'image/jpeg',
                'gif' => 'image/gif',
                'bmp' => 'image/bmp',
                'ico' => 'image/vnd.microsoft.icon',
                'tiff' => 'image/tiff',
                'tif' => 'image/tiff',
                'svg' => 'image/svg+xml',
                'svgz' => 'image/svg+xml',
            ],

            'videos' => [
                'flv' => 'video/x-flv',
                'mov' => 'video/quicktime',
                'qt' => 'video/quicktime',
                'mp4' => 'video/mp4',
                'wmv' => 'video/x-ms-wmv',
                'avi' => 'video/x-msvideo'
            ],

            'audio' => [
                'mp3' => 'audio/mpeg',
            ]
        ]);

        return key($mimes->filter(function ($group, $key) use ($media) {
            return collect($group)->filter(function ($mime, $key) use ($media) {
                return $key == $media->extension || $mime == $media->mime;
            })->isNotEmpty();
        })->toArray());
    }
}
