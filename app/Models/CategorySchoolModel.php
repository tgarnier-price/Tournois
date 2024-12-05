<?php

namespace App\Models;

use CodeIgniter\Model;

class CategorySchoolModel extends Model
{
    protected $table = 'school_category';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name'];

    // Validation
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]',
    ];

    protected $validationMessages = [
        'name' => [
            'required'   => 'Le nom de la categorie est requis.',
            'min_length' => 'Le nom de la categorie doit comporter au moins 3 caractères.',
            'max_length' => 'Le nom de la categorie ne doit pas dépasser 100 caractères.',
        ],
    ];

    public function createCategorySchool($data)
    {
        return $this->insert($data);
    }

    public function updateCategorySchool($id, $data)
    {
        return $this->update($id, $data);
    }


    public function getAllCategorySchool()
    {
        return $this->findAll();
    }

    public function deleteCategorySchool($id)
    {
        return $this->delete($id);
    }

    public function deactivateCategorySchool($id) {
        $builder = $this->builder();
        $builder->set('deleted_at', date('Y-m-d H:i:s'));
        $builder->where('id', $id);
        return $builder->update();
    }

    public function activateCategorySchool($id) {
        $builder = $this->builder();
        $builder->set('deleted_at', NULL);
        $builder->where('id', $id);
        return $builder->update();
    }


    public function getPaginatedCategorySchool($start, $length, $searchValue, $orderColumnName, $orderDirection)
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

    public function getTotalCategorySchool()
    {
        $builder = $this->builder();
        return $builder->countAllResults();
    }

    public function getFilteredCategorySchool($searchValue)
    {
        $builder = $this->builder();
        if (!empty($searchValue)) {
            $builder->like('name', $searchValue);
        }

        return $builder->countAllResults();
    }
}
