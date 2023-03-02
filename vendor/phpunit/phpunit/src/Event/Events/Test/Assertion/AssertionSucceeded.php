<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\Test;

use function sprintf;
use PHPUnit\Event\Event;
use PHPUnit\Event\Telemetry;

/**
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class AssertionSucceeded implements Event
{
    private readonly Telemetry\Info $telemetryInfo;
<<<<<<< HEAD
    private readonly string $value;
=======
>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a
    private readonly string $constraint;
    private readonly int $count;
    private readonly string $message;

    public function __construct(Telemetry\Info $telemetryInfo, string $value, string $constraint, int $count, string $message)
    {
        $this->telemetryInfo = $telemetryInfo;
<<<<<<< HEAD
        $this->value         = $value;
=======
>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a
        $this->constraint    = $constraint;
        $this->count         = $count;
        $this->message       = $message;
    }

    public function telemetryInfo(): Telemetry\Info
    {
        return $this->telemetryInfo;
    }

<<<<<<< HEAD
    public function value(): string
    {
        return $this->value;
=======
    /**
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/5183
     */
    public function value(): string
    {
        return '';
>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a
    }

    public function count(): int
    {
        return $this->count;
    }

    public function message(): string
    {
        return $this->message;
    }

    public function asString(): string
    {
        $message = '';

        if (!empty($this->message)) {
            $message = sprintf(
                ', Message: %s',
                $this->message
            );
        }

        return sprintf(
<<<<<<< HEAD
            'Assertion Succeeded (Constraint: %s, Value: %s%s)',
            $this->constraint,
            $this->value,
=======
            'Assertion Succeeded (Constraint: %s%s)',
            $this->constraint,
>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a
            $message
        );
    }
}
