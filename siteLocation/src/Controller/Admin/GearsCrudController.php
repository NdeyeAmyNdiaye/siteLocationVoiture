<?php

namespace App\Controller\Admin;

use App\Entity\Gears;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class GearsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Gears::class;
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
