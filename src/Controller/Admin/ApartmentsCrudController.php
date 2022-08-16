<?php

namespace App\Controller\Admin;

use App\Entity\Apartments;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ApartmentsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Apartments::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();
        yield TextField::new('name');
        yield TextField::new('number');
        yield TextareaField::new('description');
        yield AssociationField::new('billing')
            ->setFormTypeOption('choice_label','price')
            ->setFormTypeOption('by_reference',false);
        yield AssociationField::new('rentals')
            ->setFormTypeOption('choice_label','discount')
            ->setFormTypeOption('by_reference',true);
    }
}
