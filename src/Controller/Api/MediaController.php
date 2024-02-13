<?php

namespace App\Controller\Api;

use App\Controller\Api\AppController;

use Cake\Http\Exception\BadRequestException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Exception\InternalErrorException;

class MediaController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Query');
        $this->loadComponent('Media');
        // $this->Auth->allow();

    }

    /**
     * Upload Media
     */
    public function upload()
    {
        $this->loadComponent('Media');
        $this->request->allowMethod(['post']);
        $media = $this->request->getUploadedFile('media');
        $data = $this->request->getData();
        $mediaResp = [];
        if (empty($media->getClientFilename())) {
            throw new InternalErrorException('Invalid file.');
        }

        $mediaResp = $this->Media->onAdd($media, null);

        $this->set([
            'success' => true,
            'message' => 'Media succssfully uploaded.',
            'data' => $mediaResp
        ]);
        $this->viewBuilder()->setOption('serialize', ['success', 'data', 'message']);
    }
}
