<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class ServicesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
      parent::initialize($config);
      $this->setTable('services');
      $this->setPrimaryKey('id');
      $this->belongsTo('media', [
        'foreignKey' => 'media_id',
        'joinType' => 'LEFT',
    ]);  
      $this->addBehavior('Timestamp', [
          'services' => [
            'Model.beforeSave' => [
              'created_at' => 'new',
              'updated_at' => 'always'
            ]
          ]
      ]);
      $this->belongsTo('Media');
    //   $this->belongsTo('Admins');
    }
}

