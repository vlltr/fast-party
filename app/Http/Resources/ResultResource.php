<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $defaults = $this->test->default_test_data->map(function ($item) {
            return [
                'defname' => $item->default_name,
                'min' => $item->min_value,
                'max' => $item->max_value,
            ];
        });

        $results = $this->result_test_data->map(function ($item) {
            return [
                'defname' => $item->default_name,
                'read' => $item->read_value,
                'result' => $item->result,
            ];
        });

        return [
            'resultid' => $this->id,
            'testid' => $this->test->id,
            'testname' => $this->test->name,
            'partnumber' => $this->part_number,
            'serialno' => $this->serial_number,
            'datetime'  => $this->created_at->format('Y-m-d H:i'),
            'duration' => $this->duration,
            'defaults' => $defaults,
            'results' => $results,




        ];
    }
}
