<?php
namespace App\Controller\Admin;

use App\Entity\Note;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class NoteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Note::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IntegerField::new('id')->hideOnForm();
        yield Field::new('note', 'Float');
        yield TextEditorField::new('observation');
        yield AssociationField::new('etudiant')
            ->autocomplete()
            ->formatValue(static function ($value, $entity) {
                return $entity->getEtudiant() ? $entity->getEtudiant()->getNom() : '';
            })
            ->setCustomOption('choice_label', 'nom');
        yield AssociationField::new('module')
            ->autocomplete()
            ->formatValue(static function ($value, $entity) {
                return $entity->getModule() ? $entity->getModule()->getNom() : '';
            })
            ->setCustomOption('choice_label', 'nom');
    }
}
