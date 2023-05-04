<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $defaults = $this->default_test_data->map(function ($item) {
            return [
                'defname' => $item->default_name,
                'min' => $item->min_value,
                'max' => $item->max_value,
            ];
        });

        return [
            'testid' => $this->id,
            'testname' => $this->name,
            'datetime' => $this->created_at->format('Y-m-d H:i'),
            'defaults' => $defaults
        ];
    }
}
