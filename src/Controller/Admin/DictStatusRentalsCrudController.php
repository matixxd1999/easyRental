<?php

namespace App\Controller\Admin;

use App\Entity\DictStatusRentals;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DictStatusRentalsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DictStatusRentals::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();
        yield TextField::new('name');
        yield AssociationField::new('rentals')
            ->setFormTypeOption('choice_label','discount')
            ->setFormTypeOption('by_reference',true);
    }

}
