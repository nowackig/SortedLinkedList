<?php

declare(strict_types=1);

namespace Cleverg\SortedLinkedList;

use Cleverg\SortedLinkedList\Nodes\NodeInt;
use Cleverg\SortedLinkedList\Nodes\NodeString;
use PHPUnit\Framework\TestCase;

class SortedLinkedListNodeTypeTest extends TestCase
{
    public function test_available_types_names()
    {
        // arrange
        $types = array_map(
            static fn (SortedLinkedListNodeType $type) => $type->name,
            SortedLinkedListNodeType::cases()
        );

        $expected = ['INT', 'STRING'];

        // assert
        $this->assertEquals($expected, $types);
    }

    public function test_available_types()
    {
        // arrange
        $types = array_map(
            static fn (SortedLinkedListNodeType $type) => $type->value,
            SortedLinkedListNodeType::cases()
        );

        $expected = ['integer', 'string'];

        // assert
        $this->assertEquals($expected, $types);
    }

    public function test_node_type_int_class()
    {
        // arrange
        $type = SortedLinkedListNodeType::INT;

        // assert
        $this->assertEquals(NodeInt::class, $type->nodeClass());
    }

    public function test_node_type_string_class()
    {
        // arrange
        $type = SortedLinkedListNodeType::STRING;

        // assert
        $this->assertEquals(NodeString::class, $type->nodeClass());
    }
}
