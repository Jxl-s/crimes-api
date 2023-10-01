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
        $sql = "SELECT * FROM $this->table_name WHERE 1";

        if (isset($filters['first_name'])) {
            $sql .= ' AND first_name LIKE CONCAT(\'%\', :first_name, \'%\')';
            $filters_values['first_name'] = $filters['first_name'];
        }

        if (isset($filters['last_name'])) {
            $sql .= ' AND last_name LIKE CONCAT(\'%\', :last_name, \'%\')';
            $filters_values['last_name'] = $filters['last_name'];
        }

        if (isset($filters['from_join_date'])) {
            $sql .= ' AND join_date >= :from_join_date';
            $filters_values['from_join_date'] = $filters['from_join_date'];
        }

        if (isset($filters['to_join_date'])) {
            $sql .= ' AND join_date <= :to_join_date';
            $filters_values['to_join_date'] = $filters['to_join_date'];
        }

        if (isset($filters['rank'])) {
            $sql .= ' AND rank = :rank';
            $filters_values['rank'] = $filters['rank'];
        }

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
    public function createPolice($police)
    {
        return $this->insert($this->table_name, $police);
    }

    // TODO: Implement this
    public function updatePolice($police, $badge_id)
    {
        return $this->update($this->table_name, $police, ["badge_id" => $badge_id]);
    }

    // TODO: Implement this
    public function deletePolice($badge_id)
    {
        return $this->delete($this->table_name, ["badge_id" => $badge_id]);
    }
}
