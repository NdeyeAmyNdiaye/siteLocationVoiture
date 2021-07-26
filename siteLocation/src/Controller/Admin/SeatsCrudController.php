<?php

namespace App\Controller\Admin;

use App\Entity\Seats;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SeatsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Seats::class;
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
