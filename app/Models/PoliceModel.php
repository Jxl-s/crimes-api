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

    // TODO: Implement this
    public function getPoliceById($badge_id)
    {
        $sql = "SELECT * FROM $this->table_name WHERE badge_id = :badge_id";
        return $this->fetchAll($sql, [':badge_id' => $badge_id]);
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
    public function updatePolice()
    {
    }

    // TODO: Implement this
    public function deletePolice($police_id)
    {
    }
}
