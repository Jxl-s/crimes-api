<?php

namespace Vanier\Api\Models;

class ModiModel extends BaseModel
{
    private $table_name = 'modus';

    public function __construct()
    {
        parent::__construct();
    }

    // TODO: Implement this
    public function getAllModi(array $filters)
    {
        $filters_values = [];
        $sql = "SELECT * FROM $this->table_name WHERE 1 ";

        if (isset($filters['description'])) {
            $sql .= ' AND mo_desc LIKE CONCAT(\'%\', :description, \'%\')';
            $filters_values['description'] = $filters['description'];
        }

        return $this->paginate($sql, $filters_values);
    }

    public function getModusByCode($mo_code)
    {
        $sql = "SELECT * FROM $this->table_name WHERE mo_code = :mo_code";
        return $this->fetchSingle($sql, ['mo_code' => $mo_code]);
    }

    // TODO: Implement this
    public function createModus($modus)
    {
        if(isset($modus['description'])) {
            $modus['mo_desc'] = $modus['description'];
            unset($modus['description']);
        }
        return $this->insert($this->table_name, $modus);
    }

    // TODO: Implement this
    public function updateModus($modus, $mo_code)
    {
        if(isset($modus['mo_code'])) {
            unset($modus['mo_code']);
        }
        return $this->update($this->table_name, $modus, ["mo_code" => $mo_code]);
    }

    // TODO: Implement this
    public function deleteModus($mo_code)
    {
        $this->delete('report_modus', ["mo_code" => (int) $mo_code]);
        return $this->delete($this->table_name, ["mo_code" => $mo_code]);
    }
}
