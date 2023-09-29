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
        $sql = "SELECT * FROM $this->table_name WHERE 1 ";

        //filters handle

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
    }

    // TODO: Implement this
    public function getDistrictPolice($district_id)
    {
    }

    // TODO: Implement this
    public function createDistrict($district)
    {
        return $this->insert($this->table_name, $district);
    }

    // TODO: Implement this
    public function updateDistrict()
    {
    }

    // TODO: Implement this
    public function deleteDistrict($district_id)
    {
        return $this->delete($this->table_name, ["district_id" => $district_id]);
    }
}
