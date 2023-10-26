<?php

namespace Vanier\Api\Models;

use Exception;

class ReportsModel extends BaseModel
{
    private $table_name = 'report';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Makes it so that the returned report will have its
     * values grouped
     *
     * @param array $report
     * @return array
     */
    private function formatReport(array $report)
    {
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

        $array_to_ints = fn ($arr) => array_map(fn ($x) => intval($x), $arr);

        $report['crime_codes'] = $array_to_ints(explode(',', $report['crime_codes']));
        $report['criminal_ids'] = $array_to_ints(explode(',', $report['criminal_ids']));
        $report['police_ids'] = $array_to_ints(explode(',', $report['police_ids']));
        $report['victim_ids'] = $array_to_ints(explode(',', $report['victim_ids']));

        $report['modus_codes'] = explode(',', $report['modus_codes']);

        unset($report['incident_id'], $report['reported_time'], $report['occurred_time']);
        unset($report['location_id'], $report['district_id'], $report['address'], $report['cross_street'], $report['area_name'], $report['latitude'], $report['longitude']);

        return $report;
    }

    // TODO: Implement this
    public function getAllReports(array $filters)
    {
        $filters_values = [];
        $sql = "SELECT r.*, i.*, l.*,

        GROUP_CONCAT(DISTINCT c.crime_code) as crime_codes,
        GROUP_CONCAT(DISTINCT cr.criminal_id) as criminal_ids,
        GROUP_CONCAT(DISTINCT m.mo_code) as modus_codes,
        GROUP_CONCAT(DISTINCT p.badge_id) as police_ids,
        GROUP_CONCAT(DISTINCT v.victim_id) as victim_ids

        FROM $this->table_name r

        INNER JOIN incident i ON r.incident_id = i.incident_id
        INNER JOIN location l ON r.location_id = l.location_id

        INNER JOIN report_crime c ON r.report_id = c.report_id
        INNER JOIN report_criminal cr ON r.report_id = cr.report_id
        INNER JOIN report_modus m ON r.report_id = m.report_id
        INNER JOIN report_police p ON r.report_id = p.report_id
        INNER JOIN report_victim v ON r.report_id = v.report_id

        WHERE 1
        ";

        // Filtering parameters
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

        if (isset($filters['criminal_count'])) {
            $sql .= ' AND (SELECT COUNT(*) FROM report_criminal WHERE report_id = r.report_id) = :criminal_count';
            $filters_values['criminal_count'] = $filters['criminal_count'];
        }

        if (isset($filters['victim_count'])) {
            $sql .= ' AND (SELECT COUNT(*) FROM report_victim WHERE report_id = r.report_id) = :victim_count';
            $filters_values['victim_count'] = $filters['victim_count'];
        }

        if (isset($filters['crime_code'])) {
            $sql .= ' AND (SELECT COUNT(*) FROM report_crime WHERE report_id = r.report_id AND crime_code = :crime_code) >= 1';
            $filters_values['crime_code'] = $filters['crime_code'];
        }

        if (isset($filters['modus_code'])) {
            $sql .= ' AND (SELECT COUNT(*) FROM report_modus WHERE report_id = r.report_id AND mo_code = :modus_code) >= 1';
            $filters_values['modus_code'] = $filters['modus_code'];
        }

        if (isset($filters['premise'])) {
            $sql .= ' AND r.premise LIKE CONCAT(\'%\', :premise, \'%\')';
            $filters_values['premise'] = $filters['premise'];
        }

        $sql .= ' GROUP BY r.report_id';
        $results = $this->paginate($sql, $filters_values);

        foreach ($results['data'] as $key => $result) {
            $results['data'][$key] = $this->formatReport($result);
        }

        return $results;
    }

    public function getReportById($report_id)
    {
        $sql = "SELECT r.*, i.*, l.*,

        GROUP_CONCAT(DISTINCT c.crime_code) as crime_codes,
        GROUP_CONCAT(DISTINCT cr.criminal_id) as criminal_ids,
        GROUP_CONCAT(DISTINCT m.mo_code) as modus_codes,
        GROUP_CONCAT(DISTINCT p.badge_id) as police_ids,
        GROUP_CONCAT(DISTINCT v.victim_id) as victim_ids

        FROM $this->table_name r

        INNER JOIN incident i ON r.incident_id = i.incident_id
        INNER JOIN location l ON r.location_id = l.location_id

        INNER JOIN report_crime c ON r.report_id = c.report_id
        INNER JOIN report_criminal cr ON r.report_id = cr.report_id
        INNER JOIN report_modus m ON r.report_id = m.report_id
        INNER JOIN report_police p ON r.report_id = p.report_id
        INNER JOIN report_victim v ON r.report_id = v.report_id

        WHERE r.report_id = :report_id
        ";

        $filters_values['report_id'] = $report_id;

        $result = $this->fetchSingle($sql, $filters_values);
        if (!$result) return null;
        if (!isset($result['report_id'])) return null;
        if (!$result['report_id']) return null;

        return $this->formatReport((array) $result);
    }

