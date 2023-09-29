<?php

namespace Vanier\Api\Models;

class VictimsModel extends BaseModel
{
    private $table_name = 'victim';

    public function __construct()
    {
        parent::__construct();
    }

    // TODO: Implement this
    public function getAllVictims(array $filters)
    {
        $filters_values = [];
        $sql = "SELECT * FROM $this->table_name WHERE 1 ";

        //filters handle

        return $this->paginate($sql, $filters_values);
    }

    // TODO: Implement this
    public function getVictimById($victim_id)
    {
        $sql = "SELECT * FROM $this->table_name WHERE victim_id = :victim_id";
        return $this->fetchAll($sql, [':victim_id' => $victim_id]);
    }

    // TODO: Implement this
    public function createVictim()
    {
    }

    // TODO: Implement this
    public function updateVictim()
    {
    }

    // TODO: Implement this
    public function deleteVictim(array $victim_id)
    {
        return $this->delete($this->table_name, ["victim_id" => $victim_id]);
    }
}
