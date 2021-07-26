<?php

namespace App\Controller\Admin;
 use App\Entity\User;
 use App\Entity\Brands;
 use App\Entity\CarFleet;
 use App\Entity\Model;
 use App\Entity\Engines;
 use App\Entity\Gears;
 use App\Entity\Seats;
 use App\Entity\Rent;
 use App\Entity\Cars;
 use App\Repository\CarsRepository ;
 use App\Repository\RentRepository;
 use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
 use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
 use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
/**
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    /**
     * @var CarsRepository
     */
    protected CarsRepository $carsRepository;

    /**
     * @var RentRepository
     */
    protected RentRepository $rentRepository;

    public function __construct (
        UserRepository $userRepository,
        CarsRepository $carsRepository,
        RentRepository $rentRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->carsRepository = $carsRepository;
        $this->rentRepository = $rentRepository;
    } 

    /** 
     * @Route("/admin", name="admin")
     */

    public function index(): Response
    {
            return $this->render('bundles/EasyAdminBundle/welcome.html.twig',[
                'countUser' => $this->userRepository->countAllUser(),
                'countCars' => $this->carsRepository->countAllCars(),
                'CarsList' => $this->carsRepository->findAll(),
            ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Loca-auto')
            ->setFaviconPath('assets/front/img/favicon.png')
            ->setTextDirection('ltr');

    }
    public function configureAssets(): Assets
    {
        return Assets::new()
            ->addCssFile('bundles/easyadmin/css/style.css');

    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->setName($user->getUsername())
            ->displayUserName(true)
            ->setAvatarUrl('https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_1280.png')
            //->setAvatarUrl($user->getProfileImageUrl())
            ->displayUserAvatar(true)
            //->setGravatarEmail($user->getUsername())

            ->addMenuItems([
                //MenuItem::linkToLogout('Logout', 'fa fa-sign-out'),
            ]);
    }
    

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Tableau de bord', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::section('Utilisateurs');
        yield MenuItem::linkToCrud('Liste', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Ajout', 'fas fa-user-plus', User::class)->setAction('new');
        yield MenuItem::section('Les voitures du parc ');
        yield MenuItem::linkToCrud('Liste', 'fas fa-car', Cars::class);
        yield MenuItem::linkToCrud('Ajout', 'fas fa-plus', Cars::class)->setAction('new');
        yield MenuItem::section('Les marques');
        yield MenuItem::linkToCrud('Liste', 'fas fa-car', Brands::class);
        yield MenuItem::linkToCrud('Ajout', 'fas fa-plus', Brands::class)->setAction('new');
        yield MenuItem::section('Les Modeles');
        yield MenuItem::linkToCrud('Liste', 'fas fa-car', Model::class);
        yield MenuItem::linkToCrud('Ajout', 'fas fa-plus', Model::class)->setAction('new');
        yield MenuItem::section('Les motorisations');
        yield MenuItem::linkToCrud('Liste', 'fas fa-car', Engines::class);
        yield MenuItem::linkToCrud('Ajout', 'fas fa-plus', Engines::class)->setAction('new');
        yield MenuItem::section('Les places possibles');
        yield MenuItem::linkToCrud('Liste', 'fas fa-car', Seats::class);
        yield MenuItem::linkToCrud('Ajout', 'fas fa-plus', Seats::class)->setAction('new');
        yield MenuItem::section('Les boites de vitesse');
        yield MenuItem::linkToCrud('Liste', 'fas fa-car', Gears::class);
        yield MenuItem::linkToCrud('Ajout', 'fas fa-plus', Gears::class)->setAction('new');
        yield MenuItem::section('Statuts du parc ');
        yield MenuItem::linkToCrud('Liste', 'fas fa-car', CarFleet::class);
        yield MenuItem::linkToCrud('Ajout', 'fas fa-plus', CarFleet::class)->setAction('new');
     }
}
