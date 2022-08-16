<?php

namespace App\Controller\Admin;

use App\Entity\DictCountries;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DictCountriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DictCountries::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();
        yield CountryField::new('name');
        yield AssociationField::new('estates')
            ->setFormTypeOption('choice_label','name')
            ->setFormTypeOption('by_reference',false);
    }
}
