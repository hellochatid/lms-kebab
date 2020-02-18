<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\RestExceptionHandlerTrait;
use Illuminate\Http\Request;
use JWTAuth;
use Validator, DB;

class PagesController extends Controller
{
    use RestExceptionHandlerTrait;

    public function __construct()
    {
        $this->middleware('auth.jwt');
    }

    /**
     * Add content page.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Post(
     *   path="/admin/pages",
     *   tags={"Admin"},
     *   summary="Pages",
     *   operationId="pages",
     *   @SWG\Parameter(
     *     type="string",                                                                                                                                                                              
     *     name="Authorization",
     *     in="header",
     *     description="Bearer",
     *     required=true
     *   ),
     *   @SWG\Parameter(
     *     name="title",
     *     in="query",
     *     description="Title",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="subtitle",
     *     in="query",
     *     description="Subtitle",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="text",
     *     in="query",
     *     description="Content",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="description",
     *     in="query",
     *     description="Description",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="tag",
     *     in="query",
     *     description="Tag",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="image",
     *     in="query",
     *     description="Featured Image",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="publish",
     *     in="query",
     *     description="Publish",
     *     required=false,
     *     type="boolean"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */

    public function addPages(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        // Validate form
        $credentials = $request->all();
        $rules = [
            'title' => 'required|max:255',
        ];

        $validator = Validator::make($credentials, $rules);
        if ($validator->fails()) {
            return $this->jsonResponse(400, $validator->messages());
        }

        // Add Page
        $pageTitle =  $request->title ? $request->title: '';
        $pageSubtitle =  $request->subtitle ? $request->subtitle: '';
        $pageText =  $request->text ? $request->text: '';
        $pageDescription =  $request->description ? $request->description: '';
        $pageTag =  $request->tag ? $request->tag: '';
        $pageImage =  $request->image ? $request->image: '';
        $publish =  $request->publish ? $request->publish: false;

        DB::table('pages')->insert([
            'page_title' => $pageTitle,
            'page_subtitle' => $pageSubtitle,
            'page_text' => $pageText,
            'page_description' => $pageDescription,
            'page_tag' => $pageTag,
            'page_image' => $pageImage,
            'publish' => $publish,
            'created_at' => now(),
            'created_by' => JWTAuth::user()->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Page successfully added',
        ]);
    }
}
