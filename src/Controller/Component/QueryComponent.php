<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * PHP version 7
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @category  Component
 * @package   Query
 * @author    Mohammed Sufyan Shaikh <sufyan@ascendtis.com>
 * @copyright 2021 Copyright (c) Ascendtis IT Solutions LLP
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @version   SVN: $Id$
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 */
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\Locator\TableLocator;

use Cake\Datasource\ConnectionManager;

/**
 * Query Component
 *
 * @category Component
 * @package  Query
 * @author   Mohammed Sufyan Shaikh <sufyan@ascendtis.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 * @link     https://www.ascendtis.com/
 */
class QueryComponent extends Component
{
    /**
     * Set Data
     * @author   Mohammed Sufyan Shaikh <sufyan@ascendtis.com>
     * @return array
     */
    public function setData($model = null, $fields = []) {
        try {
            if ($model == null) return false;
            $tableLocator = new TableLocator();
            $table = $tableLocator->get($model);
            if (empty($table)) return false;
            $new_record = [];
            if (isset($fields[0])) {
                $new_record = $table->newEntities($fields);
                return $table->saveManyOrFail($new_record);//Record saved!
            } else {
                $new_record = $table->newEntity($fields);
                return $table->saveOrFail($new_record);//Record saved!
            }
            return false;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Get One Record
     * @author   Mohammed Sufyan Shaikh <sufyan@ascendtis.com>
     * @return array
     */
    public function getOne($model = null, $options = []) {
        try {
            if ($model == null) return false;
            $tableLocator = new TableLocator();
            $table = $tableLocator->get($model);
            if (empty($table)) return false;
            
            $query = $this->_getQuery($table, $options);
            return $query->first();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Get Many Record
     * @author   Mohammed Sufyan Shaikh <sufyan@ascendtis.com>
     * @return array
     */
    public function getMany($model = null, $options = []) {
        try {
            if ($model == null) return false;
            $tableLocator = new TableLocator();
            $table = $tableLocator->get($model);
            if (empty($table)) return false;

            $query = $this->_getQuery($table, $options);
            return $query->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Get List Record
     * @author   Mohammed Sufyan Shaikh <sufyan@ascendtis.com>
     * @return array
     */
    public function getList($model = null, $options = []) {
        try {
            if ($model == null) return false;
            $tableLocator = new TableLocator();
            $table = $tableLocator->get($model);
            if (empty($table)) return false;

            $query = $this->_getQuery($table, $options);
            return $query->toList();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Get Count Record
     * @author   Mohammed Sufyan Shaikh <sufyan@ascendtis.com>
     * @return array
     */
    public function getCount($model = null, $options = []) {
        try {
            if ($model == null) return false;
            $tableLocator = new TableLocator();
            $table = $tableLocator->get($model);
            if (empty($table)) return false;
            $query = $this->_getQuery($table, $options);
            return $query->count();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Soft Delete
     * @author Mohammed Sufyan Shaikh <sufyan@ascendtis.com>
     * @return array
     */
    public function softDelete($model = null, $options = []) {
        try {
            $results = $this->getMany($model, $options);
            $records = [];
            foreach ($results as $key=>$value) {
                $tmp = [];
                $tmp['id'] = $value['id'];
                $tmp['is_deleted'] = 1;
                $tmp['deleted_at'] = date('Y-m-d H:m:s');
                $records[] = $tmp;
            }
            return $this->setData($model, $records);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Recover Delete
     * @author Mohammed Sufyan Shaikh <sufyan@ascendtis.com>
     * @return array
     */
    public function recoverDelete($model = null, $options = []) {
        try {
            $results = $this->getMany($model, $options);
            $records = [];
            foreach ($results as $key=>$value) {
                $tmp = [];
                $tmp['id'] = $value['id'];
                $tmp['is_deleted'] = 0;
                $tmp['deleted_at'] = null;
                $records[] = $tmp;
            }
            return $this->setData($model, $records);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Soft Delete
     * @author Mohammed Sufyan Shaikh <sufyan@ascendtis.com>
     * @return array
     */
    public function hardDelete($model = null, $options = []) {
        try {
            //getTable
            $tableLocator = new TableLocator();
            $table = $tableLocator->get($model);
            if (empty($table)) return false;
            //fetch matching records
            $results = $this->getMany($model, ['conditions' => $options]);
            return $table->deleteManyOrFail($results); //delete or fail
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     * Preparing Query
     * @author   Mohammed Sufyan Shaikh <sufyan@ascendtis.com>
     * @return query
     */
    private function _getQuery($table = null, $options = []) {
        $query = $table->find();
        if (isset($options['conditions'])) {
            if (isset($options['fieldTypes'])) {
                $query->where($options['conditions'], $options['fieldTypes']);
            } else {
                $query->where($options['conditions']);
            }
        }

        if (isset($options['order'])) {
            $query->order($options['order']);
        }

        if (isset($options['select'])) {
            $query->select($options['select']);
        }
        
        if (isset($options['contain'])) {
            $query->contain($options['contain']);
        }

        if (isset($options['limit'])) {
            $query->limit($options['limit']);
        }

        if (isset($options['page'])) {
            $query->page($options['page']);
        }

        if (isset($options['distinct'])) {
            $query->distinct($options['distinct']);
        }

        return $query;
    }

     /**
     * Raw Query
     * 
     * @return array
     */
    public function rawQuery($query = null, $type = 'all', $db_con = 'default')
    {
        if ($query == null) return false;
        $records = [];

        $conn = ConnectionManager::get($db_con);        
        $data = $conn->execute($query);

        if ($type == 'one') {
            $records = $data->fetch('assoc');
        } else if ($type == 'all') {
            $records = $data->fetchAll('assoc');            
        }
        return $records;
    }
}