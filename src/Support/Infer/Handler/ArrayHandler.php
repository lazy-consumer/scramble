<?php

namespace Dedoc\Scramble\Support\Infer\Handler;

use Dedoc\Scramble\Support\Infer\Scope\Scope;
use Dedoc\Scramble\Support\Type\ArrayType;
use PhpParser\Node;

class ArrayHandler
{
    public function shouldHandle($node)
    {
        return $node instanceof Node\Expr\Array_;
    }

    public function leave(Node\Expr\Array_ $node, Scope $scope)
    {
        $arrayItems = collect($node->items)
            ->filter()
            ->map(fn (Node\Expr\ArrayItem $arrayItem) => $scope->getType($arrayItem))
            ->all();

        $scope->setType($node, new ArrayType($arrayItems));
    }
}
