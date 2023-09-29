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
    public function deleteReport(array $report_id)
    {
        return $this->delete($this->table_name, ["report_id" => $report_id]);
    }
}
