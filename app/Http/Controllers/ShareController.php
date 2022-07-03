<?php

namespace App\Http\Controllers;

use App\Helper\AlbumConfigHelper;
use App\Helper\AlbumImageHelper;
use App\Helper\ImageThumbnailHelper;
use App\Pipelines\UploadDirectoryPipeline\Chains\GetAlbumConfig;
use Illuminate\Support\Facades\Response;

class ShareController extends Controller
{
    public function download(string $md)
    {
        if ($md == '192347981234') {
            //PDF file is stored under project/public/download/info.pdf
            $file = resource_path('share/Reportf051901c-c4d5-4d0c-9c9f-f92361f58473.pdf');

            $headers = array(
                'Content-Type: application/pdf',
            );

            return Response::download($file, 'Reportf051901c-c4d5-4d0c-9c9f-f92361f58473.pdf', $headers);
        }

        abort(404);
    }
}
