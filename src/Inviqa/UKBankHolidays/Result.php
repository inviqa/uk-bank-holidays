<?php

namespace Inviqa\UKBankHolidays;

class Result
{
    /**
     * @var bool
     */
    private $success = false;

    /**
     * @var array
     */
    private $content;

    private function __construct()
    {
    }

    public static function successFromArray(array $content): Result
    {
        $response = new self();

        $response->success = true;
        $response->content = $content;

        return $response;
    }

    public function getContent(): array
    {
        return $this->getContent();
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }
}
