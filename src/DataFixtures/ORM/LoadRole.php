<?php
// App\src/DataFixtures/ORM/LoadRole.php

namespace App\src\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Role;

class LoadRole implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    // Liste des noms de role à ajouter
    $names = array(
      'ROLE_SYMPATHISANT',
      'ROLE_TECHNIQUE',
      'ROLE_ADHERENT',
      'ROLE_MANAGER_LYON',
      'ROLE_ADMIN'
    );

    foreach ($names as $name) {
      // On crée la catégorie
      $role = new Role();
      $role->setName($name);

      // On la persiste
      $manager->persist($role);
    }

    // On déclenche l'enregistrement de toutes les catégories
    $manager->flush();
  }
}