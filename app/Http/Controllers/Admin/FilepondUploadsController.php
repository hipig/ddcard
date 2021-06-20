<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FilepondUploadRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FilepondUploadsController extends Controller
{
    protected $disk = 'upload';

    public function process(FilepondUploadRequest $request)
    {
        $dir = Str::plural($request->type ?? 'image');
        $path = $this->getStorage()->putFile($dir, $request->file('filepond'));

        return response()->json($path);
    }

    public function load(Request $request)
    {
        $path = $request->get('load');

        return $this->getStorage()->download($path);
    }

    public function revert(Request $request)
    {
        $this->getStorage()->delete($request->getContent());

        return response(null, 204);
    }

    protected function getStorage($disk = null)
    {
        return Storage::disk($disk ?? $this->disk);
    }
}
