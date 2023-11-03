<?php

namespace Vanier\Api\Models;

class WeaponsModel extends BaseModel
{
    private $table_name = 'weapon';

    public function __construct()
    {
        parent::__construct();
    }

    // TODO: Implement this
    public function getAllWeapons(array $filters)
    {
        $filters_values = [];
        $sql = "SELECT * FROM $this->table_name WHERE 1";

        if (isset($filters['type'])) {
            $sql .= ' AND type LIKE CONCAT(\'%\', :type, \'%\')';
            $filters_values['type'] = $filters['type'];
        }

        if (isset($filters['material'])) {
            $sql .= ' AND material LIKE CONCAT(\'%\', :material, \'%\')';
            $filters_values['material'] = $filters['material'];
        }

        if (isset($filters['color'])) {
            $sql .= ' AND color LIKE CONCAT(\'%\', :color, \'%\')';
            $filters_values['color'] = $filters['color'];
        }

        if (isset($filters['description'])) {
            $sql .= ' AND description LIKE CONCAT(\'%\', :description, \'%\')';
            $filters_values['description'] = $filters['description'];
        }

        return $this->paginate($sql, $filters_values);
    }

    public function getWeaponById($weapon_id)
    {
        $sql = "SELECT * FROM $this->table_name WHERE weapon_id = :weapon_id";
        return $this->fetchSingle($sql, ['weapon_id' => $weapon_id]);
    }

    // TODO: Implement this
    public function getWeaponReports($weapon_id, $filters)
    {
        $sql = "SELECT r.*, i.*, l.* FROM report r 
        INNER JOIN location l ON r.location_id = l.location_id 
        INNER JOIN incident i ON r.incident_id = i.incident_id WHERE weapon_id = :weapon_id";
        
        $filters_values['district_id'] = $weapon_id;

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
            unset(
                $report['location_id'],
                $report['district_id'],
                $report['address'],
                $report['cross_street'],
                $report['area_name'],
                $report['latitude'],
                $report['longitude']
            );
        }

        return $reports;
    }

    // TODO: Implement this
    public function createWeapon($weapon)
    {
        return $this->insert($this->table_name, $weapon);
    }

    // TODO: Implement this
    public function updateWeapon($weapon, $weapon_id)
    {
        unset($weapon["weapon_id"]);
        return $this->update($this->table_name, $weapon, ["weapon_id" => $weapon_id]);
    }

    // TODO: Implement this
    public function deleteWeapon($weapon_id)
    {
        $sql = "UPDATE report SET weapon_id = NULL WHERE weapon_id = :weapon_id";
        return $this->run($sql, ["weapon_id"=> $weapon_id])->rowCount();
    }

}
