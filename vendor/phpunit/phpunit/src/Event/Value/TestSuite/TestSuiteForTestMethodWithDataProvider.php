<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\TestSuite;

use PHPUnit\Event\Code\TestCollection;

/**
 * @psalm-immutable
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class TestSuiteForTestMethodWithDataProvider extends TestSuite
{
    /**
     * @psalm-var class-string
     */
    private readonly string $className;
<<<<<<< HEAD

    /**
     * @psalm-var non-empty-string
     */
=======
>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a
    private readonly string $methodName;
    private readonly string $file;
    private readonly int $line;

    /**
<<<<<<< HEAD
     * @psalm-param class-string $className
     * @psalm-param non-empty-string $methodName
=======
     * @psalm-param class-string $name
>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a
     */
    public function __construct(string $name, int $size, TestCollection $tests, string $className, string $methodName, string $file, int $line)
    {
        parent::__construct($name, $size, $tests);

        $this->className  = $className;
        $this->methodName = $methodName;
        $this->file       = $file;
        $this->line       = $line;
    }

    /**
     * @psalm-return class-string
     */
    public function className(): string
    {
        return $this->className;
    }

<<<<<<< HEAD
    /**
     * @psalm-return non-empty-string
     */
=======
>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a
    public function methodName(): string
    {
        return $this->methodName;
    }

    public function file(): string
    {
        return $this->file;
    }

    public function line(): int
    {
        return $this->line;
    }

    /**
     * @psalm-assert-if-true TestSuiteForTestMethodWithDataProvider $this
     */
    public function isForTestMethodWithDataProvider(): bool
    {
        return true;
    }
}
