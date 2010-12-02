<?php
/**
 * *** BEGIN LICENSE BLOCK *****
 *  
 * This file is part of FirePHP (http://www.firephp.org/).
 * 
 * Software License Agreement (New BSD License)
 * 
 * Copyright (c) 2010, Christoph Dorn
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 * 
 *     * Redistributions of source code must retain the above copyright notice,
 *       this list of conditions and the following disclaimer.
 * 
 *     * Redistributions in binary form must reproduce the above copyright notice,
 *       this list of conditions and the following disclaimer in the documentation
 *       and/or other materials provided with the distribution.
 * 
 *     * Neither the name of Christoph Dorn nor the names of its
 *       contributors may be used to endorse or promote products derived from this
 *       software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
 * ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
 * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
 * ***** END LICENSE BLOCK *****
 * 
 * @copyright   Copyright (C) 2010 Christoph Dorn
 * @author      Christoph Dorn <christoph@christophdorn.com>
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @package     FirePHP
 */

require_once('Insight/Util.php');

$GLOBALS['INSIGHT_AUTOLOAD'] = false;
if(!isset($GLOBALS['INSIGHT_ADDITIONAL_CONFIG'])) {
    $GLOBALS['INSIGHT_ADDITIONAL_CONFIG'] = array();
}
$GLOBALS['INSIGHT_ADDITIONAL_CONFIG'] = Insight_Util::array_merge(
    $GLOBALS['INSIGHT_ADDITIONAL_CONFIG'],
    array(
        'implements' => array(
            'cadorn.org/insight/@meta/config/0' => array(
                'plugins' => array(
                    'engine' => array(
                        'api' => 'FirePHP/Plugin/Engine'
                    ),
                    'firephp' => array(
                        'api' => 'FirePHP/Plugin/FirePHP'
                    )
                )
            )
        )
    )
);

require_once('FirePHPCore/FirePHP.class.php');
require_once('Insight/Helper.php');

Insight_Helper::setSenderLibrary('cadorn.org/github/firephp-libs/packages/insight@' . FirePHP::VERSION);

class FirePHP_Insight extends FirePHP {

    /**
     * Flag to indicate if upgrade message for client extension was logged
     * 
     * @var boolean
     */
    protected static $upgradeClientMessageLogged = false;

    /**
     * Set the configuration file path
     * 
     * @param string $file The config file path
     * @return boolean FALSE if file not found TRUE otherwise
     */  
    public function setConfig($file) {
        if(!file_exists($file)) {
            return false;
        }
        if(Insight_Helper::isInitialized()) {
            throw new Exception('FirePHP::setConfig() already set');
        }
        Insight_Helper::init($file, $GLOBALS['INSIGHT_ADDITIONAL_CONFIG']);
    }

    /**
     * Enable and disable logging to Firebug
     * 
     * @param boolean $Enabled TRUE to enable, FALSE to disable
     * @return void
     */
    public function setEnabled($enabled)
    {
        Insight_Helper::getInstance()->setEnabled($enabled);
    }

    /**
     * Check if logging is enabled
     * 
     * @return boolean TRUE if enabled
     */
    public function getEnabled()
    {
        return Insight_Helper::getInstance()->getEnabled();
    }

    /**
     * Insight API wrapper
     * 
     * @see Insight_Helper::to()
     */
    public function _to() {
        self::_logUpgradeClientMessage();
        $args = func_get_args();
        $to = call_user_func_array(array('Insight_Helper', 'to'), $args);
        return $to;
    }

    /**
     * Insight API wrapper
     * 
     * @see Insight_Helper::plugin()
     */
    public function _plugin() {
        self::_logUpgradeClientMessage();
        $args = func_get_args();
        $plugin = call_user_func_array(array('Insight_Helper', 'plugin'), $args);
        return $plugin;
    }

    protected static function _logUpgradeClientMessage() {
        if(self::$upgradeClientMessageLogged) {
            return;
        }
        // x-insight: activate request header is sent and FirePHP Extension detected, but not wildfire/insight client
        $info = Insight_Helper::getInstance()->getClientInfo();
        if($info['client']=='firephp' && Insight_Util::getRequestHeader('x-insight')=='activate') {
            self::$upgradeClientMessageLogged = true;
            $firephp = self::getInstance();
            $enabled = $firephp->getEnabled();
            $firephp->setEnabled(true);
            $firephp->info('Your client only supports some features of the FirePHP library being used on the server. See http://upgrade.firephp.org/ for information on how to upgrade your client.');
            $firephp->setEnabled($enabled);
        }
    }
}
