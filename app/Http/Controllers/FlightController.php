<?php

namespace App\Http\Controllers;
use DB;
use App\Flight;
use Illuminate\Http\Request;
use View;
use Carbon\Carbon;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flights = Flight::all();
        return View::make('flight.index',compact('flights'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $chtonyc = curl_init();
        $chtosfo = curl_init();
        $chfromsfo = curl_init();
        $chfromnyc = curl_init();
        $planetonyc ='';
        $planetosfo = '';
        $planefromsfo = '';
        $flightfromnyc ='';
        $link = '';
        $date = Carbon::now();
        $flightdate = $date->toDateString();
        $token = "BAsN3AVcgyCUSXe59zXaH7yZKG9R";
        $linktonyc ="https://test.api.amadeus.com/v1/shopping/flight-offers?origin=BOM&destination=NYC&departureDate=$flightdate&max=1";
        $linktosfo ="https://test.api.amadeus.com/v1/shopping/flight-offers?origin=BOM&destination=SFO&departureDate=$flightdate&max=1";
        $linkfromsfo ="https://test.api.amadeus.com/v1/shopping/flight-offers?origin=SFO&destination=BOM&departureDate=$flightdate&max=1";
        $linkfromnyc ="https://test.api.amadeus.com/v1/shopping/flight-offers?origin=NYC&destination=BOM&departureDate=$flightdate&max=1";
        
        if($link = $linktonyc)
        {
            curl_setopt($chtonyc, CURLOPT_URL, $link );
            curl_setopt($chtonyc, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($chtonyc, CURLOPT_CUSTOMREQUEST, 'GET');
            $headers = array();
            $headers[] = "Authorization: Bearer $token";
            curl_setopt($chtonyc, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($chtonyc);
            if (curl_errno($chtonyc)) {
            echo 'Error:' . curl_error($chtonyc);
            }
            curl_close ($chtonyc);
            $flightstonyc = json_decode($result);
            $planetonyc = $flightstonyc->data[0]->offerItems[0]->price->total;
         
        }
        if($link = $linktosfo){
            curl_setopt($chtosfo, CURLOPT_URL, $link );
            curl_setopt($chtosfo, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($chtosfo, CURLOPT_CUSTOMREQUEST, 'GET');
            $headers = array();
            $headers[] = "Authorization: Bearer $token";
            curl_setopt($chtosfo, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($chtosfo);
            if (curl_errno($chtosfo)) {
            echo 'Error:' . curl_error($chtosfo);
            }
            curl_close($chtosfo);
            $flightstosfo = json_decode($result);
            $planetosfo = $flightstosfo->data[0]->offerItems[0]->price->total;
        }
        if($link = $linkfromsfo){
            curl_setopt($chfromsfo, CURLOPT_URL, $link );
            curl_setopt($chfromsfo, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($chfromsfo, CURLOPT_CUSTOMREQUEST, 'GET');
            $headers = array();
            $headers[] = "Authorization: Bearer $token";
            curl_setopt($chfromsfo, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($chfromsfo);
            if (curl_errno($chfromsfo)) {
            echo 'Error:' . curl_error($chfromsfo);
            }
            curl_close($chfromsfo);
            $flightfromsfo = json_decode($result);
            $planefromsfo = $flightfromsfo->data[0]->offerItems[0]->price->total;
        }
        if($link = $linkfromnyc){
            curl_setopt($chfromnyc, CURLOPT_URL, $link );
            curl_setopt($chfromnyc, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($chfromnyc, CURLOPT_CUSTOMREQUEST, 'GET');
            $headers = array();
            $headers[] = "Authorization: Bearer $token";
            curl_setopt($chfromnyc, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($chfromnyc);
            if (curl_errno($chfromnyc)) {
            echo 'Error:' . curl_error($chfromnyc);
            }
            curl_close($chfromnyc);
            $flightfromnyc = json_decode($result);
            $planefromnyc = $flightfromnyc->data[0]->offerItems[0]->price->total;
        }

        $flight = Flight::firstOrNew(
           ['from_airport' => 'BOM', 'to_airport' =>'NYC','lowest_fare'=>$planetonyc]
         );
         $flight1 = Flight::firstOrNew(
            ['from_airport' => 'SFO', 'to_airport' =>'BOM','lowest_fare'=>$planefromsfo],
          );
         $flight2 = Flight::firstOrNew(
            ['from_airport' => 'BOM', 'to_airport' =>'SFO','lowest_fare'=>$planetosfo],
          );
        $flight3 = Flight::firstOrNew(
            ['from_airport' => 'NYC', 'to_airport' =>'BOM','lowest_fare'=>$planefromnyc]
          );
          $flight->save();
          $flight1->save();
          $flight2->save();
          $flight3->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function show(Flight $flight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function edit(Flight $flight)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flight $flight)
    {
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flight $flight)
    {
        //
    }
}
