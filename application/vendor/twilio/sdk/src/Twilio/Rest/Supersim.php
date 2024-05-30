<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest;

use Twilio\Domain;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Supersim\V1;

/**
 * @property \Twilio\Rest\Supersim\V1 $v1
 * @property \Twilio\Rest\Supersim\V1\EsimProfileList $esimProfiles
 * @property \Twilio\Rest\Supersim\V1\FleetList $fleets
 * @property \Twilio\Rest\Supersim\V1\IpCommandList $ipCommands
 * @property \Twilio\Rest\Supersim\V1\NetworkList $networks
 * @property \Twilio\Rest\Supersim\V1\NetworkAccessProfileList $networkAccessProfiles
 * @property \Twilio\Rest\Supersim\V1\SimList $sims
 * @property \Twilio\Rest\Supersim\V1\SmsCommandList $smsCommands
 * @property \Twilio\Rest\Supersim\V1\UsageRecordList $usageRecords
 * @method \Twilio\Rest\Supersim\V1\EsimProfileContext esimProfiles(string $sid)
 * @method \Twilio\Rest\Supersim\V1\FleetContext fleets(string $sid)
 * @method \Twilio\Rest\Supersim\V1\IpCommandContext ipCommands(string $sid)
 * @method \Twilio\Rest\Supersim\V1\NetworkContext networks(string $sid)
 * @method \Twilio\Rest\Supersim\V1\NetworkAccessProfileContext networkAccessProfiles(string $sid)
 * @method \Twilio\Rest\Supersim\V1\SimContext sims(string $sid)
 * @method \Twilio\Rest\Supersim\V1\SmsCommandContext smsCommands(string $sid)
 */
class Supersim extends Domain {
    protected $_v1;

    /**
     * Construct the Supersim Domain
     *
     * @param Client $client Client to communicate with Twilio
     */
    public function __construct(Client $client) {
        parent::__construct($client);

        $this->baseUrl = 'https://supersim.twilio.com';
    }

    /**
     * @return V1 Version v1 of supersim
     */
    protected function getV1(): V1 {
        if (!$this->_v1) {
            $this->_v1 = new V1($this);
        }
        return $this->_v1;
    }

    /**
     * Magic getter to lazy load version
     *
     * @param string $name Version to return
     * @return \Twilio\Version The requested version
     * @throws TwilioException For unknown versions
     */
    public function __get(string $name) {
        $method = 'get' . \ucfirst($name);
        if (\method_exists($this, $method)) {
            return $this->$method();
        }

        throw new TwilioException('Unknown version ' . $name);
    }

    /**
     * Magic caller to get resource contexts
     *
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return \Twilio\InstanceContext The requested resource context
     * @throws TwilioException For unknown resource
     */
    public function __call(string $name, array $arguments) {
        $method = 'context' . \ucfirst($name);
        if (\method_exists($this, $method)) {
            return \call_user_func_array([$this, $method], $arguments);
        }

        throw new TwilioException('Unknown context ' . $name);
    }

    protected function getEsimProfiles(): \Twilio\Rest\Supersim\V1\EsimProfileList {
        return $this->v1->esimProfiles;
    }

    /**
     * @param string $sid The SID of the eSIM Profile resource to fetch
     */
    protected function contextEsimProfiles(string $sid): \Twilio\Rest\Supersim\V1\EsimProfileContext {
        return $this->v1->esimProfiles($sid);
    }

    protected function getFleets(): \Twilio\Rest\Supersim\V1\FleetList {
        return $this->v1->fleets;
    }

    /**
     * @param string $sid The SID that identifies the resource to fetch
     */
    protected function contextFleets(string $sid): \Twilio\Rest\Supersim\V1\FleetContext {
        return $this->v1->fleets($sid);
    }

    protected function getIpCommands(): \Twilio\Rest\Supersim\V1\IpCommandList {
        return $this->v1->ipCommands;
    }

    /**
     * @param string $sid The SID that identifies the resource to fetch
     */
    protected function contextIpCommands(string $sid): \Twilio\Rest\Supersim\V1\IpCommandContext {
        return $this->v1->ipCommands($sid);
    }

    protected function getNetworks(): \Twilio\Rest\Supersim\V1\NetworkList {
        return $this->v1->networks;
    }

    /**
     * @param string $sid The SID of the Network resource to fetch
     */
    protected function contextNetworks(string $sid): \Twilio\Rest\Supersim\V1\NetworkContext {
        return $this->v1->networks($sid);
    }

    protected function getNetworkAccessProfiles(): \Twilio\Rest\Supersim\V1\NetworkAccessProfileList {
        return $this->v1->networkAccessProfiles;
    }

    /**
     * @param string $sid The SID that identifies the resource to fetch
     */
    protected function contextNetworkAccessProfiles(string $sid): \Twilio\Rest\Supersim\V1\NetworkAccessProfileContext {
        return $this->v1->networkAccessProfiles($sid);
    }

    protected function getSims(): \Twilio\Rest\Supersim\V1\SimList {
        return $this->v1->sims;
    }

    /**
     * @param string $sid The SID that identifies the resource to fetch
     */
    protected function contextSims(string $sid): \Twilio\Rest\Supersim\V1\SimContext {
        return $this->v1->sims($sid);
    }

    protected function getSmsCommands(): \Twilio\Rest\Supersim\V1\SmsCommandList {
        return $this->v1->smsCommands;
    }

    /**
     * @param string $sid The SID that identifies the resource to fetch
     */
    protected function contextSmsCommands(string $sid): \Twilio\Rest\Supersim\V1\SmsCommandContext {
        return $this->v1->smsCommands($sid);
    }

    protected function getUsageRecords(): \Twilio\Rest\Supersim\V1\UsageRecordList {
        return $this->v1->usageRecords;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        return '[Twilio.Supersim]';
    }
}