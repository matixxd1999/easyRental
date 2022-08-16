<?php

namespace App\Controller\Admin;

use App\Entity\DictRoomsKinds;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DictRoomsKindsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DictRoomsKinds::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();
        yield TextField::new('name');
        yield AssociationField::new('rooms')
            ->setFormTypeOption('choice_label','name')
            ->setFormTypeOption('by_reference',true);
        yield AssociationField::new('accessory')
            ->setFormTypeOption('choice_label','name')
            ->setFormTypeOption('by_reference',false);
    }

}
