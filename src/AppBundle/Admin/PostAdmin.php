<?php
namespace AppBundle\Admin;

use AppBundle\Entity\Post;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class PostAdmin
 * @package AppBundle\Admin
 */
class PostAdmin extends AbstractAdmin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with(
                'Content',
                [
                    'class' => 'col-md-9'
                ]
            )
            ->add('title', 'text')
            ->add('content', 'textarea')
            ->end()
            ->with(
                'Category',
                [
                    'class' => 'col-md-3'
                ]
            )
            ->add(
                'category',
                'entity',
                [
                    'class' => 'AppBundle\Entity\Category',
                    'choice_label' => 'name',
                ]
            )
            ->end();
    }

    /**
     * @param DatagridMapper $dataGridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $dataGridMapper)
    {
        $dataGridMapper
            ->add('title')
            ->add('category', null, array(), 'entity', array(
                'class' => 'AppBundle\Entity\Category',
                'choice_label' => 'name',
            ));
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('category.name');
    }

    /**
     * @param Post $post
     * @return string
     */
    public function toString($post)
    {
        return $post->getTitle();
    }
}
