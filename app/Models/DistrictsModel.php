<?php

namespace Vanier\Api\Models;

class DistrictsModel extends BaseModel
{
    private $table_name = 'district';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all districts
     *
     * @param array $filters filters
     * @return array all district records
     */
    public function getAllDistricts(array $filters)
    {
        $filters_values = [];
        $sql = "SELECT * FROM $this->table_name WHERE 1";

        if (isset($filters['bureau'])) {
            $sql .= ' AND bureau LIKE CONCAT(\'%\', :bureau , \'%\')';
            $filters_values['bureau'] = $filters['bureau'];
        }

        if (isset($filters['precinct'])) {
            $sql .= ' AND precinct = :precinct';
            $filters_values['precinct'] = $filters['precinct'];
        }

        return $this->paginate($sql, $filters_values);
    }

    /**
     * Get district record by ID
     *
     * @param string $district_id id of district
     * @return object district record
     */
    public function getDistrictById($district_id)
    {
        $sql = "SELECT * FROM $this->table_name WHERE district_id = :district_id";
        return $this->fetchSingle($sql, ['district_id' => $district_id]);
    }

    /**
     * Get all reports related to the given district
     *
     * @param string $district_id id of a district
     * @param array $filters filters
     * @return array all related reports
     */
    public function getDistrictReports($district_id, $filters)
    {
        $sql = "SELECT r.*, i.*, l.* FROM report r 
            INNER JOIN location l ON r.location_id = l.location_id 
            INNER JOIN incident i ON r.incident_id = i.incident_id
            WHERE district_id = :district_id";
        $filters_values['district_id'] = $district_id;
        if (isset($filters['from_last_update'])) {
            $sql .= ' AND r.last_update >= :from_last_update';
            $filters_values['from_last_update'] = $filters['from_last_update'];
        }

        if (isset($filters['to_last_update'])) {
            $sql .= ' AND r.last_update <= :to_last_update';
            $filters_values['to_last_update'] = $filters['to_last_update'];
        }

        if (isset($filters['fatalities'])) {
            $sql .= ' AND r.fatalities = :fatalities';
            $filters_values['fatalities'] = $filters['fatalities'];
        }

        if (isset($filters['premise'])) {
            $sql .= ' AND r.premise LIKE CONCAT(\'%\', :premise, \'%\')';
            $filters_values['premise'] = $filters['premise'];
        }

        $reports = $this->paginate($sql, $filters_values);
        foreach ($reports['data'] as &$report) {
            $report['incident'] = [
                'reported_time' => $report['reported_time'],
                'occurred_time' => $report['occurred_time']
            ];

            $report['location'] = [
                'district_id' => $report['district_id'],
                'address' => $report['address'],
                'cross_street' => $report['cross_street'],
                'area_name' => $report['area_name'],
                'latitude' => $report['latitude'],
                'longitude' => $report['longitude'],
            ];

            unset($report['incident_id'], $report['reported_time'], $report['occurred_time']);
            unset($report['location_id'], $report['district_id'], $report['address'], 
                $report['cross_street'], $report['area_name'], $report['latitude'], 
                $report['longitude']);
        }
        
        return $reports;
    }

    /**
     * Get all police in a district
     *
     * @param string $district_id id of a district
     * @param array $filters filters
     * @return array all related police
     */
    public function getDistrictPolice($district_id, $filters)
    {
        $sql = "SELECT * FROM police p WHERE district_id = :district_id";
        $filters_values['district_id'] = $district_id;
        if (isset($filters['first_name'])) {
            $sql .= ' AND p.first_name LIKE CONCAT(\'%\', :first_name, \'%\')';
            $filters_values['first_name'] = $filters['first_name'];
        }
        if (isset($filters['last_name'])) {
            $sql .= ' AND p.last_name LIKE CONCAT(\'%\', :last_name, \'%\')';
            $filters_values['last_name'] = $filters['last_name'];
        }
        if (isset($filters['from_join_date'])) {
            $sql .= ' AND p.join_date <= :from_join_date';
            $filters_values['from_join_date'] = $filters['from_join_date'];
        }       
        if (isset($filters['to_join_date'])) {
            $sql .= ' AND p.join_date >= :to_join_date';
            $filters_values['to_join_date'] = $filters['to_join_date'];
        } 
        if (isset($filters['rank'])) {
            $sql .= ' AND p.rank = :rank';
            $filters_values['rank'] = $filters['rank'];
        }         
        return $this->paginate($sql, $filters_values);
    }

    /**
     * Create a district record
     *
     * @param object $district district data
     * @return 
     */
    public function createDistrict($district)
    {
        return $this->insert($this->table_name, $district);
    }

    /**
     * Update a district record
     *
     * @param object $district new data
     * @param string $district_id id of district
     * @return void
     */
    public function updateDistrict($district, $district_id)
    {
        if(isset($district['district_id'])) {
            unset($district["district_id"]);
        }
        return $this->update($this->table_name, $district, ["district_id" => $district_id]);
    }

    /**
     * Delete a district
     *
     * @param string $district_id id of disctrict
     * @return void
     */
    public function deleteDistrict($district_id)
    {
        $sql = "SELECT badge_id FROM police where district_id = :district_id";
        $police = $this->run($sql, ["district_id"=> $district_id]);
        foreach ($police as $key => $val) {
            $this->delete('report_police', ["badge_id" => $val['badge_id']]);
        }

        $sql = "SELECT location_id FROM `location` where district_id = :district_id";
        $locations = $this->run($sql, ["district_id"=> $district_id]);
        foreach ($locations as $key => $location) {
            $sql = "SELECT report_id FROM `report` where `location_id` = :location_id";
            $reports = $this->run($sql, ["location_id" => $location['location_id']]);

            foreach ($reports as $key => $report) {
                $this->delete('report_crime', ['report_id' => $report['report_id']], '');
                $this->delete('report_modus', ['report_id' => $report['report_id']], '');
                $this->delete('report_criminal', ['report_id' => $report['report_id']], '');
                $this->delete('report_victim', ['report_id' => $report['report_id']], '');
                $this->delete('report_police', ['report_id' => $report['report_id']], '');
            }
            
            $this->delete('report', ["location_id" => $location['location_id']]);
        }

        $this->delete('location', ["district_id" => $district_id]);
        $this->delete('police', ["district_id" => $district_id]);
        return $this->delete($this->table_name, ["district_id" => $district_id]);
    }
}
