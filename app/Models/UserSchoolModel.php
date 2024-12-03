<?php

namespace App\Models;

use CodeIgniter\Model;

class UserSchoolModel extends Model
{
    protected $table = 'user_school';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'slug'];

    // Validation
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]',
    ];

    protected $validationMessages = [
        'name' => [
            'required'   => 'Le nom de l ecole est requis.',
            'min_length' => 'Le nom de l ecole doit comporter au moins 3 caractères.',
            'max_length' => 'Le nom de l ecole ne doit pas dépasser 100 caractères.',
        ],
    ];

    public function createScholl($data)
    {
        if (isset($data['name'])) {
            // Générer et vérifier le slug unique
            $data['slug'] = $this->generateUniqueSlug($data['name']);
        }

        return $this->insert($data);
    }

    public function updateSchool($id, $data)
    {
        if (isset($data['name'])) {
            // Générer et vérifier le slug unique
            $data['slug'] = $this->generateUniqueSlug($data['name']);
        }

        return $this->update($id, $data);
    }

    private function generateUniqueSlug($name)
    {
        $slug = generateSlug($name); // Utilisez la fonction du helper pour générer le slug de base
        $builder = $this->builder();

        // Vérifiez si le slug existe déjà
        $count = $builder->where('slug', $slug)->countAllResults();

        if ($count === 0) {
            return $slug;
        }

        // Si le slug existe, ajoutez un suffixe numérique pour le rendre unique
        $i = 1;
        while ($count > 0) {
            $newSlug = $slug . '-' . $i;
            $count = $builder->where('slug', $newSlug)->countAllResults();
            $i++;
        }

        return $newSlug;
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
        // @phpstan-ignore-next-line
        if (!empty($searchValue)) {
            $builder->like('name', $searchValue);
        }

        return $builder->countAllResults();
    }
}