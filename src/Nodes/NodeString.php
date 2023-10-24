<?php

declare(strict_types=1);

namespace Cleverg\SortedLinkedList\Nodes;

use Cleverg\SortedLinkedList\Nodes\Traits\useNodeNext;
use Cleverg\SortedLinkedList\Nodes\Traits\useNodeValue;

final class NodeString implements NodeInterface
{
    use useNodeNext;
    use useNodeValue;

    public function __construct(readonly private string $value) {}
}
