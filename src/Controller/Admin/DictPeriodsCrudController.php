<?php

namespace App\Controller\Admin;

use App\Entity\DictPeriods;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DictPeriodsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DictPeriods::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();
        yield TextField::new('name');
        yield IntegerField::new('number');
        yield AssociationField::new('billings')
            ->setFormTypeOption('choice_label','price')
            ->setFormTypeOption('by_reference',true);
        yield AssociationField::new('numberKind')
            ->setFormTypeOption('choice_label','name')
            ->setFormTypeOption('by_reference',false);
    }

}
