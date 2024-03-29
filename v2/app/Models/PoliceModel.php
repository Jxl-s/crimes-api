<?php

namespace Vanier\Api\Models;

class PoliceModel extends BaseModel
{
    private $table_name = 'police';

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Get all police officers from database
     *
     * @param array $filters the filters for the police
     * @return array return an array of police
     */
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
    /**
     * Get a police officer of specific Id
     *
     * @param [type] $badge_id badge id of the police officer
     * @return object return a police officer as an object
     */
    public function getPoliceById($badge_id)
    {
        $sql = "SELECT * FROM $this->table_name WHERE badge_id = :badge_id";
        return $this->fetchSingle($sql, ['badge_id' => $badge_id]);
    }
    /**
     * Get the reports of that police officer 
     *
     * @param [type] $badge_id badge id of the police officer
     * @param [type] $filters the filters for the police
     * @return array return an array of reports
     */
    // TODO: Implement this
    public function getPoliceReports($badge_id, $filters)
    {
        $filters_values = [];
        
        $sql = "SELECT r.*, i.*, l.* FROM report r
            INNER JOIN incident i ON r.incident_id = i.incident_id
            INNER JOIN location l ON r.location_id = l.location_id
            INNER JOIN report_police rp ON r.report_id = rp.report_id

            WHERE rp.badge_id = :badge_id
        ";

        //filtering
        $filters_values['badge_id'] = $badge_id;

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

        $reports = $this->paginate($sql, $filters_values);
        
        foreach ($reports['data'] as &$report) {
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

    /**
     * Create a police officer and record it into the database
     *
     * @param [type] $police an array of values detailing the data of the police
     *
     */
    // TODO: Implement this
    public function createPolice($police)
    {
        return $this->insert($this->table_name, $police);
    }
    
    /**
     * Update the details of a police officer in the database
     *
     * @param [type] $police an array of values detailing the updated data of the police
     * @param [type] $badge_id badge id of the police officer
     * @return void
     */
    // TODO: Implement this
    public function updatePolice($police, $badge_id)
    {
        if(isset($police['badge_id'])) {
            unset($police["badge_id"]);
        }
        return $this->update($this->table_name, $police, ["badge_id" => $badge_id]);
    }
    /**
     * Delete a police officer from the database
     *
     * @param [type] $badge_id badge id of the police officer
     * @return void
     */
    // TODO: Implement this
    public function deletePolice($badge_id)
    {
        // Delete the reports
        $this->delete('report_police', ["badge_id" => $badge_id]);
        return $this->delete($this->table_name, ["badge_id" => $badge_id]);
    }
}
