<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResultRequest;
use App\Http\Resources\ResultResource;
use App\Models\Result;
use App\Models\ResultTestData;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function index()
    {
        $results = Result::with(['test', 'result_test_data'])->latest()->get();
        return ResultResource::collection($results);
    }

    public function show(Result $result)
    {
        $result->load(['test', 'result_test_data']);
        return ResultResource::make($result);
    }

    public function store(ResultRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $testResult = Result::create(
                [
                    'test_id' => $request->validated('testid'),
                    'part_number' => $request->validated('partnumber'),
                    'serial_number' => $request->validated('serialno'),
                    'duration' => $request->validated('duration'),
                ]
            );

            $results = $request->validated('results');

            foreach ($results as $result) {
                ResultTestData::create(
                    [
                        'result_id' => $testResult->id,
                        'default_name' => $result['defname'],
                        'read_value' => $result['read'],
                        'result' => $result['result'],
                    ]
                );
            }

            $testResult->load(['test', 'result_test_data']);

            return ResultResource::make($testResult);
        }, 5);
    }

    public function update(ResultRequest $request, Result $result)
    {
        return DB::transaction(function () use ($request, $result) {
            $result->update([
                'test_id' => $request->validated('testid'),
                'part_number' => $request->validated('partnumber'),
                'serial_number' => $request->validated('serialno'),
                'duration' => $request->validated('duration'),
            ]);

            $result->result_test_data()->delete();

            $resultData = $request->validated('results');
            foreach ($resultData as $data) {
                ResultTestData::create(
                    [
                        'result_id' => $result->id,
                        'default_name' => $data['defname'],
                        'read_value' => $data['read'],
                        'result' => $data['result'],
                    ]
                );
            }

            $result->load(['test', 'result_test_data']);

            return ResultResource::make($result);
        }, 5);
    }

    public function destroy(Result $result)
    {
        $result->result_test_data()->delete();
        $result->delete();

        return response()->noContent();
    }
}
