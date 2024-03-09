<?php

namespace App\Http\Resources\Course;

use App\Http\Resources\Program\ProgramResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);
        $data['programs'] = new ProgramResource($this->program);

        return $data;
    }
}
