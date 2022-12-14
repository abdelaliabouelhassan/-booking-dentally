<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\AppointmentPerDay;
use App\Nova\Metrics\Conversions;
use App\Nova\Metrics\newAppointments;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Dashboards\Main as Dashboard;

class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            //new Help,
            new newAppointments,
            new Conversions,
            new AppointmentPerDay,
        ];
    }

    
    public  function label()
    {
        return 'Dashboard';
    }

 
   
}
