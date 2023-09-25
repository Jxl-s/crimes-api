<?php

namespace Vanier\Api\Models;

class ReportsModel extends BaseModel
{
    private $table_name = 'report';

    public function __construct()
    {
        parent::__construct();
    }

    // TODO: Implement this
    public function getAllReports(array $filters)
    {
        $filters_values = [];
        $sql = "SELECT * FROM $this->table_name WHERE 1 ";

        //filters handle

        return $this->paginate($sql, $filters_values);
    }

    // TODO: Implement this
    public function getReportById($report_id)
    {
        $sql = "SELECT * FROM $this->table_name WHERE report_id = :report_id";
        return $this->fetchAll($sql, [':report_id' => $report_id]);
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
        $sql = "SELECT badge_id FROM report_police WHERE report_id = :report_id";
        $police = $this->fetchAll($sql, [':report_id' => $report_id]);
        //get all crime_code, place into an array
        $police = array_column((array) $police, 'badge_id');

        $report = $this->getReportById($report_id);
        //extend the current report
        $report['0']['police_badge_id'] = $police;
        
        // var_dump($result);exit;
        return $report;
    }

    // TODO: Implement this
    public function getReportCrimes($report_id)
    {
        $sql = "SELECT crime_code FROM report_crime WHERE report_id = :report_id";
        $crimes = $this->fetchAll($sql, [':report_id' => $report_id]);
        //get all crime_code, place into an array
        $crimes = array_column((array) $crimes, 'crime_code');

        $report = $this->getReportById($report_id);
        //extend the current report
        $report['0']['crime_codes'] = $crimes;
        
        // var_dump($result);exit;
        return $report;
    }

    // TODO: Implement this
    public function getReportModi($report_id)
    {
        $sql = "SELECT mo_code FROM report_modus WHERE report_id = :report_id";
        $modi = $this->fetchAll($sql, [':report_id' => $report_id]);
        //get all mo_code, place into an array
        $modi = array_column((array) $modi, 'mo_code');

        $report = $this->getReportById($report_id);
        //extend the current report
        $report['0']['mo_codes'] = $modi;
        
        // var_dump($result);exit;
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
    }
}
