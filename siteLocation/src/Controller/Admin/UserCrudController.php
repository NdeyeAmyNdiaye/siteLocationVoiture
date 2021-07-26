<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\HttpFoundation\Request;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }
    
    public function statistic(Request $request, UserRepository $userRepository) {
        $id = $request->query->get('id');
        $user = $userRepository->find($id);

        $counterView = [];
        $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi'];

        foreach ($days as $day) {
            array_push($counterView, random_int(1, 10));
        }

        return $this->render('bundles/EasyAdminBundle/statistics_user.html.twig', [
            'user' => $user,
            'crudAction' => 'index',
            'counterView' => $counterView,
            'dataName' => $days
        ]);
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
