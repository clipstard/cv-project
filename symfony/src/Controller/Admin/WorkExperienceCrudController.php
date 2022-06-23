<?php

namespace App\Controller\Admin;

use App\Entity\WorkExperience;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class WorkExperienceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return WorkExperience::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            DateField::new('startDate')->setRequired(true),
            DateField::new('endDate')->setRequired(false),
            TextField::new('post')->setRequired(true),
            TextField::new('title')->setRequired(true),
            TextEditorField::new('description')->setRequired(true),
        ];
    }

}
