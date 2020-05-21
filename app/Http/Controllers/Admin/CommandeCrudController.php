<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CommandeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CommandeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CommandeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Commande');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/commande');
        $this->crud->setEntityNameStrings('commande', 'commandes');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setColumns([
            
            [
              'name' => 'adressliv',
              'label' => 'adresse livraison',
              'type' => 'text'
            ],
                 [    // Select2Multiple = n-n relationship (with pivot table)
                'label'     => "Produit ",
                'type'      => 'select2_multiple',
                'name'      => 'produit', // the method that defines the relationship in your Model
                'entity'    => 'produit', // the method that defines the relationship in your Model
                'attribute' => 'nom', // foreign key attribute that is shown to user
                'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
                      'model'     => "App\Models\Produit", // foreign key model
                    'options'   => (function ($query) {
                        return $query->orderBy('nom', 'ASC')->get();
                    }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
               
                ],
              [    // Select2Multiple = n-n relationship (with pivot table)
                    'label'     => "Suplementaire ",
                    'type'      => 'select2_multiple',
                    'name'      => 'suplement', // the method that defines the relationship in your Model
                    'entity'    => 'suplement', // the method that defines the relationship in your Model
                    'attribute' => 'nomingred', // foreign key attribute that is shown to user
                    'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
                           'model'     => "App\Models\Suplement", // foreign key model
                        'options'   => (function ($query) {
                            return $query->orderBy('nomingred', 'ASC')->get();
                        }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
                   
                    ],
                    [    // Select2Multiple = n-n relationship (with pivot table)
                        'label'     => "formule ",
                        'type'      => 'select2_multiple',
                        'name'      => 'formule', // the method that defines the relationship in your Model
                        'entity'    => 'formule', // the method that defines the relationship in your Model
                        'attribute' => 'nomFormule', // foreign key attribute that is shown to user
                        'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
                              'model'     => "App\Models\Element", // foreign key model
                            'options'   => (function ($query) {
                                return $query->orderBy('nomeFormule', 'ASC')->get();
                            }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
                       
                        ],
            [
              'name' => 'type',
              'label' => 'type',
              'type' => 'text'
            ],
            [
              'name' => 'secteur',
              'label' => 'secteur',
              'type' => 'text'
            ],
            [
              'name' => 'realise',
              'label' => 'realise',
              'type' => 'number'
            ]
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(CommandeRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->addField([
            
            'name' => 'adressliv',
            'label' => 'adressliv',
            'type' => 'text'
          
          
    ]);
    $this->crud->addField(
        [
            'name' => 'type',
            'label' => 'type',
            'type' => 'text'
          ]
    );
    $this->crud->addField([    // Select2Multiple = n-n relationship (with pivot table)
        'label'     => "Produit ",
        'type'      => 'select2_multiple',
        'name'      => 'produit', // the method that defines the relationship in your Model
        'entity'    => 'produit', // the method that defines the relationship in your Model
        'attribute' => 'nom', // foreign key attribute that is shown to user
        'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
         /*      'model'     => "App\Models\Element", // foreign key model
            'options'   => (function ($query) {
                return $query->orderBy('nomelem', 'ASC')->get();
            }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
       */
      ]);
      $this->crud->addField([    // Select2Multiple = n-n relationship (with pivot table)
        'label'     => "formule ",
        'type'      => 'select2_multiple',
        'name'      => 'formule', // the method that defines the relationship in your Model
        'entity'    => 'formule', // the method that defines the relationship in your Model
        'attribute' => 'nomFormule', // foreign key attribute that is shown to user
        'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
         
      ]);
    $this->crud->addField([    // Select2Multiple = n-n relationship (with pivot table)
        'label'     => "Suplementaire ",
        'type'      => 'select2_multiple',
        'name'      => 'suplement', // the method that defines the relationship in your Model
        'entity'    => 'suplement', // the method that defines the relationship in your Model
        'attribute' => 'nomingred', // foreign key attribute that is shown to user
        'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
         /*      'model'     => "App\Models\Element", // foreign key model
            'options'   => (function ($query) {
                return $query->orderBy('nomelem', 'ASC')->get();
            }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
       */
      ]);
    $this->crud->addField([
        
            'name' => 'secteur',
            'label' => 'secteur',
            'type' => 'text'
          
    ]);
    $this->crud->addField([
        
            'name' => 'realise',
            'label' => 'realise',
            'type' => 'number'
          
    ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
