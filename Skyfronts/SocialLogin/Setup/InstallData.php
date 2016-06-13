<?php
/**
 * SkyfrontsCommerce
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
  * http://opensource.org/licenses/osl-3.0.php
 *
 * @category    Skyfronts
 * @package     Skyfronts_SocialLogin
 * @author 		SkyfrontsCommerce Magento Core Team <Skyfronts_MagentoCoreTeam@skyfrontscommerce.com>
 * @copyright   Copyright SkyfrontsCommerce (http://skyfrontscommerce.com/)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * SocialLogin 	installer
 *
 * @category   	Skyfronts
 * @package    	Skyfronts_SocialLogin
 * @author		SkyfrontsCommerce Magento Core Team <Skyfronts_MagentoCoreTeam@skyfrontscommerce.com>
 */

namespace Skyfronts\SocialLogin\Setup;

 

use Magento\Eav\Setup\EavSetup;

use Magento\Eav\Setup\EavSetupFactory;

use Magento\Framework\Setup\InstallDataInterface;

use Magento\Framework\Setup\ModuleContextInterface;

use Magento\Framework\Setup\ModuleDataSetupInterface;

 

/**

 * @codeCoverageIgnore

 */

class InstallData implements InstallDataInterface

{

    /**

     * EAV setup factory

     *

     * @var EavSetupFactory

     */

    private $eavSetupFactory;

 

    /**

     * Init

     *

     * @param EavSetupFactory $eavSetupFactory

     */

    public function __construct(EavSetupFactory $eavSetupFactory)

    {

        $this->eavSetupFactory = $eavSetupFactory;

    }

 

    /**

     * {@inheritdoc}

     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)

     */

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)

    {

        /** @var EavSetup $eavSetup */

        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

 

        /**

         * Add attributes to the eav/attribute

         */



		 $eavSetup->addAttribute(

            \Magento\Customer\Model\Customer::ENTITY,

            'skyfronts_sociallogin_gid'

            , array(

					'type' => 'text',

					'visible' => false,

					'required' => false,

					'user_defined' => false,

					'label' => 'skyfronts Google id',

					'system' => false   // Must be non system, else customer service can not update it

				)

        );

		$eavSetup->addAttribute(

            \Magento\Customer\Model\Customer::ENTITY,

            'skyfronts_sociallogin_gtoken' ,

			 array(

					'type' => 'text',

					'visible' => false,

					'required' => false,

					'user_defined' => false,

					'label' => 'skyfronts Google token',

					'system' => false   // Must be non system, else customer service can not update it

				)

        );

		

		

		$eavSetup->addAttribute(

            \Magento\Customer\Model\Customer::ENTITY,

           'skyfronts_sociallogin_fid' ,

		    array(

					'type' => 'text',

					'visible' => false,

					'required' => false,

					'user_defined' => false,

					'label' => 'skyfronts Facebook id',

					'system' => false   // Must be non system, else customer service can not update it

				)

        );

		$eavSetup->addAttribute(

            \Magento\Customer\Model\Customer::ENTITY,

           'skyfronts_sociallogin_ftoken' ,

		    array(

					'type' => 'text',

					'visible' => false,

					'required' => false,

					'user_defined' => false,

					'label' => 'skyfronts Facebook token',

					'system' => false   // Must be non system, else customer service can not update it

				)

        );

		$eavSetup->addAttribute(

            \Magento\Customer\Model\Customer::ENTITY,

            'skyfronts_sociallogin_tid' ,

			 array(

					'type' => 'text',

					'visible' => false,

					'required' => false,

					'user_defined' => false,

					'label' => 'skyfronts Twitter id',

					'system' => false   // Must be non system, else customer service can not update it

				)

        );

		$eavSetup->addAttribute(

            \Magento\Customer\Model\Customer::ENTITY,

            'skyfronts_sociallogin_ttoken' ,

			 array(

					'type' => 'text',

					'visible' => false,

					'required' => false,

					'user_defined' => false,

					'label' => 'skyfronts Twitter token',

					'system' => false   // Must be non system, else customer service can not update it

				)

        );

		$eavSetup->addAttribute(

            \Magento\Customer\Model\Customer::ENTITY,

            'skyfronts_sociallogin_lid' ,

			 array(

					'type' => 'text',

					'visible' => false,

					'required' => false,

					'user_defined' => false,

					'label' => 'skyfronts Linkedin id',

					'system' => false   // Must be non system, else customer service can not update it

				)

        );

		$eavSetup->addAttribute(

            \Magento\Customer\Model\Customer::ENTITY,

            'skyfronts_sociallogin_ltoken' ,

			 array(

					'type' => 'text',

					'visible' => false,

					'required' => false,

					'user_defined' => false,

					'label' => 'skyfronts Linkedin token',

					'system' => false   // Must be non system, else customer service can not update it

				)

        );

		

		

		

	

	



    }

}

