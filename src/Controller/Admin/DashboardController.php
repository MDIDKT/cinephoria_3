<?php

namespace App\Controller\Admin;

use App\Entity\Cinema;
use App\Entity\Commande;
use App\Entity\Film;
use App\Entity\Place;
use App\Entity\Qualite;
use App\Entity\Reservation;
use App\Entity\Salle;
use App\Entity\Seance;
use App\Entity\User;
use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('Dashboard/dashboard.html.twig');

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
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('CINEPHORIA');
    }

    Public function configureCrud (): Crud
    {
        return parent::configureCrud ()
        ->showEntityActionsInlined ();
    }


    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');
        yield MenuItem::linkToCrud('Users', 'fa-solid fa-user', User::class);
        yield MenuItem::linkToCrud('Films', 'fa-duotone fa-solid fa-film', Film::class);
        yield MenuItem::linkToCrud('Cinémas', 'fas fa-list', Cinema::class);
        yield MenuItem::linkToCrud('Commandes', 'fas fa-list', Commande::class);
        yield MenuItem::linkToCrud('Places', 'fas fa-list', Place::class);
        yield MenuItem::linkToCrud('Qualités', 'fas fa-list', Qualite::class);
        yield MenuItem::linkToCrud('Réservations', 'fas fa-list', Reservation::class);
        yield MenuItem::linkToCrud('Salles', 'fas fa-list', Salle::class);
        yield MenuItem::linkToCrud('Séances', 'fas fa-list', Seance::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fa-regular fa-user', Utilisateur::class);
    }
}
