<?php

namespace App\Controller\Admin;

use App\Entity\Rooms;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RoomsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Rooms::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();
        yield TextField::new('name');
        yield TextareaField::new('description');
        yield AssociationField::new('roomsKind')
            ->setFormTypeOption('choice_label','name')
            ->setFormTypeOption('by_reference',false);
        yield AssociationField::new('accessory')
            ->setFormTypeOption('choice_label','name')
            ->setFormTypeOption('by_reference',false);
        yield AssociationField::new('image')
            ->setFormTypeOption('choice_label','path')
            ->setFormTypeOption('by_reference',true);

    }

}
