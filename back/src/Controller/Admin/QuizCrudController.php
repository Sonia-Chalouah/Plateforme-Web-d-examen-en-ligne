<?php

namespace App\Controller\Admin;

use App\Entity\Quiz;
use App\Form\ImageType;
use App\Form\QuestionType;
use App\Form\QuizQuestionType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class QuizCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Quiz::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name')->setColumns('col-6'),
            AssociationField::new('quizType')->autocomplete()->setColumns('col-6')->autocomplete(),
            FormField::addRow(),
            CollectionField::new('questions')
                ->setEntryType(QuestionType::class)
                ->allowAdd()
                ->allowDelete()
                ->setRequired(true)
                ->setFormTypeOption('by_reference',false)
                ->setColumns('col-12')
        ];
    }

    public  function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {

        parent::persistEntity($entityManager, $entityInstance);
    }
}
