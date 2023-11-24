<?php

namespace Vanier\Api\Models;

class VictimsModel extends BaseModel
{
    private $parent_table_name = 'person';
    private $table_name = 'victim';

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllVictims(array $filters)
    {
        $filters_values = [];
        $sql = "SELECT victim_id, first_name, last_name, age, sex, height, descent FROM $this->table_name v
        INNER JOIN person p ON v.person_id = p.person_id
        WHERE 1";

        // Filters
        if (isset($filters['first_name'])) {
            $sql .= ' AND p.first_name LIKE CONCAT(\'%\', :first_name, \'%\')';
            $filters_values['first_name'] = $filters['first_name'];
        }

        if (isset($filters['last_name'])) {
            $sql .= ' AND p.last_name LIKE CONCAT(\'%\', :last_name, \'%\')';
            $filters_values['last_name'] = $filters['last_name'];
        }

        if (isset($filters['height'])) {
            $sql .= ' AND p.height = :height';
            $filters_values['height'] = $filters['height'];
        }

        if (isset($filters['age'])) {
            $sql .= ' AND p.age = :age';
            $filters_values['age'] = $filters['age'];
        }

        if (isset($filters['descent'])) {
            $sql .= ' AND p.descent = :descent';
            $filters_values['descent'] = $filters['descent'];
        }

        if (isset($filters['sex'])) {
            $sql .= ' AND p.sex = :sex';
            $filters_values['sex'] = $filters['sex'];
        }

        return $this->paginate($sql, $filters_values);
    }

    public function getVictimById($victim_id)
    {
        $sql = "SELECT victim_id, first_name, last_name, age, sex, height, descent FROM $this->table_name v INNER JOIN person p ON v.person_id = p.person_id WHERE v.victim_id = :victim_id";
        return $this->fetchSingle($sql, ['victim_id' => $victim_id]);
    }

    public function createVictim($victim)
    {
        unset($victim['victim_id']);
        $id = $this->insert($this->parent_table_name, $victim);
        return $this->insert($this->table_name, ["person_id" => $id]);
    }

    public function updateVictim($victim, $victim_id)
    {
        unset($victim["victim_id"]);

        $sql = "SELECT `person_id` FROM `$this->table_name` WHERE `victim_id` = :victim_id";
        $id = $this->fetchSingle($sql, ['victim_id' => $victim_id]);

        //return immediately if no record found
        if (!$id)
            return null;

        return $this->update($this->parent_table_name, $victim, ['person_id' => $id['person_id']]);
    }

    public function deleteVictim($victim_id)
    {
        $this->delete('report_victim', ['victim_id' => $victim_id]);
        return $this->delete($this->table_name, ["victim_id" => $victim_id]);
    }
}
