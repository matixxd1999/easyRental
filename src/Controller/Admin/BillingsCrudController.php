<?php

namespace App\Controller\Admin;

use App\Entity\Billings;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class BillingsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Billings::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();
        yield NumberField::new('price');
        yield AssociationField::new('apartments')
            ->setFormTypeOption('choice_label','name')
            ->setFormTypeOption('by_reference',true);
        yield AssociationField::new('period')
            ->setFormTypeOption('choice_label','name')
            ->setFormTypeOption('by_reference',false);
    }

}
