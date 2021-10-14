<?php

namespace App\Controller\Admin;

use App\Entity\QuizType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class QuizTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return QuizType::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
