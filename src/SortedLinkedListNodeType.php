<?php

declare(strict_types=1);

namespace Cleverg\SortedLinkedList;

use Cleverg\SortedLinkedList\Nodes\NodeInt;
use Cleverg\SortedLinkedList\Nodes\NodeString;

enum SortedLinkedListNodeType: string implements SortedLinkedListTypeInterface
{
    case INT = 'integer';
    case STRING = 'string';

    public function nodeClass(): string
    {
        return match ($this) {
            self::INT => NodeInt::class,
            self::STRING => NodeString::class,
        };
    }
}
