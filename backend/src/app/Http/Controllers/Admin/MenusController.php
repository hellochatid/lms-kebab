<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\RestExceptionHandlerTrait;
use Illuminate\Http\Request;
use JWTAuth;
use Validator, DB;

class MenusController extends Controller
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
     *   path="/admin/menus",
     *   tags={"Admin"},
     *   summary="Add Menu",
     *   operationId="menus_add",
     *   @SWG\Parameter(
     *     type="string",                                                                                                                                                                              
     *     name="Authorization",
     *     in="header",
     *     description="Bearer",
     *     required=true
     *   ),
     *   @SWG\Parameter(
     *     name="page_id",
     *     in="query",
     *     description="Title",
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="position",
     *     in="query",
     *     description="position",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */

    public function addMenus(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        // Validate form
        $credentials = $request->all();
        $rules = [
            'position' => 'required',
        ];

        $validator = Validator::make($credentials, $rules);
        if ($validator->fails()) {
            return $this->jsonResponse(400, $validator->messages());
        }

        // Add Page
        $pageID=  $request->page_id ? $request->page_id : 0;
        $position =  $request->position ? $request->position : '';

        DB::table('menus')->insert([
            'page_id' => $pageID,
            'position' => $position,
            'created_at' => now(),
            'created_by' => JWTAuth::user()->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Menu successfully added',
        ]);
    }

    /**
     * Get the manus
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @SWG\Get(
     *   path="/admin/menus",
     *   tags={"Admin"},
     *   summary="Get Menus",
     *   operationId="menus_get",
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
    public function getMenus(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        $query = DB::table('menus');
        $query->whereNull('deleted_at');

        // if query position exist
        if ($request->query->get('position') !== null) {
            $query->where('position', '=', $request->query->get('position'));
        }

        // Get response data
        $data = $query->get();
        $response = [];

        // foreach ($data as $page) {
        //     $response[] = [
        //         'id' => $page->id,
        //         'title' => $page->page_title,
        //         'subtitle' => $page->page_subtitle,
        //         'text' => $page->page_text,
        //         'description' => $page->page_description,
        //         'tag' => $page->page_tag,
        //         'image' => [
        //             'name' => $page->page_image !== '' ? $page->page_image : '',
        //             'url' => $page->page_image !== '' ? url('') . Storage::url($page->page_image) : ''
        //         ]
        //     ];
        // }

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    /**
     * Edit menu.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Patch(
     *   path="/admin/menus/{id}",
     *   tags={"Admin"},
     *   summary="Edit Menus",
     *   operationId="menus_edit",
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
     *   @SWG\Parameter(
     *     name="parent_id",
     *     in="query",
     *     description="Parent ID",
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="menu_order",
     *     in="query",
     *     description="Menu order",
     *     type="integer"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function editMenus(Request $request, $id = 0)
    {
        $request->user()->authorizeRoles(['admin']);

        $updatedValue = [];
        if($request->parent_id) $updatedValue['parent_id'] = $request->parent_id;
        if($request->menu_order) $updatedValue['menu_order'] = $request->menu_order;

        DB::table('menus')
            ->where('id', $id)
            ->update($updatedValue);

        return response()->json([
            'success' => true,
            'message' => 'Menu successfully updated'
        ]);
    }

    /**
     * Delete menu
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Delete(
     *   path="/admin/menus/{id}",
     *   tags={"Admin"},
     *   summary="Delete Menus",
     *   operationId="menus_delete",
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
    public function deleteMenus(Request $request, $id = 0)
    {
        $request->user()->authorizeRoles(['admin']);

        $updatedValue = array(
            'deleted_at' => now(),
            'deleted_by' => JWTAuth::user()->id
        );

        DB::table('menus')
        ->where('id', $id)
        ->update($updatedValue);

        return response()->json([
            'success'=> true,
            'message' => 'Menu successfully deleted'
        ]);
    }
}
