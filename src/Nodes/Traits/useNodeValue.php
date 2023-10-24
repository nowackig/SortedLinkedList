<?php

declare(strict_types=1);

namespace Cleverg\SortedLinkedList\Nodes\Traits;

trait useNodeValue
{
    public function getValue(): mixed
    {
        return $this->value;
    }
}