    // TODO: Implement this
    public function getReportVictims($report_id, $filters)
    {
        $filters_values = [];
        $sql = "SELECT v.victim_id, first_name, last_name, age, sex, height, descent FROM report_victim rv
        INNER JOIN victim v ON rv.victim_id = v.victim_id
        INNER JOIN person p ON v.person_id = p.person_id

        WHERE rv.report_id = :report_id
        ";

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

        $filters_values['report_id'] = $report_id;

        $victims = $this->paginate($sql, $filters_values);
        return $victims;
    }

    // TODO: Implement this
    public function getReportCriminals($report_id, $filters)
    {
        $filters_values = [];
        $sql = "SELECT c.criminal_id, first_name, last_name, age, sex, height, descent, is_arrested FROM report_criminal rc
        INNER JOIN criminal c ON rc.criminal_id = c.criminal_id
        INNER JOIN person p ON c.person_id = p.person_id

        WHERE rc.report_id = :report_id
        ";

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

        $filters_values['report_id'] = $report_id;

        $criminals = $this->paginate($sql, $filters_values);
        return $criminals;
    }

    // TODO: Implement this
    public function getReportPolice($report_id, $filters)
    {
        $filters_values = [];
        $sql = "SELECT p.* FROM report_police rp
        INNER JOIN police p ON rp.badge_id = p.badge_id

        WHERE rp.report_id = :report_id
        ";

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

        $filters_values['report_id'] = $report_id;

        $police = $this->paginate($sql, $filters_values);
        return $police;
    }

    // TODO: Implement this
    public function getReportCrimes($report_id, $filters)
    {
        $filters_values = [];
        $sql = "SELECT c.* FROM report_crime rc
        INNER JOIN crime c ON rc.crime_code = c.crime_code

        WHERE rc.report_id = :report_id
        ";

        if (isset($filters['description'])) {
            $sql .= ' AND crime_desc LIKE CONCAT(\'%\', :description, \'%\')';
            $filters_values['description'] = $filters['description'];
        }

        $filters_values['report_id'] = $report_id;

        $crimes = $this->paginate($sql, $filters_values);
        return $crimes;
    }

    // TODO: Implement this
    public function getReportModi($report_id, $filters)
    {
        $filters_values = [];
        $sql = "SELECT m.* FROM report_modus rm
        INNER JOIN modus m ON rm.mo_code = m.mo_code

        WHERE rm.report_id = :report_id
        ";

        if (isset($filters['description'])) {
            $sql .= ' AND mo_desc LIKE CONCAT(\'%\', :description, \'%\')';
            $filters_values['description'] = $filters['description'];
        }

        $filters_values['report_id'] = $report_id;

        $crimes = $this->paginate($sql, $filters_values);
        return $crimes;
    }

    // TODO: Implement this
    public function createReport($report)
    {
        // Many-to-many fields
        $crime_codes = $report['crime_codes'];
        $modus_codes = $report['modus_codes'];
        $criminal_ids = $report['criminal_ids'];
        $victim_ids = $report['victim_ids'];
        $police_ids = $report['police_ids'];

        unset($report['crime_codes'], $report['criminal_ids'], $report['modus_codes'], $report['police_ids'], $report['victim_ids']);

        // Sub-entities
        $incident = $report['incident'];
        $location = $report['location'];

        unset($report['incident'], $report['location']);

        $report['incident_id'] = $this->insert('incident', $incident);
        $report['location_id'] = $this->insert('location', $location);

        $report_id = $this->insert($this->table_name, $report);

        // Insert many-to-many fields
        foreach ($crime_codes as $code) {
            $this->insert('report_crime', ['report_id' => $report_id, 'crime_code' => $code]);
        }

        foreach ($modus_codes as $code) {
            $this->insert('report_modus', ['report_id' => $report_id, 'mo_code' => $code]);
        }

        foreach ($criminal_ids as $id) {
            $this->insert('report_criminal', ['report_id' => $report_id, 'criminal_id' => $id]);
        }

        foreach ($victim_ids as $id) {
            $this->insert('report_victim', ['report_id' => $report_id, 'victim_id' => $id]);
        }

        foreach ($police_ids as $id) {
            $this->insert('report_police', ['report_id' => $report_id, 'badge_id' => $id]);
        }

        return $report_id;
    }

    // TODO: Implement this
    public function updateReport($report, $report_id)
    {
        unset($report["report_id"]);
        return $this->update($this->table_name, $report, ["report_id" => $report_id]);
    }

    // TODO: Implement this
    public function deleteReport($report_id)
    {
        return $this->delete($this->table_name, ["report_id" => $report_id]);
    }
}
