<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\RestExceptionHandlerTrait;
use Illuminate\Http\Request;
use JWTAuth;
use Validator, DB;
use Storage;

class LessonsController extends Controller
{
    use RestExceptionHandlerTrait;

    public function __construct()
    {
        $this->middleware('auth.jwt');
    }

    /**
     * Add lessons.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Post(
     *   path="/admin/lessons",
     *   tags={"Admin"},
     *   summary="Add lessons",
     *   operationId="lessons_add",
     *   @SWG\Parameter(
     *     type="string",                                                                                                                                                                              
     *     name="Authorization",
     *     in="header",
     *     description="Bearer",
     *     required=true
     *   ),
     *   @SWG\Parameter(
     *     name="course_id",
     *     in="query",
     *     description="Course ID",
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
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */

    public function addLessons(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        // Validate form
        $credentials = $request->all();
        $rules = [
            'course_id' => 'required',
            'title' => 'required',
        ];

        $validator = Validator::make($credentials, $rules);
        if ($validator->fails()) {
            return $this->jsonResponse(400, $validator->messages());
        }

        // Add lessons
        $course_id =  $request->course_id ? $request->course_id : 0;
        $title =  $request->title ? $request->title : '';
        $subtitle =  $request->subtitle ? $request->subtitle : '';
        $description =  $request->description ? $request->description : '';
        $tag =  $request->tag ? $request->tag : '';
        $image =  $request->image ? $request->image : '';

        DB::table('lessons')->insert([
            'course_id' => $course_id,
            'title' => $title,
            'subtitle' => $subtitle,
            'description' => $description,
            'tag' => $tag,
            'image' => $image,
            'created_at' => now(),
            'created_by' => JWTAuth::user()->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'lessons successfully added',
        ]);
    }

    /**
     * Get the lessons
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @SWG\Get(
     *   path="/admin/lessons",
     *   tags={"Admin"},
     *   summary="Get lessons",
     *   operationId="lessons_get",
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
    public function getLessons(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        $query = DB::table('lessons')
        ->select(
            DB::raw('(select title from courses where id=course_id and deleted_at is null) as course_title'),
            'id',
            'course_id',
            'title',
            'subtitle',
            'description',
            'tag',
            'image',
            'order'
        )
        ->whereNull('deleted_at')
        ->orderBy('order');

        // if query ID exist
        if ($request->query->get('id') !== null) {
            $query->where('id', '=', $request->query->get('id'));
        }

        // if query Course ID exist
        if ($request->query->get('course') !== null) {
            $query->where('course_id', '=', $request->query->get('course'));
        }

        // Get response data
        $data = $query->get();
        $response = [];

        foreach ($data as $lessons) {
            $response[] = [
                'id' => $lessons->id,
                'course' => [
                    'id' => $lessons->course_id,
                    'name' => $lessons->course_title
                ],
                'title' => $lessons->title,
                'subtitle' => $lessons->subtitle,
                'description' => $lessons->description,
                'tag' => $lessons->tag,
                'image' => [
                    'name' => $lessons->image !== '' && $lessons->image !== null ? $lessons->image : '',
                    'url' => $lessons->image !== '' && $lessons->image !== null ? url('') . Storage::url($lessons->image) : ''
                ],
                'order' => $lessons->order
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $response,
        ]);
    }

    /**
     * Edit lessons.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Patch(
     *   path="/admin/lessons/{id}",
     *   tags={"Admin"},
     *   summary="Edit lessons",
     *   operationId="lessons_edit",
     *   @SWG\Parameter(
     *     type="string",                                                                                                                                                                              
     *     name="Authorization",
     *     in="header",
     *     description="Bearer",
     *     required=true
     *   ),
     *   @SWG\Parameter(
     *     name="course_id",
     *     in="query",
     *     description="Course ID",
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
     *     name="image",
     *     in="query",
     *     description="Image",
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function editLessons(Request $request, $id = 0)
    {
        $request->user()->authorizeRoles(['admin']);

        $updatedValue = [];
        if ($request->course_id) $updatedValue['course_id'] = $request->course_id;
        if ($request->title) $updatedValue['title'] = $request->title;
        if ($request->subtitle) $updatedValue['subtitle'] = $request->subtitle;
        if ($request->description) $updatedValue['description'] = $request->description;
        if ($request->tag) $updatedValue['tag'] = $request->tag;
        if ($request->image) $updatedValue['image'] = $request->image;
        if ($request->order) $updatedValue['order'] = $request->order;

        DB::table('lessons')
            ->where('id', $id)
            ->update($updatedValue);

        return response()->json([
            'success' => true,
            'message' => 'lessons successfully updated'
        ]);
    }

    /**
     * Delete lessons
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Delete(
     *   path="/admin/lessons/{id}",
     *   tags={"Admin"},
     *   summary="Delete lessons",
     *   operationId="lessons_delete",
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
    public function deleteLessons(Request $request, $id = 0)
    {
        $request->user()->authorizeRoles(['admin']);

        $updatedValue = array(
            'deleted_at' => now(),
            'deleted_by' => JWTAuth::user()->id
        );

        DB::table('lessons')
            ->where('id', $id)
            ->update($updatedValue);

        return response()->json([
            'success' => true,
            'message' => 'lessons successfully deleted'
        ]);
    }
}