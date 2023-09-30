<?php

namespace Vanier\Api\Models;

class CriminalsModel extends BaseModel
{
    private $parent_table_name = 'person';
    private $table_name = 'criminal';

    public function __construct()
    {
        parent::__construct();
    }

    // TODO: Implement this
    public function getAllCriminals(array $filters)
    {
        $filters_values = [];
        $sql = "SELECT criminal_id, first_name, last_name, age, sex, height, descent, is_arrested FROM $this->table_name c
        INNER JOIN person p ON c.person_id = p.person_id WHERE 1";

        // Filters
        if (isset($filters['first_name'])) {
            $sql .= ' AND p.first_name LIKE CONCAT(\'%\', :first_name, \'%\')';
            $filters_values['first_name'] = $filters['first_name'];
        }

        if (isset($filters['last_name'])) {
            $sql .= ' AND p.last_name LIKE CONCAT(\'%\', :last_name, \'%\')';
            $filters_values['last_name'] = $filters['last_name'];
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

        if (isset($filters['is_arrested'])) {
            $sql .= ' AND c.is_arrested = :is_arrested';
            $filters_values['is_arrested'] = $filters['is_arrested'];
        }

        return $this->paginate($sql, $filters_values);
    }

    public function getCriminalById($criminal_id)
    {
        $sql = "SELECT criminal_id, first_name, last_name, age, sex, height, descent, is_arrested FROM $this->table_name c
        INNER JOIN person p ON c.person_id = p.person_id
        WHERE criminal_id = :criminal_id";

        return $this->fetchSingle($sql, ['criminal_id' => $criminal_id]);
    }

    // TODO: Implement this
    public function getCriminalReports($criminal_id)
    {
    }

    // TODO: Implement this
    public function createCriminal()
    {
        $id = $this->insert($this->parent_table_name, $criminal);
        return $this->insert($this->table_name, ["person_id" => $id]);
    }

    // TODO: Implement this
    public function updateCriminal($criminal, $criminal_id)
    {
        $sql = "SELECT `person_id` FROM `$this->table_name` WHERE `criminal_id` = :criminal_id";
        $id = $this->fetchSingle($sql, ['criminal_id' => $criminal_id]);
        return $this->update($this->parent_table_name, $criminal, ['person_id' => $id['person_id']]);
    }

    // TODO: Implement this
    public function deleteCriminal($criminal_id)
    {
        return $this->delete($this->table_name, ["criminal_id" => $criminal_id]);
    }
}
