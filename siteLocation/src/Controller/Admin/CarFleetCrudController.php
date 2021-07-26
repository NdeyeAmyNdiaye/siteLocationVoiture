<?php

namespace App\Controller\Admin;

use App\Entity\CarFleet;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CarFleetCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CarFleet::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
