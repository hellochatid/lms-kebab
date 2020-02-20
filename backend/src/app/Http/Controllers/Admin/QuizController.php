<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\RestExceptionHandlerTrait;
use Illuminate\Http\Request;
use JWTAuth;
use Validator, DB;

class QuizController extends Controller
{
    use RestExceptionHandlerTrait;

    public function __construct()
    {
        $this->middleware('auth.jwt');
    }

    /**
     * Add quiz.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Post(
     *   path="/admin/quiz",
     *   tags={"Admin"},
     *   summary="Add quiz",
     *   operationId="quiz_add",
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
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */

    public function addQuiz(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        // Validate form
        $credentials = $request->all();
        $rules = [
            'lesson_id' => 'required',
            'title' => 'required',
        ];

        $validator = Validator::make($credentials, $rules);
        if ($validator->fails()) {
            return $this->jsonResponse(400, $validator->messages());
        }

        // Add quiz
        $lessonId =  $request->lesson_id ? $request->lesson_id : '';
        $title =  $request->title ? $request->title : '';

        try {
            DB::table('quiz')->insert([
                'lesson_id' => $lessonId,
                'title' => $title,
                'created_at' => now(),
                'created_by' => JWTAuth::user()->id,
            ]);
        } catch (\Illuminate\Database\QueryException $error) {
            return $this->jsonResponse(500, $error);
        }

        return response()->json([
            'success' => true,
            'message' => 'quiz successfully added',
        ]);
    }

    /**
     * Get the quiz
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @SWG\Get(
     *   path="/admin/quiz",
     *   tags={"Admin"},
     *   summary="Get quiz",
     *   operationId="quiz_get",
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
    public function getQuiz(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        $query = DB::table('quiz');
        $query->whereNull('deleted_at');

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
        // $response = [];

        // foreach ($data as $quiz) {
        //     $response[] = [
        //         'id' => $quiz->id,
        //         'title' => $quiz->title,
        //         'subtitle' => $quiz->subtitle,
        //         'description' => $quiz->description,
        //         'image' => [
        //             'name' => $quiz->image !== '' && $quiz->image !== null ? $quiz->image : '',
        //             'url' => $quiz->image !== '' && $quiz->image !== null ? url('') . Storage::url($quiz->image) : ''
        //         ]
        //     ];
        // }

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    /**
     * Edit quiz.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Patch(
     *   path="/admin/quiz/{id}",
     *   tags={"Admin"},
     *   summary="Edit quiz",
     *   operationId="quiz_edit",
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
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function editQuiz(Request $request, $id = 0)
    {
        $request->user()->authorizeRoles(['admin']);

        $updatedValue = [];
        if ($request->title) $updatedValue['title'] = $request->title;

        DB::table('quiz')
            ->where('id', $id)
            ->update($updatedValue);

        return response()->json([
            'success' => true,
            'message' => 'quiz successfully updated'
        ]);
    }

    /**
     * Delete quiz
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Delete(
     *   path="/admin/quiz/{id}",
     *   tags={"Admin"},
     *   summary="Delete quiz",
     *   operationId="quiz_delete",
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
    public function deleteQuiz(Request $request, $id = 0)
    {
        $request->user()->authorizeRoles(['admin']);

        DB::table('quiz')
            ->where('id', $id)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'quiz successfully deleted'
        ]);
    }
}
