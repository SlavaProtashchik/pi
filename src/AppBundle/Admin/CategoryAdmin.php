<?php
namespace AppBundle\Admin;

use AppBundle\Entity\Category;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class PostAdmin
 * @package AppBundle\Admin
 */
class CategoryAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text');
    }

    protected function configureDatagridFilters(DatagridMapper $dataGridMapper)
    {
        $dataGridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
    }

    /**
     * @param Category $post
     * @return string mixed
     */
    public function toString($post)
    {
        return $post->getName();
    }
}
