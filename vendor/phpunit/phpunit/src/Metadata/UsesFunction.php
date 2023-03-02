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
final class UsesFunction extends Metadata
{
    private readonly string $functionName;

    public function __construct(int $level, string $functionName)
    {
        parent::__construct($level);

        $this->functionName = $functionName;
    }

    public function isUsesFunction(): bool
    {
        return true;
    }

    public function functionName(): string
    {
        return $this->functionName;
    }

<<<<<<< HEAD
    /**
     * @internal This method is not covered by the backward compatibility promise for PHPUnit
     */
=======
>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a
    public function asStringForCodeUnitMapper(): string
    {
        return '::' . $this->functionName;
    }
}
