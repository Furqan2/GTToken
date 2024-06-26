<?php

namespace App\Services;

use Web3\Web3;
use Web3\Contract;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;

class GlobalToadTokenService
{
    protected $web3;
    protected $contract;
    protected $contractAddress;

    public function __construct()
    {
        $this->web3 = new Web3(new HttpProvider(new HttpRequestManager(env('WEB3_PROVIDER'))));
        $this->contractAddress = env('GLOBAL_TOAD_TOKEN_ADDRESS');
        $this->contract = new Contract($this->web3->provider, $this->getAbi());
    }

    private function getAbi()
    {
        return json_decode(file_get_contents(storage_path('app/abi/GlobalToadToken.json')), true);
    }

    public function getBalance($address)
    {
        $balance = 0;

        $this->contract->at($this->contractAddress)->call('balanceOf', $address, function ($err, $result) use (&$balance) {
            if ($err !== null) {
                throw new \Exception($err->getMessage());
            }
            $balance = $result[0]->toString();
        });

        return $balance;
    }

}
