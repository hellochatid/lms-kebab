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
        $order =  $request->order ? $request->order : 0;

        $insertId = DB::table('lessons')->insertGetId([
            'course_id' => $course_id,
            'title' => $title,
            'subtitle' => $subtitle,
            'description' => $description,
            'tag' => $tag,
            'image' => $image,
            'created_at' => now(),
            'created_by' => JWTAuth::user()->id,
        ]);

        // Response
        $response = [];
        $response['id'] = $insertId;
        $response['course_id'] = $course_id;
        $response['title'] = $title;
        $response['subtitle'] = $subtitle;
        $response['description'] = $description;
        $response['image'] = [
            'name' => $image !== '' && $image !== null ? $image : '',
            'url' => $image !== '' && $image !== null ? url('') . Storage::url($image) : ''
        ];
        $response['tag'] = array_filter(explode(',', $tag));
        $response['order'] = $order;

        return response()->json([
            'success' => true,
            'data' => $response
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
                'tag' => array_filter(explode(',', $lessons->tag)),
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
        $updatedValue['course_id'] = $request->course_id;
        $updatedValue['title'] = $request->title;
        $updatedValue['subtitle'] = $request->subtitle;
        $updatedValue['description'] = $request->description;
        $updatedValue['tag'] = $request->tag;
        $updatedValue['image'] = $request->image;
        $updatedValue['order'] = $request->order;
        $response = $updatedValue;

        DB::table('lessons')
            ->where('id', $id)
            ->update($updatedValue);

        $response['tag'] = array_filter(explode(',', $request->tag));
        $response['image'] = [
            'name' => $request->image !== '' && $request->image !== null ? $request->image : '',
            'url' => $request->image !== '' && $request->image !== null ? url('') . Storage::url($request->image) : ''
        ];

        return response()->json([
            'success' => true,
            'data' => $response
        ]);
    }

    /**
     * Set lessons orders.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Patch(
     *   path="/admin/lessons/order/{id}",
     *   tags={"Admin"},
     *   summary="Set lesson orders",
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
     *     name="order",
     *     in="query",
     *     description="Order",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function setLessonOrders(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        $requestOrder = isset($request->order) ? $request->order : '';
        $dataOrder = array_filter(explode(',', $requestOrder));
        $lessonOrder = [];

        for ($i = 0; $i < count($dataOrder); $i++) {
            $lessonId = $dataOrder[$i];
            DB::table('lessons')
                ->where('id', $lessonId)
                ->update([
                    'order' => $i
                ]);

            $lessonOrder[] = [
                'id' => $lessonId,
                'order' => $i
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $lessonOrder
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
