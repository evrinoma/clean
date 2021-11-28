<?php

namespace App\Command\Description;

use App\Command\Handler\DummyHandler;
use Evrinoma\FetchBundle\Description\AbstractDescription;
use Evrinoma\FetchBundle\Exception\Description\CommunicationException;
use Evrinoma\FetchBundle\Exception\Description\DescriptionNotValidException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FixerDescription extends AbstractDescription
{
//region SECTION: Fields
    private HttpClientInterface $client;
//endregion Fields

//region SECTION: Constructor
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
//endregion Constructor
//region SECTION: Public

    /**
     * @return array
     * @throws CommunicationException
     */
    public function load(): array
    {
        $response = $this->client->request(
            'GET',
            'http://data.fixer.io/api/latest?access_key=7539b4b41544dd93773c2d1aa9f60311&format=1'
        );

        return json_decode(
            '{"success":true,"timestamp":1637935744,"base":"EUR","date":"2021-11-26","rates":{"AED":4.146174,"AFN":106.618591,"ALL":121.271366,"AMD":545.541134,"ANG":2.03469,"AOA":666.981528,"ARS":113.716371,"AUD":1.580706,"AWG":2.032212,"AZN":1.912171,"BAM":1.957789,"BBD":2.279472,"BDT":96.860355,"BGN":1.956582,"BHD":0.42564,"BIF":2248.570163,"BMD":1.12885,"BND":1.546775,"BOB":7.795512,"BRL":6.307897,"BSD":1.128975,"BTC":2.0739813e-5,"BTN":84.54591,"BWP":13.352695,"BYN":2.890593,"BYR":22125.454715,"BZD":2.275668,"CAD":1.441874,"CDF":2266.730207,"CHF":1.04509,"CLF":0.033921,"CLP":936.08721,"CNY":7.214701,"COP":4491.930135,"CRC":722.161513,"CUC":1.12885,"CUP":29.914518,"GBP":0.846316,"GEL":3.510806,"GGP":0.841483,"GHS":6.928796,"GIP":0.841483,"CVE":110.37644,"CZK":25.681397,"DJF":200.97291,"DKK":7.436241,"DOP":63.8536,"DZD":157.017534,"EGP":17.746761,"ERN":16.933096,"ETB":54.410235,"EUR":1,"FJD":2.397282,"FKP":0.841483,"GMD":59.095516,"GNF":10746.850436,"GTQ":8.73593,"GYD":236.195796,"HKD":8.802714,"HNL":27.219446,"HRK":7.522315,"HTG":111.545573,"HUF":367.979048,"IDR":16240.365973,"ILS":3.589155,"IMP":0.841483,"INR":84.502984,"IQD":1646.011039,"IRR":47693.901357,"ISK":147.393619,"JEP":0.841483,"JMD":175.807953,"JOD":0.800329,"JPY":128.534781,"KES":127.063384,"KGS":95.697895,"KHR":4592.477426,"KMF":496.749933,"KPW":1015.965153,"KRW":1348.579948,"KWD":0.341592,"KYD":0.940779,"KZT":492.508163,"LAK":12232.058318,"LBP":1707.176563,"LKR":228.610339,"LRD":160.917574,"LSL":17.98258,"LTL":3.3332,"LVL":0.68283,"LYD":5.210515,"MAD":10.438847,"MDL":20.060877,"MGA":4504.387902,"MKD":61.677272,"MMK":2021.649144,"MNT":3226.499309,"MOP":9.068338,"MRO":402.99916,"MUR":48.506293,"MVR":17.382987,"MWK":921.658542,"MXN":24.510568,"MYR":4.785178,"MZN":72.053989,"NAD":17.982263,"NGN":463.325046,"NIO":39.77339,"NOK":10.191809,"NPR":135.273776,"NZD":1.656909,"OMR":0.434574,"PAB":1.128975,"PEN":4.556642,"PGK":3.963937,"PHP":56.974738,"PKR":199.427216,"PLN":4.710295,"PYG":7705.916718,"QAR":4.11014,"RON":4.949784,"RSD":117.564077,"RUB":85.14518,"RWF":1169.116634,"SAR":4.234724,"SBD":9.107336,"SCR":14.473945,"SDG":493.875661,"SEK":10.268079,"SGD":1.547258,"SHP":1.554876,"SLL":12468.145293,"SOS":661.50587,"SRD":24.292533,"STD":23364.91028,"SVC":9.87828,"SYP":1418.719781,"SZL":18.30154,"THB":38.003294,"TJS":12.740245,"TMT":3.950974,"TND":3.270847,"TOP":2.570615,"TRY":14.018066,"TTD":7.654866,"TWD":31.411936,"TZS":2598.743052,"UAH":30.585509,"UGX":4022.325463,"USD":1.12885,"UYU":49.809172,"UZS":12166.308023,"VEF":241382188826.1632,"VND":25601.183035,"VUV":125.663111,"WST":2.893965,"XAF":656.625772,"XAG":0.048044,"XAU":0.000625,"XCD":3.050772,"XDR":0.809939,"XOF":656.619949,"XPF":120.877383,"YER":282.494641,"ZAR":18.307391,"ZMK":10161.010425,"ZMW":20.066582,"ZWL":363.489153}}',
            true
        );
    }

    /**
     * @return bool
     * @throws DescriptionNotValidException
     */
    public function configure(): bool
    {
        return true;
    }

    /**
     * @return string
     */
    public function tag(): string
    {
        return DummyHandler::class;
    }

    public function name(): string
    {
        return 'fixer';
    }
//endregion Public
}