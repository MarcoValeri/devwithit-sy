<?php

namespace App\Controller\Admin;

use App\Entity\Guide;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GuideCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Guide::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),
            TextField::new('title'),
            TextField::new('description'),
            TextField::new('url'),
            DateTimeField::new('created'),
            DateTimeField::new('updated'),
            AssociationField::new('image')
                ->setFormTypeOptions([
                    'by_reference' => true,
                ]),
            CodeEditorField::new('content')
        ];
    }
}
