<?php

namespace Ignite\FileDownloads;

use Ignite\FileDownloads\Traits\IsFile;
use Illuminate\Database\Eloquent\Model;

class FileDownload extends Model
{
    use IsFile;

    // protected $fileAttachmentModel = self::class;

    protected $fillable = [
        'display_name', 'group', 'disk', 'filepath', 'filename', 'mimetype',
        'size', 'meta',
    ];

    protected $casts = [
        'size' => 'int',
        'meta' => 'json',
    ];

    protected $attributes = [
        'disk' => 'public',
    ];
}
