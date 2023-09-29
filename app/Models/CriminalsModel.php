<?php

namespace Vanier\Api\Models;

class CriminalsModel extends BaseModel
{
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

        // TODO: Filters

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
    }

    // TODO: Implement this
    public function updateCriminal()
    {
    }

    // TODO: Implement this
    public function deleteCriminal($criminal_id)
    {
        return $this->delete($this->table_name, ["criminal_id" => $criminal_id]);
    }
}
