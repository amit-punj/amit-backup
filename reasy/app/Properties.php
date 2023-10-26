<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\PropertiesUnit;
use App\User;
class Properties extends Model
{
	public $propertiesUnit;
    public function buildingPropertyManager($id){
    	$buildingUnits = $this->where('id', $id)->first();
    	return $userData =	User::where('id', $buildingUnits->property_manager_id)->first();
    }
    public function buildingPropertyDescriptionExperts($id){
    	$buildingUnits = $this->where('id', $id)->first();
    	return $userData =	User::where('id', $buildingUnits->property_description_experts_id)->first();
    }
    public function buildingPropertyLegalAdvisor($id){
    	$buildingUnits = $this->where('id', $id)->first();
    	return $userData =	User::where('id', $buildingUnits->property_legal_advisor_id)->first();
    }
    public function buildingPropertyVisitOrganizer($id){
    	$buildingUnits = $this->where('id', $id)->first();
    	return $userData =	User::where('id', $buildingUnits->property_visit_organizer_id)->first();
    }
}
