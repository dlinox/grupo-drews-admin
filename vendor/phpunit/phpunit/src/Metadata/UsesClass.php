<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata;

/**
<<<<<<< HEAD
 * @psalm-immutable
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
=======
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 *
 * @psalm-immutable
>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a
 */
final class UsesClass extends Metadata
{
    /**
     * @psalm-var class-string
     */
    private readonly string $className;

    /**
     * @psalm-param class-string $className
     */
    protected function __construct(int $level, string $className)
    {
        parent::__construct($level);

        $this->className = $className;
    }

    public function isUsesClass(): bool
    {
        return true;
    }

    /**
     * @psalm-return class-string
     */
    public function className(): string
    {
        return $this->className;
    }

    /**
     * @psalm-return class-string
<<<<<<< HEAD
     *
     * @internal This method is not covered by the backward compatibility promise for PHPUnit
=======
>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a
     */
    public function asStringForCodeUnitMapper(): string
    {
        return $this->className;
    }
}
