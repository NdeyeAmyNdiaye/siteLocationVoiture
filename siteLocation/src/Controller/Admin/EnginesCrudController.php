<?php

namespace App\Controller\Admin;

use App\Entity\Engines;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EnginesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Engines::class;
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
