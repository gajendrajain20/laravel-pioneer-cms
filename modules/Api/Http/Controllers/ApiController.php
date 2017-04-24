<?php namespace Modules\Api\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class ApiController extends Controller {
	
	public function __construct()
	{
		$this->repository = $this->getRepository();
	}
	
	/**
	 * Get repository instance.
	 *
	 * @return mixed
	 */
	public function getRepository() {
		$repository = 'Modules\Admin\Repositories\Articles\EloquentAdminArticleRepository';

		return app($repository);
	}
	
	
	
	/**
	 * @SWG\Get(
	 *   path="/api/getPostList",
	 *   summary="Get all the articles data from storage",
	 *   @SWG\Response(
	 *     response=200,
	 *     description="A list of all the articles"
	 *   ),
	 *   @SWG\Response(
	 *     response="default",
	 *     description="an ""unexpected"" error"
	 *   )
	 * )
	 */
	public function postIndex()
	{	
		$articles = $this->repository->getAllPostData();
		
		return response()->json($articles);
	}
	
}