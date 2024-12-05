<?php

namespace App\Models;

use CodeIgniter\Model;

class UserSchoolModel extends Model
{
    protected $table = 'school';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'city', 'score', 'actif'];

    // Validation
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]',
    ];

    protected $validationMessages = [
        'name' => [
            'required'   => 'Le nom de l école est requis.',
            'min_length' => 'Le nom de l école doit comporter au moins 3 caractères.',
            'max_length' => 'Le nom de l école ne doit pas dépasser 100 caractères.',
        ],
    ];

    public function createSchool($data)
    {
        // Pas de génération de slug ici
        return $this->insert($data);
    }

    public function updateSchool($id, $data)
    {
        return $this->update($id, $data);
    }

    public function getUsersBySchool($schoolId)
    {
        return $this->join('TableUser', 'TableUserSchool.id = TableUser.id_school')
            ->where('TableUserSchool.id', $schoolId)
            ->select('TableUser.*, TableUserSchool.name as school_name')
            ->findAll();
    }

    public function getAllSchool()
    {
        return $this->findAll();
    }

    public function getUserSchoolById($id)
    {
        return $this->find($id);
    }

    public function deleteSchool($id)
    {
        return $this->delete($id);
    }

    public function getPaginatedSchool($start, $length, $searchValue, $orderColumnName, $orderDirection)
    {
        $builder = $this->builder();
        // Recherche
        if ($searchValue != null) {
            $builder->like('name', $searchValue);
        }

        // Tri
        if ($orderColumnName && $orderDirection) {
            $builder->orderBy($orderColumnName, $orderDirection);
        }

        $builder->limit($length, $start);

        return $builder->get()->getResultArray();
    }

    public function getTotalSchool()
    {
        $builder = $this->builder();
        return $builder->countAllResults();
    }

    public function getFilteredSchool($searchValue)
    {
        $builder = $this->builder();
        if (!empty($searchValue)) {
            $builder->like('name', $searchValue);
        }

        return $builder->countAllResults();
    }
}
