<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\ResultTestData;
use App\Models\Test;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Test $test, Result $result, ResultTestData $resultTestData)
    {
        $totalTestCount = $test->count();
        $totalResultCount = $result->count();
        $totalPassedCount = $resultTestData->where('result', 'pass')->count();
        $totalFailCount = $resultTestData->where('result', 'fail')->count();
        $averageDuration = $result->avg('duration');
        $averageRead = $resultTestData->avg('read_value');

        return response()->json(
            [
                [
                    'name' => 'Total Test',
                    'stat' => $totalTestCount
                ],
                [
                    'name' => 'Total Result',
                    'stat' => $totalResultCount
                ],
                [
                    'name' => 'Passed Results',
                    'stat' => $totalPassedCount
                ],
                [
                    'name' => 'Failed Results',
                    'stat' => $totalFailCount
                ],
                [
                    'name' => 'Average Duration',
                    'stat' => $averageDuration
                ],
                [
                    'name' => 'Average Read',
                    'stat' => $averageRead
                ],
            ]
        );
    }
}
