<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\ORM\Locator\TableLocator;
//Exceptions
use Cake\Http\Exception\BadRequestException;

class QueryController extends AppController
{
    public function initialize():void
    {
      parent::initialize();
      $this->loadComponent('Query');
    }
  
    public function create() {
        $this->request->allowMethod(['post']);
        $data = $this->request->getData();

        if (!isset($data['model']) || empty($data['model'])) {
            throw new BadRequestException('Please provide valid model.');
        }

        if (!isset($data['fields']) || empty($data['fields'])) {
            throw new BadRequestException('Please provide valid fields.');
        }

        $resp = $this->Query->setData($data['model'], $data['fields']);

        $this->set([
            'success' => true,
            'message' => 'Record successfully created.',
            'data' => $resp
        ]);
        $this->viewBuilder()->setOption('serialize', ['success','message','data']);      
    }

    public function read() {
        $this->request->allowMethod(['post']);
        $data = $this->request->getData();

        if (!isset($data['model']) || empty($data['model'])) {
            throw new BadRequestException('Please provide valid `model`.');
        }

        if (!isset($data['options']) || empty($data['options'])) {
            throw new BadRequestException('Please provide valid `options`.');
        }

        if (!isset($data['type']) || empty($data['type'])) {
            throw new BadRequestException('Please provide valid `type`.');
        }
        $resp = [];
        if ($data['type'] == 'one') {
            $resp = $this->Query->getOne($data['model'], $data['options']);
        } else if ($data['type'] == 'many') {
            $resp = $this->Query->getMany($data['model'], $data['options']);
        } else if ($data['type'] == 'list') {
            $resp = $this->Query->getList($data['model'], $data['options']);
        } else if ($data['type'] == 'count') {
            $resp = $this->Query->getCount($data['model'], $data['options']);
        }
        $this->set([
            'success' => true,
            'message' => 'Records successfully fetched.',
            'data' => $resp
        ]);
        $this->viewBuilder()->setOption('serialize', ['success','message','data']);      
    }

    public function readPagination() {
        $this->request->allowMethod(['post']);
        $data = $this->request->getData();

        if (!isset($data['model']) || empty($data['model'])) {
            throw new BadRequestException('Please provide valid `model`.');
        }

        if (!isset($data['options']) || empty($data['options'])) {
            throw new BadRequestException('Please provide valid `options`.');
        }

        //Pagination Part
        $limit = env('PAGE_LIMIT');
        if (!isset($data['options']['limit'])) {
            $data['options']['limit'] = env('PAGE_LIMIT');
        } else {
            $limit = $data['options']['limit'];
        }
        if (!isset($data['options']['page'])) {
            $data['options']['page'] = 1;
        }
        //---------------------------
        
        $results = $this->Query->getMany($data['model'], $data['options']);
        $total = $this->Query->getCount($data['model'], $data['options']);

        $this->set([
            'success' => true,
            'message' => 'Records fetched with Paginations.',
            'data' => [
              'pagesCount' => ceil($total / $limit),
              'results' => $results,
              'total' => $total
            ],
        ]);
        $this->viewBuilder()->setOption('serialize', ['success','message', 'data']);  
    }
    
    public function update() {
        $this->request->allowMethod(['put']);

    }

    public function delete() {
        $this->request->allowMethod(['delete']);
        $data = $this->request->getData();

        if (!isset($data['model']) || empty($data['model'])) {
            throw new BadRequestException('Please provide valid `model`.');
        }

        if (!isset($data['options']) || empty($data['options'])) {
            throw new BadRequestException('Please provide valid `options`.');
        }

        if (!isset($data['type']) || empty($data['type'])) {
            throw new BadRequestException('Please provide valid `type`.');
        }

        $resp = [];
        if ($data['type'] == 'soft') {
            $resp = $this->Query->softDelete($data['model'], $data['options']);
        } else if ($data['type'] == 'recover') {
            $resp = $this->Query->recoverDelete($data['model'], $data['options']);
        } else if ($data['type'] == 'hard') {
            $resp = $this->Query->hardDelete($data['model'], $data['options']);
        }

        $this->set([
            'success' => true,
            'message' => `Records are deleted.`,
            'data' => $resp,
            'total' => sizeof($resp)
        ]);
        $this->viewBuilder()->setOption('serialize', ['success','message', 'data', 'total']);
    }
}
