<?php

use Illuminate\Http\Response as IlluminateResponse;

class ApiController extends BaseController{

	public function errorApi(){
		return Response::json([
			'errors' => [
				'message' => 'Please choose category',
				'code' => IlluminateResponse::HTTP_NOT_FOUND
 			]
		]);
	}

	public function getApi($category){
		$data = Advertisement::orderBy(DB::raw('RAND()'))
					->where('category','=',$category)
					->where('activation','=',1)
					->get();
		if(!$data){
			return Response::json([
				'errors' => [
					'message' => 'Please enter valid category',
					'code' => IlluminateResponse::HTTP_BAD_REQUEST
	 			]
			]);
		}else{
			return Response::json($data->toArray())->setCallback(Input::get('callback'),JSON_PRETTY_PRINT);
		}
	}

}