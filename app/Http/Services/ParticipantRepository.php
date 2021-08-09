<?php
namespace App\Http\Services;

use Carbon\Carbon;
use App\Models\Participant;
use App\Http\Services\PromotionInterface;

class ParticipantRepository implements ParticipantInterface
{
   
   protected $participant;
   
   public function __construct(Participant $participant)
   {
      $this->model = $participant;
   }

   public function store($payload)
   {
      $data = $this->$payload->only($this->model->getFillable());
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

   public function getRules($client_slug)
   {
      $rules = implode(",", $this->model->mechanics);
      $now = Carbon::now()->format("Y-m-d H:i:s");
      return [
         "mechanic" => "required|in:". $rules,
         "client_name" => "required|unique:promotions,client_name",
         "prize" => "sometimes",
         "start_time" => "required|after_or_equal:$now"
      ];
   }


   public function getRequiredFields($id)
   {
      $promo =  $this->find($id);
      return $promo->requiredFields();
   }


}