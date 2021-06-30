<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use DateTime;
use DateInterval;
use DatePeriod;

class EventController extends Controller
{
    
    public function index( Request $request )
    {
        $startDate = date('Y-m-01', strtotime("+1 month"));
        $endDate = date('Y-m-d', strtotime($startDate . "+1 month"));
        $endDate = date('Y-m-d', strtotime($endDate . "-1 day"));

        $params = [
            "start_date" => $startDate, 
            "end_date" => $endDate,
            "month" => date('F', strtotime($startDate)),
            "year" => date('Y', strtotime($startDate)),
            "dates" => $this->getAllDates( $startDate, $endDate )
        ];

        return view('events', $params);
    }

    public function read( Request $request, string $startDate, string $endDate )
    {

        $params = $request->all();

        $events = Event::getEvents( $startDate, $endDate );

        return response()->json(compact('events'), 200);


    }

    public function createEvents( Request $request )
    {

        $params = $request->all();
        
        $validation = $this->validateInput( $params );
        if($validation->fails()) {
			return response()->json(["err" => true, "message" => "Invalid Request", "params" => $validation->errors()], 400);
		}


        // validate date input
        if(!strtotime($params['start_date']) || !strtotime($params['end_date'])){
            return response()->json(["err" => true, "message" => "Invalid Request", "params" => "Invalid date format"], 400);
        }

        $startDate = date('Y-m-d', strtotime($params['start_date']));
        $endDate = date('Y-m-d', strtotime($params['end_date']));

        // validate date range
        if ( $startDate > $endDate )
        {
            return response()->json(["err" => true, "message" => "Invalid Request", "params" => "Start date cannot be greater that End date"], 400);
        }

        // Repeat should only have values on date format l
        $repeat = $params['repeat'];
        $dates = $this->getAllDates($startDate, $endDate);

        foreach( $dates as $date )
        {

            if ( in_array($date["l"], $repeat ) )
            {
                Event::createEvents($params['name'], $date["date"]);
            }

        }

        return response()->json([], 201);

    }

    private function getAllDates( string $startDate, string $endDate )
    {
        $start = new \DateTime($startDate);
        $end = new \DateTime($endDate . " +1 day");
        $interval = \DateInterval::createFromDateString('1 day');
        $period = new \DatePeriod($start, $interval, $end);

        foreach ($period as $dt) {
            $dates[] = ["l" => $dt->format("l"), "date" => $dt->format("Y-m-d")];
        }
        return $dates;
    }

    private function validateInput( array $params ) 
	{
        
        $validation = Validator::make($params ,[ 
			'name'					=> 'required|string',
			'start_date'			=> 'required|date',
			'end_date'      		=> 'required|date',
			'repeat'    			=> 'required|array',
        ]);

        return $validation;
    }
    

}
