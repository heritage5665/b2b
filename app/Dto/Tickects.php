<?php

namespace App\Dto;

use Spatie\DataTransferObject\DataTransferObject;
use App\Http\Requests\TickectRequest as Request;
use App\Models\Agency;

class Tickets extends DataTransferObject
{



    public string $status;
    public string $firstname;
    public float $amount;
    public string $txnid;
    public Agency  $agency;
    public string $postedHash;
    public string $key;
    public string $productInfo;
    public int $paymentId;
    public int $userId;
    public float $paymentAmount;
    // public ?string $hashSeq;

    public static function fromRequest(Request $request): self
    {
        return new self([
            'status' => $request->input('status'),
            'agency' => $request->input('agency'),
            'key' => $request->input('key'),
            'firstname' => $request->input('firstname'),
            'amounnt' => $request->input('amount'),
            'txnid' => $request->input('txnid'),
            'postedHash' => $request->input('hash'),
            'productInfo' => $request->input("productinfo"),
            'paymentId' => $request->input('udf1'),
            'userId' => $request->input('udf2'),
            'paymentAmount' => $request->input('udf3'),
        ]);
    }

    public function getHashSeq($email)
    {
        $salt = $this->agency->payu_merchant_salt;
        //$salt . '|' . $ticket->status . '||||||||' . $ticket->paymentAmount . '|' . $ticket->userId . '|' . $paymentId . '|' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        $hash = $salt . '|' . $this->status . '||||||||' . $this->paymentAmount . '|' . $this->userId . '|' . $this->paymentId . '|' . $email . '|' . $this->firstname . '|' . $this->productinfo . '|' . $this->amount . '|' . $this->txnid . '|' . $this->key;
        return $hash;
    }

    public function identifyHash($email): bool
    {
        $hash = hash("sha512", $this->getHashSeq($email));
        return $hash == $this->postedHash;
    }
}
