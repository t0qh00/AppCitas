<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Manipulations;

class Carpeta extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    public $table = 'Carpetas';

    public $fillable = [
        'nombre',
        'id_padre',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $thumbnailWidth  = 50;
        $thumbnailHeight = 50;

        $thumbnailPreviewWidth  = 120;
        $thumbnailPreviewHeight = 120;

        $this->addMediaConversion('thumbnail')
            ->width($thumbnailWidth)
            ->height($thumbnailHeight)
            ->fit('crop', $thumbnailWidth, $thumbnailHeight);
        $this->addMediaConversion('preview_thumbnail')
            ->width($thumbnailPreviewWidth)
            ->height($thumbnailPreviewHeight)
            ->fit('crop', $thumbnailPreviewWidth, $thumbnailPreviewHeight);
    }

    public function getIconAttribute()
    {
        return $this->getMedia('CarpetaPadre-collection-1')->map(function ($item) {
            $media = $item->toArray();
            $media['url'] = $item->getUrl();
            if ($item->getUrl('thumbnail')) {
                $media['thumbnail'] = $item->getUrl('thumbnail');
            }
            if ($item->getUrl('preview_thumbnail')) {
                $media['preview_thumbnail'] = $item->getUrl('preview_thumbnail');
            }

            return $media;
        });
    }

}
