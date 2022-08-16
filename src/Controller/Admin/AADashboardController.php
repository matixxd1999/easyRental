<?php

namespace App\Controller\Admin;

use App\Entity\Admins;
use App\Entity\Apartments;
use App\Entity\Billings;
use App\Entity\DictAccessories;
use App\Entity\DictCountries;
use App\Entity\DictPeriods;
use App\Entity\DictPeriodsNumberKinds;
use App\Entity\DictRoomsKinds;
use App\Entity\DictStatusRentals;
use App\Entity\Estates;
use App\Entity\Images;
use App\Entity\Rentals;
use App\Entity\Rooms;
use App\Entity\Tokens;
use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AADashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
//        return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
//         return $this->render('@EasyAdmin/page/content.html.twig');
         return $this->render('dashboard/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('EasyRentalAplication');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Admins', 'fas fa-list', Admins::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-list', Users::class);
        yield MenuItem::linkToCrud('Estates', 'fas fa-list', Estates::class);
        yield MenuItem::linkToCrud('Apartments', 'fas fa-list', Apartments::class);
        yield MenuItem::linkToCrud('Rooms', 'fas fa-list', Rooms::class);
        yield MenuItem::linkToCrud('Rentals', 'fas fa-list', Rentals::class);
        yield MenuItem::linkToCrud('Billings', 'fas fa-list', Billings::class);
        yield MenuItem::linkToCrud('Images', 'fas fa-list', Images::class);
        yield MenuItem::linkToCrud('DictCountries', 'fas fa-list', DictCountries::class);
        yield MenuItem::linkToCrud('DictRoomsKinds', 'fas fa-list', DictRoomsKinds::class);
        yield MenuItem::linkToCrud('DictAccessories', 'fas fa-list', DictAccessories::class);
        yield MenuItem::linkToCrud('DictPeriods', 'fas fa-list', DictPeriods::class);
        yield MenuItem::linkToCrud('DictStatusRentals', 'fas fa-list', DictStatusRentals::class);
        yield MenuItem::linkToCrud('DictPeriodsNumberKinds', 'fas fa-list', DictPeriodsNumberKinds::class);
        yield MenuItem::linkToCrud('Tokens', 'fas fa-list', Tokens::class);
        yield MenuItem::linkToRoute('Strona Główna','fa-solid fa-right-from-bracket','app_index_user_page');
    }
}
