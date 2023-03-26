<?php

namespace App\Controller\Admin;

use App\Entity\Nation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class NationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Nation::class;
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
