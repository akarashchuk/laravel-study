<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
//            'id' => $this->resource->id,
            'id' => $this->id,
            'title' => $this->title,
            'text' => $this->text,
            'author' => new AuthorResource($this->user),
            'categories' => CategoryResource::collection($this->categories),
        ];
    }
}
