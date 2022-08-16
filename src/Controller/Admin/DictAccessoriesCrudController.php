<?php

namespace App\Controller\Admin;

use App\Entity\DictAccessories;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DictAccessoriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DictAccessories::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();
        yield TextField::new('name');
        yield AssociationField::new('rooms')
            ->setFormTypeOption('choice_label','name')
            ->setFormTypeOption('by_reference',false);
        yield AssociationField::new('dictRoomsKinds')
            ->setFormTypeOption('choice_label','name')
            ->setFormTypeOption('by_reference',false);
    }

}
