<?php

namespace App\Controller\Admin;

use App\Entity\Estates;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class EstatesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Estates::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();
        yield TextField::new('name');
        yield TextField::new('postcode');
        yield TextField::new('city');
        yield TextField::new('street');
        yield TextField::new('number');
        yield TextareaField::new('description');
        yield TimeField::new('checkIn')->setFormat('kk:mm');
        yield TimeField::new('checkOut')->setFormat('kk:mm');
        yield AssociationField::new('admins')
            ->setFormTypeOption('choice_label','email')
            ->setFormTypeOption('by_reference',true);
        yield AssociationField::new('country')
            ->setFormTypeOption('choice_label','name')
            ->setFormTypeOption('by_reference',true);



    }

}
