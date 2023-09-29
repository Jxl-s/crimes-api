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
        $sql = "SELECT victim_id, first_name, last_name, age, sex, height, descent FROM $this->table_name v INNER JOIN person p ON v.person_id = p.person_id WHERE 1";

        // TODO: Filters

        return $this->paginate($sql, $filters_values);
    }

    // TODO: Implement this
    public function getVictimById($victim_id)
    {
        $sql = "SELECT victim_id, first_name, last_name, age, sex, height, descent FROM $this->table_name v INNER JOIN person p ON v.person_id = p.person_id WHERE v.victim_id = :victim_id";
        return $this->fetchSingle($sql, ['victim_id' => $victim_id]);
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
    public function deleteVictim($victim_id)
    {
        return $this->delete($this->table_name, ["victim_id" => $victim_id]);
    }
}
