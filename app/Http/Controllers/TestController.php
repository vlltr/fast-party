<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use App\Http\Resources\TestResource;
use App\Models\DefaultTestData;
use App\Models\Test;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index()
    {
        $tests = Test::with('default_test_data')->get();
        return TestResource::collection($tests);
    }

    public function show(Test $test)
    {
        $test->load('default_test_data');
        return TestResource::make($test);
    }

    public function store(TestRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $test = Test::create(
                ['name' => $request->validated('testname')]
            );

            $defaults = $request->validated('defaults');

            foreach ($defaults as $default) {
                DefaultTestData::create(
                    [
                        'test_id' => $test->id,
                        'default_name' => $default['defname'],
                        'min_value' => $default['min'],
                        'max_value' => $default['max'],
                    ]

                );
            }
            $test->load('default_test_data');

            return TestResource::make($test);
        }, 5);
    }

    public function update(TestRequest $request, Test $test)
    {
        return DB::transaction(function () use ($request, $test) {
            $test->update(
                ['name' => $request->validated('testname')]
            );

            $defaults = $request->validated('defaults');

            $test->default_test_data()->delete();

            foreach ($defaults as $default) {
                DefaultTestData::create(
                    [
                        'test_id' => $test->id,
                        'default_name' => $default['defname'],
                        'min_value' => $default['min'],
                        'max_value' => $default['max'],
                    ]
                );
            }

            $test->load('default_test_data');

            return TestResource::make($test);
        }, 5);
    }
    public function destroy(Test $test)
    {
        $test->default_test_data()->delete();
        $test->delete();

        return response()->noContent();
    }
}
