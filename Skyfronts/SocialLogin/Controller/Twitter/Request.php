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
 * @author 		SkyfrontsCommerce Magento Core Team <Skyfronts_MagentoCoreTeam@cedcommerce.com>
 * @copyright   Copyright SkyfrontsCommerce (http://cedcommerce.com/)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * SocialLogin 	Twitter controller
 *
 * @category   	Skyfronts
 * @package    	Skyfronts_SocialLogin
 * @author		SkyfrontsCommerce Magento Core Team <Skyfronts_MagentoCoreTeam@cedcommerce.com>
 */
namespace Skyfronts\SocialLogin\Controller\Twitter;

 

use Magento\Framework\App\Action\NotFoundException;

use Magento\Framework\App\RequestInterface;

 

class Request extends \Magento\Framework\App\Action\Action

{
	/**
	* @var \Magento\Framework\ObjectManagerInterface 
	*/
	protected $_objectManager;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
   		\Magento\Framework\ObjectManagerInterface $objectManager
    ) {

       	 $this->_objectManager =  $objectManager;
        parent::__construct($context);

    }

 

	/*
	*	execute the code
	*/
    public function execute()

    {
		$client = $this->_objectManager->create('Skyfronts\SocialLogin\Model\Twitter\Oauth2\Client');

       /* if(!($client->isEnabled())) {
            Mage::helper('sociallogin')->redirect404($this);
        }*/

        $client->fetchRequestToken();

    }

}

?>