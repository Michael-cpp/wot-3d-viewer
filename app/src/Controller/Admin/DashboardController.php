<?php

namespace App\Controller\Admin;

use App\Entity\Nation;
use App\Entity\User;
use App\Entity\Vehicle;
use App\Service\AdminService;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractDashboardController
{
    private $adminService;

    public function __construct( AdminService $adminService )
    {
        $this->adminService = $adminService;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Admin panel');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Nations', 'fa fa-tags', Nation::class);
        yield MenuItem::linkToCrud('Users', 'fa fa-tags',  User::class);
        yield MenuItem::linkToCrud('Vehicles', 'fa fa-tags',  Vehicle::class);
    }

    #[Route('/admin/import', name: 'admin_import')]
    public function import()
    {
        $this->adminService->import();
        return $this->redirectToRoute('admin');
    }

}
