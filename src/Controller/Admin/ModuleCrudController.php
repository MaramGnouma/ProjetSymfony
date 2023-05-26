<?php

namespace App\Controller\Admin;

use App\Entity\Module;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ModuleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Module::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IntegerField::new('id')->hideOnForm();
        yield TextField::new('Nom');
        yield AssociationField::new('enseignant')
            ->autocomplete()
            ->formatValue(static function ($value, $entity) {
                return $entity->getEnseignant() ? $entity->getEnseignant()->getNom() : '';
            })
            ->setCustomOption('choice_label', 'nom');
        yield AssociationField::new('filiere')
            ->autocomplete()
            ->formatValue(static function ($value, $entity) {
                return $entity->getFiliere() ? $entity->getFiliere()->getNom() : '';
            })
            ->setCustomOption('choice_label', 'nom');
        yield AssociationField::new('semestre')
            ->autocomplete()
            ->formatValue(static function ($value, $entity) {
                return $entity->getSemestre() ? $entity->getSemestre()->getNom() : '';
            })
            ->setCustomOption('choice_label', 'nom');
    }
}
