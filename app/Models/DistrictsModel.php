<?php

namespace Vanier\Api\Models;

class DistrictsModel extends BaseModel
{
    private $table_name = 'district';

    public function __construct()
    {
        parent::__construct();
    }

    // TODO: Implement this
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

    public function getDistrictById($district_id)
    {
        $sql = "SELECT * FROM $this->table_name WHERE district_id = :district_id";
        return $this->fetchSingle($sql, ['district_id' => $district_id]);
    }

    // TODO: Implement this
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

    // TODO: Implement this
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

    // TODO: Implement this
    public function createDistrict($district)
    {
        if(isset($district['district_id'])) {
            unset($district["district_id"]);
        }
        return $this->insert($this->table_name, $district);
    }

    // TODO: Implement this
    public function updateDistrict($district, $district_id)
    {
        if(isset($district['district_id'])) {
            unset($district["district_id"]);
        }
        return $this->update($this->table_name, $district, ["district_id" => $district_id]);
    }

    // TODO: Implement this
    public function deleteDistrict($district_id)
    {
        $this->delete('police', ["district_id" => $district_id]);
        return $this->delete($this->table_name, ["district_id" => $district_id]);
    }
}
