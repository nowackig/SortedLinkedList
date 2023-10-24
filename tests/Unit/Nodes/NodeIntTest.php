<?php

declare(strict_types=1);

namespace Cleverg\SortedLinkedList\Tests\Unit\Nodes;

use Cleverg\SortedLinkedList\Nodes\NodeInt;
use Cleverg\SortedLinkedList\Nodes\NodeInterface;
use PHPUnit\Framework\TestCase;

class NodeIntTest extends TestCase
{
    public function test_implements_interface()
    {
        // arrange
        $node = new NodeInt(1);

        // assert
        $this->assertInstanceOf(NodeInterface::class, $node);
    }

    public function test_node_next()
    {
        // arrange
        $node = new NodeInt(1);
        $nodeNext = new NodeInt(2);

        // act
        $node->setNextNode($nodeNext);

        // assert
        $this->assertInstanceOf(NodeInterface::class, $nodeNext);
        $this->assertEquals($nodeNext, $node->getNextNode());
    }
}
