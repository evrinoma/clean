<?php
/**
 * Created by PhpStorm.
 * User: nikolns
 * Date: 2/12/18
 * Time: 10:43 AM
 */

namespace App\Security;

/**
 * Class Ldap
 *
 * @package App\Core
 */
class Ldap
{
//region SECTION: Fields
    /**
     * @var mixed $connect ldap server connector
     */
            private $connect = false;

    /**
     * @var mixed $servers list ldap servers
     */
    private $servers = null;

    private $host;
    private $port;
    private $domain;
    private $search;

    private $log  = "ldap";
    private $pass = "ldap";
//endregion Fields

//region SECTION: Constructor
    /**
     * конструктор
     *
     * @param $servers
     */
    public function __construct($servers)
    {
        $this->servers = $servers;
    }
//endregion Constructor

//region SECTION: Public
    /**
     * @param string $user
     * @param string $pass
     * @param string $domain
     *
     * @return bool
     */
    public function checkUser($user, $pass, $domain = null)
    {
        //нет пароля не нужно лезть в ldap
        if (mb_strlen($pass) !== 0) {
            //нет соединения пытаемся найти о создать подключение и проверяем пользователя
            if (!$this->connect) {
                return $this->searchLdap($user, $pass, $domain);
            } else {
                //есть соединения - проверяем пользователя
                try {
                    $bind = @ldap_bind($this->connect, $user."@".$this->domain, $pass);
                } catch (\ErrorException $e) {
                    $bind = false;
                }

                return $bind;
            }
        } else {
            return false;
        }
    }

    public function connect($domain = 'ite-ng.ru')
    {
        $this->domain  = $domain;
        $domainServers = $this->servers[$domain];
        foreach ($domainServers as $server) {
            $this->connect = ldap_connect($server['host'], $server['port']);

            if (false !== $this->connect) {
                $this->setLdapDefaultSettings();
                $this->host   = $server['host'];
                $this->port   = $server['port'];
                $this->search = $server['search'];
                break;
            }
        }

        if (!$this->connect) {
            throw new \Exception('No ldap connection');
        }

    }

    /**
     * сбрасываем соединение
     */
    public function closeLdap()
    {
        if ($this->connect) {
            ldap_unbind($this->connect);
        }
    }

    /**
     * деструктор
     */
    public function __destruct()
    {
        $this->closeLdap();
    }
//endregion Public

//region SECTION: Private
    /**
     * @param $domainServers
     * @param $user
     * @param $pass
     *
     * @return bool
     */
    private function openLdapServer($domainServers, $user, $pass)
    {
        foreach ($domainServers as $server) {
            $this->connect = ldap_connect($server['host'], $server['port']);
            if (false !== $this->connect) {
                $this->setLdapDefaultSettings();
                if (!$this->checkUser($user, $pass, $this->domain)) {
                    $this->closeLdap();
                    $this->connect = false;
                } else {
                    $this->host   = $server['host'];
                    $this->port   = $server['port'];
                    $this->search = $server['search'];

                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @param string $user   user name
     * @param string $pass   user pass
     * @param string $domain domain name
     *
     * @return mixed|resource
     */
    private function searchLdap($user, $pass, $domain)
    {
        if (!is_null($this->servers)) {
            if (null !== $domain && array_key_exists($domain, $this->servers)) {
                $this->domain  = $domain;
                $domainServers = $this->servers[$domain];
                if ($this->openLdapServer($domainServers, $user, $pass)) {
                    return true;
                }
            } else {
                foreach ($this->servers as $nameDomain => $domainServers) {
                    $this->domain = $nameDomain;
                    if ($this->openLdapServer($domainServers, $user, $pass)) {
                        return true;
                    }
                }
            }
            $this->domain = '';

            return false;
        } else {
            die("List of Servers is empty");
        }
    }
//endregion Private

//region SECTION: Getters/Setters
//    public function getList($domain = 'ite-ng.ru')
//    {
//        if (!$this->connect) {
//            $this->connect($domain);
//        }
//
//        $ad_users = array();
//
//        if (true === ldap_bind($this->connect, $this->log, $this->pass)) {
//            $ldap_base_dn  = $this->search;
//            $search_filter = '(&(objectclass=organizationalperson)(samaccountname=*))';
//            $attributes    = array(
//                'mail',
//                'givenname',
//                'sn',
//                'telephonenumber',
//                'description',
//                'physicaldeliveryofficename',
//                'department',
//                'company',
//                'samaccountname',
//                'whencreated',
//                'whenchanged',
//            );
//            $result        = ldap_search($this->connect, $ldap_base_dn, $search_filter, $attributes);
//
//            if (false !== $result) {
//                $entries = ldap_get_entries($this->connect, $result);
//                for ($x = 0; $x < $entries['count']; $x++) {
//                    if (
//                        !empty($entries[$x]['givenname'][0]) &&
//                        !empty($entries[$x]['mail'][0]) &&
//                        !empty($entries[$x]['samaccountname'][0]) &&
//                        !empty($entries[$x]['sn'][0])
//                    ) {
//                        $account = trim($entries[$x]['samaccountname'][0]);
//
//                        $ad_users[$account] = //$entries[$x];
//                            array(
//                                'email'           => isset($entries[$x]['mail'][0]) ? trim($entries[$x]['mail'][0]) : '',//strtolower(trim($entries[$x]['mail'][0])),
//                                'first_name'      => isset($entries[$x]['givenname'][0]) ? trim($entries[$x]['givenname'][0]) : '',
//                                'last_name'       => isset($entries[$x]['sn'][0]) ? trim($entries[$x]['sn'][0]) : '',//trim($entries[$x]['sn'][0]),
//                                'telephonenumber' => isset($entries[$x]['telephonenumber'][0]) ? trim($entries[$x]['telephonenumber'][0]) : '',
//                                'post'            => isset($entries[$x]['description'][0]) ? trim($entries[$x]['description'][0]) : '',
//                                'room'            => isset($entries[$x]['physicaldeliveryofficename'][0]) ? trim($entries[$x]['physicaldeliveryofficename'][0]) : '',
//                                'department'      => isset($entries[$x]['department'][0]) ? trim($entries[$x]['department'][0]) : '',
//                                'company'         => isset($entries[$x]['company'][0]) ? trim($entries[$x]['company'][0]) : '',
//                                'createdAt'       => isset($entries[$x]['whencreated'][0]) ? trim($entries[$x]['whencreated'][0]) : '',
//                                'updatedAt'       => isset($entries[$x]['whenchanged'][0]) ? trim($entries[$x]['whenchanged'][0]) : '',
//                                'dn'              => trim($entries[$x]['dn']),
//                            );
//                    }
//                }
//            }
//        }
//
//
//        return $ad_users;
//    }

    /**
     * настроки поумолчанию для ldap серверов
     */
    public function setLdapDefaultSettings()
    {
        //for win2003
        ldap_set_option($this->connect, LDAP_OPT_PROTOCOL_VERSION, 3) or die("Could set protocol version 3");
        //for win2003
        ldap_set_option($this->connect, LDAP_OPT_REFERRALS, 0) or die("Could not set referrals");
    }
//endregion Getters/Setters

}