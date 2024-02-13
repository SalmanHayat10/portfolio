<?php
/*
   In the present example, these changes would be made in:
   src/Model/Table/UsersTable.php
*/
declare(strict_types=1);

namespace App\Model\Table;
use Cake\ORM\Table;

class MediaTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable('media');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp', [
            'events' => [
              'Model.beforeSave' => [
                'created_at' => 'new',
                'updated_at' => 'always'
              ]
            ]
        ]);
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'value' => [
                'fields' => [
                    // if these fields or their defaults exist
                    // the values will be set.
                    'dir' => 'directory', // defaults to `dir`
                    'size' => 'size', // defaults to `size`
                    'type' => 'type', // defaults to `type`
                ],
                'nameCallback' => function ($table, $entity, $data, $field, $settings) {
                    return date('s').'-'.str_replace(' ', '', strtolower($data->getClientFilename()));
                },
                'deleteCallback' => function ($path, $entity, $field, $settings) {
                    // When deleting the entity, both the original and the thumbnail will be removed
                    // when keepFilesOnDelete is set to false
                    // $this->log("Deleting Files: ". $path . $entity->{$field});
                    return [
                        $path . $entity->{$field}
                    ];
                },
                'keepFilesOnDelete' => false
            ],
        ]);
    }
}
?>