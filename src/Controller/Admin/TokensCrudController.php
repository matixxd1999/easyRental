<?php

namespace App\Controller\Admin;

use App\Entity\Tokens;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TokensCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tokens::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();
        yield IntegerField::new('code');
        yield BooleanField::new('activeAccount');
        yield DateTimeField::new('dataExpire');
    }

}
