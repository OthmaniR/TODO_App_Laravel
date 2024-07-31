<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Task;
class StatisticsController extends Controller
{
    public function getDailyStatistics()
    {
        $today = Carbon::today();
        $completedTasksCount = Task::whereDate('is_completed', $today)->count();
        $createdTasksCount = Task::whereDate('created_at', $today)->count();

        // Prevent division by zero
        $completionRate = $createdTasksCount > 0 ? ($completedTasksCount / $createdTasksCount) * 100 : 0;
        $tasks = Task::whereDate('is_completed', $today)->get();
        $averageCompletionTime = $tasks->isNotEmpty() ? $tasks->avg(fn($task) => $task->is_completed->diffInMinutes($task->created_at)) : 0;

        return view('Tasks.statTask', compact('completionRate', 'averageCompletionTime'));
    }

     public function getWeeklyStatistics()
      {
          $startOfWeek = Carbon::now()->startOfWeek();
          $endOfWeek = Carbon::now()->endOfWeek();
          $completedTasksCount = Task::whereBetween('is_completed', [$startOfWeek, $endOfWeek])->count();
          $createdTasksCount = Task::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();

          // Prevent division by zero
          $completionRate = $createdTasksCount > 0 ? ($completedTasksCount / $createdTasksCount) * 100 : 0;

          return view('statistics.weekly', compact('completionRate'));
      }


        public function getMonthlyStatistics()
        {
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();
            $completedTasksCount = Task::whereBetween('is_completed', [$startOfMonth, $endOfMonth])->count();
            $createdTasksCount = Task::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

            // Prevent division by zero
            $completionRate = $createdTasksCount > 0 ? ($completedTasksCount / $createdTasksCount) * 100 : 0;

            return view('statistics.monthly', compact('completionRate'));
        }


}
