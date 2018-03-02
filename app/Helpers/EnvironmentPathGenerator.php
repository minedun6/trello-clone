<?php

namespace App\Helpers;

use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\PathGenerator\PathGenerator;

use Spatie\MediaLibrary\PathGenerator\BasePathGenerator;

class EnvironmentPathGenerator implements PathGenerator
{

    protected $path;

    public function __construct()
    {
        $this->path = app()->environment();
    }

    /**
     * @param Media $media
     * @return string
     */
    public function getPath(Media $media): string
    {
        return $this->basePath($media);
    }

    /**
     * @param Media $media
     * @return string
     */
    public function getPathForConversions(Media $media): string
    {
        return $this->basePath($media, 'conversions');
    }

    /**
     * @param Media $media
     * @return string
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->basePath($media, 'responsive');
    }

    /**
     * @param $media
     * @param null $type
     * @param string $folder
     * @return string
     */
    protected function basePath($media, $type = null, $folder = 'attachements')
    {
        $folder_type = attachement_folder($media);
        return "{$this->path}/{$folder_type}/{$folder}-{$media->id}/{$type}/";
    }
}