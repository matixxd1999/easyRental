<?php

namespace App\Controller\Admin;

use App\Entity\DictPeriodsNumberKinds;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DictPeriodsNumberKindsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DictPeriodsNumberKinds::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();
        yield TextField::new('name');
        yield IntegerField::new('limitMax');
        yield AssociationField::new('dictPeriods')
            ->setFormTypeOption('choice_label','name')
            ->setFormTypeOption('by_reference',true);
    }

}
