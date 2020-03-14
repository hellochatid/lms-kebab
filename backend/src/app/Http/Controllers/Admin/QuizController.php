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

        // get request
        $lessonId =  $request->lesson_id ? $request->lesson_id : '';
        $title =  $request->title ? $request->title : '';

        // Check is quiz exists
        try {
            $query = DB::table('quiz');
            $query->whereNull('deleted_at');
            $query->where('lesson_id', '=', $lessonId);
            $quiz = $query->first();
        } catch (\Illuminate\Database\QueryException $error) {
            return $this->jsonResponse(500, $error);
        }

        if ($quiz === null) {
            // Add quiz
            try {
                $quizId = DB::table('quiz')->insertGetId([
                    'lesson_id' => $lessonId,
                    'title' => $title,
                    'created_at' => now(),
                    'created_by' => JWTAuth::user()->id,
                ]);
            } catch (\Illuminate\Database\QueryException $error) {
                return $this->jsonResponse(500, $error);
            }
        } else {
            $quizId = $quiz->id;
        }


        // Add questions
        $question =  $request->question ? $request->question : '';
        $type =  $request->type ? $request->type : 'text';
        $attachment =  $request->attachment ? $request->attachment : '';
        $order =  $request->order ? $request->order : 0;

        try {
            $insertQuestionId = DB::table('questions')->insertGetId([
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

        // Add answers
        $answers = [];
        foreach ($request->answers as $answer) {
            try {
                DB::table('answers')->insert([
                    'question_id' => $insertQuestionId,
                    'answer' => $answer['value'],
                    'correct_answer' => $answer['correct'],
                    'created_at' => now(),
                    'created_by' => JWTAuth::user()->id,
                ]);
            } catch (\Illuminate\Database\QueryException $error) {
                return $this->jsonResponse(500, $error);
            }
            array_push($answers, [
                'question_id' => $insertQuestionId,
                'answer' => $answer['value'],
                'correct_answer' => $answer['correct'],
            ]);
        }

        // Response
        $response = [
            'quiz_id' => $quizId,
            'lesson_id' => $lessonId,
            'question' => [
                'id' => $insertQuestionId,
                'value' => $question,
                'order' => 0
            ],
            'answers' => $answers,
        ];
        return response()->json([
            'success' => true,
            'data' => $response
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

        $query = DB::table('questions')
            ->join('quiz', 'quiz.id', '=', 'questions.quiz_id')
            ->join('lessons', 'lessons.id', '=', 'quiz.lesson_id')
            ->select(
                'lessons.id as lesson_id',
                'quiz.id as quiz_id',
                'quiz.title as quiz_title',
                'questions.id as question_id',
                'questions.question',
                'questions.order'
            )
            ->whereNull('questions.deleted_at')
            ->whereNull('quiz.deleted_at')
            ->whereNull('lessons.deleted_at')
            ->orderBy('questions.order');

        // Get response data
        $data = $query->get();
        $response = [];

        foreach ($data as $quiz) {
            $query = DB::table('answers')
                ->select(
                    'id',
                    'answer',
                    'correct_answer'
                )
                ->whereNull('deleted_at')
                ->where('question_id', '=', $quiz->question_id)
                ->orderBy('order');

            // Get response data
            $answers = $query->get();

            $response[] = [
                'quiz_id' => $quiz->quiz_id,
                'lesson_id' => $quiz->lesson_id,
                'question' => [
                    'id' => $quiz->question_id,
                    'value' => $quiz->question,
                    'order' => $quiz->order
                ],
                'answers' => $answers,
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $response,
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
