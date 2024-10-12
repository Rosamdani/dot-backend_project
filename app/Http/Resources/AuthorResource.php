<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public $resource;

    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->resource = $resource;
    }
    public function toArray(Request $request): array
    {
        return [
            'status' => 'success',
            'message' => 'success get data',
            'data' => $this->resource
        ];
    }
}
