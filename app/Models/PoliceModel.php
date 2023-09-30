<?php

namespace Vanier\Api\Models;

class PoliceModel extends BaseModel
{
    private $table_name = 'police';

    public function __construct()
    {
        parent::__construct();
    }

    // TODO: Implement this
    public function getAllPolice(array $filters)
    {
        $filters_values = [];
        $sql = "SELECT * FROM $this->table_name WHERE 1 ";

        //filters handle

        return $this->paginate($sql, $filters_values);
    }

    public function getPoliceById($badge_id)
    {
        $sql = "SELECT * FROM $this->table_name WHERE badge_id = :badge_id";
        return $this->fetchSingle($sql, ['badge_id' => $badge_id]);
    }

    // TODO: Implement this
    public function getPoliceReports($police_id)
    {
    }

    // TODO: Implement this
    public function createPolice()
    {
    }

    // TODO: Implement this
    public function updatePolice($police, $badge_id)
    {
        unset($police["badge_id"]);
        return $this->update($this->table_name, $police, ["badge_id" => $badge_id]);
    }

    // TODO: Implement this
    public function deletePolice($badge_id)
    {
        return $this->delete($this->table_name, ["badge_id" => $badge_id]);
    }
}
