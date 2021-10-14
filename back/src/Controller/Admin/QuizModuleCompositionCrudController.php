<?php

namespace App\Controller\Admin;

use App\Entity\QuizModuleComposition;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class QuizModuleCompositionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return QuizModuleComposition::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addRow(),
            IdField::new('id')->hideOnForm(),
            IdField::new('nbQuestion')->setColumns('col-4'),
            AssociationField::new('quizType')->setColumns('col-4')->autocomplete(),
            AssociationField::new('module')->setColumns('col-4')->autocomplete(),
        ];
    }

}
