<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FormuleRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class FormuleCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class FormuleCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Formule');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/formule');
        $this->crud->setEntityNameStrings('formule', 'formules');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setColumns([
            [
                'name' => "img",
                'label' => "image",
                'type' => 'image',
                'upload' => true,
                'aspect_ratio' => 1,
                'height' => '80px',
                'width' => '80px'
            ],
            [
                'name' => 'nomFormule',
                'label' => 'nomFormule ',
                'type' => 'text'
            ],
            [
                'name' => 'description',
                'label' => 'description ',
                'type' => 'text'
            ],
            [
                'name' => 'prix',
                'label' => 'prix ',
                'type' => 'number'
            ]
        
        ]);
    }
    protected function setupCreateOperation()
    {
        $this->crud->setValidation(FormuleRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->addField([
            'name' => "img",
            'label' => "image",
            'type' => 'image',
            'upload' => true,
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 1,
            'height' => '80px',
            'width' => '80px'
      ]);
        $this->crud->addField([
            'name' => 'nomFormule',
            'label'=> 'Nom Formule ',
            'type' => 'text'
          ]);
          $this->crud->addField([
            'name' => 'description',
            'label' => 'Description ',
            'type' => 'ckeditor'
          ]);
          $this->crud->addField([  
            'name' => 'prix',
            'label' => 'Prix ',
            'type' => 'number'
          ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}