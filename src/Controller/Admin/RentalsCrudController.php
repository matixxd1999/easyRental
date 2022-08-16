<?php

namespace App\Controller\Admin;

use App\Entity\Rentals;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class RentalsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Rentals::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();
        yield NumberField::new('discount');
        yield DateField::new('dateFrom')
            ->setFormat('dd-MM-yyyy');
        yield DateField::new('dateTo')
            ->setFormat('dd-MM-yyyy');
        yield AssociationField::new('user')
            ->setFormTypeOption('choice_label','email')
            ->setFormTypeOption('by_reference',false);
        yield AssociationField::new('apartment')
            ->setFormTypeOption('choice_label','name')
            ->setFormTypeOption('by_reference',false);
        yield AssociationField::new('statusy')
            ->setFormTypeOption('choice_label','name')
            ->setFormTypeOption('by_reference',false);
    }

}
