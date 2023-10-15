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
    public function getCriminalReports($criminal_id, $filters)
    {
        $sql = "SELECT r.*, i.*, l.* FROM report r
            INNER JOIN incident i ON r.incident_id = i.incident_id
            INNER JOIN location l ON r.location_id = l.location_id
            INNER JOIN report_criminal rc ON r.report_id = rc.report_id
            WHERE rc.criminal_id = :criminal_id
        ";

        //filtering
        $filters_values['criminal_id'] = $criminal_id;
        if (isset($filters['from_last_update'])) {
            $sql .= ' AND r.last_update >= :from_last_update';
            $filters_values['from_last_update'] = $filters['from_last_update'];
        }

        if (isset($filters['to_last_update'])) {
            $sql .= ' AND r.last_update <= :to_last_update';
            $filters_values['to_last_update'] = $filters['to_last_update'];
        }

        if (isset($filters['fatalities'])) {
            $sql .= ' AND r.fatalities = :fatalities';
            $filters_values['fatalities'] = $filters['fatalities'];
        }

        if (isset($filters['premise'])) {
            $sql .= ' AND r.premise LIKE CONCAT(\'%\', :premise, \'%\')';
            $filters_values['premise'] = $filters['premise'];
        }

        $reports = $this->fetchAll($sql, $filters_values);
        
        foreach ($reports as &$report) {
            $report['incident'] = [
                'reported_time' => $report['reported_time'],
                'occurred_time' => $report['occurred_time']
            ];

            $report['location'] = [
                'district_id' => $report['district_id'],
                'address' => $report['address'],
                'cross_street' => $report['cross_street'],
                'area_name' => $report['area_name'],
                'latitude' => $report['latitude'],
                'longitude' => $report['longitude'],
            ];

            unset($report['incident_id'], $report['reported_time'], $report['occurred_time']);
            unset($report['location_id'], $report['district_id'], $report['address'], $report['cross_street'], $report['area_name'], $report['latitude'], $report['longitude']);
        }
        
        return $reports;
    }

    // TODO: Implement this
    public function createCriminal($criminal)
    {
        $is_arrested = $criminal["is_arrested"];
        unset($criminal["is_arrested"]);
        $id = $this->insert($this->parent_table_name, $criminal);
        return $this->insert($this->table_name, ["person_id" => $id, "is_arrested" => $is_arrested ]);
    }

    // TODO: Implement this
    public function updateCriminal($criminal, $criminal_id)
    {
        unset($criminal["is_arrested"]);
        unset($criminal["criminal_id"]);
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
