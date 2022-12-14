<?php

namespace App\Nova\Metrics;

use App\Models\BookedApiRecord;
use App\Models\User;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class Conversions extends Partition
{

   
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        //past 28days 
        

        $date = [now()->subDays(28)->format('Y-m-d'), now()->format('Y-m-d')]; 
        $Conversions = BookedApiRecord::all()->when($date,  function ($query, $date) {
                return $query->whereBetween('appointment_start_date', $date);
        })->groupBy('converted_by_id')->map(function ($item, $key) {
            return [
                'converted_by_name' => User::find($key) ? User::find($key)->name : 'Unassigned',
                'conversion_value' => $item->sum('value'),
            ];
        });
        $results = [];
        // return $this->result([
        //     'converted_by_name 1' => conversion_value,
        // ]);
        
        foreach($Conversions as $conversion){
            if($conversion['converted_by_name'] != 'Unassigned')
              $results[$conversion['converted_by_name']] = $conversion['conversion_value'];
        }
        return $this->result($results);
           
    }

    /**
     * Determine the amount of time the results of the metric should be cached.
     *
     * @return \DateTimeInterface|\DateInterval|float|int|null
     */
    public function cacheFor()
    {
        //return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'conversions';
    }

    public function name()
    {
        return 'Total Conversions Value past 28days';
    }
}
