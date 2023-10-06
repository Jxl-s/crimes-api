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
            $sql .= ' AND bureau = :bureau';
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
    public function getDistrictReports($district_id)
    {
        $sql = "SELECT report.* FROM report INNER JOIN location ON report.location_id = location.location_id WHERE district_id = :district_id";
        return $this->fetchAll($sql,[':district_id' => $district_id]);
    }

    // TODO: Implement this
    public function getDistrictPolice($district_id)
    {
        $sql = "SELECT * FROM police WHERE district_id = :district_id";
        return $this->fetchAll($sql,[':district_id' => $district_id]);
    }

    // TODO: Implement this
    public function createDistrict($district)
    {
        return $this->insert($this->table_name, $district);
    }

    // TODO: Implement this
    public function updateDistrict($district, $district_id)
    {
        unset($district["district_id"]);
        return $this->update($this->table_name, $district, ["district_id" => $district_id]);
    }

    // TODO: Implement this
    public function deleteDistrict($district_id)
    {
        return $this->delete($this->table_name, ["district_id" => $district_id]);
    }
}
