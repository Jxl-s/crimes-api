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
        $sql = "SELECT * FROM $this->table_name WHERE 1 ";

        //filters handle

        return $this->paginate($sql, $filters_values);
    }

    // TODO: Implement this
    public function getCriminalById($criminal_id)
    {
        $sql = "SELECT * FROM $this->table_name WHERE criminal_id = :criminal_id";
        return $this->fetchAll($sql, [':criminal_id' => $criminal_id]);
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
    }
}
