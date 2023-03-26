<?php

namespace App\Controller\Admin;

use App\Entity\Vehicle;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VehicleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vehicle::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name', 'Name');
        yield AssociationField::new('nation', 'Nation')
            ->setCrudController(NationCrudController::class);
        yield IntegerField::new('level', 'Level');
    }

}
