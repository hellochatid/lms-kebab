<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\RestExceptionHandlerTrait;
use Illuminate\Http\Request;
use JWTAuth;
use Validator, DB;

class AnswersController extends Controller
{
    use RestExceptionHandlerTrait;

    public function __construct()
    {
        $this->middleware('auth.jwt');
    }

    /**
     * Add answers.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Post(
     *   path="/admin/answers",
     *   tags={"Admin"},
     *   summary="Add answers",
     *   operationId="answers_add",
     *   @SWG\Parameter(
     *     type="string",                                                                                                                                                                              
     *     name="Authorization",
     *     in="header",
     *     description="Bearer",
     *     required=true
     *   ),
     *   @SWG\Parameter(
     *     name="question_id",
     *     in="query",
     *     description="Question ID",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="answer",
     *     in="query",
     *     description="answer",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="correct_answer",
     *     in="query",
     *     description="Correct Answer",
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

    public function addAnswer(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        // Validate form
        $credentials = $request->all();
        $rules = [
            'question_id' => 'required',
            'answer' => 'required',
        ];

        $validator = Validator::make($credentials, $rules);
        if ($validator->fails()) {
            return $this->jsonResponse(400, $validator->messages());
        }

        // Add answers
        $questionId =  $request->question_id ? $request->question_id : '';
        $answer =  $request->answer ? $request->answer : '';
        $correctAnswer =  $request->correct_answer ? $request->correct_answer : false;
        $order =  $request->order ? $request->order : 0;

        try {
            DB::table('answers')->insert([
                'question_id' => $questionId,
                'answer' => $answer,
                'correct_answer' => $correctAnswer,
                'order' => $order,
                'created_at' => now(),
                'created_by' => JWTAuth::user()->id,
            ]);
        } catch (\Illuminate\Database\QueryException $error) {
            return $this->jsonResponse(500, $error);
        }

        return response()->json([
            'success' => true,
            'message' => 'answers successfully added',
        ]);
    }

    /**
     * Get the answers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @SWG\Get(
     *   path="/admin/answers",
     *   tags={"Admin"},
     *   summary="Get answers",
     *   operationId="answers_get",
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
    public function getAnswer(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        $query = DB::table('answers')
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

        foreach ($data as $answers) {
            $response[] = [
                'id' => $answers->id,
                'answer' => $answers->answer,
                'type' => $answers->type,
                'attachment' => $answers->attachment,
                'order' => $answers->order
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $response,
        ]);
    }

    /**
     * Edit answers.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Patch(
     *   path="/admin/answers/{id}",
     *   tags={"Admin"},
     *   summary="Edit answers",
     *   operationId="answers_edit",
     *   @SWG\Parameter(
     *     type="string",                                                                                                                                                                              
     *     name="Authorization",
     *     in="header",
     *     description="Bearer",
     *     required=true
     *   ),
     *   @SWG\Parameter(
     *     name="answer",
     *     in="query",
     *     description="answer",
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="correct_answer",
     *     in="query",
     *     description="Correct Answer",
     *     type="integer"
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
    public function editAnswer(Request $request, $id = 0)
    {
        $request->user()->authorizeRoles(['admin']);

        $updatedValue = [];
        if ($request->answer) $updatedValue['answer'] = $request->answer;
        if ($request->correct_answer) $updatedValue['correct_answer'] = $request->correct_answer;
        if ($request->order) $updatedValue['order'] = $request->order;

        DB::table('answers')
            ->where('id', $id)
            ->update($updatedValue);

        return response()->json([
            'success' => true,
            'message' => 'answers successfully updated'
        ]);
    }

    /**
     * Delete answers
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Delete(
     *   path="/admin/answers/{id}",
     *   tags={"Admin"},
     *   summary="Delete answers",
     *   operationId="answers_delete",
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
    public function deleteAnswer(Request $request, $id = 0)
    {
        $request->user()->authorizeRoles(['admin']);

        $updatedValue = array(
            'deleted_at' => now(),
            'deleted_by' => JWTAuth::user()->id
        );

        DB::table('answers')
        ->where('id', $id)
        ->update($updatedValue);

        return response()->json([
            'success'=> true,
            'message' => 'answer successfully deleted'
        ]);
    }
}
