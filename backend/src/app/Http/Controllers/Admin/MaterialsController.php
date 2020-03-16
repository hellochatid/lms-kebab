<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\RestExceptionHandlerTrait;
use Illuminate\Http\Request;
use JWTAuth;
use Validator, DB;
use Storage;

class MaterialsController extends Controller
{
    use RestExceptionHandlerTrait;

    public function __construct()
    {
        $this->middleware('auth.jwt');
    }

    /**
     * Add materials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Post(
     *   path="/admin/materials",
     *   tags={"Admin"},
     *   summary="Add materials",
     *   operationId="materials_add",
     *   @SWG\Parameter(
     *     type="string",                                                                                                                                                                              
     *     name="Authorization",
     *     in="header",
     *     description="Bearer",
     *     required=true
     *   ),
     *   @SWG\Parameter(
     *     name="lesson_id",
     *     in="query",
     *     description="Lesson ID",
     *     required=true,
     *     type="string"
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
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="description",
     *     in="query",
     *     description="Description",
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="content",
     *     in="query",
     *     description="Content",
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="tag",
     *     in="query",
     *     description="Tag",
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="image",
     *     in="query",
     *     description="Image",
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="pdf",
     *     in="query",
     *     description="PDF",
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="audio",
     *     in="query",
     *     description="Audio",
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="video",
     *     in="query",
     *     description="Video",
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */

    public function addMaterials(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        // Validate form
        $credentials = $request->all();
        $rules = [
            'lesson_id' => 'required',
            'title' => 'required',
            'content' => 'required',
        ];

        $validator = Validator::make($credentials, $rules);
        if ($validator->fails()) {
            return $this->jsonResponse(400, $validator->messages());
        }

        // Add materials
        $lesson_id =  $request->lesson_id ? $request->lesson_id : 0;
        $title =  $request->title ? $request->title : '';
        $subtitle =  $request->subtitle ? $request->subtitle : '';
        $description =  $request->description ? $request->description : '';
        $content =  $request->content ? $request->content : '';
        $tag =  $request->tag ? $request->tag : '';
        $image =  $request->image ? $request->image : '';
        $pdf =  $request->pdf ? $request->pdf : '';
        $audio =  $request->audio ? $request->audio : '';
        $video =  $request->video ? $request->video : '';

        $insertId = DB::table('materials')->insertGetId([
            'lesson_id' => $lesson_id,
            'title' => $title,
            'subtitle' => $subtitle,
            'description' => $description,
            'content' => $content,
            'tag' => $tag,
            'image' => $image,
            'pdf' => $pdf,
            'audio' => $audio,
            'video' => $video,
            'created_at' => now(),
            'created_by' => JWTAuth::user()->id,
        ]);

        // Response
        $response = [];
        $response['id'] = $insertId;
        $response['lesson_id'] = $lesson_id;
        $response['title'] = $title;
        $response['subtitle'] = $subtitle;
        $response['description'] = $description;
        $response['content'] = $content;
        $response['image'] = [
            'name' => $image !== '' && $image !== null ? $image : '',
            'url' => $image !== '' && $image !== null ? url('') . Storage::url('images/' . $image) : ''
        ];
        $response['pdf'] = [
            'name' => $pdf !== '' && $pdf !== null ? $pdf : '',
            'url' => $pdf !== '' && $pdf !== null ? url('') . Storage::url('documents/' . $pdf) : ''
        ];
        $response['audio'] = [
            'name' => $audio !== '' && $audio !== null ? $audio : '',
            'url' => $audio !== '' && $audio !== null ? url('') . Storage::url('audios/' . $audio) : ''
        ];
        $response['video'] = [
            'name' => $video !== '' && $video !== null ? $video : '',
            'url' => $video !== '' && $video !== null ? url('') . Storage::url('videos/' . $video) : ''
        ];

        return response()->json([
            'success' => true,
            'data' => $response
        ]);
    }

