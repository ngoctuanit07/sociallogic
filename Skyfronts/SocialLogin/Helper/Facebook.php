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
 * SocialLogin 	Facebook Helper
 *
 * @category   	Skyfronts
 * @package    	Skyfronts_SocialLogin
 * @author		SkyfrontsCommerce Magento Core Team <Skyfronts_MagentoCoreTeam@cedcommerce.com>
 */
namespace Skyfronts\SocialLogin\Helper;

use Magento\Customer\Service\V1\CustomerAccountServiceInterface;


class Facebook extends \Magento\Framework\App\Helper\AbstractHelper

{

	/** @var \Magento\Framework\ObjectManager */
    private $_objectManager;
   
    /**

     *

     * @var \Magento\Customer\Model\Session

     */

    protected $_customerSession;

 
	


    /**

     *

     * @var \Magento\Customer\Model\CustomerFactory

     */

    protected $_customerFactory;


  

    /**

     * Facebook client model

     *

     * @var \Skyfronts\SocialLogin\Model\Facebook\Oauth2\Client

     */

    protected $_client; 

	/**
	@param	\Magento\Store\Model\StoreManagerInterface $storeManager,

    @param	\Magento\Customer\Model\Session $customerSession,

	@param	\Magento\Framework\ObjectManagerInterface $objectManager,
		
	@param	\Magento\Customer\Model\CustomerFactory $customerFactory,

    @param	\Magento\Framework\Image\Factory $imageFactory,

    @param	\Magento\Framework\HTTP\ZendClientFactory $httpClientFactory,

    @param	\Skyfronts\SocialLogin\Model\Facebook\Oauth2\Client $client,

    @param	\Magento\Framework\App\Helper\Context $context
		*/

    public function __construct(

        \Magento\Store\Model\StoreManagerInterface $storeManager,

        \Magento\Customer\Model\Session $customerSession,

		\Magento\Framework\ObjectManagerInterface $objectManager,
		
        \Magento\Customer\Model\CustomerFactory $customerFactory,

        \Magento\Framework\HTTP\ZendClientFactory $httpClientFactory,

        \Skyfronts\SocialLogin\Model\Facebook\Oauth2\Client $client,

        \Magento\Framework\App\Helper\Context $context)

    {
	

	    $this->_objectManager =  $objectManager;

        $this->_customerSession = $customerSession;
		
        $this->_customerFactory = $customerFactory;



        $this->_client = $client;

        parent::__construct($context);

    }

	/*
	*	connect existing account with facebook
	* 	@param int $customerId
	*	@param string $facebookId
	*	@param string $token
	*/
    public function connectByFacebookId(
		$customerId,
        $facebookId,
        $token
        )

    {

		$customer = $this->_objectManager->create('Magento\Customer\Model\Customer');
		$customer->load($customerId);
		$customer->setSkyfrontsSocialloginFid($facebookId);
		$customer->setSkyfrontsSocialloginFtoken($token);
		$customer->save();
        $this->_customerSession->setCustomerAsLoggedIn($customer);

    }

	/*
	*	connect new account with facebook
	*	@param string $email
	*	@param string $firstname
	*	@param string $lastname
	*	@param string $facebookId
	*	@param string $token
	*/
    public function connectByCreatingAccount(
        $email,
        $firstName,
        $lastName,
		$facebookId,
        $token)

    {
		$customer = $this->_objectManager->create('Magento\Customer\Model\Customer');
        $customerDetails = array(
            'firstname' => $firstName,
            'lastname' => $lastName,
            'email' => $email,
            'sendemail' => 0,
            'confirmation' => 0,
			'skyfronts_sociallogin_fid' =>$facebookId,
			'skyfronts_sociallogin_ftoken' =>$token
        );
		$customer->setData($customerDetails);
		$customer->save();
		
		
		$customerData = $this->_objectManager->create('Magento\Customer\Model\Customer');
		$customerData->load($customer->getId());
		$customerData->setSkyfrontsSocialloginFid($facebookId);
		$customerData->setSkyfrontsSocialloginFtoken($token);
		$customerData->save();
		
		
		//$customer->sendNewAccountEmail('confirmed', '');
        $this->_customerSession->setCustomerAsLoggedIn($customerData);
    }
	
	/*
	*	login by customer
	*	@param \Magento\Customer\Model\Customer $customer
	*/
    public function loginByCustomer(\Magento\Customer\Model\Customer $customer)

    {

        if($customer->getConfirmation()) {

            $customer->setConfirmation(null);

            $customer->save();

        }

        $this->_customerSession->setCustomerAsLoggedIn($customer);

    }
	
	/*
	*	get customer by facebook id
	*	@param int $facebookId
	*
	*	return \Magento\Customer\Model\Customer $customer
	*/
    public function getCustomersByFacebookId($facebookId)

    {

        $customer = $this->_customerFactory->create();

        $collection = $customer->getResourceCollection()

            ->addAttributeToSelect('*')

            ->addAttributeToFilter('skyfronts_sociallogin_fid', $facebookId)

            ->setPage(1, 1);

        return $collection;

    }
	
	/*
	*	get customer by email id
	*	@param string $email
	*
	*	return \Magento\Customer\Model\Customer $customer
	*/
    public function getCustomersByEmail($email)

    {

        $customer = $this->_customerFactory->create();

        $collection = $customer->getResourceCollection()

            ->addAttributeToSelect('*')

            ->addAttributeToFilter('email', $email)

            ->setPage(1, 1);

        return $collection;

    }


}