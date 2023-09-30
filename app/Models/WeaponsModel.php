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
    }

    // TODO: Implement this
    public function createWeapon($weapon)
    {
        return $this->insert($this->table_name, $weapon);
    }

    // TODO: Implement this
    public function updateWeapon()
    {
        
    }

    // TODO: Implement this
    public function deleteWeapon($weapon_id)
    {
        return $this->delete($this->table_name, ["weapon_id" => $weapon_id]);
    }
}
