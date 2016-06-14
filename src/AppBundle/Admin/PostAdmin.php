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
            ->end()
            ->with(
                'Image',
                [
                    'class' => 'col-md-3'
                ]
            )
            ->add('image', 'comur_image', array(
                'uploadConfig' => array(
                    'uploadUrl' => Post::UPLOAD_ROOT_DIR,
                    'webDir' => Post::UPLOAD_DIR,
                    'fileExt' => '*.jpg;*.gif;*.png;*.jpeg',
                ),
                'cropConfig' => array(
                    'minWidth' => 588,
                    'minHeight' => 300,
                    'aspectRatio' => false,
                    'cropRoute' => 'comur_api_crop',
                    'forceResize' => true,
                    'thumbs' => array(
                        array(
                            'maxWidth' => 200,
                            'maxHeight' => 200,
                            'useAsFieldImage' => true
                        )
                    )
                )
            ))
            ->end()
        ;

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
