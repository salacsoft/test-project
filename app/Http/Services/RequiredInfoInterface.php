<?php

namespace App\Http\Services;

interface RequiredInfoInterface
{
   public function store($payload);
   public function findBySlug($slug);
   public function find($id);
   public function update($payload, $id);
   public function getRules();
   public function delete($id);
}