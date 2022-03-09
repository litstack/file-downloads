<?php

namespace Ignite\FileDownloads;

use Ignite\FileDownloads\Traits\IsFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileDownload extends Model
{
    use IsFile;
    use SoftDeletes;

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
