<?php

use Core\Container;

test('it can resolve something out of the container', function () {
    // Arrange
    $container = new Container();

    $container->bind('foo', fn() => 'bar');

    // Action
    $result = $container->resolve('foo');

    // Expectations
    expect($result)->toEqual('bar');
});