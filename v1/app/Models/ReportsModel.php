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
    /**
     * Get all reports
     *
     * @param array $filters the filters to specify a group of reports
     * @return array return an array of reports
     */
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
    /**
     * Get a specific report
     *
     * @param [type] $report_id the specific id of the report
     * @return array return a report as an array
     */
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
    /**
     * Get the victims of that report
     *
     * @param [type] $report_id the specific id of the report
     * @param [type] $filters the filters of the group of victims
     * @return array return an array of victims
     */
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
    /**
     * Get the criminals of the report
     *
     * @param [type] $report_id the specific id of the report
     * @param [type] $filters the filters of the group of criminals
     * @return array return an array of criminals
     */
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
    /**
     * Get the police of the report
     *
     * @param [type] $report_id the specific id of the report
     * @param [type] $filters the filters of the group of police
     * @return array return an array of police
     */
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
    /**
     * Get the crimes of the report
     *
     * @param [type] $report_id the specific id of the report
     * @param [type] $filters the filters of the group of crimes
     * @return array return an array of crimes
     */
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
    /**
     * Get the modi of the report
     *
     * @param [type] $report_id the specific id of the report
     * @param [type] $filters the filters of the group of modi
     * @return array return an array of modi
     */
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
    private function createReportRelations($report_id, $table_name, $ids, $key)
    {
        foreach ($ids as $id) {
            $this->insert($table_name, ['report_id' => $report_id, $key => $id]);
        }
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
        $this->createReportRelations($report_id, 'report_crime', $crime_codes, 'crime_code');
        $this->createReportRelations($report_id, 'report_modus', $modus_codes, 'mo_code');
        $this->createReportRelations($report_id, 'report_criminal', $criminal_ids, 'criminal_id');
        $this->createReportRelations($report_id, 'report_victim', $victim_ids, 'victim_id');
        $this->createReportRelations($report_id, 'report_police', $police_ids, 'badge_id');

        return $report_id;
    }

    // TODO: Implement this
    public function updateReport($report, $report_id)
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

        // incident_id comes from `incident_id` in the report table. we have to get it from here
        $incident_sql = 'UPDATE incident SET

        reported_time = :reported_time,
        occurred_time = :occurred_time

        WHERE incident_id = (SELECT incident_id FROM report WHERE report_id = :report_id)';

        $location_sql = 'UPDATE location SET

        district_id = :district_id,
        address = :address,
        cross_street = :cross_street,
        area_name = :area_name,
        latitude = :latitude,
        longitude = :longitude

        WHERE location_id = (SELECT location_id FROM report WHERE report_id = :report_id)';

        $this->db->prepare($incident_sql)->execute([
            'report_id' => $report_id,

            'reported_time' => $incident['reported_time'],
            'occurred_time' => $incident['occurred_time'],
        ]);

        $this->db->prepare($location_sql)->execute([
            'report_id' => $report_id,

            'district_id' => $location['district_id'],
            'address' => $location['address'],
            'cross_street' => $location['cross_street'],
            'area_name' => $location['area_name'],
            'latitude' => $location['latitude'],
            'longitude' => $location['longitude'],
        ]);

        // Drop all the old many-to-many fields
        $this->delete('report_crime', ['report_id' => $report_id], '');
        $this->delete('report_modus', ['report_id' => $report_id], '');
        $this->delete('report_criminal', ['report_id' => $report_id], '');
        $this->delete('report_victim', ['report_id' => $report_id], '');
        $this->delete('report_police', ['report_id' => $report_id], '');

        // Insert many-to-many fields
        $this->createReportRelations($report_id, 'report_crime', $crime_codes, 'crime_code');
        $this->createReportRelations($report_id, 'report_modus', $modus_codes, 'mo_code');
        $this->createReportRelations($report_id, 'report_criminal', $criminal_ids, 'criminal_id');
        $this->createReportRelations($report_id, 'report_victim', $victim_ids, 'victim_id');
        $this->createReportRelations($report_id, 'report_police', $police_ids, 'badge_id');

        // Update report
        $success = $this->update($this->table_name, $report, ['report_id' => $report_id]);
        return $success;
    }

    // TODO: Implement this
    public function deleteReport($report_id)
    {
        // Delete all the old many-to-many fields
        $this->delete('report_crime', ['report_id' => $report_id], '');
        $this->delete('report_modus', ['report_id' => $report_id], '');
        $this->delete('report_criminal', ['report_id' => $report_id], '');
        $this->delete('report_victim', ['report_id' => $report_id], '');
        $this->delete('report_police', ['report_id' => $report_id], '');

        // Delete the report
        $success = $this->delete($this->table_name, ["report_id" => $report_id]);

        return $success;
    }

    public function toWeather($weather_code) {
        $table = array(
            '0' => 'Clear sky', 
            '1' => 'Mainly clear', 
            '2' => 'Partly cloudy', 
            '3' => 'Overcast', 
            '45' => 'Fog', 
            '48' => 'Depositing rime fog',
            '51' => 'Light drizzle',
            '53' => 'Moderate drizzle',
            '55' => 'Dense drizzle',
            '56' => 'Light freezing drizzle',
            '57' => 'Dense freezing drizzle',
            '61' => 'Light rain',
            '63' => 'Moderate rain',
            '65' => 'Dense rain',
            '66' => 'Light freezing rain',
            '67' => 'Dense freezing rain',
            '71' => 'Light snow fall',
            '73' => 'Moderate snow fall',
            '75' => 'Dense snow fall',
            '77' => 'Snow grains',
            '80' => 'Slight rain showers',
            '81' => 'Moderate rain showers',
            '82' => 'Violent rain showers',
            '85' => 'Slight snow showers',
            '86' => 'Violent snow showers',
        );
        return strtr($weather_code, $table);
    }
}
