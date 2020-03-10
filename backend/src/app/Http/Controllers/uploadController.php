<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\RestExceptionHandlerTrait;
use Illuminate\Http\Request;
use Validator;
use Storage;

class uploadController extends Controller
{
    use RestExceptionHandlerTrait;

    public function __construct()
    {
        $this->middleware('auth.jwt');
    }

    /**
     * Upload file.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Post(
     *   path="/upload",
     *   tags={"Upload"},
     *   summary="Upload",
     *   operationId="upload",
     *   @SWG\Parameter(
     *     type="string",                                                                                                                                                                              
     *     name="Authorization",
     *     in="header",
     *     description="Bearer",
     *     required=true
     *   ),
     *   @SWG\Parameter( 
     *     name="file", 
     *     in="formData",
     *     required=true, 
     *     type="file", 
     *     description="File"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */

    public function upload(Request $request)
    {
        // Validate form
        $credentials = $request->all();
        $rules = [
            'file' => 'required',
        ];

        $validator = Validator::make($credentials, $rules);
        if ($validator->fails()) {
            return $this->jsonResponse(400, $validator->messages());
        }

        // Upload image
        if (!isset($_FILES['file'])) {
            return $this->jsonResponse(400, 'Bad request');
        }

        $fileStorage = 'public';
        $extension  = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $fileName   = date("Ymdhis") . '.' . $extension;

        if (isset($request->type)) {
            switch ($request->type) {
                case "image":
                    $fileStorage = 'image';
                    break;
                case "document":
                    $fileStorage = 'document';
                    break;
                case "audio":
                    $fileStorage = 'audio';
                    break;
            }
        }

        Storage::disk($fileStorage)->put($fileName, file_get_contents($_FILES['file']['tmp_name']));

        return response()->json([
            'success' => true,
            'data' => [
                'file_name' => $fileName,
                'file_url' => url('/') . Storage::url($fileName)
            ]
        ]);
    }
}