    /**
     * Get the materials
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @SWG\Get(
     *   path="/admin/materials",
     *   tags={"Admin"},
     *   summary="Get materials",
     *   operationId="materials_get",
     *   @SWG\Parameter(
     *     type="string",                                                                                                                                                                              
     *     name="Authorization",
     *     in="header",
     *     description="Bearer",
     *     required=true
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function getMaterials(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        $query = DB::table('materials')
            ->select(
                'id',
                'lesson_id',
                'title',
                'subtitle',
                'description',
                'content',
                'tag',
                'image',
                'pdf',
                'audio',
                'video'
            )
            ->whereNull('deleted_at');

        // if query ID exist
        if ($request->query->get('id') !== null) {
            $query->where('id', '=', $request->query->get('id'));
        }

        // if query lesson ID exist
        if ($request->query->get('lesson') !== null) {
            $query->where('lesson_id', '=', $request->query->get('lesson'));
        }

        // Get response data
        $data = $query->get();
        $response = [];

        foreach ($data as $materials) {
            $response[] = [
                'id' => $materials->id,
                'lesson_id' => $materials->lesson_id,
                'title' => $materials->title,
                'subtitle' => $materials->subtitle,
                'description' => $materials->description,
                'content' => $materials->content,
                'tag' => $materials->tag,
                'image' => [
                    'name' => $materials->image !== '' && $materials->image !== null ? $materials->image : '',
                    'url' => $materials->image !== '' && $materials->image !== null ? url('') . Storage::url('images/' . $materials->image) : ''
                ],
                'pdf' => [
                    'name' => $materials->pdf !== '' && $materials->pdf !== null ? $materials->pdf : '',
                    'url' => $materials->pdf !== '' && $materials->pdf !== null ? url('') . Storage::url('documents/' . $materials->pdf) : ''
                ],
                'audio' => [
                    'name' => $materials->audio !== '' && $materials->audio !== null ? $materials->audio : '',
                    'url' => $materials->audio !== '' && $materials->audio !== null ? url('') . Storage::url('audios/' . $materials->audio) : ''
                ],
                'video' => [
                    'name' => $materials->video !== '' && $materials->video !== null ? $materials->video : '',
                    'url' => $materials->video !== '' && $materials->video !== null ? url('') . Storage::url('videos/' . $materials->video) : ''
                ]
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $response,
        ]);
    }

    /**
     * Edit materials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Patch(
     *   path="/admin/materials/{id}",
     *   tags={"Admin"},
     *   summary="Edit materials",
     *   operationId="materials_edit",
     *   @SWG\Parameter(
     *     type="string",                                                                                                                                                                              
     *     name="Authorization",
     *     in="header",
     *     description="Bearer",
     *     required=true
     *   ),
     *   @SWG\Parameter(
     *     name="lesson_id",
     *     in="query",
     *     description="lesson ID",
     *     required=true,
     *     type="string"
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
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="description",
     *     in="query",
     *     description="Description",
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="content",
     *     in="query",
     *     description="Content",
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="image",
     *     in="query",
     *     description="Image",
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="pdf",
     *     in="query",
     *     description="PDF",
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="audio",
     *     in="query",
     *     description="Audio",
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="video",
     *     in="query",
     *     description="Video",
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function editMaterials(Request $request, $id = 0)
    {
        $request->user()->authorizeRoles(['admin']);

        $updatedValue = [];
        $updatedValue['lesson_id'] = $request->lesson_id;
        $updatedValue['title'] = $request->title;
        $updatedValue['subtitle'] = $request->subtitle;
        $updatedValue['description'] = $request->description;
        $updatedValue['content'] = $request->content;
        $updatedValue['tag'] = $request->tag;
        $updatedValue['image'] = $request->image;
        $updatedValue['pdf'] = $request->pdf;
        $updatedValue['audio'] = $request->audio;
        $updatedValue['video'] = $request->video;
        $updatedValue['order'] = $request->order;

        DB::table('materials')
            ->where('id', $id)
            ->update($updatedValue);

        // Response
        $response = $updatedValue;
        $response['id'] = $id;
        $response['tag'] = array_filter(explode(',', $request->tag));
        $response['image'] = [
            'name' => $request->image !== '' && $request->image !== null ? $request->image : '',
            'url' => $request->image !== '' && $request->image !== null ? url('') . Storage::url('images/' . $request->image) : ''
        ];
        $response['pdf'] = [
            'name' => $request->pdf !== '' && $request->pdf !== null ? $request->pdf : '',
            'url' => $request->pdf !== '' && $request->pdf !== null ? url('') . Storage::url('documents/' . $request->pdf) : ''
        ];
        $response['audio'] = [
            'name' => $request->audio !== '' && $request->audio !== null ? $request->audio : '',
            'url' => $request->audio !== '' && $request->audio !== null ? url('') . Storage::url('audios/' . $request->audio) : ''
        ];
        $response['video'] = [
            'name' => $request->video !== '' && $request->video !== null ? $request->video : '',
            'url' => $request->video !== '' && $request->video !== null ? url('') . Storage::url('videos/' . $request->video) : ''
        ];

        return response()->json([
            'success' => true,
            'data' => $response
        ]);
    }

    /**
     * Delete materials
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Delete(
     *   path="/admin/materials/{id}",
     *   tags={"Admin"},
     *   summary="Delete materials",
     *   operationId="materials_delete",
     *   @SWG\Parameter(
     *     type="string",                                                                                                                                                                              
     *     name="Authorization",
     *     in="header",
     *     description="Bearer",
     *     required=true
     *   ),
     *   @SWG\Parameter( 
     *     name="id", 
     *     in="path", 
     *     type="integer", 
     *     description="ID",
     *     required=true
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function deleteMaterials(Request $request, $id = 0)
    {
        $request->user()->authorizeRoles(['admin']);

        $updatedValue = array(
            'deleted_at' => now(),
            'deleted_by' => JWTAuth::user()->id
        );

        DB::table('materials')
            ->where('id', $id)
            ->update($updatedValue);

        return response()->json([
            'success' => true,
            'message' => 'materials successfully deleted'
        ]);
    }
}
