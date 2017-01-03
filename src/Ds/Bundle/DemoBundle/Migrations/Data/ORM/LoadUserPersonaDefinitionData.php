<?php

namespace Ds\Bundle\DemoBundle\Migrations\Data\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Ds\Bundle\UserPersonaBundle\Migration\Extension\DefinitionExtensionAwareInterface;
use Ds\Bundle\UserPersonaBundle\Migration\Extension\DefinitionExtensionAwareTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadUserPersonaDefinitionData
 */
class LoadUserPersonaDefinitionData extends AbstractFixture implements DependentFixtureInterface, DefinitionExtensionAwareInterface, ContainerAwareInterface
{
    use DefinitionExtensionAwareTrait;
    use ContainerAwareTrait;

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            'Oro\Bundle\OrganizationBundle\Migrations\Data\ORM\LoadOrganizationAndBusinessUnitData'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $objectManager)
    {
        // @todo Remove once auto injection via DefinitionExtensionAwareInterface gets added.
        $this->setDefinitionExtension($this->container->get('ds.userpersona.migration.extension.definition'));
        //

        $resource = __DIR__.'/../../../Resources/data/user_persona_definitions.yml';
        $this->definitionExtension->import($resource, $objectManager);
    }
}
