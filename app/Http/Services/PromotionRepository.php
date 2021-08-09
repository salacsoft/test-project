<?php
namespace App\Http\Services;

use Carbon\Carbon;
use App\Models\Promotion;
use App\Http\Services\PromotionInterface;

class PromotionRepository implements PromotionInterface
{
   
   protected $promotion;
   
   public function __construct(Promotion $promotion)
   {
      $this->model = $promotion;
   }

   public function store($payload)
   {
      $data = $payload->only($this->model->getFillable());
      return $this->model->create($data);
   }

   public function findBySlug($slug)
   {
      return $this->model->where("client_slug", $slug)->first();
   }


   public function find($id)
   {
      return $this->model->findOrFail($id);
   }

   public function all()
   {
      return $this->model->all();
   }


   public function update($payload, $id)
   {
      $data = $this->find($id);
      return $data->update($payload);
   }


   public function getRules()
   {
      $rules = implode(",", $this->model->mechanics);
      $now = Carbon::now()->format("Y-m-d H:i:s");
      $validation = array(
         "mechanic" => "required|in:". $rules,
         "client_name" => "required|unique:promotions",
         "prize" => "sometimes",
         "start_time" => "required|after_or_equal:$now"
      );

      return $validation;
   }


   public function delete($id): void
   {
      $this->find($id)->destroy();
   }

   public function getCustomMessage()
   {
      return [
         "mechanic.in" => "Please select Mechanics from ". implode(",", $this->model->mechanics)
      ];
   }


   public function getPromo($clientSlug)
   {
      $promo = $this->model->where("client_slug", $clientSlug)->first();
      return  $promo->with("requiredFields")->get();
   }

}