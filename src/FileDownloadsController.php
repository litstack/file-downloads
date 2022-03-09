<?php

namespace Ignite\FileDownloads;

use Ignite\Page\Page;
use Illuminate\Http\Request;

class FileDownloadsController
{
    public function __invoke()
    {
        $page = new Page;
        $page->component('files');

        $page->bind([
            'files' => FileDownload::all(),
        ]);

        return $page->title('File Downloads');
    }

    public function upload(Request $request)
    {
        $file = FileDownload::newFromUploadedFile($request->file)->save();

        return $file;
    }
}
