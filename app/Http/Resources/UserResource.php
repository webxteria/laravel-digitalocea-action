<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'username' => $this->username,
            'token' => $this->createToken('authToken')->plainTextToken,
            'image' => $this->whenLoaded('image', function () {
                return new ImagesResource($this->image);
            }),
            'companies' => $this->whenLoaded('companies', function () {
                return CompanyResource::collection($this->companies);
            })
        ];
    }
}
