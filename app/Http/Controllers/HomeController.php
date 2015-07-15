<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Locations;
use App\Busstop;
use DB;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(Request $request, Locations $locations, Busstop $busstop)
	{
		$this->middleware('auth');
		$this->request 		= $request;
		$this->locations 	= $locations;
		$this->busstop 		= $busstop;
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('home');
	}

	/**
	* Fetch the user selected location's latitude and longitude
	*
	* @return object
	*/
	private function getLocation($name)
	{
	    return $this->locations->select('id','latitude','longitude')->where('name', $name)->first();
	}

	/**
	* Fetch the user selected bust stop's latitude and longitude
	*
	* @return object
	*/
	private function getStoplocation($id)
	{
	    return $this->busstop->select('id','latitude','longitude')->where('id', $id)->first();
	}


	/**
	* Ajax method to return the latitude and longitude for the given location
	*
	* @return Json
	*/
	public function locate()
	{	
		if($this->request->ajax()) {
			$location = $this->request->input('name');
			$response  = $this->getLocation($location);
	      	//$busstop = DB::table('bustop_list')->where('id', '2')->first();
	     	return response()->json($response);
     	} 
    }

    /**
	* Ajax method to nearby bus stop list for the given location
	*
	* @return Json
	*/
    public function getStoplist()
    {
    	$dist = 10; // Fetching all the stop list around 10 miles radius
    	if($this->request->ajax()) {
    		$location 	= $this->request->input('name');
    		$response  	= $this->getLocation($location); // Retrive the latitude and longitude
    		$origLat 	= $response->latitude;
    		$origLon    = $response->longitude;
    		$resultset 	= DB::select( DB::raw("SELECT `id`, `name`, `latitude`, `longitude`, 3956 * 2 * ASIN(SQRT( POWER(SIN(($origLat - abs(latitude))*pi()/180/2),2) +COS($origLat*pi()/180 )*COS(abs(latitude)*pi()/180) *POWER(SIN(($origLon-longitude)*pi()/180/2),2))) as `distance` FROM `busstop` WHERE `longitude` between ($origLon-$dist/abs(cos(radians($origLat))*69)) and ($origLon+$dist/abs(cos(radians($origLat))*69)) and `latitude` between ($origLat-($dist/69)) and ($origLat+($dist/69)) having `distance` < $dist ORDER BY `distance` limit 10") );
    		$returnHTML = view('ajax.liststops')->with('response', $resultset)->render();
            return response()->json( array('success' => true, 'html'=>$returnHTML) );
    	}
    }

    /**
	* Ajax method to nearby bus list for the given bus stop
	*
	* @return Json
	*/
    public function getBuslist()
    {	
    	$dist = 10; // Fetching all the bus list around 10 miles radius
    	if($this->request->ajax()) {
    		$stopID 	= $this->request->input('stopID');
    		$response  	= $this->getStoplocation($stopID);
    		$origLat 	= $response->latitude;
    		$origLon    = $response->longitude;
    		$resultset 	= DB::select( DB::raw("SELECT `id`, `busno`, `name`, `latitude`, `longitude`, 3956 * 2 * ASIN(SQRT( POWER(SIN(($origLat - abs(latitude))*pi()/180/2),2) +COS($origLat*pi()/180 )*COS(abs(latitude)*pi()/180) *POWER(SIN(($origLon-longitude)*pi()/180/2),2))) as `distance` FROM `buslist` WHERE `longitude` between ($origLon-$dist/abs(cos(radians($origLat))*69)) and ($origLon+$dist/abs(cos(radians($origLat))*69)) and `latitude` between ($origLat-($dist/69)) and ($origLat+($dist/69)) having `distance` < $dist ORDER BY `distance` limit 10") );
    		$returnHTML = view('ajax.listbus')->with('response', $resultset)->render();
            return response()->json( array('success' => true, 'html'=>$returnHTML) );
    	}
    }


}
