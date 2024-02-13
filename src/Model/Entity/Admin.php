<?php
declare(strict_types=1);

namespace App\Model\Entity;
use Cake\Auth\DefaultPasswordHasher; 
use Cake\ORM\Entity;


class Admin extends Entity
{
    protected function _setPassword($value)
    {
      if (strlen($value)) {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($value);
      }
    }
}
