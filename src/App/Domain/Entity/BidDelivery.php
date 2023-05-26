<?php

declare(strict_types=1);

namespace App\Domain\Entity;

class BidDelivery
{
    private int $id;

    private string $code;

    /**
     * @var Bid[]
     */
    private array $bids = [];

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

    /**
     * @return Bid[]
     */
    public function getBids(): array
    {
        return $this->bids;
    }

    /**
     * @param Bid[] $bids
     */
    public function setBids(array $bids): self
    {
        $this->bids = $bids;

        return $this;
    }
}
