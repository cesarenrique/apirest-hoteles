<?php


namespace App\Http\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use League\Fractal\TransformerAbstract;
trait ApiResponse{

  private function successResponse($data,$code){
    return response()->json($data,$code);
  }

  protected function errorResponse($message,$code){
    return response()->json(['error'=>$message, 'code'=>$code],$code);
  }

  protected function showMessage($message,$code=200){
    return response()->json(['data'=>$message, 'code'=>$code],$code);
  }

  protected function showAll(Collection $collection, $code=200){
    if($collection->isEmpty()){
      return $this->successResponse(['data'=>$collection],$code);
    }
    $transformer = $collection->first()->transformer;
    $collection = $this->transformData($collection,$transformer);
    return $this->successResponse($collection, $code); //ya añade data
  }
  protected function showAll2(Collection $collection, $code=200){
    if($collection->isEmpty()){
      return $this->successResponse(['data'=>$collection],$code);
    }
    return $this->successResponse(['data'=>$collection], $code); //ya añade data
  }
  protected function showOne(Model $instance,$code=200){
    $transformer = $instance->transformer;
    $instance = $this->transformData($instance,$transformer);
    return $this->successResponse($instance, $code); //ya añade data
  }

  protected function showOne2($instance,$code=200){
    return $this->successResponse(['data'=>$instance], $code); //ya añade data
  }

  protected function transformData( $data, $transformer){
    $transformation= fractal($data,new $transformer);
    return $transformation->toArray();
  }
}
