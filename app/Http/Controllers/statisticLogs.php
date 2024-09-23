<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use Illuminate\Http\JsonResponse;


class statisticLogs extends Controller
{
    public function stat(): JsonResponse
{ 
    // count type logs
    $criticalCount = Logs::where('type', 'critical')->count();
    $alertCount = Logs::where('type', 'alert')->count();
    $warningCount = Logs::where('type', 'warning')->count();
   
    // Counts all requests in the 'Logs' table
    $totalRequests = Logs::count(); 

    // create a pie chart for protocols  => Count logs by protocol
    $httpCount = Logs::where('protocol', 'HTTP')->count();
    $smtpCount = Logs::where('protocol', 'SMTP')->count();
    $tcpCount = Logs::where('protocol', 'TCP')->count();
    $udpCount = Logs::where('protocol', 'UDP')->count();
    $websocketsCount = Logs::where('protocol', 'Websockets')->count();
    // Prepare protocol data for pie chart
    $protocolCounts = [
        'HTTP' => $httpCount,
        'SMTP' => $smtpCount,
        'TCP' => $tcpCount,
        'UDP' => $udpCount,
        'Websockets' => $websocketsCount,
    ];



    // create a pie chart for ip adress 
    // use $ipCounts in front-end
    $ipCounts = Logs::select('ip_address', Logs::raw('count(*) as count'))
        ->groupBy('ip_address')
        ->orderBy('count', 'desc')
        ->get();

    // Prepare IP data for pie chart
    $ipData = [];
    foreach ($ipCounts as $ip) {
        $ipData[$ip->ip_address] = $ip->count;
    }


    // Create bar chart for requests by day
    $dateCounts = Logs::select(Logs::raw('DATE(created_at) as date'), Logs::raw('count(*) as count'))
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

    // Prepare date data for bar chart
    $dateData = [];
    $requestCounts = [];
    foreach ($dateCounts as $entry) {
        $dateData[] = $entry->date;
        $requestCounts[] = $entry->count;
    }

    // Create data for map visualization (longitude and latitude)
    // Add Leaflet to Your Project:  npm install leaflet
    //And in your main CSS file or <style> block: @import "leaflet/dist/leaflet.css";
    $locationData = Logs::select('longitude', 'latitude')
    ->whereNotNull('longitude')
    ->whereNotNull('latitude')
    ->get();

$locations = $locationData->map(function ($location) {
    return [
        'longitude' => $location->longitude,
        'latitude' => $location->latitude,
    ];
})->toArray();
    
 
    ///////////////////////////
    // Print data in front-end
    return response()->json([
        'criticalCount' => $criticalCount,
        'alertCount' => $alertCount,
        'warningCount' => $warningCount,
        'totalRequests' => $totalRequests,
        'protocolCounts' => $protocolCounts,
        'ipCounts' => $ipData,
        'dateCounts' => [
            'dates' => $dateData,
            'counts' => $requestCounts,
        ],
        'locations' => $locations,
    ]);



}}

