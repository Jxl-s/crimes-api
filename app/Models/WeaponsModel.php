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
            $sql .= ' AND type = :type';
            $filters_values['type'] = $filters['type'];
        }

        if (isset($filters['material'])) {
            $sql .= ' AND material = :material';
            $filters_values['material'] = $filters['material'];
        }

        if (isset($filters['color'])) {
            $sql .= ' AND color = :color';
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
    public function getWeaponReports($weapon_id)
    {
        $sql = "SELECT * FROM report WHERE weapon_id = :weapon_id";
        return $this->fetchAll($sql,[':weapon_id' => $weapon_id]);
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
        return $this->delete($this->table_name, ["weapon_id" => $weapon_id]);
    }
}
