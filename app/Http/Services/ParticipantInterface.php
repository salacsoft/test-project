<?php

namespace App\Http\Services;

interface ParticipantInterface
{
   public function store($payload);
   public function getAll($promotionId);
   public function find($id);
   public function update($payload, $id);
   public function getRules($id);
}