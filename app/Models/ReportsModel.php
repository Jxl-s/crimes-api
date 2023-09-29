<?php

namespace Vanier\Api\Models;

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
            'occured_time' => $report['occured_time']
        ];

        $report['location'] = [
            'district_id' => $report['district_id'],
            'address' => $report['address'],
            'cross_street' => $report['cross_street'],
            'area_name' => $report['area_name'],
            'latitude' => $report['latitude'],
            'longitude' => $report['longitude'],
        ];

        $array_to_ints = fn ($arr) => array_map(fn($x) => intval($x), $arr);

        $report['crime_codes'] = $array_to_ints(explode(',', $report['crime_codes']));
        $report['criminal_ids'] = $array_to_ints(explode(',', $report['criminal_ids']));
        $report['police_ids'] = $array_to_ints(explode(',', $report['police_ids']));
        $report['victim_ids'] = $array_to_ints(explode(',', $report['victim_ids']));

        $report['modus_codes'] = explode(',', $report['modus_codes']);

        unset($report['incident_id'], $report['reported_time'], $report['occured_time']);
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
        if (isset($filters['fromLastUpdate'])) {
            $sql .= ' AND r.last_update >= :fromLastUpdate';
            $filters_values['fromLastUpdate'] = $filters['fromLastUpdate'];
        }

        if (isset($filters['toLastUpdate'])) {
            $sql .= ' AND r.last_update <= :toLastUpdate';
            $filters_values['toLastUpdate'] = $filters['toLastUpdate'];
        }

        if (isset($filters['fatalities'])) {
            $sql .= ' AND r.fatalities = :fatalities';
            $filters_values['fatalities'] = $filters['fatalities'];
        }

        if (isset($filters['criminalCount'])) {
            $sql .= ' AND (SELECT COUNT(*) FROM report_criminal WHERE report_id = r.report_id) = :criminalCount';
            $filters_values['criminalCount'] = $filters['criminalCount'];
        }

        if (isset($filters['victimCount'])) {
            $sql .= ' AND (SELECT COUNT(*) FROM report_victim WHERE report_id = r.report_id) = :victimCount';
            $filters_values['victimCount'] = $filters['victimCount'];
        }

        if (isset($filters['crimeCode'])) {
            $sql .= ' AND (SELECT COUNT(*) FROM report_crime WHERE report_id = r.report_id AND crime_code = :crimeCode) >= 1';
            $filters_values['crimeCode'] = $filters['crimeCode'];
        }

        if (isset($filters['modusCode'])) {
            $sql .= ' AND (SELECT COUNT(*) FROM report_modus WHERE report_id = r.report_id AND mo_code = :modusCode) >= 1';
            $filters_values['modusCode'] = $filters['modusCode'];
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

        $result = $this->fetchSingle($sql, ['report_id' => $report_id]);
        if (!$result) return $result;

        return $this->formatReport((array) $result);
    }

    // TODO: Implement this
    public function getReportVictims($report_id)
    {
        $sql = "SELECT victim_id FROM report_victim WHERE report_id = :report_id";
        $victims = $this->fetchAll($sql, [':report_id' => $report_id]);
        //get all crime_code, place into an array
        $victims = array_column((array) $victims, 'victim_id');

        $report = $this->getReportById($report_id);
        //extend the current report
        $report['0']['victim_id'] = $victims;

        // var_dump($result);exit;
        return $report;
    }

    // TODO: Implement this
    public function getReportCriminals($report_id)
    {
        $sql = "SELECT criminal_id FROM report_criminal WHERE report_id = :report_id";
        $criminals = $this->fetchAll($sql, [':report_id' => $report_id]);
        //get all crime_code, place into an array
        $criminals = array_column((array) $criminals, 'criminal_id');

        $report = $this->getReportById($report_id);
        //extend the current report
        $report['0']['criminal_id'] = $criminals;

        // var_dump($result);exit;
        return $report;
    }

    // TODO: Implement this
    public function getReportPolice($report_id)
    {
        //retrieve police officer information who was in charged
        $sql = "SELECT *
                FROM police p JOIN report_police rp
                ON p.badge_id = rp.badge_id
                WHERE report_id = :report_id";
        $police = $this->fetchAll($sql, [':report_id' => $report_id]);

        $report = $this->getReportById($report_id);
        //extend the current report
        $report['0']['police_badge_id'] = $police;

        return $report;
    }

    // TODO: Implement this
    public function getReportCrimes($report_id)
    {
        //retrieve code + description
        $sql = "SELECT c.crime_code, crime_desc 
                FROM crime c JOIN report_crime rc 
                ON c.crime_code = rc.crime_code
                WHERE report_id = :report_id";
        $crimes = $this->fetchAll($sql, [':report_id' => $report_id]);

        $report = $this->getReportById($report_id);
        //extend the current report
        $report['0']['crime_codes'] = $crimes;

        return $report;
    }

    // TODO: Implement this
    public function getReportModi($report_id)
    {
        //retrieve code + description
        $sql = "SELECT m.mo_code, mo_desc 
                FROM modus m JOIN report_modus rm 
                ON m.mo_code = rm.mo_code
                WHERE report_id = :report_id";
        $modi = $this->fetchAll($sql, [':report_id' => $report_id]);

        $report = $this->getReportById($report_id);
        //extend the current report
        $report['0']['mo_codes'] = $modi;

        return $report;
    }

    // TODO: Implement this
    public function createReport()
    {
    }

    // TODO: Implement this
    public function updateReport()
    {
    }

    // TODO: Implement this
    public function deleteReport($report_id)
    {
        return $this->delete($this->table_name, ["report_id" => $report_id]);
    }
}
