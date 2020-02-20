<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\RestExceptionHandlerTrait;
use Illuminate\Http\Request;
use JWTAuth;
use Validator, DB;

class QuestionsController extends Controller
{
    use RestExceptionHandlerTrait;

    public function __construct()
    {
        $this->middleware('auth.jwt');
    }

    /**
     * Add questions.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Post(
     *   path="/admin/questions",
     *   tags={"Admin"},
     *   summary="Add questions",
     *   operationId="questions_add",
     *   @SWG\Parameter(
     *     type="string",                                                                                                                                                                              
     *     name="Authorization",
     *     in="header",
     *     description="Bearer",
     *     required=true
     *   ),
     *   @SWG\Parameter(
     *     name="quiz_id",
     *     in="query",
     *     description="Quiz ID",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="question",
     *     in="query",
     *     description="Question",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="type",
     *     in="query",
     *     description="Type",
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="attachment",
     *     in="query",
     *     description="Attachment",
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="order",
     *     in="query",
     *     description="Order",
     *     type="integer"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */

    public function addQuestion(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        // Validate form
        $credentials = $request->all();
        $rules = [
            'quiz_id' => 'required',
            'question' => 'required',
        ];

        $validator = Validator::make($credentials, $rules);
        if ($validator->fails()) {
            return $this->jsonResponse(400, $validator->messages());
        }

        // Add questions
        $quizId =  $request->quiz_id ? $request->quiz_id : '';
        $question =  $request->question ? $request->question : '';
        $type =  $request->type ? $request->type : 'text';
        $attachment =  $request->attachment ? $request->attachment : '';
        $order =  $request->order ? $request->order : 0;

        try {
            DB::table('questions')->insert([
                'quiz_id' => $quizId,
                'question' => $question,
                'type' => $type,
                'attachment' => $attachment,
                'order' => $order,
                'created_at' => now(),
                'created_by' => JWTAuth::user()->id,
            ]);
        } catch (\Illuminate\Database\QueryException $error) {
            return $this->jsonResponse(500, $error);
        }

        return response()->json([
            'success' => true,
            'message' => 'questions successfully added',
        ]);
    }

    /**
     * Get the questions
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @SWG\Get(
     *   path="/admin/questions",
     *   tags={"Admin"},
     *   summary="Get questions",
     *   operationId="questions_get",
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
    public function getQuestion(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        $query = DB::table('questions')
        ->whereNull('deleted_at')
        ->orderBy('order');

        // if query ID exist
        if ($request->query->get('id') !== null) {
            $query->where('id', '=', $request->query->get('id'));
        }

        // if query quiz ID exist
        if ($request->query->get('quiz') !== null) {
            $query->where('quiz_id', '=', $request->query->get('quiz'));
        }

        // Get response data
        $data = $query->get();
        $response = [];

        foreach ($data as $questions) {
            $response[] = [
                'id' => $questions->id,
                'question' => $questions->question,
                'type' => $questions->type,
                'attachment' => $questions->attachment,
                'order' => $questions->order
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $response,
        ]);
    }

    /**
     * Edit questions.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Patch(
     *   path="/admin/questions/{id}",
     *   tags={"Admin"},
     *   summary="Edit questions",
     *   operationId="questions_edit",
     *   @SWG\Parameter(
     *     type="string",                                                                                                                                                                              
     *     name="Authorization",
     *     in="header",
     *     description="Bearer",
     *     required=true
     *   ),
     *   @SWG\Parameter(
     *     name="question",
     *     in="query",
     *     description="Question",
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="order",
     *     in="query",
     *     description="Order",
     *     type="integer"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function editQuestion(Request $request, $id = 0)
    {
        $request->user()->authorizeRoles(['admin']);

        $updatedValue = [];
        if ($request->question) $updatedValue['question'] = $request->question;
        if ($request->order) $updatedValue['order'] = $request->order;

        DB::table('questions')
            ->where('id', $id)
            ->update($updatedValue);

        return response()->json([
            'success' => true,
            'message' => 'questions successfully updated'
        ]);
    }

    /**
     * Delete questions
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Delete(
     *   path="/admin/questions/{id}",
     *   tags={"Admin"},
     *   summary="Delete questions",
     *   operationId="questions_delete",
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
    public function deleteQuestion(Request $request, $id = 0)
    {
        $request->user()->authorizeRoles(['admin']);

        $updatedValue = array(
            'deleted_at' => now(),
            'deleted_by' => JWTAuth::user()->id
        );

        DB::table('questions')
        ->where('id', $id)
        ->update($updatedValue);

        return response()->json([
            'success'=> true,
            'message' => 'Question successfully deleted'
        ]);
    }
}
