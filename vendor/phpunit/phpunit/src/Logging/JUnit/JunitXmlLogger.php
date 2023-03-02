<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Logging\JUnit;

use function assert;
use function basename;
<<<<<<< HEAD
=======
use function class_exists;
>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a
use function is_int;
use function sprintf;
use function str_replace;
use function trim;
use DOMDocument;
use DOMElement;
use PHPUnit\Event\Code\Test;
use PHPUnit\Event\Code\TestMethod;
<<<<<<< HEAD
=======
use PHPUnit\Event\Code\Throwable;
>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a
use PHPUnit\Event\EventFacadeIsSealedException;
use PHPUnit\Event\Facade;
use PHPUnit\Event\InvalidArgumentException;
use PHPUnit\Event\Telemetry\HRTime;
<<<<<<< HEAD
use PHPUnit\Event\Telemetry\Info;
=======
>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a
use PHPUnit\Event\Test\Errored;
use PHPUnit\Event\Test\Failed;
use PHPUnit\Event\Test\Finished;
use PHPUnit\Event\Test\MarkedIncomplete;
use PHPUnit\Event\Test\Prepared;
use PHPUnit\Event\Test\Skipped;
use PHPUnit\Event\TestData\NoDataSetFromDataProviderException;
use PHPUnit\Event\TestSuite\Started;
use PHPUnit\Event\UnknownSubscriberTypeException;
use PHPUnit\TextUI\Output\Printer;
use PHPUnit\Util\Xml;
<<<<<<< HEAD
=======
use ReflectionClass;
use ReflectionException;
>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class JunitXmlLogger
{
    private readonly Printer $printer;
    private DOMDocument $document;
    private DOMElement $root;

    /**
     * @var DOMElement[]
     */
    private array $testSuites = [];

    /**
     * @psalm-var array<int,int>
     */
    private array $testSuiteTests = [0];

    /**
     * @psalm-var array<int,int>
     */
    private array $testSuiteAssertions = [0];

    /**
     * @psalm-var array<int,int>
     */
    private array $testSuiteErrors = [0];

    /**
     * @psalm-var array<int,int>
     */
    private array $testSuiteFailures = [0];

    /**
     * @psalm-var array<int,int>
     */
    private array $testSuiteSkipped = [0];

    /**
     * @psalm-var array<int,int>
     */
    private array $testSuiteTimes        = [0];
    private int $testSuiteLevel          = 0;
    private ?DOMElement $currentTestCase = null;
    private ?HRTime $time                = null;
<<<<<<< HEAD
    private bool $prepared               = false;
=======
>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a

    /**
     * @throws EventFacadeIsSealedException
     * @throws UnknownSubscriberTypeException
     */
    public function __construct(Printer $printer)
    {
        $this->printer = $printer;

        $this->registerSubscribers();
        $this->createDocument();
    }

    public function flush(): void
    {
        $this->printer->print($this->document->saveXML());

        $this->printer->flush();
    }

    public function testSuiteStarted(Started $event): void
    {
        $testSuite = $this->document->createElement('testsuite');
        $testSuite->setAttribute('name', $event->testSuite()->name());

<<<<<<< HEAD
        if ($event->testSuite()->isForTestClass()) {
            $testSuite->setAttribute('file', $event->testSuite()->file());
=======
        if (class_exists($event->testSuite()->name(), false)) {
            try {
                $class = new ReflectionClass($event->testSuite()->name());

                $testSuite->setAttribute('file', $class->getFileName());
            } catch (ReflectionException) {
            }
>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a
        }

        if ($this->testSuiteLevel > 0) {
            $this->testSuites[$this->testSuiteLevel]->appendChild($testSuite);
        } else {
            $this->root->appendChild($testSuite);
        }

        $this->testSuiteLevel++;
        $this->testSuites[$this->testSuiteLevel]          = $testSuite;
        $this->testSuiteTests[$this->testSuiteLevel]      = 0;
        $this->testSuiteAssertions[$this->testSuiteLevel] = 0;
        $this->testSuiteErrors[$this->testSuiteLevel]     = 0;
        $this->testSuiteFailures[$this->testSuiteLevel]   = 0;
        $this->testSuiteSkipped[$this->testSuiteLevel]    = 0;
        $this->testSuiteTimes[$this->testSuiteLevel]      = 0;
    }

    public function testSuiteFinished(): void
    {
        $this->testSuites[$this->testSuiteLevel]->setAttribute(
            'tests',
            (string) $this->testSuiteTests[$this->testSuiteLevel]
        );

        $this->testSuites[$this->testSuiteLevel]->setAttribute(
            'assertions',
            (string) $this->testSuiteAssertions[$this->testSuiteLevel]
        );

        $this->testSuites[$this->testSuiteLevel]->setAttribute(
            'errors',
            (string) $this->testSuiteErrors[$this->testSuiteLevel]
        );

        $this->testSuites[$this->testSuiteLevel]->setAttribute(
            'failures',
            (string) $this->testSuiteFailures[$this->testSuiteLevel]
        );

        $this->testSuites[$this->testSuiteLevel]->setAttribute(
            'skipped',
            (string) $this->testSuiteSkipped[$this->testSuiteLevel]
        );

        $this->testSuites[$this->testSuiteLevel]->setAttribute(
            'time',
            sprintf('%F', $this->testSuiteTimes[$this->testSuiteLevel])
        );

        if ($this->testSuiteLevel > 1) {
            $this->testSuiteTests[$this->testSuiteLevel - 1] += $this->testSuiteTests[$this->testSuiteLevel];
            $this->testSuiteAssertions[$this->testSuiteLevel - 1] += $this->testSuiteAssertions[$this->testSuiteLevel];
            $this->testSuiteErrors[$this->testSuiteLevel - 1] += $this->testSuiteErrors[$this->testSuiteLevel];
            $this->testSuiteFailures[$this->testSuiteLevel - 1] += $this->testSuiteFailures[$this->testSuiteLevel];
            $this->testSuiteSkipped[$this->testSuiteLevel - 1] += $this->testSuiteSkipped[$this->testSuiteLevel];
            $this->testSuiteTimes[$this->testSuiteLevel - 1] += $this->testSuiteTimes[$this->testSuiteLevel];
        }

        $this->testSuiteLevel--;
    }

    /**
     * @throws InvalidArgumentException
     * @throws NoDataSetFromDataProviderException
     */
    public function testPrepared(Prepared $event): void
    {
        $this->createTestCase($event);
<<<<<<< HEAD
        $this->prepared = true;
=======
>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testFinished(Finished $event): void
    {
<<<<<<< HEAD
        $this->handleFinish($event->telemetryInfo(), $event->numberOfAssertionsPerformed());
=======
        assert($this->currentTestCase !== null);
        assert($this->time !== null);

        $time = $event->telemetryInfo()->time()->duration($this->time)->asFloat();

        $this->testSuiteAssertions[$this->testSuiteLevel] += $event->numberOfAssertionsPerformed();

        $this->currentTestCase->setAttribute(
            'assertions',
            (string) $event->numberOfAssertionsPerformed()
        );

        $this->currentTestCase->setAttribute(
            'time',
            sprintf('%F', $time)
        );

        $this->testSuites[$this->testSuiteLevel]->appendChild(
            $this->currentTestCase
        );

        $this->testSuiteTests[$this->testSuiteLevel]++;
        $this->testSuiteTimes[$this->testSuiteLevel] += $time;

        $this->currentTestCase = null;
        $this->time            = null;
>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a
    }

    /**
     * @throws InvalidArgumentException
     * @throws NoDataSetFromDataProviderException
     */
    public function testMarkedIncomplete(MarkedIncomplete $event): void
    {
        $this->handleIncompleteOrSkipped($event);
    }

    /**
     * @throws InvalidArgumentException
     * @throws NoDataSetFromDataProviderException
     */
    public function testSkipped(Skipped $event): void
    {
        $this->handleIncompleteOrSkipped($event);
    }

    /**
     * @throws InvalidArgumentException
     * @throws NoDataSetFromDataProviderException
     */
    public function testErrored(Errored $event): void
    {
<<<<<<< HEAD
        $this->handleFault($event, 'error');
=======
        $this->handleFault($event->test(), $event->throwable(), 'error');
>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a

        $this->testSuiteErrors[$this->testSuiteLevel]++;
    }

    /**
     * @throws InvalidArgumentException
     * @throws NoDataSetFromDataProviderException
     */
    public function testFailed(Failed $event): void
    {
<<<<<<< HEAD
        $this->handleFault($event, 'failure');
=======
        $this->handleFault($event->test(), $event->throwable(), 'failure');
>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a

        $this->testSuiteFailures[$this->testSuiteLevel]++;
    }

    /**
<<<<<<< HEAD
     * @throws InvalidArgumentException
     */
    private function handleFinish(Info $telemetryInfo, int $numberOfAssertionsPerformed): void
    {
        assert($this->currentTestCase !== null);
        assert($this->time !== null);

        $time = $telemetryInfo->time()->duration($this->time)->asFloat();

        $this->testSuiteAssertions[$this->testSuiteLevel] += $numberOfAssertionsPerformed;

        $this->currentTestCase->setAttribute(
            'assertions',
            (string) $numberOfAssertionsPerformed
        );

        $this->currentTestCase->setAttribute(
            'time',
            sprintf('%F', $time)
        );

        $this->testSuites[$this->testSuiteLevel]->appendChild(
            $this->currentTestCase
        );

        $this->testSuiteTests[$this->testSuiteLevel]++;
        $this->testSuiteTimes[$this->testSuiteLevel] += $time;

        $this->currentTestCase = null;
        $this->time            = null;
        $this->prepared        = false;
    }

    /**
=======
>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a
     * @throws EventFacadeIsSealedException
     * @throws UnknownSubscriberTypeException
     */
    private function registerSubscribers(): void
    {
        Facade::registerSubscribers(
            new TestSuiteStartedSubscriber($this),
            new TestSuiteFinishedSubscriber($this),
            new TestPreparedSubscriber($this),
            new TestFinishedSubscriber($this),
            new TestErroredSubscriber($this),
            new TestFailedSubscriber($this),
            new TestMarkedIncompleteSubscriber($this),
            new TestSkippedSubscriber($this),
            new TestRunnerExecutionFinishedSubscriber($this),
        );
    }

    private function createDocument(): void
    {
        $this->document               = new DOMDocument('1.0', 'UTF-8');
        $this->document->formatOutput = true;

        $this->root = $this->document->createElement('testsuites');
        $this->document->appendChild($this->root);
    }

    /**
     * @throws InvalidArgumentException
     * @throws NoDataSetFromDataProviderException
     */
<<<<<<< HEAD
    private function handleFault(Errored|Failed $event, string $type): void
    {
        if (!$this->prepared) {
            $this->createTestCase($event);
        }

        assert($this->currentTestCase !== null);

        $buffer = $this->testAsString($event->test());

        $throwable = $event->throwable();
=======
    private function handleFault(Test $test, Throwable $throwable, string $type): void
    {
        assert($this->currentTestCase !== null);

        $buffer = $this->testAsString($test);

>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a
        $buffer .= trim(
            $throwable->description() . PHP_EOL .
            $throwable->stackTrace()
        );

        $fault = $this->document->createElement(
            $type,
            Xml::prepareString($buffer)
        );

        $fault->setAttribute('type', $throwable->className());

        $this->currentTestCase->appendChild($fault);
<<<<<<< HEAD

        if (!$this->prepared) {
            $this->handleFinish($event->telemetryInfo(), 0);
        }
=======
>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a
    }

    /**
     * @throws InvalidArgumentException
     * @throws NoDataSetFromDataProviderException
     */
    private function handleIncompleteOrSkipped(MarkedIncomplete|Skipped $event): void
    {
<<<<<<< HEAD
        if (!$this->prepared) {
=======
        if ($this->currentTestCase === null) {
>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a
            $this->createTestCase($event);
        }

        assert($this->currentTestCase !== null);

        $skipped = $this->document->createElement('skipped');

        $this->currentTestCase->appendChild($skipped);

        $this->testSuiteSkipped[$this->testSuiteLevel]++;
<<<<<<< HEAD

        if (!$this->prepared) {
            $this->handleFinish($event->telemetryInfo(), 0);
        }
=======
>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a
    }

    /**
     * @throws InvalidArgumentException
     * @throws NoDataSetFromDataProviderException
     */
    private function testAsString(Test $test): string
    {
        if ($test->isPhpt()) {
            return basename($test->file());
        }

        assert($test instanceof TestMethod);

        return sprintf(
            '%s::%s%s',
            $test->className(),
            $this->name($test),
            PHP_EOL,
        );
    }

    /**
     * @throws InvalidArgumentException
     * @throws NoDataSetFromDataProviderException
     */
    private function name(Test $test): string
    {
        if ($test->isPhpt()) {
            return basename($test->file());
        }

        assert($test instanceof TestMethod);

        if (!$test->testData()->hasDataFromDataProvider()) {
            return $test->methodName();
        }

        $dataSetName = $test->testData()->dataFromDataProvider()->dataSetName();

        if (is_int($dataSetName)) {
            return sprintf(
                '%s with data set #%d',
                $test->methodName(),
                $dataSetName
            );
        }

        return sprintf(
            '%s with data set "%s"',
            $test->methodName(),
            $dataSetName
        );
    }

    /**
     * @throws InvalidArgumentException
     * @throws NoDataSetFromDataProviderException
<<<<<<< HEAD
     *
     * @psalm-assert !null $this->currentTestCase
     */
    private function createTestCase(Prepared|MarkedIncomplete|Skipped|Errored|Failed $event): void
=======
     */
    private function createTestCase(Prepared|MarkedIncomplete|Skipped $event): void
>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a
    {
        $testCase = $this->document->createElement('testcase');

        $test = $event->test();

        $testCase->setAttribute('name', $this->name($test));
        $testCase->setAttribute('file', $test->file());

        if ($test->isTestMethod()) {
            assert($test instanceof TestMethod);

            $testCase->setAttribute('line', (string) $test->line());
            $testCase->setAttribute('class', $test->className());
            $testCase->setAttribute('classname', str_replace('\\', '.', $test->className()));
        }

        $this->currentTestCase = $testCase;
        $this->time            = $event->telemetryInfo()->time();
    }
}
