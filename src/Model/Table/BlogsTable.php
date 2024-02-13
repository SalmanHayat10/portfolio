<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class BlogsTable extends Table
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
      $this->setTable('blogs');

      $this->addBehavior('Timestamp', [
          'events' => [
            'Model.beforeSave' => [
              'created_at' => 'new',
              'updated_at' => 'always'
            ]
          ]
      ]);
      $this->belongsTo('Media');
    }
}

