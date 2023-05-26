<?php

declare(strict_types=1);

namespace App\Domain\Entity;

class Bid
{

    private int $id;

    private string $code;

    private ?string $bidDeliveryCode = null;

    private ?BidDelivery $bidDelivery = null;

    public function __construct(
        int $id,
        string $code,
    ) {
        $this->id = $id;
        $this->code = $code;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getBidDeliveryCode(): ?string
    {
        return $this->bidDeliveryCode;
    }

    /**
     * @return BidDelivery|null
     */
    public function getBidDelivery(): ?BidDelivery
    {
        return $this->bidDelivery;
    }

    /**
     * @param BidDelivery|null $bidDelivery
     */
    public function setBidDelivery(?BidDelivery $bidDelivery): void
    {
        $this->bidDelivery = $bidDelivery;
        $this->bidDeliveryCode = $bidDelivery?->getCode();
    }
}
