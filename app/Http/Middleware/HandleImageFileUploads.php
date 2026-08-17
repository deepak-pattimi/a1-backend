<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\CPU\ImageManager;

class HandleImageFileUploads
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Loop through all uploaded files
        foreach ($request->allFiles() as $key => $file) {
            // Check if the input name ends with '_file' (e.g., blog_image_file, image_file)
            if (str_ends_with($key, '_file')) {
                // Determine the base field name (e.g., blog_image, image)
                $baseKey = substr($key, 0, -5);
                
                $fileName = \Carbon\Carbon::now()->toDateString() . "-" . uniqid() . "." . $file->extension();
                $uploadPath = public_path('uploads/general/');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                
                // We COPY the file instead of moving it, so if a specific controller (like BlogController) 
                // still tries to process the file manually later, it won't crash trying to read a missing temp file!
                copy($file->getPathname(), $uploadPath . '/' . $fileName);
                $url = '/uploads/general/' . $fileName;
                
                $request->merge([$baseKey => $url]);
                // Removed request->files->remove($key) so downstream logic can safely ignore or process it.
            }
        }

        return $next($request);
    }
}
