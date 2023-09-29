<?php

namespace Vanier\Api\Models;
use Vanier\Api\Models\BaseModel;

class CrimesModel extends BaseModel
{
    private $table_name = 'crime';

    public function __construct()
    {
        parent::__construct();
    }

    // TODO: Implement this
    public function getAllCrimes(array $filters)
    {
        $filters_values = [];
        $sql = "SELECT * FROM $this->table_name WHERE 1 ";

        // TODO: Filters

        return $this->paginate($sql, $filters_values);
    }

    public function getCrimeByCode($crime_code)
    {
        $sql = "SELECT * FROM $this->table_name WHERE crime_code = :crime_code";
        return $this->fetchSingle($sql, ['crime_code' => $crime_code]);
    }

    // TODO: Implement this
    public function createCrime($crime)
    {
        return $this->insert($this->table_name, $crime);
    }

    // TODO: Implement this
    public function updateCrime($crime, $crime_code)
    {
        unset($crime["crime_code"]);
        return $this->update($this->table_name, $crime, ["crime_code" => $crime_code]);
    }
    
    // TODO: Implement this
    public function deleteCrime($code)
    {
        return $this->delete($this->table_name, ["crime_code" => (int) $code]);
    }
}
