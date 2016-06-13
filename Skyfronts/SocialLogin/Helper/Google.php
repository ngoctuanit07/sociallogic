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
 * SocialLogin 	Google Helper
 *
 * @category   	Skyfronts
 * @package    	Skyfronts_SocialLogin
 * @author		SkyfrontsCommerce Magento Core Team <Skyfronts_MagentoCoreTeam@cedcommerce.com>
 */
namespace Skyfronts\SocialLogin\Helper;

use Magento\Customer\Service\V1\CustomerAccountServiceInterface;

use Magento\Customer\Model\Account\Redirect as AccountRedirect;
class Google extends \Magento\Framework\App\Helper\AbstractHelper

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

     * Google client model

     *

     * @var \Skyfronts\SocialLogin\Model\Google\Oauth2\Client

     */

    protected $_client; 

	/**
		@param	\Magento\Store\Model\StoreManagerInterface $storeManager

        @param	\Magento\Customer\Model\Session $customerSession

		@param	\Magento\Framework\ObjectManagerInterface $objectManager
		
		@param  \Magento\Customer\Model\CustomerFactory $customerFactory

		@param	\Magento\Framework\HTTP\ZendClientFactory $httpClientFactory

		@param	\Skyfronts\SocialLogin\Model\Google\Oauth2\Client $client

        @param	\Magento\Framework\App\Helper\Context $context
		*/
    private $accountRedirect;
    public function __construct(

        \Magento\Store\Model\StoreManagerInterface $storeManager,
    	AccountRedirect $accountRedirect ,

        \Magento\Customer\Model\Session $customerSession,

		\Magento\Framework\ObjectManagerInterface $objectManager,
		
        \Magento\Customer\Model\CustomerFactory $customerFactory,

        \Magento\Framework\HTTP\ZendClientFactory $httpClientFactory,

        \Skyfronts\SocialLogin\Model\Google\Oauth2\Client $client,

        \Magento\Framework\App\Helper\Context $context)

    {
	

	    $this->_objectManager =  $objectManager;

        $this->_customerSession = $customerSession;
		
        $this->_customerFactory = $customerFactory;
        $this->accountRedirect = $accountRedirect;



        $this->_client = $client;

        parent::__construct($context);

    }

	/*
	*	connect existing account with Google
	* 	@param int $customerId
	*	@param string $googleId
	*	@param string $token
	*/
    public function connectByGoogleId(
		$customerId,
        $googleId,
        $token
        )

    {

		$customer = $this->_objectManager->create('Magento\Customer\Model\Customer');
		$customer->load($customerId);
		$customer->setSkyfrontsSocialloginGid($googleId);
		$customer->setSkyfrontsSocialloginGtoken($token);
		$customer->save();
        $this->_customerSession->setCustomerAsLoggedIn($customer);

    }
	/*
	*	connect new account with Google
	*	@param string $email
	*	@param string $firstname
	*	@param string $lastname
	*	@param string $googleId
	*	@param string $token
	*/
    public function connectByCreatingAccount(
        $email,
        $firstName,
        $lastName,
		$googleId,
        $token)

    {
    	$this->_customerSession->regenerateId();
		$customer = $this->_objectManager->create('Magento\Customer\Model\Customer');
        $customerDetails = array(
            'firstname' => $firstName,
            'lastname' => $lastName,
            'email' => $email,
            'sendemail' => 0,
            'confirmation' => 0,
        	'password' => $this->generatePassword(),
        	'is_active' => true,
			'skyfronts_sociallogin_gid' =>$googleId,
			'skyfronts_sociallogin_gtoken' =>$token
        );
		$customer->setData($customerDetails);
		
		$customer->save();

	 	
 		$customerData = $this->_objectManager->create('Magento\Customer\Model\Customer');
		$customerData->load($customer->getId());
		$customerData->setSkyfrontsSocialloginGid($googleId);
		$customerData->setSkyfrontsSocialloginGtoken($token);
		$customerData->save();   
	

		$this->_customerSession->setCustomerAsLoggedIn($customerData);
		
		
		
		
    }
    
    public function login($customerId){
    	$this->_customerSession->loginById($customerId);
    	$this->_customerSession->regenerateId();
    	$resultRedirect = $this->accountRedirect->getRedirect();
    	return $resultRedirect;
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
	*	get customer by google id
	*	@param int $googleId
	*
	*	return \Magento\Customer\Model\Customer $customer
	*/
    public function getCustomersByGoogleId($googleId)

    {

        $customer = $this->_customerFactory->create();

        $collection = $customer->getResourceCollection()

            ->addAttributeToSelect('*')

            ->addAttributeToFilter('skyfronts_sociallogin_gid', $googleId)

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
    
    public function generatePassword()
    {
    	return md5('qaz123456');
    }


}