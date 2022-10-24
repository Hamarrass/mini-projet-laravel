<?php

namespace App\Http\Resources;

use App\Http\Resources\CommentUserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'id'=>$this->id,
            'contenu'=>$this->content,
            'commentaire_date'=>$this->updated_at,
            'user'=> new CommentUserResource($this->whenLoaded('user'))
        ];

    }
}
