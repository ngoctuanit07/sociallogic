<?php
namespace SKyfronts\SocialLogin\Model;

use Skyfronts\SocialLogin\Helper\Data as helper;
use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Store\Model\ScopeInterface;
//use Magento\Framework\View\Element\AbstractBlock as block;


class SocialConfigProvider implements ConfigProviderInterface
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfiguration;
	protected $_helper;
	protected $_block;
	protected $_clientFacebook;
	protected $_clientGoogle;
	protected $_clientTwitter;
	protected $_googleFacebook;
	protected $_twitterFacebook;
	protected $_customerSession;
    /**
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfiguration
     * @codeCoverageIgnore
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfiguration,
    		helper  $helper,
    		\Magento\Customer\Model\Session $customerSession,
    		\Skyfronts\SocialLogin\Model\Facebook\Oauth2\Client $clientFacebook,
    		\Skyfronts\SocialLogin\Model\Google\Oauth2\Client $clientGoogle,
    		\Skyfronts\SocialLogin\Model\Twitter\Oauth2\Client $clientTwitter
    	//\Magento\Framework\View\Asset\File $block
    ) {
        $this->scopeConfiguration = $scopeConfiguration;
        //$this->_block = $block ;
        $this->_customerSession = $customerSession;
        $this->_helper = $helper;
        $this->_clientFacebook = $clientFacebook;
        $this->_clientGoogle = $clientGoogle;
        $this->_clientTwitter = $clientTwitter;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
    	$this->_customerSession->setFacebookCsrf('checkout');
    	$this->_customerSession->setGooglePage('checkout');
    	$this->_customerSession->setTwitterPage('checkout');
    	 
    	
    	 
    	$this->_clientFacebook->setState('checkout');
    	
    	$this->_clientGoogle->setState('checkout');
    	
    	$this->_clientTwitter->setState('checkout');
    	
        $showHide = [];
        //$showHide['show_hide_custom_block'] = ($enabled)?true:false;
        	$showHide['facebook'] = $this->_helper->getFacebookImg();//$this->_block->getViewFileUrl('Skyfronts_SocialLogin::css/facebook/images/social_connect_fb.png');
        
        /* if( $golEnabled){ */
        	$showHide['google'] = $this->_helper->getGoogleImg();
        /* } */
        /* if( $twtEnabled){ */
        	$showHide['twitter'] = $this->_helper->getTwitterImg();
        /* } */
        
         $showHide['facebook_config'] = $this->_clientFacebook->isEnabled();
        $showHide['google_config'] = $this->_clientGoogle->isEnabled();
        $showHide['twitter_config'] = $this->_clientTwitter->isEnabled();
         $showHide['facebook_link'] = $this->_clientFacebook->createAuthUrl(); 
        	$showHide['google_link'] = $this->_clientGoogle->createAuthUrl();
        	$showHide['twitter_link'] = $this->_clientTwitter->createAuthUrl();
        return $showHide;
    }
}