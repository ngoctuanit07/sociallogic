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
 * SocialLogin 	Data Helper
 *
 * @category   	Skyfronts
 * @package    	Skyfronts_SocialLogin
 * @author		SkyfrontsCommerce Magento Core Team <Skyfronts_MagentoCoreTeam@cedcommerce.com>
 */
namespace Skyfronts\SocialLogin\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper

{

    /**

     * @var \Magento\Framework\App\State

     */

    protected $_appState;
    protected $_assetRepo;

    /**

     * @param \Magento\Framework\App\Helper\Context $context

     * @param \Magento\Framework\App\State $appState

     */

    public function __construct(

        \Magento\Framework\App\Helper\Context $context,
    		\Magento\Framework\View\Asset\Repository $assetRepo,

        \Magento\Framework\App\State $appState)

    {
    	$this->_assetRepo = $assetRepo;
        $this->_appState = $appState;

        parent::__construct($context);

    }

    public function log1($message, $level = \Zend_Log::DEBUG, $loggerKey = \Magento\Framework\Logger::LOGGER_SYSTEM)

    {

        if($this->_appState->getMode() == \Magento\Framework\App\State::MODE_DEVELOPER) {

            $this->_logger->log($message, $level, $loggerKey);

        }

    }
    
    public function getFacebookImg(){
    	return $this->_assetRepo->getUrl('Skyfronts_SocialLogin::css/facebook/images/social_connect_fb.png');
    }
    
    public function getGoogleImg(){
    	return $this->_assetRepo->getUrl('Skyfronts_SocialLogin::css/google/images/social_connect_go.png');
    }
    
    public function getTwitterImg(){
    	return $this->_assetRepo->getUrl('Skyfronts_SocialLogin::css/twitter/images/social_connec_twitter.png');
    }

}