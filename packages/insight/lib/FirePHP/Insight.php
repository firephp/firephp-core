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

$GLOBALS['INSIGHT_AUTOLOAD'] = false;
$GLOBALS['INSIGHT_ADDITIONAL_CONFIG'] = array(
    'implements' => array(
        'cadorn.org/insight/@meta/config/0' => array(
            'plugins' => array(
                'engine' => array(
                    'api' => 'FirePHP/Plugin/Engine'
                )
            )
        )
    )
);

require_once('FirePHPCore/FirePHP.class.php');
require_once('Insight/Helper.php');

Insight_Helper::setSenderLibrary('cadorn.org/github/firephp-libs/packages/core@' . FirePHP::VERSION);

class FirePHP_Insight extends FirePHP {

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
     * Insight API wrapper
     * 
     * @see Insight_Helper::to()
     */
    public function _to() {
        $args = func_get_args();
        $to = call_user_func_array(array('Insight_Helper', 'to'), $args);
        // TODO: set traceOffset?
        return $to;
    }

    /**
     * Insight API wrapper
     * 
     * @see Insight_Helper::plugin()
     */
    public function _plugin() {
        $args = func_get_args();
        $plugin = call_user_func_array(array('Insight_Helper', 'plugin'), $args);
        return $plugin;
    }
}
