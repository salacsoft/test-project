<?php
namespace App\Http\Services;

use Carbon\Carbon;
use App\Models\Promotion;
use App\Models\RequiredInfo;
use App\Http\Services\RequiredInfoInterface;

class RequiredInfoRepository implements RequiredInfoInterface
{
   
   protected $required;
   protected $promo;
   
   public function __construct(RequiredInfo $required, Promotion $promo)
   {
      $this->model = $required;
      $this->promo = $promo;
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


   public function update($payload, $id)
   {
      $data = $this->find($id);
      return $data->update($payload);
   }


   public function getRules()
   {
      $now = Carbon::now()->format("Y-m-d H:i:s");
      $validation = array(
         "field_name" => "required",
         "promotion_id" => "required|exists:promotions,id"
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


}