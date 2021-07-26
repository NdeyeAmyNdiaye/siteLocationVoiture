<?php

namespace App\Controller\Admin;

use App\Entity\Cars;
use App\Form\BrandsType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CarsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cars::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $imageField = ImageField::new('imageFile')
        // ->setFormType(VichImageType::class)
        ->setBasePath("build/upload/images/voitures")
        ->setLabel('Image');

         $image = ImageField::new('image')
         ->setBasePath("build/upload/images/voitures")
         ->setLabel('Image');

        $fields= [
            TextField::new('plate', 'Numero immatriculation'),
            MoneyField::new('price', 'prix par jour')->setCurrency('EUR'),
            AssociationField::new('brand', 'Marque'),
            AssociationField::new('model', 'Modéle'),
            AssociationField::new('engine', 'Motorisation'),
            AssociationField::new('gear', 'Boite de vitesse'),
            AssociationField::new('seat','Nombre de place'), 
            AssociationField::new('carFleet','Statut'), 
            TextField::new('image', 'Nom de l\'image'),
            BooleanField::new('availability', 'Disponibilité')
        ];
            if ($pageName === Crud::PAGE_INDEX || $pageName === Crud::PAGE_DETAIL) {
                $fields[] = $image;
            } else {
                $fields[] = $imageField;
            }
        return $fields;
    }
    
}
