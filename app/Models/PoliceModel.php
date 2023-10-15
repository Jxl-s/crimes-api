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
        $sql = "SELECT * FROM report r
            INNER JOIN incident i ON r.incident_id = i.incident_id
            INNER JOIN location l ON r.location_id = l.location_id

            WHERE r.report_id IN (
                SELECT report_id 
                FROM report_police rp 
                WHERE badge_id = :police_id
            )
        ";
        $reports = $this->fetchAll($sql, ['police_id' => $police_id]);
        
        foreach ($reports as $key => $report) {
            //set reports[$key] = a new report (map) after re-formatted
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
            // var_dump($report);exit;
            $reports[$key] = $report;
        }
        
        return $reports;
    }

    // TODO: Implement this
    public function createPolice($police)
    {
        return $this->insert($this->table_name, $police);
    }

    // TODO: Implement this
    public function updatePolice($police, $badge_id)
    {
        unset($police["badge_id"]);
        return $this->update($this->table_name, $police, ["badge_id" => $badge_id]);
    }

    // TODO: Implement this
    public function deletePolice($badge_id)
    {
        return $this->delete($this->table_name, ["badge_id" => $badge_id]);
    }
}
