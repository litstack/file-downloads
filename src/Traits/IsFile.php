<?php

namespace Ignite\FileDownloads\Traits;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait IsFile
{
    public static function storeFileOnDisk(UploadedFile $file, string $filepath)
    {
        self::storage()->putFileAs(
            $filepath,
            $file,
            $file->getClientOriginalName()
        );
    }

    public static function newFromUploadedFile(UploadedFile $file)
    {
        $filepath = Str::uuid();

        self::storeFileOnDisk($file, $filepath);

        $model = new static([
            'filepath' => $filepath,
            'filename' => $file->getClientOriginalName(),
            'mimetype' => $file->getClientMimeType(),
            'size'     => $file->getSize(),
        ]);

        return $model;
    }

    public function updateFromUploadedFile(UploadedFile $file)
    {
        $filepath = Str::uuid();

        self::storeFileOnDisk($file, $filepath);

        $model = $this->update([
            'filepath' => $filepath,
            'filename' => $file->getClientOriginalName(),
            'mimetype' => $file->getClientMimeType(),
            'size'     => $file->getSize(),
        ]);

        return $model;
    }

    public function getUrl()
    {
        return $this->storage()->url(
            $this->filepath.DIRECTORY_SEPARATOR.$this->filename
        );
    }

    /**
     * The filesystem that should be used.
     *
     * @return FilesystemAdapter
     */
    public static function storage(): FilesystemAdapter
    {
        return Storage::disk('public');
    }

    /**
     * Delete file from disk.
     *
     */
    public function removeFileFromDisk()
    {
        self::storage()->deleteDirectory($this->filepath);
    }
}
