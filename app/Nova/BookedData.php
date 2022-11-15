<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

use Laravel\Nova\Http\Requests\NovaRequest;

class BookedData extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\BookedApiRecord::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'treatment_name',
        'practitioner_name',
        'site_id',
        'appointment_start_date',
        'appointment_end_date',
        'appointment_duration',
        'patient_first_name',
        'patient_last_name',
        'patient_email',
        'patient_phone',
        'patient_address',
        'patient_postcode',
        'patient_birthday',

    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Treatment Name')->showOnPreview(),
            Text::make('Practitioner Name')->showOnPreview(),
            Text::make('Site ID')->hideFromIndex(),
            Avatar::make('Practitioner Image')->thumbnail(fn()=>$this->practitioner_image)->showOnIndex()->hideFromDetail(),
    
            Text::make('Appointment Start Date')->showOnPreview(),
            Text::make('Appointment End Date')->showOnPreview(),
            Text::make('Appointment Duration')->showOnPreview()->hideFromIndex(),
            Text::make('Patient First Name')->showOnPreview(),
            Text::make('Patient Last Name')->showOnPreview()->hideFromIndex(),
            Text::make('Patient Email')->showOnPreview(),
            Text::make('Patient Phone')->showOnPreview()->hideFromIndex(),
            Text::make('Patient Address')->showOnPreview()->hideFromIndex(),
            Text::make('Patient Postcode')->showOnPreview()->hideFromIndex(),
            Text::make('Patient Birthday')->showOnPreview()->hideFromIndex(),
            Avatar::make('Patient Image')->thumbnail(fn()=>$this->patient_image)->showOnIndex()->hideFromDetail()
            
            
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
