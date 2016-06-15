<?php
namespace AppBundle\Admin;

use AppBundle\Entity\Post;
use AppBundle\Entity\Security\User;
use Doctrine\ORM\QueryBuilder;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;

/**
 * Class PostAdmin
 * @package AppBundle\Admin
 */
class PostAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'sonata_post';

    public function __construct($code, $class, $baseControllerName)
    {
        parent::__construct($code, $class, $baseControllerName);
        $this->pagerType = 'Blog';
    }

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
            ->add(
                'content',
                'sonata_simple_formatter_type',
                [
                    'format' => 'richhtml'
                ]
            )
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
            ->add('image', 'comur_image', [
                'required' => false,
                'uploadConfig' => [
                    'uploadUrl' => Post::UPLOAD_ROOT_DIR,
                    'webDir' => Post::UPLOAD_DIR,
                    'fileExt' => '*.jpg;*.gif;*.png;*.jpeg',
                ],
                'cropConfig' => [
                    'minWidth' => 588,
                    'minHeight' => 300,
                    'aspectRatio' => false,
                    'cropRoute' => 'comur_api_crop',
                    'forceResize' => true,
                    'thumbs' => [
                        [
                            'maxWidth' => 200,
                            'maxHeight' => 200,
                            'useAsFieldImage' => true
                        ]
                    ]
                ]
            ])
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

    public function isGranted($name, $object = null)
    {
        $isGranted = parent::isGranted($name, $object);

        if (!$isGranted) {
            return $isGranted;
        }

        if (parent::isGranted('ROLE_ADMIN') || is_null($object) || $name == 'CREATE') {
            return $isGranted;
        }

        if ($object instanceof Post && $this->getCurrentUser() != $object->getCreatedBy()) {
            return false;
        }

        return $isGranted;
    }

    /**
     * @return User
     */
    private function getCurrentUser()
    {
        return $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();
    }

    /**
     * @param Post $object
     */
    public function prePersist($object)
    {
        parent::prePersist($object);
        $object->setCreatedBy($this->getCurrentUser());
    }

    public function createQuery($context = 'list')
    {
        /** @var ProxyQuery $query */
        $query = parent::createQuery($context);

        if (!$this->isGranted('ROLE_ADMIN')) {
            /** @var QueryBuilder $queryBuilder */
            $queryBuilder = $query->getQueryBuilder();
            $alias = $queryBuilder->getRootAliases();
            $queryBuilder->andWhere(
                $queryBuilder->expr()->eq(
                    $alias['0'] . '.createdBy',
                    ':user'
                )
            )
                ->setParameter('user', $this->getCurrentUser());
        }

        return $query;
    }
}
