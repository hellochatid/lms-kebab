<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\RestExceptionHandlerTrait;
use Illuminate\Http\Request;
use JWTAuth;
use Validator, DB;
use Storage;

class CategoriesController extends Controller
{
    use RestExceptionHandlerTrait;

    public function __construct()
    {
        $this->middleware('auth.jwt');
    }

    /**
     * Add category.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Post(
     *   path="/admin/categories",
     *   tags={"Admin"},
     *   summary="Add category",
     *   operationId="category_add",
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

    public function addCategory(Request $request)
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

        // Add Category
        $title =  $request->title ? $request->title : '';
        $subtitle =  $request->subtitle ? $request->subtitle : '';
        $description =  $request->description ? $request->description : '';
        $image =  $request->image ? $request->image : '';

        DB::table('categories')->insert([
            'title' => $title,
            'subtitle' => $subtitle,
            'description' => $description,
            'image' => $image,
            'created_at' => now(),
            'created_by' => JWTAuth::user()->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Category successfully added',
        ]);
    }

    /**
     * Get the categories
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @SWG\Get(
     *   path="/admin/categories",
     *   tags={"Admin"},
     *   summary="Get Categories",
     *   operationId="categories_get",
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
    public function getCategory(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        $query = DB::table('categories');
        $query->whereNull('deleted_at');

        // if query ID exist
        if ($request->query->get('id') !== null) {
            $query->where('id', '=', $request->query->get('id'));
        }

        // if query parent ID exist
        if ($request->query->get('parent') !== null) {
            $query->where('parent_id', '=', $request->query->get('parent'));
        }

        // Get response data
        $data = $query->get();
        $response = [];

        foreach ($data as $category) {
            $response[] = [
                'id' => $category->id,
                'title' => $category->title,
                'subtitle' => $category->subtitle,
                'description' => $category->description,
                'image' => [
                    'name' => $category->image !== '' && $category->image !== null ? $category->image : '',
                    'url' => $category->image !== '' && $category->image !== null ? url('') . Storage::url($category->image) : ''
                ]
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $response,
        ]);
    }

    /**
     * Edit category.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Patch(
     *   path="/admin/categories/{id}",
     *   tags={"Admin"},
     *   summary="Edit Categories",
     *   operationId="categories_edit",
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
    public function editCategory(Request $request, $id = 0)
    {
        $request->user()->authorizeRoles(['admin']);

        $updatedValue = [];
        if ($request->title) $updatedValue['title'] = $request->title;
        if ($request->subtitle) $updatedValue['subtitle'] = $request->subtitle;
        if ($request->description) $updatedValue['description'] = $request->description;
        if ($request->image) $updatedValue['image'] = $request->image;

        DB::table('categories')
            ->where('id', $id)
            ->update($updatedValue);

        return response()->json([
            'success' => true,
            'message' => 'Category successfully updated'
        ]);
    }

    /**
     * Delete category
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Delete(
     *   path="/admin/categories/{id}",
     *   tags={"Admin"},
     *   summary="Delete Categories",
     *   operationId="categories_delete",
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
    public function deleteCategory(Request $request, $id = 0)
    {
        $request->user()->authorizeRoles(['admin']);

        $updatedValue = array(
            'deleted_at' => now(),
            'deleted_by' => JWTAuth::user()->id
        );

        DB::table('categories')
            ->where('id', $id)
            ->update($updatedValue);

        return response()->json([
            'success' => true,
            'message' => 'Category successfully deleted'
        ]);
    }
}
