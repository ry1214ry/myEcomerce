<?php

namespace App\Http\Controllers;

use App\Support\PublicMedia;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function show(string $path)
    {
        $normalizedPath = PublicMedia::normalize($path);

        abort_if(
            !$normalizedPath || filter_var($normalizedPath, FILTER_VALIDATE_URL),
            404
        );

        $segments = explode('/', $normalizedPath);

        abort_if(
            collect($segments)->contains(fn (string $segment) => in_array($segment, ['', '.', '..'], true)),
            404
        );

        abort_unless(Storage::disk('public')->exists($normalizedPath), 404);

        return Storage::disk('public')->response($normalizedPath);
    }
}
