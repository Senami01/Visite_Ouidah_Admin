<?php

namespace App\Http\Resources\Sites_Touristiques;

use App\Lib\FieldName;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SiteMediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            FieldName::TYPE => $this->{FieldName::TYPE},
            FieldName::URL => $this->{FieldName::URL},
            FieldName::EST_COUVERTURE => $this->{FieldName::EST_COUVERTURE},
            FieldName::ORDRE => $this->{FieldName::ORDRE}
        ];
    }
}
