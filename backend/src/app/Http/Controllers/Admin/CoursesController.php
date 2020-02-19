<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\RestExceptionHandlerTrait;
use Illuminate\Http\Request;
use JWTAuth;
use Validator, DB;
use Storage;

class CoursesController extends Controller
{
    use RestExceptionHandlerTrait;

    public function __construct()
    {
        $this->middleware('auth.jwt');
    }

    /**
     * Add courses.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Post(
     *   path="/admin/courses",
     *   tags={"Admin"},
     *   summary="Add courses",
     *   operationId="courses_add",
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

    public function addCourses(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        // Validate form
        $credentials = $request->all();
        $rules = [
            'title' => 'required',
        ];

        $validator = Validator::make($credentials, $rules);
        if ($validator->fails()) {
            return $this->jsonResponse(400, $validator->messages());
        }

        // Add courses
        $title =  $request->title ? $request->title : '';
        $subtitle =  $request->subtitle ? $request->subtitle : '';
        $description =  $request->description ? $request->description : '';
        $tag =  $request->tag ? $request->tag : '';
        $image =  $request->image ? $request->image : '';

        DB::table('courses')->insert([
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
            'message' => 'courses successfully added',
        ]);
    }

    /**
     * Get the courses
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @SWG\Get(
     *   path="/admin/courses",
     *   tags={"Admin"},
     *   summary="Get courses",
     *   operationId="courses_get",
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
    public function getCourses(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        $query = DB::table('courses');
        $query->whereNull('deleted_at');

        // if query category ID exist
        if ($request->query->get('category_id') !== null) {
            $query->where('category_id', '=', $request->query->get('category_id'));
        }

        // Get response data
        $data = $query->get();
        $response = [];

        foreach ($data as $courses) {
            $response[] = [
                'id' => $courses->id,
                'title' => $courses->title,
                'subtitle' => $courses->subtitle,
                'description' => $courses->description,
                'tag' => $courses->tag,
                'image' => [
                    'name' => $courses->image !== '' && $courses->image !== null ? $courses->image : '',
                    'url' => $courses->image !== '' && $courses->image !== null ? url('') . Storage::url($courses->image) : ''
                ]
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $response,
        ]);
    }

    /**
     * Edit courses.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Patch(
     *   path="/admin/courses/{id}",
     *   tags={"Admin"},
     *   summary="Edit courses",
     *   operationId="courses_edit",
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
    public function editCourses(Request $request, $id = 0)
    {
        $request->user()->authorizeRoles(['admin']);

        $updatedValue = [];
        if ($request->title) $updatedValue['title'] = $request->title;
        if ($request->subtitle) $updatedValue['subtitle'] = $request->subtitle;
        if ($request->description) $updatedValue['description'] = $request->description;
        if ($request->image) $updatedValue['image'] = $request->image;

        DB::table('courses')
            ->where('id', $id)
            ->update($updatedValue);

        return response()->json([
            'success' => true,
            'message' => 'courses successfully updated'
        ]);
    }

    /**
     * Delete courses
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Delete(
     *   path="/admin/courses/{id}",
     *   tags={"Admin"},
     *   summary="Delete courses",
     *   operationId="courses_delete",
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
    public function deleteCourses(Request $request, $id = 0)
    {
        $request->user()->authorizeRoles(['admin']);

        $updatedValue = array(
            'deleted_at' => now(),
            'deleted_by' => JWTAuth::user()->id
        );

        DB::table('courses')
            ->where('id', $id)
            ->update($updatedValue);

        return response()->json([
            'success' => true,
            'message' => 'courses successfully deleted'
        ]);
    }
}
