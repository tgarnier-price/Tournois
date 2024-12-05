<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryGameModel extends Model
{
    protected $table = 'game_category';
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

    public function createCategoryGame($data)
    {
        return $this->insert($data);
    }

    public function updateCategoryGame($id, $data)
    {
        return $this->update($id, $data);
    }


    public function getAllCategoryGame()
    {
        return $this->findAll();
    }

    public function deleteCategoryGame($id)
    {
        return $this->delete($id);
    }

    public function deactivateCategoryGame($id) {
        $builder = $this->builder();
        $builder->set('deleted_at', date('Y-m-d H:i:s'));
        $builder->where('id', $id);
        return $builder->update();
    }

    public function activateCategoryGame($id) {
        $builder = $this->builder();
        $builder->set('deleted_at', NULL);
        $builder->where('id', $id);
        return $builder->update();
    }


    public function getPaginatedCategoryGame($start, $length, $searchValue, $orderColumnName, $orderDirection)
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

    public function getTotalCategoryGame()
    {
        $builder = $this->builder();
        return $builder->countAllResults();
    }

    public function getFilteredCategoryGame($searchValue)
    {
        $builder = $this->builder();
        if (!empty($searchValue)) {
            $builder->like('name', $searchValue);
        }

        return $builder->countAllResults();
    }
}
