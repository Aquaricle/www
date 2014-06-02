<?php

class AquariumController extends BaseController
{	

	public function index()
	{
		return self::getAquariums();
	}

	public function getIndex()
	{
		return self::getAquariums();
	}

	public function getAquariums()
	{
		$aquariums = Aquarium::byAuthUser()->get();
	    return View::make('aquariums')->with('aquariums', $aquariums);		
	}
	
	public function getAquarium($aquariumID)
	{
		if ($aquariumID == null)
			return Redirect::to("aquariums");
		
		// Only look at last 30 days for the Aquarium Logs
		$dateSub = new DateTime();
		$dateSub->sub(new DateInterval('P10D'));

		$aquarium = Aquarium::singleAquarium($aquariumID);
		
		$logs = $aquarium->aquariumLogs()
			->where('logDate', '>=', $dateSub)
			->get();
		
		/*
		$equipment = $aquarium->equipment()
			->join('EquipmentLogs', 'EquipmentLogs.equipmentID', '=', 'Equipment.equipmentID')
			->join('AquariumLogs', 'AquariumLogs.aquariumLogID', '=', 'EquipmentLogs.aquariumLogID')
			->select('DATEDIFF(UTC_TIMESTAMP(), AquariumLogs.logDate)')
			->get();
		*/
		
		$equipment = array('0' => 'None') + Equipment::where('aquariumID', '=', $aquariumID)->lists('name', 'equipmentID');
		
		
		return View::make('aquarium')
			->with('aquarium', $aquarium)
			->with('logs', $logs)
			->with('equipment', $equipment)
			->with('measurementUnits', $aquarium->getMeasurementUnits());
	}
	
	public function create()
	{
		return View::make('modifyaquarium');
	}
	
	public function store()
	{
		$aquarium = new Aquarium(Input::all());
		$aquarium->userID = Auth::user()->userID;
		$aquarium->save();
		$aquariumID = $aquarium->aquariumID;
		
		return Redirect::to("aquariums/$aquariumID/edit");
	}
	
	public function edit($aquariumID)
	{
		if ($aquariumID == null)
			return Redirect::to('aquariums');

		$aquarium = Aquarium::singleAquarium($aquariumID);

		return View::make('modifyaquarium')
			->with('aquarium', $aquarium);
	}
	
	public function update($aquariumID)
	{
		$aquarium = Aquarium::singleAquarium($aquariumID);
		$aquarium->name = Input::get('name');
		$aquarium->location = Input::get('location');
		$aquarium->measurementUnits = Input::get('measurementUnits');
		$aquarium->capacity = Input::get('capacity');
		$aquarium->length = Input::get('length');
		$aquarium->width = Input::get('width');
		$aquarium->height = Input::get('height');
		$aquarium->save();
		return Redirect::to("aquariums/$aquariumID/edit");
	}
	
	public function destroy($aquariumID)
	{
		//
	}
	
	public function show($aquariumID)
	{
		return self::getAquarium($aquariumID);
	}
	
	public function missingMethod($parameters = array())
	{
	 	echo "Missing, goddamnit";
	}
	
	
}
	
?>