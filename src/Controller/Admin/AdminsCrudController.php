<?php

namespace App\Controller\Admin;

use App\Entity\Admins;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AdminsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Admins::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
        ->onlyOnIndex();
        yield TextField::new('email');
        $roles = ['ROLE_ADMIN', 'ROLE_USER'];
        yield ChoiceField::new('roles')
            ->setChoices(array_combine($roles, $roles))
            ->allowMultipleChoices()
            ->renderExpanded();
        yield TextField::new('password')
        ->hideOnForm()
        ->hideOnIndex();
        yield IntegerField::new('phone_number');
        yield TextField::new('first_name');
        yield TextField::new('last_name');
        yield DateTimeField::new('date_create')
        ->setFormat('dd-MM-yyyy | kk:mm');
        yield DateTimeField::new('date_update')
            ->setFormat('dd-MM-yyyy | kk:mm');
        yield DateField::new('date_expire')
            ->setFormat('dd-MM-yyyy');
        yield AssociationField::new('estate')
        ->setFormTypeOption('choice_label','name')
        ->setFormTypeOption('by_reference',false);
        yield AssociationField::new('users')
            ->setFormTypeOption('choice_label','email')
            ->setFormTypeOption('by_reference',false);
//        $this->createIndexQueryBuilder();
    }
}
