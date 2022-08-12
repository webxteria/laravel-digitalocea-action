<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'company_name' => $this->company_name,
            'created_by' => new UserResource($this->user),
            'image' => $this->whenLoaded('image', function () {
                return new ImagesResource($this->image);
            }),
            'channels' => $this->whenLoaded('channels', function () {
                return ChannelResource::collection($this->channels);
            }),
            'groups' => $this->whenLoaded('groups', function () {
                return GroupResource::collection($this->groups);
            })
        ];
    }
}
