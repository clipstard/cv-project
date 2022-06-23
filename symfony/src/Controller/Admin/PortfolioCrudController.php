<?php

namespace App\Controller\Admin;

use App\Entity\Portfolio;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PortfolioCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Portfolio::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextEditorField::new('introduction'),
            TextField::new('lastName'),
            TextField::new('firstName'),
            CollectionField::new('educations')->useEntryCrudForm(EducationCrudController::class)->hideOnIndex(),
            CollectionField::new('workExperiences')->useEntryCrudForm(WorkExperienceCrudController::class)->hideOnIndex(),
            CollectionField::new('_references')->useEntryCrudForm(ReferenceCrudController::class)->hideOnIndex(),
            ...parent::configureFields($pageName),
            ImageField::new('image')
                ->setBasePath('/images')
                ->setUploadDir('public/images'),
        ];
    }
}
